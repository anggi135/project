@extends('layouts.app')

@section('content')

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="img/favicon.png" alt="Logo" width="30" height="24">
      Cyber Threats & Defense
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/threats">Threats</a></li>
        <li class="nav-item"><a class="nav-link" href="/defense">Defense</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">

  <h1 class="text-center">Cyber Defense</h1>

  <!-- Gambar sebelum artikel -->
  <div class="text-center my-4">
    <img src="{{ asset('img/defense.avif') }}" class="img-fluid img-hover" style="max-width: 350px; height: auto;" alt="Cyber Threats">
  </div>

  <!-- Artikel -->
  <p><strong>Cyber</strong> merupakan tim pertahanan dalam dunia keamanan siber yang bertugas menjaga keamanan sistem dari berbagai serangan. Mereka fokus pada monitoring, analisis log, deteksi anomali, dan implementasi perlindungan seperti firewall, IDS/IPS, hingga patching sistem. Blue Team juga merancang strategi incident response untuk meminimalisir dampak jika terjadi serangan.</p>
  <div class="mt-5">
  <h2>1. DoS & DDoS (Denial of Service)</h2>
  <p>
    Serangan <strong>DoS (Denial of Service)</strong> dan <strong>DDoS (Distributed Denial of Service)</strong> bertujuan untuk membuat layanan tidak tersedia dengan membanjiri server dengan trafik atau request palsu secara masif.
  </p>
  <h5>Pertahanan:</h5>
  <ul>
    <li>Menggunakan firewall dan Web Application Firewall (WAF).</li>
    <li>Menerapkan rate limiting untuk membatasi jumlah request dari satu IP.</li>
    <li>Menggunakan layanan mitigasi DDoS seperti Cloudflare atau AWS Shield.</li>
    <li>Monitoring trafik dengan tool seperti Fail2Ban, Snort, atau IDS lainnya.</li>
  </ul>
</div>

<div class="mt-5">
  <h2>2. SQL Injection</h2>
  <p>
    <strong>SQL Injection</strong> adalah teknik serangan di mana attacker menyisipkan perintah SQL berbahaya ke dalam input user, untuk mengambil atau merusak data di database.
  </p>
  <h5>Pertahanan:</h5>
  <ul>
    <li>Gunakan <strong>prepared statements</strong> dan <strong>parameter binding</strong> di query database.</li>
    <li>Validasi dan sanitasi semua input dari user.</li>
    <li>Gunakan ORM (Object Relational Mapping) seperti Eloquent di Laravel untuk menghindari query mentah.</li>
    <li>Batasi hak akses user database, misalnya user tidak boleh bisa DROP TABLE.</li>
  </ul>
</div>

<div class="mt-5">
  <h2>3. Brute Force Attack</h2>
  <p>
    <strong>Brute Force</strong> adalah teknik di mana attacker mencoba menebak password dengan mencoba berbagai kombinasi secara terus-menerus hingga berhasil.
  </p>
  <h5>Pertahanan:</h5>
  <ul>
    <li>Batasi jumlah percobaan login (misalnya 5x percobaan, kemudian lock sementara).</li>
    <li>Gunakan CAPTCHA untuk memverifikasi bahwa user adalah manusia.</li>
    <li>Implementasikan 2FA (Two-Factor Authentication).</li>
    <li>Enkripsi password dengan algoritma kuat seperti bcrypt.</li>
    <li>Log dan pantau aktivitas login mencurigakan.</li>
  </ul>
</div>

</div>

@endsection