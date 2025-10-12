@extends('main_design')

@section('index')
    <div class="container">
      <div class="heading_container heading_center">
        <h2>Buku Terbaru</h2>
      </div>
      <div class="row">
          @foreach($latestProducts as $product)
            <div class="col-sm-6 col-md-4 col-lg-3">
              <div class="box">
                <a href="{{ route('product_details', $product->id) }}">
                  <div class="img-box">
                    @if($product->product_image)
                    <img src="{{ asset('uploads/products/' . $product->product_image) }}" alt="{{ $product->product_name }}">
                    @else
                    <img src="front_end/images/b1.jpg" alt="no image">
                    @endif
                  </div>
                  <div class="detail-box">
                    <h6>{{ $product->product_name }}</h6>
                    <h6>Harga <span>Rp{{ number_format($product->product_price, 0, ',', '.') }}</span></h6>
                  </div>
                  <div class="new"><span>Baru</span></div>
                </a>
              </div>
            </div>
        @endforeach
      </div>
  <div class="btn-box"><a href="{{ route('catalog.index') }}">Lihat Semua Buku</a></div>
    </div>

@endsection