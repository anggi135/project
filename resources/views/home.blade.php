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

<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide mt-4" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img6.jpg" class="d-block w-100" alt="Slide 1">
    </div>
    <div class="carousel-item">
      <img src="img8.jpg" class="d-block w-100" alt="Slide 2">
    </div>
    <div class="carousel-item">
      <img src="img10.jpg" class="d-block w-100" alt="Slide 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

<!-- Artikel -->
<div class="container mt-5">
<div class="row mb-5">
    <div class="col-md-4">
      <img src="img/itech.jpg" class="img-fluid img-hover" alt="Bawah 1">
    </div>
    <div class="col-md-8">
      <h3>Tentang situs</h3>
      <p>Situs ini adalah hasil dedikasi belajar Pemrograman berorientasi object lanjutan.</p>
      <a href="aaaa.aa"><b>Baca ajah atau baca doang</b></a>
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
