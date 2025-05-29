@extends('layouts.app')

@section('content')

<style>
  html {
    scroll-behavior: smooth;
  }

  /* Custom animation */
  .fade-in-up {
    opacity: 0;
    transform: translateY(30px);
    animation: fadeInUp 1s ease-out forwards;
  }

  @keyframes fadeInUp {
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .delay-1 {
    animation-delay: 0.3s;
  }

  .delay-2 {
    animation-delay: 0.6s;
  }

  .delay-3 {
    animation-delay: 0.9s;
  }
</style>

<!-- Hero Section with Slideshow Background -->
<section id="hero" class="text-white section-scroll" style="min-height: 100vh; display: flex; align-items: center; position: relative; overflow: hidden;">
  <div id="hero-background" class="w-100 h-100 position-absolute" style="top: 0; left: 0; z-index: 0; background-size: cover; background-position: center; transition: background-image 1s ease;"></div>

  <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

  <div class="container text-center position-relative" style="z-index: 2;">
    <h1 class="display-4 fw-bold mb-3 fade-in-up delay-1">Welcome to Cyber Threats & Defense</h1>
    <p class="lead fade-in-up delay-2">Mengenal, Mendeteksi, dan Melindungi Dunia Digital dengan Strategi Keamanan Siber Terbaik</p>
    <div class="mt-4 fade-in-up delay-3">
      <a href="#tujuan" class="btn btn-outline-light btn-lg mx-2">📌 Tujuan</a>
      <a href="/threats" class="btn btn-outline-light btn-lg mx-2">📛 Cyber Threats</a>
      <a href="/defense" class="btn btn-info btn-lg mx-2">🛡️ Cyber Defense</a>
    </div>
  </div>
</section>

<!-- Narasi Kenapa Penting -->
<section class="bg-light py-5 section-scroll" data-aos="fade-up">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-6 col-lg-5 mb-4 mb-md-0 text-center" data-aos="fade-right">
        <img src="{{ asset('img/cyber-secure.jpg') }}" alt="Cyber Security Illustration"
             class="img-fluid rounded shadow" style="max-width: 90%; height: auto;">
      </div>
      <div class="col-md-6 col-lg-7" data-aos="fade-left">
        <h2 class="fw-bold">Kenapa Cyber Security Itu Penting?</h2>
        <p class="text-muted text-justify">
          Di era digital, ancaman siber bisa menyerang siapa saja — individu, perusahaan, hingga pemerintahan. Cyber Security jadi tameng utama untuk melindungi data, sistem, dan privasi dari serangan seperti peretasan, pencurian data, hingga ransomware.
        </p>
        <p class="text-muted text-justify">
          Setiap perangkat yang terhubung ke internet butuh perlindungan berlapis. Mulai dari firewall, sistem enkripsi, antivirus, hingga edukasi pengguna agar lebih waspada terhadap potensi serangan.
        </p>
        <p class="text-muted text-justify">
          Intinya, cyber security bukan cuma soal teknologi. Ini adalah komitmen jangka panjang untuk menjaga dunia digital tetap aman, nyaman, dan terpercaya.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Tujuan Website -->
<section id="tujuan" class="py-5 bg-light text-dark section-scroll" data-aos="fade-up">
  <div class="container">
    <div class="text-center mb-5" data-aos="zoom-in">
      <h2 class="fw-bold display-5">Tujuan Website Ini Dibuat</h2>
      <p class="lead text-secondary">Kenapa website ini hadir untuk semua kalangan</p>
    </div>

    <div class="row align-items-center justify-content-center">
      <div class="col-md-6 col-lg-5 mb-4" data-aos="fade-right">
        <div class="text-center">
          <img src="{{ asset('img/cyber-objective.jpg') }}" alt="Tujuan Website"
            class="img-fluid rounded shadow" style="max-width: 90%; height: auto;">
        </div>
      </div>
      <div class="col-md-6 col-lg-7" data-aos="fade-left">
        <p class="fs-5 mb-4 text-justify">
          Website ini dibuat sebagai sarana edukasi untuk memperluas wawasan kita semua dalam dunia
          <span class="fw-bold text-info">Cyber Security</span>. Kami ingin mengajak masyarakat agar lebih sadar terhadap pentingnya
          perlindungan data, mengenal berbagai ancaman digital, dan memahami strategi pertahanan sistem dari serangan siber.
        </p>
        <p class="fs-6 text-secondary text-justify">
          <i class="bi bi-check-circle-fill text-success me-2"></i>
          Harapan kami, melalui platform ini kita bisa belajar dengan cara yang mudah dipahami, menarik, dan aplikatif —
          baik untuk pelajar, mahasiswa, maupun profesional yang ingin mengenal lebih dalam dunia keamanan digital.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="text-center text-white bg-dark py-3" data-aos="fade-up">
  <small>&copy; 2025 Cyber Defense Team | All Rights Reserved</small>
</footer>

<!-- AOS + Animate -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000,
    once: true
  });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<script>
  const heroImages = [
    "{{ asset('img/cyber-bg.jpg') }}",
    "{{ asset('img/cyber-slide-2.jpg') }}",
    "{{ asset('img/cyber-slide-3.jpg') }}"
  ];

  let currentIndex = 0;
  const heroBg = document.getElementById('hero-background');

  function changeBackground() {
    currentIndex = (currentIndex + 1) % heroImages.length;
    heroBg.style.backgroundImage = `url('${heroImages[currentIndex]}')`;
  }

  heroBg.style.backgroundImage = `url('${heroImages[currentIndex]}')`;
  setInterval(changeBackground, 5000); // ganti setiap 5 detik
</script>

@endsection
