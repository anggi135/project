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
    <img src="{{ asset('img/defense.avif') }}" class="img-fluid img-hover" style="max-width: 350px; height: auto;" alt="Cyber Threats">
  </div>

  <!-- Artikel -->
  <p><strong>Cyber</strong> merubakan cyber cyber jadi ketika cyber melakukan kegiatan cyber maka akan menjadi cyber.</p>

</div>

@endsection