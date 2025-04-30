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

  <h1 class="text-center">Cyber Threats</h1>

  <!-- Gambar sebelum artikel -->
  <div class="text-center my-4">
    <img src="{{ asset('img/threats.jpg') }}" class="img-fluid img-hover" style="max-width: 350px; height: auto;" alt="Cyber Threats">
  </div>

  <!-- Artikel -->
  <p><strong>Cyber threats</strong> adalah ancaman atau serangan yang dilakukan oleh penjahat siber untuk merusak dan mencuri data, bahkan ada juga yang sampai memusnahkan data.</p>
  <h2>Jenis-jenis serangan umum</h2>
  <p>Sebetulnya banyak sekali serangan yang dilakukan oleh penjahat siber namun diartikel ini kami hanya akan membahas beberapa serangan umum saja.</p>
  <ul>
    <li><strong>Phishing</strong>: Penipuan dengan menyamar sebagai pihak terpercaya untuk mencuri data pribadi.</li>
    <li><strong>SQL Injection</strong>: Menyisipkan perintah SQL ke formulir input untuk mengakses atau merusak database.</li>
    <li><strong>DDoS (Distributed Denial of Service)</strong>: Membanjiri server dengan lalu lintas palsu agar tidak bisa melayani pengguna sah.</li>
    <li><strong>Brute Force Attack</strong>: Mencoba berbagai kombinasi username dan password hingga menemukan yang benar.</li>
  </ul>
  <h2>Cara kerja serangan siber</h2>
  <b>A. Phising</b>
  <p>Phishing adalah metode penipuan siber yang mencoba menipu korban agar memberikan informasi sensitif, seperti username, password, nomor kartu kredit, atau OTP </p>
  <b>Cara kerja Phising</b>
  <ul>
    <li>Targeting, Penyerang menentukan target.</li>
    <li>Pengiriman umpan, Penyerang mengirim email, sms atau pesan yang tampak sah dengan menyamar menjadi petugas atau teler bank dll</li>
    <li>Kemudian penyerang mengirim tautan atau url palsu</li>
    <li>Penyerang memanipulasi psikologis korban</li>
    <li>Korban tertipu</li>
    <li>Kemudian penyerang mengambil alih data korban dan menyalah gunakannya.</li>
  </ul>
  <b>B. SQL Inject</b>
  <p>SQL inject adalah teknik serangan yang menargetkan input berbahaya didalam aplikasi seperti formulir, login, request tampering dan parameter url yang tujuannya tak lain untuk mengakses atau merusak database.</p>
  <b>Cara kerja SQL Inject</b>
  <ul>
    <li>Penyerang mencari form input aplikasi, Login, regist, formulir dll</li>
    <li>Penyerang mencoba kueri <strong>[ ' or '1'='1 ]</strong> karena nila itu selalu benar, maka login akan dianggap valid dan berhasil masuk tanpa passwd.</li>
  </ul>
  <b>C. DDOS (Distributed Denial of Service)</b>
  <p>DDOS adalah jenis serangan siber umum dimana serangan ini bertujuan untuk membanjiri server, jaringan atau layanan online. Si penyerang membuat lalu lalulintas yang sangat besar terhadap server sehingga sistem yang memiliki kapasitas akan menjadi lambat. hal buruknya adalah sistem akan lumpuh sepenuhnya.</p>
  <b>Cara kerja DDos</b>
  <ul>
    <li>Penyerang menyiapkan ribuan bahkan jutaan Botnet atau zombie dalam satu jaringan.</li>
    <li>Penyerang menentukan target situs, server atau layanan API.</li>
    <li>Kemudian Botnet yang telah disiapkan secara serentak akan mengirim permintaan HTTP/S, TCP/UDP atau ICMP/Ping secara terus-menerus.</li>
  </ul>
  <b>D. Brute Force Attack</b>
  <p>Ini hampir mirip cara seperti login pada umumnya seperti memasukan username dan passwd, Akan tetapi Serangan Bruteforce adalah metode dimana sipenyerang mencoba semua kombinasi username dan passwd dengan otomatis sampai menemukan nilai yang benar.</p>
  <b>Cara kerja Bruteforce attack</b>
  <ul>
    <li>Menentukan target login pada aplikasi.</li>
    <li>memperisapkan kumpulan usernam dan passwd atau yang disebut wordlist.</li>
    <li>Menyiapkan beberapa tools, seperti Hydra medusa dll.</li>
    <li>Kemudian mengeksekusinya dengan permintaan yang berulang.</li>
  </ul>
  <b>Kesimpulan</b>
  <p>Cyber threats atau serangan siber adalah ancaman nyata di era digital yang semakin berkembang. banyak sekali penjahat siber yang memanfaatkan metode atau celah seperti Phising, Sql inject, Ddos dan Bruteforce untuk mencuri, merusak bahkan menghancurkan data pribadi maupun sistem dari organisasi.</p>
  <p>Dengan memahami cara kerja dari serangan siber umum yang terjadi, kita bisa lebih waspada dan mengambil langkah-langkah pencegahan yang tepat dan juga verifikasi berlapis tentunya juga dengan pengamanan captcha serta firewal.</p>

</div>

@endsection