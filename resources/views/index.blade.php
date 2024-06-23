


@include('layouts._header')

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">MindMend</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('patient.login') }}">Login</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('signup') }}">Register</a>
    </div>
  </header>

  <main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="hero-bg">
        <img src="{{ asset('assets/assets_template/img/hero-bg-light.webp') }}" alt="">
      </div>
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1 data-aos="fade-up">Minimize Inconveniences & Wait Times.</h1>
          <p data-aos="fade-up" data-aos-delay="100">Feeling under the weather today? No need to fret!<br>
            Take advantage of our instant appointment service for psychologists and psychiatrists at MindMend. <br>
            Whether you're seeking a therapist or a mental health specialist, book your session conveniently online. 
            <br>Best of all, our service is free of charge. Schedule your appointment now.</p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('patient.login') }}" class="btn-get-started">Make Appointment</a>
          </div>
          <img src="{{ asset('assets/assets_template/img/hero.png') }}" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>
    </section><!-- /Hero Section -->
  </main>

  <footer id="footer" class="footer position-relative">
    <div class="container copyright text-center mt-4">
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Presented by. <a href="https://github.com/yogaelfaraby">Kelompok 4</a>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>
  @include('layouts._scripts')
  </body>

</html>
