@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="text-white d-flex align-items-center justify-content-center text-center"
         style="background: linear-gradient(to right, #1f2937, #111827); height: 250px;">
  <div>
    <h1 class="display-5 fw-bold animate__animated animate__fadeInDown">Check URL</h1>
    <p class="lead mt-2 animate__animated animate__fadeInUp">
      Tools ini memeriksa URL dengan mencocokkan domain ke blacklist dan menampilkan hasil danger (malware, phishing, virus) atau safe
    </p>
  </div>
</section>

<!-- Form Checker -->
<section class="py-5 d-flex align-items-center justify-content-center" style="min-height: 66vh; margin:0; background: rgba(31,41,55,0.6);">
  <div class="card shadow-lg border-0" style="max-width: 600px; width: 100%; background: rgba(255,255,255,0.08); backdrop-filter: blur(6px); border:1px solid rgba(255,255,255,0.15); color: #e2e8f0;">
    <div class="card-body p-4">
      <h3 class="fw-bold text-center mb-4 text-white">Masukkan URL untuk Diperiksa</h3>

      <form method="POST" action="{{ route('checkurl.do') }}">
        @csrf
        <div class="mb-3">
          <label for="url" class="form-label fw-semibold">URL Target</label>
          <input type="text"
                 name="url"
                 id="url"
                 class="form-control form-control-lg"
                 placeholder="https://contoh.com"
                 value="{{ old('url', $url ?? '') }}"
                 style="background: rgba(255,255,255,0.1); color:#e2e8f0; border:1px solid rgba(255,255,255,0.2);">
          @error('url')
            <div class="text-danger small mt-1">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn-modern-dark w-100 fw-semibold shadow-sm">
          Check Sekarang
        </button>
      </form>

      @if(isset($result))
        <div class="mt-4 p-4 rounded animate__animated animate__fadeInUp"
             style="background: {{ $result['status'] === 'danger' ? 'rgba(220,38,38,0.8)' : 'rgba(22,163,74,0.8)' }}; color: #fff; backdrop-filter: blur(4px);">
          <h5 class="fw-bold">Hasil Pemeriksaan</h5>
          <hr class="border-light opacity-50">
          <p class="mb-1"><strong>Domain:</strong> {{ $result['domain'] ?? '—' }}</p>
          <p class="mb-1"><strong>Status:</strong>
            @if($result['status'] === 'danger')
              Situs Ditemukan dalam Daftar Hitam
            @else
              Tidak Ditemukan dalam Daftar
            @endif
          </p>
          <p class="mb-0"><strong>Pesan:</strong> {{ $result['message'] }}</p>
        </div>
      @endif
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="text-center text-white bg-dark py-3 m-0">
  <small>&copy; 2025 Cyber Defense Team | All Rights Reserved</small>
</footer>

@push('styles')
<style>
body {
  background: #0d1117;
  color: #e2e8f0;
  overflow-x: hidden;
}

/* Card Glass Effect */
.card {
  border-radius: 15px;
}

/* Tombol Modern Gelap */
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

/* Input Transparan */
input.form-control {
  transition: all 0.25s ease-in-out;
}
input.form-control:focus {
  background: rgba(255,255,255,0.15);
  color: #fff;
  border-color: #2563eb;
  box-shadow: 0 0 10px rgba(37,99,235,0.4);
}
</style>
@endpush

@endsection
