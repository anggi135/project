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
<section class="bg-light text-dark py-5 d-flex align-items-center justify-content-center" style="min-height: 66vh; margin: 0;">
  <div class="card shadow-lg border-0" style="max-width: 600px; width: 100%;">
    <div class="card-body p-4">
      <h3 class="fw-bold text-center mb-4 text-primary">Masukkan URL untuk Diperiksa</h3>

      <form method="POST" action="{{ route('checkurl.do') }}">
        @csrf
        <div class="mb-3">
          <label for="url" class="form-label fw-semibold">URL Target</label>
          <input type="text"
                 name="url"
                 id="url"
                 class="form-control form-control-lg"
                 placeholder="https://contoh.com"
                 value="{{ old('url', $url ?? '') }}">
          @error('url')
            <div class="text-danger small mt-1">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-dark w-100 fw-semibold shadow-sm">
          Check Sekarang
        </button>
      </form>

      @if(isset($result))
        <div class="mt-4 p-4 rounded {{ $result['status'] === 'danger' ? 'bg-danger text-white' : 'bg-success text-white' }} animate__animated animate__fadeInUp">
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

<footer class="text-center text-white bg-dark py-3 m-0">
  <small>&copy; 2025 Cyber Defense Team | All Rights Reserved</small>
</footer>

<style>
  body {
    background: #0d1117;
    color: #f8f9fa;
    overflow-x: hidden;
  }
  .card {
    background: #ffffff;
    border-radius: 15px;
  }
</style>

@endsection
