@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="text-white py-5" style="background: linear-gradient(to right, #1f2937, #111827);">
  <div class="container text-center">
    <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">🛡️ Cyber Defense</h1>
    <p class="lead animate__animated animate__fadeInUp">Strategi & Proteksi Terbaik Melawan Serangan Siber</p>
  </div>
</section>

<!-- Definisi Cyber Defense -->
<section class="py-5 bg-light text-dark">
  <div class="container">
    <div class="row align-items-center mb-5">
      <div class="col-md-6 mb-4 mb-md-0" data-aos="fade-right">
        <img src="{{ asset('img/cyber-defense.jpg') }}" class="img-fluid rounded shadow" alt="Cyber Defense">
      </div>
      <div class="col-md-6" data-aos="fade-left">
        <h2 class="fw-bold mb-3">Apa itu Cyber Defense?</h2>
        <p class="text-justify">
          Cyber defense adalah serangkaian tindakan, strategi, dan teknologi yang digunakan untuk mencegah, mendeteksi, dan merespons serangan siber. Tujuannya adalah untuk menjaga integritas, kerahasiaan, dan ketersediaan sistem informasi dari ancaman dunia maya.
        </p>
      </div>
    </div>

    <!-- Jenis-jenis Perlindungan -->
    <div class="mb-5" data-aos="fade-up">
      <h3 class="fw-bold text-center mb-4">Jenis-jenis Pertahanan Siber Umum</h3>
      <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
          <a href="#phishing" class="text-decoration-none text-dark">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body">
                <h5 class="card-title fw-bold">🎣 Mencegah Phishing</h5>
                <p class="card-text">Menghindari penipuan dengan menyamar sebagai pihak terpercaya.</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col">
          <a href="#sqlinjection" class="text-decoration-none text-dark">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body">
                <h5 class="card-title fw-bold">💉 Mencegah SQL Injection</h5>
                <p class="card-text">Perlindungan terhadap injeksi kode jahat di query database.</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col">
          <a href="#ddos" class="text-decoration-none text-dark">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body">
                <h5 class="card-title fw-bold">🌐 Mencegah DDoS</h5>
                <p class="card-text">Melindungi sistem dari serangan trafik masif dan overload.</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col">
          <a href="#bruteforce" class="text-decoration-none text-dark">
            <div class="card h-100 border-0 shadow-sm">
              <div class="card-body">
                <h5 class="card-title fw-bold">🔑 Mencegah Brute Force</h5>
                <p class="card-text">Mengamankan akun dari percobaan login berulang secara otomatis.</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <!-- Detail Strategi Pertahanan -->
    <div data-aos="fade-up">
      <h3 class="fw-bold mb-4">Bagaimana Cara Mencegah Serangan Ini?</h3>
      <div class="accordion" id="defenseAccordion">

        <!-- Phishing -->
        <div class="accordion-item" id="phishing">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePhishing">
              Cara Mencegah Phishing
            </button>
          </h2>
          <div id="collapsePhishing" class="accordion-collapse collapse show">
            <div class="accordion-body">
              <ul>
                <li>Jangan klik tautan mencurigakan atau lampiran dari email tak dikenal.</li>
                <li>Gunakan email filter dan anti-spam protection di mail server.</li>
                <li>Selalu verifikasi keaslian domain dan login hanya lewat situs resmi.</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- SQL Injection -->
        <div class="accordion-item" id="sqlinjection">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSQL">
              Cara Mencegah SQL Injection
            </button>
          </h2>
          <div id="collapseSQL" class="accordion-collapse collapse">
            <div class="accordion-body">
              <ul>
                <li>Gunakan query dengan prepared statements atau ORM (Eloquent).</li>
                <li>Validasi dan sanitasi semua input dari user sebelum diproses.</li>
                <li>Batasi hak akses user database agar tidak bisa DROP atau UPDATE sembarangan.</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- DDoS -->
        <div class="accordion-item" id="ddos">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDDoS">
              Cara Mencegah DDoS Attack
            </button>
          </h2>
          <div id="collapseDDoS" class="accordion-collapse collapse">
            <div class="accordion-body">
              <ul>
                <li>Gunakan layanan seperti Cloudflare, Akamai, atau AWS Shield.</li>
                <li>Implementasikan rate limiting dan load balancer pada server.</li>
                <li>Monitoring trafik secara real-time menggunakan IDS/IPS.</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Brute Force -->
        <div class="accordion-item" id="bruteforce">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBruteForce">
              Cara Mencegah Brute Force Attack
            </button>
          </h2>
          <div id="collapseBruteForce" class="accordion-collapse collapse">
            <div class="accordion-body">
              <ul>
                <li>Batasi jumlah percobaan login dan blokir sementara jika gagal terus.</li>
                <li>Gunakan CAPTCHA dan Two-Factor Authentication (2FA).</li>
                <li>Enkripsi password dengan algoritma kuat seperti bcrypt atau Argon2.</li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Kesimpulan -->
    <div class="mt-5" data-aos="fade-up">
      <h3 class="fw-bold mb-3">Kesimpulan</h3>
      <p class="text-justify">Cyber defense bukan cuma soal teknologi, tapi juga soal edukasi, awareness, dan ketepatan strategi. Dengan langkah-langkah pencegahan yang tepat, kita bisa mengurangi resiko serangan digital secara signifikan.</p>
    </div>

  </div>
</section>

{{-- SESSION LOGIN --}}
@if (!session()->has('user'))
  <h4>Login atau Daftar untuk Berkomentar</h4>
  @if(session('error'))
    <p class="text-danger">{{ session('error') }}</p>
  @endif
  <form method="POST" action="/login" class="mb-4">
    @csrf
    <div class="mb-2">
      <input type="text" name="username" class="form-control" placeholder="Nama" required>
    </div>
    <div class="mb-2">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    <a href="/register" class="btn btn-link">Daftar</a>
  </form>
@else
  <div class="d-flex justify-content-between align-items-center">
    <h5>Hi, {{ session('user') }} 👋</h5>
    <form method="POST" action="/logout">
      @csrf
      <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
    </form>
  </div>

  <form method="POST" action="/comment" class="mt-3 mb-5">
    @csrf
    <textarea name="message" class="form-control" required placeholder="Tulis komentarmu di sini..." rows="3"></textarea>
    <button type="submit" class="btn btn-success mt-2">Kirim Komentar</button>
  </form>
@endif

<hr>

<h4>Komentar Pengunjung</h4>
<ul class="list-group mb-5">
  @forelse($comments as $comment)
    <li class="list-group-item">
      <strong>{{ $comment['user'] }}</strong>: {{ $comment['message'] }}
    </li>
  @empty
    <li class="list-group-item">Belum ada komentar.</li>
  @endforelse
</ul>
@endsection
