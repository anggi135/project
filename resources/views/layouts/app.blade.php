<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cyber Threats & Defense</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <!-- AOS Scroll Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <style>
    html {
      scroll-behavior: smooth;
    }
    html, body {
  height: 100%;
  display: flex;
  flex-direction: column;
}

section {
  flex: 1;
}

footer {
  margin-top: auto;
}

  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="/">
        <img src="{{ asset('img/favicon.png') }}" width="26" class="me-2"> Cyber Defense
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/threats">Threats</a></li>
          <li class="nav-item"><a class="nav-link" href="/defense">Defense</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="toolsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Tools
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="toolsDropdown">
              <li><a class="dropdown-item" href="/fuzz">Fuzzing</a></li>
              <li><a class="dropdown-item" href="/check-url">Check URL</a></li>
              <li><a class="dropdown-item" href="/api-testing">API Testing</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Content dari setiap halaman -->
  @yield('content')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- AOS Init -->
  <script>
    AOS.init({
      duration: 1000,
      once: true
    });
  </script>

</body>
</html>