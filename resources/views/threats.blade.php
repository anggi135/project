@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="text-white py-5" style="background: linear-gradient(to right, #1f2937, #111827);">
  <div class="container text-center">
    <h1 class="display-4 fw-bold animate__animated animate__fadeInDown">📛 Cyber Threats</h1>
    <p class="lead animate__animated animate__fadeInUp">Pahami Ancaman Dunia Digital dan Cara Menghadapinya</p>
  </div>
</section>

<!-- Threat Overview -->
<section class="py-5 bg-light text-dark">
  <div class="container">
    <div class="row align-items-center mb-5">
      <div class="col-md-6 mb-4 mb-md-0" data-aos="fade-right">
        <img src="{{ asset('img/threats.jpg') }}" class="img-fluid rounded shadow" alt="Cyber Threats">
      </div>
      <div class="col-md-6" data-aos="fade-left">
        <h2 class="fw-bold mb-3">Apa itu Cyber Threats?</h2>
        <p style="text-align: justify;">Cyber threats adalah ancaman atau serangan yang dilakukan oleh penjahat siber / hacker untuk merusak dan mencuri data, bahkan memusnahkan sistem digital. Ancaman ini menjadi tantangan serius di era digital saat ini.</p>
      </div>
    </div>

    <!-- Jenis-jenis Serangan -->
    <div class="mb-5" data-aos="fade-up">
      <h3 class="fw-bold text-center">Jenis-jenis Serangan Siber Umum</h3>
      <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">
        <div class="col">
          <a href="#phishing" class="text-decoration-none text-dark">
            <div class="card h-100 border-0 shadow-sm hover-shadow animate__animated animate__fadeIn">
              <div class="card-body">
                <h5 class="card-title fw-bold">🎣 Phishing</h5>
                <p class="card-text">Penipuan dengan menyamar sebagai pihak terpercaya untuk mencuri data pribadi korban seperti OTP, password, dan lainnya.</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col">
          <a href="#sqlinjection" class="text-decoration-none text-dark">
            <div class="card h-100 border-0 shadow-sm hover-shadow animate__animated animate__fadeIn">
              <div class="card-body">
                <h5 class="card-title fw-bold">💉 SQL Injection</h5>
                <p class="card-text">Teknik menyisipkan kode SQL jahat untuk mengakses dan merusak database aplikasi yang rentan.</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col">
          <a href="#ddos" class="text-decoration-none text-dark">
            <div class="card h-100 border-0 shadow-sm hover-shadow animate__animated animate__fadeIn">
              <div class="card-body">
                <h5 class="card-title fw-bold">🌐 DDoS</h5>
                <p class="card-text">Membanjiri server dengan trafik palsu hingga sistem menjadi lambat atau lumpuh.</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col">
          <a href="#bruteforce" class="text-decoration-none text-dark">
            <div class="card h-100 border-0 shadow-sm hover-shadow animate__animated animate__fadeIn">
              <div class="card-body">
                <h5 class="card-title fw-bold">🔑 Brute Force</h5>
                <p class="card-text">Menebak password dengan mencoba berbagai kombinasi username dan password secara otomatis.</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

    <!-- Penjelasan Detail -->
    <div class="accordion" id="threatDetails">

      <div class="accordion-item" id="phishing">
        <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePhishing" aria-expanded="true">
            Cara Kerja Phishing
          </button>
        </h2>
        <div id="collapsePhishing" class="accordion-collapse collapse show">
          <div class="accordion-body">
            <ul>
              <li>Penyerang menentukan target pengguna potensial.</li>
              <li>Mengirim email/sms palsu yang tampak sah.</li>
              <li>Menanamkan link palsu yang menuju situs login tiruan.</li>
              <li>Korban tertipu dan memasukkan data sensitif.</li>
              <li>Data dikirim ke server milik penyerang.</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item" id="sqlinjection">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSQL">
            Cara Kerja SQL Injection
          </button>
        </h2>
        <div id="collapseSQL" class="accordion-collapse collapse">
          <div class="accordion-body">
            <ul>
              <li>Penyerang mengidentifikasi form input yang rentan.</li>
              <li>Menginputkan kode SQL seperti <code>' OR '1'='1</code>.</li>
              <li>Database akan menganggap perintah itu valid dan membuka akses.</li>
              <li>Penyerang dapat mencuri, mengubah, atau menghapus data.</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item" id="ddos">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDdos">
            Cara Kerja DDoS
          </button>
        </h2>
        <div id="collapseDdos" class="accordion-collapse collapse">
          <div class="accordion-body">
            <ul>
              <li>Penyerang menginfeksi ribuan perangkat menjadi botnet.</li>
              <li>Botnet dikendalikan untuk mengakses satu server target secara serentak.</li>
              <li>Permintaan berlebih membuat sistem overload dan akhirnya down.</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="accordion-item" id="bruteforce">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBrute">
            Cara Kerja Brute Force
          </button>
        </h2>
        <div id="collapseBrute" class="accordion-collapse collapse">
          <div class="accordion-body">
            <ul>
              <li>Penyerang menyiapkan wordlist berisi kombinasi username dan password.</li>
              <li>Tools seperti Hydra atau Medusa digunakan untuk brute login otomatis.</li>
              <li>Jika ada kombinasi yang cocok, sistem bisa dijebol.</li>
            </ul>
          </div>
        </div>
      </div>

    </div>

    <!-- Kesimpulan -->
    <div class="mt-5" data-aos="fade-up">
      <h3 class="fw-bold mb-3">Kesimpulan</h3>
      <p style="text-align: justify;">Cyber threats adalah tantangan besar bagi pengguna internet. Dengan memahami jenis-jenis serangan dan cara kerjanya, kita bisa meningkatkan kewaspadaan dan perlindungan terhadap data dan sistem yang kita gunakan sehari-hari.</p>
    </div>


    
<!-- Komentar Section -->
<hr class="my-5">

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

  </div>
</section>

@endsection
