<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Katalog Buku - Toko Buku Swasembada</title>
  <link rel="shortcut icon" href="/front_end/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="/front_end/css/bootstrap.css" />
  <link href="/front_end/css/style.css" rel="stylesheet" />
  <link href="/front_end/css/responsive.css" rel="stylesheet" />
  <style>
    .product-card .detail-box h6 { margin-bottom: .5rem; }
    .product-card .img-box img { height: 220px; object-fit: cover; width: 100%; }
  </style>
</head>

<body>
  <div class="hero_area">
    <!-- header -->
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="/">
          <span>Toko Buku Swasembada</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
          <span class=""></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Beranda</a></li>
            <li class="nav-item active"><a class="nav-link" href="{{ route('catalog.index') }}">Katalog Buku</a></li>
            </ul>
          <div class="user_option">
            @if(Auth::check())
            <a href="{{route('dashboard')}}"><i class="fa fa-user"></i> Dashboard</a>
            @else
            <a href="{{route('login')}}"><i class="fa fa-user"></i> Login</a>
            <a href="{{route('register')}}"><i class="fa fa-user"></i> Daftar</a>
            @endif
            <a href=""><i class="fa fa-shopping-bag"></i></a>
            <form class="form-inline">
              <button class="btn nav_search-btn" type="submit"><i class="fa fa-search"></i></button>
            </form>
          </div>
        </div>
      </nav>
    </header>
    <!-- end header -->
  </div>

  <!-- shop section -->
  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>Katalog Buku</h2>
      </div>

      <div class="row mb-4">
        <div class="col-md-8">
          <form method="GET" action="{{ route('catalog.index') }}" class="form-inline w-100">
            <div class="input-group w-100">
              <input type="search" name="q" class="form-control" placeholder="Cari judul atau deskripsi..." value="{{ old('q', $q ?? '') }}">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Cari</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-4">
          <form method="GET" action="{{ route('catalog.index') }}">
            <div class="form-group">
              <select name="category" class="form-control" onchange="this.form.submit()">
                <option value="">-- Semua Kategori --</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @if(isset($category) && $category == $cat->id) selected @endif>{{ $cat->category_name }}</option>
                @endforeach
              </select>
            </div>
          </form>
        </div>
      </div>

      <div class="row">
        @forelse($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="box product-card">
            <a href="#">
              <div class="img-box">
                @if($product->product_image)
                <img src="{{ asset('uploads/products/' . $product->product_image) }}" alt="{{ $product->product_name }}">
                @else
                <img src="/front_end/images/b1.jpg" alt="no image">
                @endif
              </div>
              <div class="detail-box">
                <h6>{{ $product->product_name }}</h6>
                <h6>Harga <span>Rp{{ number_format($product->product_price, 0, ',', '.') }}</span></h6>
              </div>
            </a>
          </div>
        </div>
        @empty
        <div class="col-12">
          <p>Tidak ada produk ditemukan.</p>
        </div>
        @endforelse
      </div>

      <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
      </div>
    </div>
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

  <script src="/front_end/js/jquery-3.4.1.min.js"></script>
  <script src="/front_end/js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script src="/front_end/js/custom.js"></script>
</body>

</html>
