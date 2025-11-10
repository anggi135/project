// proxy.cjs (robust import for http-mitm-proxy + axios)
const axios = require('axios');
const os = require('os');

let httpMitmProxy;
try {
  httpMitmProxy = require('http-mitm-proxy');
} catch (e) {
  console.error('[proxy] gagal require http-mitm-proxy:', e && e.message ? e.message : e);
  process.exit(1);
}

// create proxy instance supporting multiple export shapes
let proxy;
if (typeof httpMitmProxy === 'function') {
  // classic: const Proxy = require('http-mitm-proxy'); const proxy = Proxy();
  try { proxy = httpMitmProxy(); } catch (e) { /* ignore */ }
}
if (!proxy && httpMitmProxy && typeof httpMitmProxy.createProxy === 'function') {
  // some builds: require('http-mitm-proxy').createProxy()
  proxy = httpMitmProxy.createProxy();
}
if (!proxy && httpMitmProxy && httpMitmProxy.default && typeof httpMitmProxy.default.createProxy === 'function') {
  // ESM-ish default export
  proxy = httpMitmProxy.default.createProxy();
}
if (!proxy) {
  console.error('[proxy] Tidak bisa membuat instance http-mitm-proxy. Versi/ekspor paket tidak dikenali.');
  console.error('Pastikan kamu menginstall paket "http-mitm-proxy" yang kompatibel.');
  process.exit(1);
}

const API_ENDPOINT = process.env.LARAVEL_API || 'http://127.0.0.1:8000/api/intercept';
const API_TOKEN = process.env.LARAVEL_API_TOKEN || null;
const PORT = parseInt(process.env.PROXY_PORT || '8080', 10);

function concatBuffer(oldBuf, chunk) {
  if (!oldBuf) return Buffer.from(chunk || '');
  return Buffer.concat([oldBuf, Buffer.from(chunk || '')]);
}
function toBase64(buf) { if (!buf) return null; return Buffer.from(buf).toString('base64'); }
function shortId() { return `${Date.now()}-${Math.random().toString(36).slice(2,8)}`; }

proxy.onError((ctx, err) => {
  console.error('[proxy] error:', err && err.message ? err.message : err);
});

proxy.onRequest((ctx, callback) => {
  let reqBuf = Buffer.alloc(0);
  // request data may come in many chunks
  try {
    ctx.onRequestData((ctx2, chunk, cb) => {
      if (chunk) reqBuf = concatBuffer(reqBuf, chunk);
      cb(null, chunk);
    });

    ctx.onRequestEnd((ctx2, cb) => {
      ctx.requestBodyBuffer = reqBuf.length ? reqBuf : null;
      cb();
    });
  } catch (e) {
    // older/newer API shapes may require different hook names; still proceed
    console.warn('[proxy] warning in onRequest hook:', e && e.message ? e.message : e);
  }
  return callback();
});

proxy.onResponse((ctx, callback) => {
  let resBuf = Buffer.alloc(0);
  try {
    ctx.onResponseData((ctx2, chunk, cb) => {
      if (chunk) resBuf = concatBuffer(resBuf, chunk);
      cb(null, chunk);
    });

    ctx.onResponseEnd(async (ctx2, cb) => {
      try {
        const req = ctx.clientToProxyRequest;
        const res = ctx.serverToProxyResponse;

        const payload = {
          id: shortId(),
          host: req.headers && (req.headers.host || null),
          client_ip: (req.socket && (req.socket.remoteAddress || req.socket.localAddress)) || null,
          method: req.method || null,
          url: (req.url && req.url.toString()) || null,
          request_headers: req.headers || {},
          request_body_base64: ctx.requestBodyBuffer ? toBase64(ctx.requestBodyBuffer) : null,
          request_body_size: ctx.requestBodyBuffer ? ctx.requestBodyBuffer.length : 0,
          response_status: res ? (res.statusCode || null) : null,
          response_headers: res ? (res.headers || {}) : {},
          response_body_base64: resBuf && resBuf.length ? toBase64(resBuf) : null,
          response_body_size: resBuf ? resBuf.length : 0,
          timestamp: new Date().toISOString(),
          platform: os.platform(),
        };

        const headers = { 'Content-Type': 'application/json' };
        if (API_TOKEN) headers['Authorization'] = `Bearer ${API_TOKEN}`;

        // post but do not block the proxy response
        axios.post(API_ENDPOINT, payload, { headers, timeout: 5000 })
          .catch(err => console.error('[proxy] POST->Laravel failed:', err && err.message ? err.message : err));
      } catch (e) {
        console.error('[proxy] onResponse processing failed:', e && e.message ? e.message : e);
      } finally {
        cb();
      }
    });
  } catch (e) {
    console.warn('[proxy] warning in onResponse hook:', e && e.message ? e.message : e);
    // still call callback to avoid hanging
    return callback();
  }
  return callback();
});

proxy.listen({ port: PORT }, () => {
  console.log(`🔍 MITM proxy listening on port ${PORT}`);
  console.log(`→ Forward HTTP(S) traffic through localhost:${PORT}`);
  console.log(`→ Laravel endpoint: ${API_ENDPOINT}`);
  if (API_TOKEN) console.log('→ Using API token auth');
  console.log('Note: this proxy generates a local CA; trust it in your OS/browser (see docs).');
});
