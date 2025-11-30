@extends('layouts.app')

@section('content')
<!-- Hero Section -->


<section class="text-white py-5" style="background: linear-gradient(to right, #1f2937, #111827);">
  <div class="container text-center">
    <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">Hasil Fuzzing</h1>
    <p class="lead animate__animated animate__fadeInUp">Keterangan Code</br>
      404 Tidak Ditemukan (halaman tidak tersedia)<br>
      403 Akses Dilarang (forbidden)<br>
      500 Kesalahan Server Internal<br>
      200 OK (halaman berhasil dimuat)
</p>

  </div>
</section>

<!-- Main Section -->
<section class="py-5 bg-light text-dark">
  <div class="container" data-aos="fade-up">

    <!-- Job Info -->
    <div class="card shadow border-0 mb-4">
      <div class="card-body">
        <div class="row text-center text-md-start align-items-center">
          <div class="col-md-4 col-12 mb-2 mb-md-0">
            <p class="mb-1"><strong>Target:</strong></p>
            <p class="text-break">{{ $job->target }}</p>
          </div>

          <div class="col-md-3 col-6">
            <p class="mb-1"><strong>Status:</strong></p>
            <span id="status" class="badge bg-secondary fs-6">{{ $job->status }}</span>
          </div>

          <div class="col-md-3 col-6">
            <p class="mb-1"><strong>Progress:</strong></p>
            <div class="d-flex align-items-center justify-content-center justify-content-md-start">
              <span class="fw-bold me-2" id="progress">0</span>
              <span class="me-2">/</span>
              <span id="total">0</span>
            </div>
          </div>

          <!-- Tombol -->
          <div class="col-12 mt-4">
            <div class="fuzz-btn-row">
              <button id="toggleBtn" class="btn-modern-dark w-100 fw-semibold shadow-sm">Loading...</button>
              <a href="/fuzz" class="btn-modern-outline w-100 fw-semibold shadow-sm text-center">Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Results -->
    <div class="card shadow-lg border-0">
      <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Hasil Fuzzing</h5>
        <small id="last-update" class="text-light">Memuat...</small>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
<table class="table table-sm mb-0">
<thead class="table-dark">
  <tr>
    <th style="width:30px">#</th>
    <th>Word</th>
    <th style="width:60px">Status</th>
    <th>URL</th>
    <th style="width:80px">Last Seen</th>
  </tr>
</thead>

            <tbody id="results">
              <tr>
                <td colspan="5" class="text-center text-muted py-4">
                  <div class="spinner-border text-secondary me-2" role="status" style="width:1.2rem; height:1.2rem;"></div>
                  Memuat hasil...
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</section>
<footer class="text-center text-white bg-dark py-3" data-aos="fade-up">
  <small>&copy; 2025 Cyber Defense Team | All Rights Reserved</small>
</footer>

<script>
const jobId = {{ $job->id }};
const resultsTable = document.getElementById('results');
const statusEl = document.getElementById('status');
const doneEl = document.getElementById('progress');
const totalEl = document.getElementById('total');
const lastUpdate = document.getElementById('last-update');
const toggleBtn = document.getElementById('toggleBtn');

let isFetching = false;
let stopPolling = false;

function statusClass(status) {
  switch(status) {
    case 'finished': return 'bg-success';
    case 'failed': return 'bg-danger';
    case 'running': return 'bg-warning text-dark';
    case 'stopped': return 'bg-secondary';
    case 'pending': return 'bg-info text-dark';
    default: return 'bg-secondary';
  }
}
function toInt(v){ return (typeof v==='number'?v:parseInt(v)||0); }

async function fetchProgress(){
  if(isFetching||stopPolling)return;
  isFetching=true;
  try{
    const res=await fetch(`/fuzz/${jobId}/progress`,{headers:{'Accept':'application/json'}});
    if(!res.ok)throw new Error('HTTP '+res.status);
    const data=await res.json();

    statusEl.textContent=data.status??'unknown';
    statusEl.className='badge fs-6 '+statusClass(data.status??'');

    const done=toInt(data.done);
    const total=toInt(data.total);
    doneEl.textContent=done;
    totalEl.textContent=total;

    lastUpdate.textContent="⏱️ "+new Date().toLocaleTimeString();

    toggleBtn.disabled=false;
    if(data.status==='running'){
      toggleBtn.textContent='Stop';
      toggleBtn.className='btn-modern-dark btn-danger-glow w-100 fw-semibold shadow-sm';
    }else if(['pending','stopped'].includes(data.status)){
      toggleBtn.textContent='Start';
      toggleBtn.className='btn-modern-dark btn-success-glow w-100 fw-semibold shadow-sm';
    }else if(data.status==='failed'){
      toggleBtn.textContent='Failed';
      toggleBtn.className='btn-modern-dark btn-danger-glow disabled w-100 fw-semibold shadow-sm';
    }else if(data.status==='finished'){
      toggleBtn.textContent='Finished';
      toggleBtn.className='btn-modern-dark disabled w-100 fw-semibold shadow-sm';
    }

    resultsTable.innerHTML='';
    const words=Array.isArray(data.words)?data.words:[];
    if(words.length>0){
      words.forEach((r,i)=>{
        const safeUrl=r.url?r.url.replace(/"/g,'%22'):'#';
        const row=document.createElement('tr');
        row.innerHTML=`
          <td>${i+1}</td>
          <td class="text-break">${escapeHtml(r.word??'')}</td>
          <td>${escapeHtml(String(r.status??''))}</td>
          <td class="text-break"><a href="${safeUrl}" target="_blank">${escapeHtml(r.url??'')}</a></td>
          <td>${escapeHtml(r.last_seen??'-')}</td>
        `;
        resultsTable.appendChild(row);
      });
    }else{
      resultsTable.innerHTML=`<tr><td colspan="5" class="text-center text-muted py-3">Belum ada hasil.</td></tr>`;
    }

    if(['finished','failed'].includes(data.status))stopPolling=true;
    else setTimeout(fetchProgress,2000);
  }catch(err){
    console.error(err);
    lastUpdate.textContent="Gagal update";
    setTimeout(fetchProgress,4000);
  }finally{isFetching=false;}
}
fetchProgress();

toggleBtn.addEventListener('click',async()=>{
  try{
    toggleBtn.disabled=true;
    const prevText=toggleBtn.textContent;
    toggleBtn.textContent='⏳...';
    let url=`/fuzz/${jobId}/start`;
    if(prevText.includes('Stop'))url=`/fuzz/${jobId}/stop`;
    const res=await fetch(url,{
      method:'POST',
      headers:{
        'X-CSRF-TOKEN':'{{ csrf_token() }}',
        'Accept':'application/json',
        'Content-Type':'application/json'
      },
      body:JSON.stringify({})
    });
    await res.json().catch(()=>{});
    stopPolling=false;
    fetchProgress();
  }catch(err){console.error(err);}
  finally{setTimeout(()=>toggleBtn.disabled=false,1500);}
});

function escapeHtml(unsafe){
  return String(unsafe??'')
  .replaceAll('&','&amp;')
  .replaceAll('<','&lt;')
  .replaceAll('>','&gt;')
  .replaceAll('"','&quot;')
  .replaceAll("'","&#039;");
}
</script>

<style>
body { background: #0d1117; color: #e2e8f0; }
.card { border-radius: 12px; background: #1a1f24; color: #e2e8f0; }
.table th, .table td { vertical-align: middle; font-size: 0.9rem; }
.table a { color: #58a6ff; text-decoration: none; }
.table a:hover { text-decoration: underline; }
.badge { padding: .45em .7em; border-radius: 8px; }

.fuzz-btn-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
}

/* --- FIX RESPONSIVE TABLE MOBILE --- */
.table {
  table-layout: fixed;
}

.table td, .table th {
  white-space: normal !important;
  word-wrap: break-word !important;
  word-break: break-all !important;
}


/* === Tombol modern gelap === */
.btn-modern-dark {
  background-color: #111827;
  color: #e5e7eb;
  border: 1px solid #1f2937;
  border-radius: 10px;
  padding: 12px 0;
  transition: all 0.25s ease-in-out;
  box-shadow: 0 2px 8px rgba(0,0,0,0.4);
}

.btn-modern-dark:hover {
  background-color: #1f2937;
  color: #fff;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(59,130,246,0.4);
}

.btn-modern-outline {
  background: transparent;
  color: #e5e7eb;
  border: 1px solid #374151;
  border-radius: 10px;
  padding: 12px 0;
  transition: all 0.25s ease-in-out;
}

.btn-modern-outline:hover {
  background-color: #2563eb;
  color: #fff;
  border-color: #2563eb;
  transform: translateY(-2px);
  box-shadow: 0 4px 10px rgba(37,99,235,0.4);
}

/* Efek khusus */
.btn-success-glow {
  background-color: #16a34a !important;
  box-shadow: 0 0 10px rgba(34,197,94,0.6);
}

.btn-danger-glow {
  background-color: #dc2626 !important;
  box-shadow: 0 0 10px rgba(239,68,68,0.6);
}

.btn-modern-dark.disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

@media (max-width: 576px) {
  .fuzz-btn-row { grid-template-columns: 1fr; }
}
</style>
@endsection