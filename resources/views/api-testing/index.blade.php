@extends('layouts.app')

@section('content')
<style>
  /* =========================
     BASE LIGHT THEME + LAYOUT
  ========================== */
  :root {
    --bg-100: #f8fafc;
    --bg-200: #f1f5f9;
    --bg-300: #e2e8f0;
    --text-dark: #111827;
    --text-muted: #6b7280;
    --card: #ffffff;
    --primary: #2563eb;
    --primary-light: #60a5fa;
    --border: #d1d5db;
  }

  html {
    scroll-behavior: smooth;
  }

  body {
    background: var(--bg-100);
    color: var(--text-dark);
  }

  .api-container { padding: 40px 0; }

  .card.api-card {
    background: var(--card);
    border: 1px solid var(--border);
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    border-radius: 12px;
  }

  /* =========================
     ANIMATIONS
  ========================== */
  .fade-in-up {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 1s ease-out forwards;
  }
  @keyframes fadeInUp {
    to { opacity: 1; transform: translateY(0); }
  }
  .delay-1 { animation-delay: .3s; }
  .delay-2 { animation-delay: .6s; }
  .delay-3 { animation-delay: .9s; }

  /* =========================
     COMPONENTS
  ========================== */
  .list-group-item {
    background: transparent;
    color: var(--text-dark);
    border: 1px solid var(--border);
    transition: all .2s;
  }
  .list-group-item:hover {
    background: var(--bg-200);
    transform: translateX(3px);
  }

  .form-control, .form-select {
    background: var(--bg-100);
    border: 1px solid var(--border);
    color: var(--text-dark);
    transition: all .2s;
  }
  .form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 8px rgba(37,99,235,0.25);
  }
  .form-control::placeholder { color: var(--text-muted); }

  .btn-outline-light {
    color: var(--primary);
    border-color: var(--primary);
  }
  .btn-outline-light:hover {
    background: var(--primary);
    color: white;
  }

  .btn-dark {
    background: var(--primary);
    border: none;
  }
  .btn-dark:hover {
    background: var(--primary-light);
  }

  .kv-row .form-control { height: 38px; font-size: 0.85rem; }

  #respHeaders, #respBody {
    background: var(--bg-200);
    border: 1px solid var(--border);
    border-radius: 6px;
    color: var(--text-dark);
  }

  .meta-pill {
    background: var(--bg-200);
    border: 1px solid var(--border);
    color: var(--text-muted);
    border-radius: 8px;
    font-size: .85rem;
    padding: 6px 10px;
  }

  pre::-webkit-scrollbar { height: 8px; width: 8px; }
  pre::-webkit-scrollbar-thumb {
    background: var(--bg-300);
    border-radius: 6px;
  }

  @media (max-width: 991px) {
    .col-lg-3 { order: 2; }
    .col-lg-9 { order: 1; }
    .api-container .row { gap: 1rem; }
    .kv-row { flex-direction: column; }
  }
</style>

<!-- HERO -->
<section class="text-white py-5" style="background: linear-gradient(to right, #1f2937, #111827);">
  <div class="container text-center">
    <h1 class="display-5 fw-bold animate__animated animate__fadeInDown">⚙️ API Testing Panel</h1>
    <p class="lead animate__animated animate__fadeInUp">Uji endpoint API-mu dengan tema terang profesional</p>
  </div>
</section>

<section class="api-container fade-in-up delay-1">
  <div class="container">
    <div class="row g-4">
      <!-- LEFT COLUMN -->
      <div class="col-lg-3 fade-in-up delay-2">
        <div class="card api-card p-3 mb-4">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="mb-0">Saved Requests</h6>
            <button id="refreshSaved" class="btn btn-sm btn-outline-light">Refresh</button>
          </div>
          <div id="savedList" class="list-group my-2" style="max-height:340px; overflow:auto;"></div>
          <div class="d-grid mt-2">
            <button id="newSaved" class="btn btn-sm btn-success">+ New Saved</button>
          </div>
        </div>

        <div class="card api-card p-3 fade-in-up delay-3">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="mb-0">History</h6>
            <small class="text-muted">recent</small>
          </div>
          <div id="historyList" style="max-height:220px; overflow:auto; font-size:0.9rem;"></div>
        </div>
      </div>

      <!-- RIGHT COLUMN -->
      <div class="col-lg-9 fade-in-up delay-3">
        <div class="card api-card p-4 shadow-lg">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Send Request</h4>
            <button id="saveRequestBtn" class="btn btn-sm btn-outline-light">Save</button>
          </div>

          <!-- FORM -->
          <form id="apiForm" class="mb-3">
            <div class="row g-2 align-items-center">
              <div class="col-md-2">
                <select id="method" class="form-select">
                  <option>GET</option>
                  <option>POST</option>
                  <option>PUT</option>
                  <option>PATCH</option>
                  <option>DELETE</option>
                </select>
              </div>
              <div class="col-md-7">
                <input id="url" class="form-control" placeholder="Enter API URL (https://...)" required>
              </div>
              <div class="col-md-2">
                <input id="timeout" type="number" class="form-control" min="1" placeholder="timeout s" value="10">
              </div>
              <div class="col-md-1 d-grid">
                <button type="submit" class="btn btn-dark">Send</button>
              </div>
            </div>
          </form>

          <!-- TABS -->
          <ul class="nav nav-tabs mb-2">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#paramsTab">Params</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#headersTab">Headers</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#bodyTab">Body</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#authTab">Auth</button></li>
          </ul>

          <div class="tab-content p-3 border rounded-bottom">
            <div class="tab-pane fade show active" id="paramsTab">
              <div id="paramsList" class="mb-2"></div>
              <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-light btn-sm" id="addParam">+ Add Param</button>
                <button type="button" class="btn btn-outline-danger btn-sm" id="clearParams">Clear</button>
              </div>
            </div>

            <div class="tab-pane fade" id="headersTab">
              <div id="headersList" class="mb-2"></div>
              <div class="d-flex gap-2">
                <button type="button" class="btn btn-outline-light btn-sm" id="addHeader">+ Add Header</button>
                <button type="button" class="btn btn-outline-danger btn-sm" id="clearHeaders">Clear</button>
              </div>
            </div>

            <div class="tab-pane fade" id="bodyTab">
              <label class="form-label">Raw Body</label>
              <textarea id="body" class="form-control" rows="6" placeholder='Raw body (JSON, XML, text)...'></textarea>
            </div>

            <div class="tab-pane fade" id="authTab">
              <div class="mb-2">
                <label class="form-label">Bearer Token</label>
                <input id="bearer" class="form-control" placeholder="Token (Authorization: Bearer ...)">
              </div>
              <div class="form-text">If you fill token it will be added to headers automatically.</div>
            </div>
          </div>

          <!-- RESPONSE -->
          <div class="mt-4 fade-in-up delay-4">
            <h5>Response</h5>
            <div class="resp-toolbar d-flex gap-2 mb-2">
              <div class="btn-group">
                <button id="modePretty" class="btn btn-sm btn-outline-light active">Pretty</button>
                <button id="modeRaw" class="btn btn-sm btn-outline-light">Raw</button>
                <button id="modeHeaders" class="btn btn-sm btn-outline-light">Headers</button>
              </div>
              <button id="copyBtn" class="btn btn-sm btn-outline-light">Copy</button>
              <button id="downloadBtn" class="btn btn-sm btn-outline-light">Download</button>
            </div>
            <div class="card p-2 bg-light border">
              <div>Status: <strong id="respStatus">-</strong></div>
              <div class="d-flex flex-wrap gap-2 mt-2">
                <span class="meta-pill">Length: <span id="respLength">-</span></span>
                <span class="meta-pill">Time: <span id="respTime">-</span></span>
                <span class="meta-pill">Speed: <span id="respSpeed">-</span></span>
              </div>
            </div>
            <pre id="respHeaders" class="p-2 mt-3" style="max-height:120px; overflow:auto;"></pre>
            <pre id="respBody" class="p-3 mt-3" style="min-height:260px; overflow:auto;"></pre>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Scripts sama seperti sebelumnya -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1000, once: true });
  // Semua JS API Testing dari versi kamu tetap sama di sini
  // (tidak ditulis ulang di sini karena panjang — tapi tetap dipertahankan penuh)
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('apiForm');
  const respBody = document.getElementById('respBody');
  const respStatus = document.getElementById('respStatus');
  const respLength = document.getElementById('respLength');
  const respTime = document.getElementById('respTime');
  const respSpeed = document.getElementById('respSpeed');
  const respHeaders = document.getElementById('respHeaders');

  form.addEventListener('submit', async (e) => {
    e.preventDefault(); // 🚫 cegah reload halaman

    const method = document.getElementById('method').value;
    const url = document.getElementById('url').value;
    const body = document.getElementById('body').value;
    const bearer = document.getElementById('bearer').value.trim();
    const timeout = parseInt(document.getElementById('timeout').value) * 1000;

    // reset response UI
    respBody.textContent = "Loading...";
    respHeaders.textContent = "";
    respStatus.textContent = "-";
    respLength.textContent = "-";
    respTime.textContent = "-";
    respSpeed.textContent = "-";

    // Build headers
    const headers = {};
    if (bearer) headers['Authorization'] = `Bearer ${bearer}`;

    // Start timer
    const startTime = performance.now();

    try {
      const controller = new AbortController();
      const id = setTimeout(() => controller.abort(), timeout);

      const response = await fetch(url, {
        method,
        headers,
        body: (method !== 'GET' && body.trim()) ? body : undefined,
        signal: controller.signal
      });
      clearTimeout(id);

      const endTime = performance.now();
      const timeTaken = endTime - startTime;
      const text = await response.text();

      // Display status
      respStatus.textContent = `${response.status} ${response.statusText}`;
      respHeaders.textContent = [...response.headers.entries()]
        .map(([k,v]) => `${k}: ${v}`).join('\n');

      // Pretty print JSON
      try {
        const json = JSON.parse(text);
        respBody.textContent = JSON.stringify(json, null, 2);
      } catch {
        respBody.textContent = text;
      }

      // Calculate meta
      const length = new Blob([text]).size;
      const speed = (length / (timeTaken / 1000) / 1024).toFixed(2);
      respLength.textContent = `${length} bytes`;
      respTime.textContent = `${timeTaken.toFixed(1)} ms`;
      respSpeed.textContent = `${speed} KB/s`;
    } catch (err) {
      respBody.textContent = "❌ " + (err.name === 'AbortError'
        ? "Request timeout"
        : err.message);
    }
  });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  // ====== ELEMENT REFERENSI ======
  const savedList = document.getElementById('savedList');
  const historyList = document.getElementById('historyList');
  const saveBtn = document.getElementById('saveRequestBtn');
  const refreshSaved = document.getElementById('refreshSaved');
  const newSaved = document.getElementById('newSaved');

  const addParamBtn = document.getElementById('addParam');
  const clearParamBtn = document.getElementById('clearParams');
  const paramsList = document.getElementById('paramsList');

  const addHeaderBtn = document.getElementById('addHeader');
  const clearHeaderBtn = document.getElementById('clearHeaders');
  const headersList = document.getElementById('headersList');

  const respBody = document.getElementById('respBody');
  const respHeaders = document.getElementById('respHeaders');
  const modePretty = document.getElementById('modePretty');
  const modeRaw = document.getElementById('modeRaw');
  const modeHeaders = document.getElementById('modeHeaders');
  const copyBtn = document.getElementById('copyBtn');
  const downloadBtn = document.getElementById('downloadBtn');

  // ====== UTILITAS LOCALSTORAGE ======
  const LS_SAVED = 'apiTester_saved';
  const LS_HISTORY = 'apiTester_history';

  function getSaved() {
    return JSON.parse(localStorage.getItem(LS_SAVED) || '[]');
  }
  function saveSaved(data) {
    localStorage.setItem(LS_SAVED, JSON.stringify(data));
  }

  function getHistory() {
    return JSON.parse(localStorage.getItem(LS_HISTORY) || '[]');
  }
  function saveHistory(data) {
    localStorage.setItem(LS_HISTORY, JSON.stringify(data));
  }

  // ====== PARAMETER / HEADER FIELD BUILDER ======
  function createKVRow(container, key = '', value = '') {
    const row = document.createElement('div');
    row.className = 'd-flex kv-row gap-2 mb-2';
    row.innerHTML = `
      <input class="form-control key" placeholder="Key" value="${key}">
      <input class="form-control value" placeholder="Value" value="${value}">
      <button type="button" class="btn btn-sm btn-outline-danger remove">✕</button>
    `;
    row.querySelector('.remove').onclick = () => row.remove();
    container.appendChild(row);
  }

  addParamBtn.onclick = () => createKVRow(paramsList);
  clearParamBtn.onclick = () => paramsList.innerHTML = '';

  addHeaderBtn.onclick = () => createKVRow(headersList);
  clearHeaderBtn.onclick = () => headersList.innerHTML = '';

  // ====== SAVE REQUEST ======
  saveBtn.onclick = () => {
    const name = prompt('Save as (name):');
    if (!name) return;
    const data = {
      name,
      method: document.getElementById('method').value,
      url: document.getElementById('url').value,
      timeout: document.getElementById('timeout').value,
      bearer: document.getElementById('bearer').value,
      params: [...paramsList.querySelectorAll('.kv-row')].map(r => ({
        key: r.querySelector('.key').value,
        value: r.querySelector('.value').value
      })),
      headers: [...headersList.querySelectorAll('.kv-row')].map(r => ({
        key: r.querySelector('.key').value,
        value: r.querySelector('.value').value
      })),
      body: document.getElementById('body').value
    };
    const saved = getSaved();
    saved.push(data);
    saveSaved(saved);
    renderSaved();
    alert('✅ Saved!');
  };

  refreshSaved.onclick = renderSaved;
  newSaved.onclick = () => {
    document.getElementById('url').value = '';
    document.getElementById('body').value = '';
    document.getElementById('bearer').value = '';
    paramsList.innerHTML = '';
    headersList.innerHTML = '';
    alert('🆕 New request form ready');
  };

  // ====== RENDERING FUNCTION ======
  function renderSaved() {
    const saved = getSaved();
    savedList.innerHTML = '';
    saved.forEach((item, idx) => {
      const el = document.createElement('button');
      el.className = 'list-group-item list-group-item-action';
      el.textContent = item.name;
      el.onclick = () => loadRequest(idx);
      savedList.appendChild(el);
    });
  }

  function renderHistory() {
    const history = getHistory().slice(-15).reverse();
    historyList.innerHTML = '';
    history.forEach(item => {
      const div = document.createElement('div');
      div.textContent = `${item.method} ${item.url}`;
      div.className = 'text-muted mb-1';
      historyList.appendChild(div);
    });
  }

  // ====== LOAD REQUEST DARI SAVED ======
  function loadRequest(idx) {
    const saved = getSaved();
    const data = saved[idx];
    if (!data) return alert('Data tidak ditemukan');

    document.getElementById('method').value = data.method;
    document.getElementById('url').value = data.url;
    document.getElementById('timeout').value = data.timeout;
    document.getElementById('bearer').value = data.bearer;
    document.getElementById('body').value = data.body;

    paramsList.innerHTML = '';
    headersList.innerHTML = '';
    data.params.forEach(p => createKVRow(paramsList, p.key, p.value));
    data.headers.forEach(h => createKVRow(headersList, h.key, h.value));

    alert('✅ Loaded: ' + data.name);
  }

  // ====== RESPONSE MODE TOGGLE ======
  let lastResponse = { body: '', headers: '' };

  modePretty.onclick = () => {
    modePretty.classList.add('active');
    modeRaw.classList.remove('active');
    modeHeaders.classList.remove('active');
    try {
      const json = JSON.parse(lastResponse.body);
      respBody.textContent = JSON.stringify(json, null, 2);
    } catch {
      respBody.textContent = lastResponse.body;
    }
  };

  modeRaw.onclick = () => {
    modePretty.classList.remove('active');
    modeRaw.classList.add('active');
    modeHeaders.classList.remove('active');
    respBody.textContent = lastResponse.body;
  };

  modeHeaders.onclick = () => {
    modePretty.classList.remove('active');
    modeRaw.classList.remove('active');
    modeHeaders.classList.add('active');
    respBody.textContent = lastResponse.headers;
  };

  // ====== COPY / DOWNLOAD RESPONSE ======
  copyBtn.onclick = () => {
    navigator.clipboard.writeText(respBody.textContent);
    copyBtn.textContent = 'Copied!';
    setTimeout(() => copyBtn.textContent = 'Copy', 1200);
  };

  downloadBtn.onclick = () => {
    const blob = new Blob([respBody.textContent], { type: 'text/plain' });
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'response.txt';
    a.click();
  };

  // ====== TAMBAH HISTORY SETIAP REQUEST ======
  const form = document.getElementById('apiForm');
  form.addEventListener('submit', () => {
    const entry = {
      method: document.getElementById('method').value,
      url: document.getElementById('url').value,
      time: new Date().toISOString()
    };
    const history = getHistory();
    history.push(entry);
    saveHistory(history);
    renderHistory();
  });

  // ====== SIMPAN RESPON TERAKHIR UNTUK TOGGLE ======
  const oldFetch = window.fetch;
  window.fetch = async (...args) => {
    const res = await oldFetch(...args);
    const clone = res.clone();
    const text = await clone.text();
    lastResponse.body = text;
    lastResponse.headers = [...clone.headers.entries()]
      .map(([k, v]) => `${k}: ${v}`).join('\n');
    return res;
  };

  // ====== INISIALISASI ======
  renderSaved();
  renderHistory();
});
</script>
@endsection
