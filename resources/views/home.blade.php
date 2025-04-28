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
        <li class="nav-item"><a class="nav-link" href="#">Threats</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Defense</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- Artikel -->
<div class="container mt-5">
<div class="row mb-5">
    <div class="col-md-4">
      <img src="img/itech.jpg" class="img-fluid img-hover" alt="Bawah 1">
    </div>
    <div class="col-md-8">
      <h3>Tentang situs</h3>
      <p>Situs ini adalah hasil dedikasi belajar Pemrograman berorientasi object lanjutan.</p>
      <a href="/cyber"><b>Baca ajah atau baca doang</b></a>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-md-4">
      <img src="img/threats.jpg" class="img-fluid img-hover" alt="Bawah 1">
    </div>
    <div class="col-md-8">
      <h3>Cyber Threats</h3>
      <p>Cyber threat adalah segala bentuk ancaman yang berasal dari dunia maya dan ditujukan untuk merusak, mencuri, atau mengganggu sistem komputer serta jaringan. Ancaman ini mencakup berbagai jenis serangan seperti malware, phishing, ransomware, dan serangan denial-of-service (DoS).</p>
    </div>
  </div>
  <div class="row mb-5">
    <div class="col-md-4">
      <img src="img/defense.avif" class="img-fluid img-hover" alt="Bawah 1">
    </div>
    <div class="col-md-8">
      <h3>Cyber Defense</h3>
      <p>Cyber ​​Defense adalah mekanisme pertahanan jaringan komputer yang mencakup respons terhadap tindakan dan perlindungan infrastruktur kritis dan jaminan informasi untuk organisasi, entitas pemerintah dan kemungkinan jaringan lainnya.</p>
    </div>
  </div>



  <!-- Embed Video YouTube -->
  <h2>Rekomendasi video</h2>
  <div class="row mb-5">
    @foreach (['VNp35Uw_bSM', 'zPodxy8zlX0', '7WFypNcDNLQ'] as $video)
    <div class="col-md-4 mb-4">
      <div class="ratio ratio-16x9">
        <iframe src="https://www.youtube.com/embed/{{ $video }}" title="YouTube video" allowfullscreen></iframe>
      </div>
    </div>
    @endforeach
  </div>

  <!-- Konten Bawah (Kamu Bisa Tambahkan Sebanyak yang Kamu Mau) -->
  <h2>Artikel lainnya</h2>
  <div class="row mb-5">
    <div class="col-md-4">
      <img src="img/studies.jpg" class="img-fluid img-hover" alt="Bawah 1">
    </div>
    <div class="col-md-8">
      <h3>Belajar</h3>
      <p>Belajar adalah cara kita untuk melawan rasa malas dan agar kita tetap malas.</p>
    </div>
  </div>

</div>

@endsection
