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
<br>
<br>
<h1>Halo ini test halaman artikel mengenai cyber</h1>
<br>
<br>
<img src="img/threats.jpg" alt="cyber" style="max-width: 100%; height: auto;">
<br>
<p><b>Cyber</b>Merubakan cyber cyber jadi ketika cyber melakukan kegiatan cyber maka akan menjadi cyber</p>

@endsection