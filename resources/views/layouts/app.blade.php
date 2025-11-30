<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cyber Threats & Defense</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

  <!-- AOS Scroll Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  <style>
    html {
      scroll-behavior: smooth;
    }

    /* Background partikel */
    #particles-js {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      background: #0d1117;
    }
  </style>
</head>
<body>

  <!-- Background Partikel -->
  <div id="particles-js"></div>

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

  <!-- Konten halaman -->
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

  <!-- Particles.js -->
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script>
    particlesJS("particles-js", {
      "particles": {
        "number": { "value": 100, "density": { "enable": true, "value_area": 800 } },
        "color": { "value": "#ffffff" },
        "shape": { "type": "circle" },
        "opacity": { "value": 0.5 },
        "size": { "value": 3, "random": true },
        "line_linked": { "enable": true, "distance": 140, "color": "#ffffff", "opacity": 0.3, "width": 1 },
        "move": { "enable": true, "speed": 1.5 }
      },
      "interactivity": {
        "events": { "onhover": { "enable": false }, "onclick": { "enable": true, "mode": "push" } },
        "modes": { "push": { "particles_nb": 15 } }
      },
      "retina_detect": true
    });
  </script>

  <!-- Particles mengikuti mouse -->
  <script>
document.addEventListener("mousemove", function(e) {
    const pJS = window.pJSDom[0].pJS;
    const canvas = pJS.canvas.el;

    // Rasio canvas internal vs CSS
    const scaleX = canvas.width / canvas.offsetWidth;
    const scaleY = canvas.height / canvas.offsetHeight;

    // Posisi mouse relatif ke canvas
    const mouseX = e.clientX * scaleX;
    const mouseY = e.clientY * scaleY;

    pJS.particles.array.forEach(p => {
        const dx = mouseX - p.x;
        const dy = mouseY - p.y;
        const dist = Math.sqrt(dx*dx + dy*dy);

        if (dist < 200) {
            const force = (200 - dist) / 200;
            p.x += dx * force * 0.12;  
            p.y += dy * force * 0.12;
        }
    });
});
  </script>

</body>
</html>
