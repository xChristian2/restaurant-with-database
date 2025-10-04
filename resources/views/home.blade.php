@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>La Cuisine Élégante</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lora:wght@400;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    html { scroll-behavior: smooth; }
    section { scroll-margin-top: 50px; }

    /* ----- Base (dark mode default) ----- */
    body {
      font-family: 'Lora', serif;
      background-color: #111;
      color: #f8f9fa;
      opacity: 0;
      transition: background-color 0.45s ease, color 0.45s ease, opacity 0.6s ease;
    }
    body.fade-in { opacity: 1; }

    h1, h2, h3, .navbar-brand { font-family: 'Playfair Display', serif; }

    .navbar {
      background-color: #000 !important;
      position: fixed; top: 0; left: 0; width: 100%; z-index: 1030;
      transition: background-color 0.4s, box-shadow 0.4s;
    }
    .navbar-brand { font-weight: bold; font-size: 1.5rem; color: #d4af37 !important; }
    .nav-link { color: #f8f9fa !important; transition: color 0.3s; }
    .nav-link:hover { color: #d4af37 !important; }

  .nav-home {
    opacity: 1;
    transition: opacity 0.6s ease-in-out;
  }
  .nav-home.hidden {
    opacity: 0;
  }

    .hero {
      background: url('https://images.unsplash.com/photo-1552566626-52f8b828add9?auto=format&fit=crop&w=1500&q=80') center/cover no-repeat;
      height: 90vh;
      position: relative;
      display: flex; align-items: center; justify-content: center;
      padding-top: 80px; text-align: center;
    }
    /* Strong dark overlay in hero so text is readable */
    .hero::before {
      content: "";
      position: absolute; inset: 0;
      background: rgba(0,0,0,0.55);
      z-index: 1; transition: background 0.4s;
    }
    .hero-content { position: relative; z-index: 2; max-width: 900px; }

    /* Force hero text to remain readable white even in light mode */
    .hero .hero-content h3,
    .hero .hero-content h1,
    .hero .hero-content p {
      color: #fff !important;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.6) !important;
    }

    .btn-gold { background-color: #d4af37; color: #000; border: none; }
    .btn-gold:hover { background-color: #b8962f; color: #fff; }

    .card { background-color: #1c1c1c; border: none; transition: box-shadow 0.35s, background-color 0.35s, color 0.35s; }
    .card-img-top { height: 250px; object-fit: cover; }
    .card-title { color: #d4af37; }

    footer {
      background: #1c1c1c; color: #f1f1f1; padding: 20px; text-align: center;
      transition: background-color 0.4s, color 0.4s;
    }

    /* Culinary card hover */
    #culinary .card { transition: transform 0.3s, box-shadow 0.3s, border 0.3s;}
    #culinary .card:hover { transform: scale(1.05); box-shadow: 0 10px 25px rgba(212,175,55,0.6); border:2px solid #d4af37; }
    #culinary .card:hover .card-title { color: #ffd700; }

    /* Toggle switch (oblong) */
    .theme-switch { position: relative; display: inline-block; width: 50px; height: 26px; }
    .theme-switch input { display: none; }
    .slider { position: absolute; inset: 0; background: #333; border-radius: 34px; transition: 0.35s; cursor: pointer; }
    .slider:before {
      content: ""; position: absolute; height: 20px; width: 20px; left: 3px; bottom: 3px;
      background: #fff; border-radius: 50%; transition: 0.35s;
    }
    .theme-switch input:checked + .slider { background: #f1c40f; }
    .theme-switch input:checked + .slider:before { transform: translateX(24px); }

    /* Carousel base caption (dark) */
    .carousel-caption-custom {
      background: rgba(0,0,0,0.6);
      border-radius: 10px;
      padding: .9rem 1.2rem;
      color: #fff;
      transition: background 0.35s, color 0.35s;
    }
    .carousel-caption-custom h3 { margin-bottom: .3rem; color: #d4af37; }

    /* ----- Light mode overrides ----- */
    body.light-mode {
      background-color: #ffffff; color: #111;
    }

    /* navbar becomes subtle glass so it doesn't "cut" into the hero */
    body.light-mode .navbar {
      background: rgba(255,255,255,0.92) !important;
      box-shadow: 0 4px 18px rgba(0,0,0,0.06);
      backdrop-filter: blur(6px);
    }
    /* ensure brand looks clean */
    body.light-mode .navbar-brand { color: #111 !important; }
    body.light-mode .nav-link { color: #111 !important; }
    body.light-mode .nav-link:hover { color: #b8860b !important; }

    /* cards in light mode */
    body.light-mode .card {
      background-color: #ffffff; color: #111;
      box-shadow: 0 6px 20px rgba(0,0,0,0.12) !important;
      border: 1px solid rgba(0,0,0,0.06);
    }
    body.light-mode footer { background: #f8f9fa; color: #111; }

    /* Global major text forced to black in light mode (EXCEPT hero and carousel captions) */
    body.light-mode h1,
    body.light-mode h2,
    body.light-mode h3,
    body.light-mode p,
    body.light-mode .lead,
    body.light-mode .card-text,
    body.light-mode .card-title {
      color: #111 !important;
      text-shadow: none !important;
    }

    /* Carousel caption in light mode: light background + black text */
    body.light-mode .carousel-caption-custom {
      background: rgba(255,255,255,0.92) !important;
      color: #111 !important;
    }
    body.light-mode .carousel-caption-custom h3,
    body.light-mode .carousel-caption-custom p,
    body.light-mode .carousel-caption-custom .text-white {
      color: #111 !important;
      text-shadow: none !important;
    }

    /* keep hero content readable always (override the h1/h3/p global light-mode colors) */
    body.light-mode .hero .hero-content h3,
    body.light-mode .hero .hero-content h1,
    body.light-mode .hero .hero-content p {
      color: #fff !important;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.6) !important;
    }

    /* small adjustment so navbar brand doesn't get boxed */
    .navbar-brand { background: transparent; padding: 0; border: none; }

    /* make sure carousel controls are visible */
    .carousel-control-prev-icon, .carousel-control-next-icon { filter: none; }

    /* >>> Modal Light Mode Overrides <<< */
    body.light-mode .modal-content {
      background:#ffffff !important;
      color:#111 !important;
      border:2px solid #d4af37 !important;
      box-shadow:0px 8px 30px rgba(0,0,0,0.15) !important;
    }
    body.light-mode .modal-title { color:#b8860b !important; }
    body.light-mode .modal-body p { color:#111 !important; }
    body.light-mode .btn-close { filter: invert(1); }
    body.light-mode .modal-footer .btn {
      background:#d4af37 !important;
      color:#111 !important;
    }

    /* responsive fine-tuning */
    @media (max-width: 768px) {
      .hero { height: 60vh; padding-top: 70px; }
      .hero .hero-content h1 { font-size: 2rem; }
    }
</style>

</head>

<body>
  <!-- Order Invitation Modal -->
  <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center"
           style="background:#1b1b1b; border:2px solid #d4af37; border-radius:18px; color:white; box-shadow:0px 8px 30px rgba(0,0,0,0.7);">
        <div class="modal-header border-0">
          <h5 class="modal-title w-100" id="orderModalLabel"
              style="color:#d4af37; font-weight:bold; font-size:1.7rem;">
             A Culinary Experience Awaits
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body px-4">
          <p style="font-size:1.1rem; line-height:1.6;">
            You’ve explored our menu… now let us bring the flavors to your table.
            Indulge in dishes crafted with <span style="color:#d4af37;">passion, artistry, and premium ingredients</span>.
          </p>
          <img src="{{ asset('images/dining.jpg') }}" class="img-fluid rounded shadow mt-3" alt="Fine Dining">
          <p class="mt-3" style="font-size:1rem; font-style:italic; color:#cfcfcf;">
            Your perfect dining experience is just a click away.
          </p>
        </div>
        <div class="modal-footer border-0 justify-content-center">
          <a href="{{ url('/registration') }}" target="_blank" class="btn"
   style="background:#d4af37; color:#1b1b1b; font-weight:bold; border-radius:25px; padding:12px 28px; font-size:1.1rem; margin-top:-15px;">
   Order Now
</a>

        </div>
      </div>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark py-3 fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">La Cuisine Élégante</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link nav-home active" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#culinary">Menu</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Reservations</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/profile') }}">Profile</a></li>
          <li class="nav-item ms-3">
            <label class="theme-switch" title="Toggle theme">
              <input type="checkbox" id="themeToggle">
              <span class="slider"></span>
            </label>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <header class="hero d-flex align-items-center justify-content-center text-center">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
      <h3 class="mb-3 px-3 py-2"
          style="color:#ffd700; font-weight:600; text-shadow: 2px 2px 6px rgba(0,0,0,0.7);
                 background: rgba(0,0,0,0.6); border-radius: 10px; display: inline-block;">
        @auth
          Greetings, {{ auth()->user()->name }}!
        @else
          Greetings, Guest!
        @endauth
      </h3>

      <h1 class="display-3 fw-bold" style="color:#fff; text-shadow: 2px 2px 8px rgba(0,0,0,0.6);">
        Experience Fine Dining
      </h1>

      <p class="lead mb-4" style="color:#fff; text-shadow: 1px 1px 5px rgba(0,0,0,0.6);">
        A symphony of flavors crafted with elegance and passion
      </p>

      @auth
        <a href="{{ url('/reservation') }}" class="btn btn-gold btn-lg">Reserve a Table</a>
      @endauth
      @guest
        <a href="{{ route('registration') }}" class="btn btn-gold btn-lg">Reserve a Table</a>
      @endguest
    </div>
  </header>

  <!-- Carousel -->
  <div id="storyCarousel" class="carousel slide mt-5" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('images/image2.jpg') }}" alt="Steak Dish" class="d-block w-100"
             style="height: 700px; object-fit: cover; background-color: #000;">
        <div class="carousel-caption carousel-caption-custom d-none d-md-block p-3">
          <h3>Our Culinary Philosophy</h3>
          <p>
            Every dish begins with passion, precision, and respect for the finest ingredients.
            We craft experiences, not just meals.
          </p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="{{ asset('images/image3.jpg') }}" alt="Wine Pairing" class="d-block w-100"
             style="height: 700px; object-fit: cover; background-color: #000;">
        <div class="carousel-caption carousel-caption-custom d-none d-md-block p-3">
          <h3>The Perfect Pairing</h3>
          <p>
            Our sommeliers curate an exquisite wine collection, elevating every bite into a harmony of flavors.
          </p>
        </div>
      </div>

      <div class="carousel-item">
        <img src="{{ asset('images/image1.jpg') }}" alt="Elegant Ambience" class="d-block w-100"
             style="height: 700px; object-fit: cover; background-color: #000;">
        <div class="carousel-caption carousel-caption-custom d-none d-md-block p-3">
          <h3>An Elegant Ambience</h3>
          <p>
            Candlelight, refined interiors, and attentive service — every moment is designed to indulge your senses.
          </p>
        </div>
      </div>
    </div>

    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#storyCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#storyCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- Signature Dishes -->
  <section class="py-5">
    <div class="container text-center">
      <h2 class="mb-5 text-uppercase" style="color:#d4af37;">Our Signature Dishes</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card shadow-sm">
            <img src="{{ asset('images/scallops.jpg') }}" alt="Seared Scallops" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Seared Scallops</h5>
              <p class="card-text">Perfectly seared tenderloin served with truffle butter sauce.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card shadow-sm">
            <img src="{{ asset('images/steak.jpg') }}" alt="Steak" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Steak</h5>
              <p class="card-text">Silky smooth soup infused with cognac and fresh cream.</p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card shadow-sm">
            <img src="{{ asset('images/souffle.jpg') }}" alt="Chocolate Soufflé" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Chocolate Soufflé</h5>
              <p class="card-text">Decadent dark chocolate dessert with a molten center.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="culinary" class="py-5" style="padding-top: 120px; margin-top: -80px;">
    <div class="container text-center">
      <h2 class="mb-5 text-uppercase" style="color:#d4af37;">Culinary Selections</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <a href="{{ url('/primecut') }}" target="_blank" class="text-decoration-none text-reset">
            <div class="card shadow-sm h-100">
              <img src="{{ asset('images/meat.jpg') }}" alt="Prime Cuts" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">Prime Cuts</h5>
                <p class="card-text">Exquisite cuts of meat, grilled and roasted to perfection.</p>
              </div>
            </div>
          </a>
        </div>
         <div class="col-md-4 mb-4">
      <div class="card shadow-sm">
        <img src="{{ asset('images/seafood.jpg') }}" alt="Seafood Delights" class="card-img-top">
        <div class="card-body text-center">
          <h5 class="card-title">Seafood Delights</h5>
          <p class="card-text">Freshly sourced seafood, prepared with a touch of elegance.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm">
        <img src="{{ asset('images/vegan.jpg') }}" alt="Vegetarian Treats" class="card-img-top">
        <div class="card-body text-center">
          <h5 class="card-title">Vegetarian Treats</h5>
          <p class="card-text">Wholesome vegetarian dishes packed with flavor and nutrition.</p>
        </div>
      </div>
    </div>
  </div>
</div>
  </section>

  <!-- Sign-in Warning Modal -->
  <div class="modal fade" id="signInWarningModal" tabindex="-1" aria-labelledby="signInWarningLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center" style="background:#1b1b1b; border:2px solid #d4af37; border-radius:18px; color:white;">
        <div class="modal-header border-0 justify-content-center">
          <h5 class="modal-title" id="signInWarningLabel" style="color:#d4af37; font-weight:bold; font-size:1.5rem;">
            Access Denied
          </h5>
        </div>
        <div class="modal-body px-4">
          <p style="font-size:1.1rem; line-height:1.6;">
            You must be signed in/registered to continue.
          </p>
        </div>
        <div class="modal-footer border-0 justify-content-center">
          <button type="button" class="btn" style="background:#d4af37; color:#1b1b1b; font-weight:bold; border-radius:25px; padding:10px 25px;" data-bs-dismiss="modal">
            OK
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center py-4">
    <p class="mb-0">© 2025 La Cuisine Élégante | Crafted with Passion</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const isLoggedIn = @json(auth()->check());
      if (!isLoggedIn) {
        setTimeout(function () {
          const orderModalEl = document.getElementById('orderModal');
          const orderModal = new bootstrap.Modal(orderModalEl);
          orderModal.show();
        }, 20000);
      }

      document.body.classList.add('fade-in');

      const cards = document.querySelectorAll("#culinary .card a, #culinary .card");
      const warningModal = new bootstrap.Modal(document.getElementById('signInWarningModal'));
      cards.forEach(card => card.addEventListener('click', function(e){
        if (!isLoggedIn) { e.preventDefault(); warningModal.show(); }
      }));

      const toggle = document.getElementById('themeToggle');
      const body = document.body;

      const saved = localStorage.getItem('theme') || 'dark';
      if (saved === 'light') {
        body.classList.add('light-mode');
        if (toggle) toggle.checked = true;
      } else {
        body.classList.remove('light-mode');
        if (toggle) toggle.checked = false;
      }

      if (toggle) {
        toggle.addEventListener('change', function () {
          if (this.checked) {
            body.classList.add('light-mode');
            localStorage.setItem('theme', 'light');
          } else {
            body.classList.remove('light-mode');
            localStorage.setItem('theme', 'dark');
          }
        });
      }
    });
  </script>
 
<script>
  const homeBtn = document.querySelector('.nav-home');
  let scrollTimer;

  window.addEventListener('scroll', () => {
    if (homeBtn) homeBtn.classList.add('hidden');

    clearTimeout(scrollTimer);
    scrollTimer = setTimeout(() => {
      if (homeBtn) homeBtn.classList.remove('hidden');
    }, 2000);
  });
</script>
</body>
</html>
@endsection