<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Toko Buku Swasembada</title>
  <link rel="shortcut icon" href="{{ asset('front_end/images/favicon.png') }}" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" type="text/css" href="{{ asset('front_end/css/bootstrap.css') }}" />
  <link href="{{ asset('front_end/css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('front_end/css/responsive.css') }}" rel="stylesheet" />
  <!-- Add this line for Font Awesome if you need it -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <style>
    /* Navbar hover effect */
    .custom_nav-container .navbar-nav .nav-link {
      transition: color .15s ease, background-color .15s ease, transform .12s ease, box-shadow .12s ease;
      border-radius: 6px;
      padding: .45rem .7rem;
      color: inherit;
    }

    .custom_nav-container .navbar-nav .nav-link:hover,
    .custom_nav-container .navbar-nav .nav-item.active .nav-link {
      background-color: rgba(0, 0, 0, 0.08);
      color: #111;
      transform: translateY(-3px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
      text-decoration: none;
    }

    .user_option a,
    .user_option .logout a,
    .user_option .logout x-dropdown-link {
      transition: transform .12s ease, color .12s ease;
    }

    .user_option a:hover,
    .user_option .logout:hover,
    .user_option .logout a:hover,
    .user_option .logout x-dropdown-link:hover {
      transform: translateY(-2px);
      color: #111;
    }

    @media (max-width: 767px) {
      .custom_nav-container .navbar-nav .nav-link {
        padding: .4rem .5rem;
      }
    }
  </style>
</head>

<body>
  <div class="hero_area">
    <!-- header -->
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="{{ route('index') }}">
          <span>Toko Buku Swasembada</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
          <span class=""></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('index') }}">Beranda</a></li>
            <li class="nav-item {{ request()->routeIs('catalog.index') ? 'active' : '' }}"><a class="nav-link" href="{{ route('catalog.index') }}">Katalog Buku</a></li>
            <li class="nav-item {{ request()->routeIs('order.history') ? 'active' : '' }}"><a class="nav-link" href="{{ route('order.history') }}">Riwayat Pesanan</a></li>
          </ul>

          <div class="user_option">
            @if(Auth::check() && Auth::user()->role === 'admin')
            <a href="{{route('dashboard')}}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fa fa-user"></i> Dashboard</a>
            @elseif(!Auth::check())
            <a href="{{route('login')}}" class="{{ request()->routeIs('login') ? 'active' : '' }}"><i class="fa fa-user"></i> Login</a>
            <a href="{{route('register')}}" class="{{ request()->routeIs('register') ? 'active' : '' }}"><i class="fa fa-user"></i> Daftar</a>
            @else
            <!-- Log out               -->
            <div class="list-inline-item logout">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </div>
            @endif
            <a href="{{ route('cart.index') }}"><i class="fa fa-shopping-bag"></i></a>
            
          </div>
          
        </div>
      </nav>
    </header>
    <!-- end header -->

    {{-- Show hero slider except on product details page --}}
    @unless(request()->routeIs(['product_details', 'cart.index', 'checkout.form', 'catalog.index', 'order.history']))
    <!-- slider -->
    <section class="slider_section">
      <div class="slider_container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-7">
                    <div class="detail-box">
                      <h1>Selamat Datang di <br>Toko Buku Swasembada</h1>
                      <p>Kami menyediakan berbagai macam buku bacaan, novel, komik, hingga referensi kuliah dengan harga terjangkau.</p>
                      <a href="{{ route('catalog.index') }}">Lihat Katalog</a>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="img-box">
                      <img style="width:500px" src="front_end/images/book-banner.jpg" alt="banner buku" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end slider -->
    @endunless
  </div>

  <!-- shop section -->
  <section class="shop_section layout_padding">
    @yield('index')
    @yield('product_details')
    @yield('katalog')
    @yield('login')
    @yield('register')
    @yield('cart')
    @yield('checkout_form')
    @yield('checkout_success')
    @yield('order_history')
  </section>
  <!-- end shop section -->

  <!-- info section -->
  <section class="info_section layout_padding2-top">
    <div class="social_container">
      <div class="social_box">
        <a href=""><i class="fa fa-facebook"></i></a>
        <a href=""><i class="fa fa-twitter"></i></a>
        <a href=""><i class="fa fa-instagram"></i></a>
        <a href=""><i class="fa fa-youtube"></i></a>
      </div>
    </div>
    <div class="info_container ">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <h6>Tentang Kami</h6>
            <p>Toko Buku Swasembada berdiri sejak 2025 dan berkomitmen menyediakan bacaan berkualitas untuk semua kalangan.</p>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="info_form">
              <h5>Newsletter</h5>
              <form action="#"><input type="email" placeholder="Masukkan email"><button>Subscribe</button></form>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <h6>Bantuan</h6>
            <p>Hubungi kami untuk informasi stok, pemesanan buku khusus, atau layanan pelanggan lainnya.</p>
          </div>
          <div class="col-md-6 col-lg-3">
            <h6>Kontak Kami</h6>
            <div class="info_link-box">
              <a href=""><i class="fa fa-map-marker"></i><span>Jl. Prof. Sudarto, Tembalang, Semarang</span></a>
              <a href=""><i class="fa fa-phone"></i><span>+62 812 3456 7890</span></a>
              <a href=""><i class="fa fa-envelope"></i><span>swasembadau@gmail.com</span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer_section">
      <div class="container">
        <p>&copy; <span id="displayYear"></span> Toko Buku Swasembada</p>
      </div>
    </footer>
  </section>
  <!-- end info section -->

  <script src="front_end/js/jquery-3.4.1.min.js"></script>
  <script src="front_end/js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="front_end/js/custom.js"></script>
  @yield('scripts')
</body>
</html>