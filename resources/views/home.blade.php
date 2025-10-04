@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>La Cuisine Élégante</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Lora:wght@400;600&display=swap" rel="stylesheet">
  <link href="  https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css  " rel="stylesheet">
  <style>
    html {
      scroll-behavior: smooth;
    }

    section {
      scroll-margin-top: 50px;
    }

    body {
      font-family: 'Lora', serif;
      background-color: #111;
      color: #f8f9fa;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }

    body.fade-in {
    opacity: 1;
    }

    h1, h2, h3, .navbar-brand {
      font-family: 'Playfair Display', serif;
    }

    .navbar {
      background-color: #000 !important;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1030;
    }

    .navbar-brand {
      font-weight: bold;
      font-size: 1.5rem;
      color: #d4af37 !important;
    }

    .nav-link {
      color: #f8f9fa !important;
    }

    .nav-link:hover {
      color: #d4af37 !important;
    }

    .hero {
      background: url('https://images.unsplash.com/photo-1552566626-52f8b828add9?auto=format&fit=crop&w=1500&q=80') no-repeat center center;
      background-size: cover;
      height: 90vh;
      position: relative;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding-top: 80px;
    }

    .hero::before {
      content: "";
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.55);
      z-index: 1;
    }

    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 800px;
    }

    .btn-gold {
      background-color: #d4af37;
      color: #000;
      border: none;
    }

    .btn-gold:hover {
      background-color: #b8962f;
      color: #fff;
    }

    .card {
      background-color: #1c1c1c;
      border: none;
    }

    .card-img-top {
      height: 250px;
      object-fit: cover;
    }

    .card-title {
      color: #d4af37;
    }

    #orderModal .btn {
      transition: all 0.3s ease;
    }

    #orderModal .btn:hover {
      background-color: #1b1b1b;
      color: #d4af37;
      transform: scale(1.05);
      box-shadow: 0 5px 15px rgba(212, 175, 55, 0.5);
    }

    .navbar-nav .nav-link.active {
      transition: opacity 0.5s ease;
    }

    .navbar-nav .nav-link.active.hidden {
      opacity: 0;
      pointer-events: none;
    }

        /* Culinary Selection Card Hover Effect */
    #culinary .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease, border 0.3s ease;
      border: 2px solid transparent; /* default */
    }

    #culinary .card:hover {
      transform: scale(1.05); /* grow slightly */
      box-shadow: 0 10px 25px rgba(212, 175, 55, 0.6); /* golden glow */
      border: 2px solid #d4af37; /* gold border */
    }

    /* Optional: card title color highlight on hover */
    #culinary .card:hover .card-title {
      color: #ffd700; /* brighter gold */
    }

    footer {
      background: #000;
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
             style="background:#d4af37; color:#1b1b1b; font-weight:bold; border-radius:25px; padding:12px 28px; font-size:1.1rem;">
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
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#culinary">Menu</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Reservations</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ url('/profile') }}">Profile</a></li>
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
             style="height: 700px; object-fit: contain; background-color: #000;">
        <div class="carousel-caption d-none d-md-block p-3"
             style="background: rgba(0, 0, 0, 0.6); border-radius: 10px;">
          <h3 style="color:#d4af37;">Our Culinary Philosophy</h3>
          <p class="text-white">
            Every dish begins with passion, precision, and respect for the finest ingredients.  
            We craft experiences, not just meals.
          </p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/image3.jpg') }}" alt="Wine Pairing" class="d-block w-100"
             style="height: 700px; object-fit: contain; background-color: #000;">
        <div class="carousel-caption d-none d-md-block p-3"
             style="background: rgba(0, 0, 0, 0.6); border-radius: 10px;">
          <h3 style="color:#d4af37;">The Perfect Pairing</h3>
          <p class="text-white">
            Our sommeliers curate an exquisite wine collection, elevating every bite into a harmony of flavors.
          </p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('images/image1.jpg') }}" alt="Elegant Ambience" class="d-block w-100"
             style="height: 700px; object-fit: contain; background-color: #000;">
        <div class="carousel-caption d-none d-md-block p-3"
             style="background: rgba(0, 0, 0, 0.6); border-radius: 10px;">
          <h3 style="color:#d4af37;">An Elegant Ambience</h3>
          <p class="text-white">
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
              <p class="text-white card-text">Perfectly seared tenderloin served with truffle butter sauce.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm">
            <img src="{{ asset('images/steak.jpg') }}" alt="Steak" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Steak</h5>
              <p class="text-white card-text">Silky smooth soup infused with cognac and fresh cream.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm">
            <img src="{{ asset('images/souffle.jpg') }}" alt="Chocolate Soufflé" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">Chocolate Soufflé</h5>
              <p class="text-white card-text">Decadent dark chocolate dessert with a molten center.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Culinary Selections -->
  <section id="culinary" class="py-5" style="padding-top: 120px; margin-top: -80px;">
    <div class="container text-center">
      <h2 class="mb-5 text-uppercase" style="color:#d4af37;">Culinary Selections</h2>
      <div class="row g-4">
        <!-- Each selection card -->
        <!-- Prime Cuts -->
        <div class="col-md-4">
          <a href="{{ url('/primecut') }}" target="_blank" class="text-decoration-none text-reset">
            <div class="card shadow-sm h-100">
              <img src="{{ asset('images/meat.jpg') }}" alt="Prime Cuts" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">Prime Cuts</h5>
                <p class="text-white card-text">Exquisite cuts of meat, grilled and roasted to perfection.</p>
              </div>
            </div>
          </a>
        </div>
        <!-- Garden Harvest -->
        <div class="col-md-4">
          <a href="{{ url('/gardenharvest') }}" target="_blank" class="text-decoration-none text-reset">
            <div class="card shadow-sm h-100">
              <img src="{{ asset('images/vegan.jpg') }}" alt="Garden Harvest" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">Garden Harvest</h5>
                <p class="text-white card-text">Fresh seasonal produce, crafted with culinary artistry.</p>
              </div>
            </div>
          </a>
        </div>
        <!-- Gourmet Starters -->
        <div class="col-md-4">
          <a href="{{ url('/gourmetstarters') }}" target="_blank" class="text-decoration-none text-reset">
            <div class="card shadow-sm h-100">
              <img src="{{ asset('images/gourmet.jpg') }}" alt="Gourmet Starters" class="card-img-top">
              <div class="card-body">
                <h5 class="card-title">Gourmet Starters</h5>
                <p class="text-white card-text">Refined appetizers to begin your dining journey in style.</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Signature Cocktails -->
        <div class="col-md-4 mb-4">
          <a href="{{ url('/cocktails') }}" target="_blank" class="text-decoration-none text-reset">
            <div class="card shadow-sm h-100">
              <img src="{{ asset('images/cocktails.jpg') }}" alt="Signature Cocktails" class="card-img-top" style="height:250px; object-fit:cover;">
              <div class="card-body text-center">
                <h5 class="card-title" style="color:#d4af37;">Signature Cocktails</h5>
                <p class="text-white card-text">Artfully mixed cocktails designed to captivate your palate.</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Fine Beverages -->
        <div class="col-md-4 mb-4">
          <a href="{{ url('/beverages') }}" target="_blank" class="text-decoration-none text-reset">
            <div class="card shadow-sm h-100">
              <img src="{{ asset('images/beverages.jpg') }}" alt="Fine Beverages" class="card-img-top" style="height:250px; object-fit:cover;">
              <div class="card-body text-center">
                <h5 class="card-title" style="color:#d4af37;">Fine Beverages</h5>
                <p class="text-white card-text">An exquisite collection of wines, spirits, and refreshments.</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Chef's Recommendation -->
        <div class="col-md-4 mb-4">
          <a href="{{ url('/chefs-recommendation') }}" target="_blank" class="text-decoration-none text-reset">
            <div class="card shadow-sm h-100">
              <img src="{{ asset('images/chef.jpg') }}" alt="Chef's Recommendation" class="card-img-top" style="height:250px; object-fit:cover;">
              <div class="card-body text-center">
                <h5 class="card-title" style="color:#d4af37;">Chef's Recommendation</h5>
                <p class="text-white card-text">A signature creation by our head chef, crafted with rare ingredients and unmatched artistry.</p>
              </div>
            </div>
          </a>
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

  <script src="  https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js  "></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Blade variable: true if user is logged in
        const isLoggedIn = @json(auth()->check()); 

        // Show Order Modal after 30 seconds ONLY if not logged in
        if (!isLoggedIn) {
            setTimeout(function () {
                var orderModalEl = document.getElementById('orderModal');
                var orderModal = new bootstrap.Modal(orderModalEl);
                orderModal.show();

                orderModalEl.addEventListener('hidden.bs.modal', function () {
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.querySelectorAll('.modal-backdrop').forEach(function(el) { el.remove(); });
                });
            }, 30000); // 30 seconds
        }

    // Home button scroll hide/reappear
    const homeBtn = document.querySelector('.navbar-nav .nav-link.active');
    let scrollTimer;
    window.addEventListener('scroll', () => {
        if (homeBtn) homeBtn.classList.add('hidden');
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(() => { if (homeBtn) homeBtn.classList.remove('hidden'); }, 3000);
    });
});
</script>
  <script>
document.addEventListener("DOMContentLoaded", function () {
    // Blade variable: true if user is logged in
    const isLoggedIn = @json(auth()->check()); 

    // Select all culinary selection cards links
    const cards = document.querySelectorAll("#culinary .card a, #culinary .card");

    const warningModalEl = document.getElementById('signInWarningModal');
    const warningModal = new bootstrap.Modal(warningModalEl);

    cards.forEach(card => {
        card.addEventListener("click", function(e) {
            if (!isLoggedIn) {
                e.preventDefault(); // prevent navigation
                warningModal.show(); // show the warning modal
            }
        });
    });
});
</script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
      document.body.classList.add('fade-in');
  });
</script>
</body>
</html>
@endsection