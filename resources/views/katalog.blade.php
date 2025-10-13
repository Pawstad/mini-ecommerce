@extends('main_design')

@section('katalog')
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
              <option value="{{ $cat->id }}" @if(isset($category) && $category == $cat->id) selected @endif>
                {{ $cat->category_name }}
              </option>
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
        <a href="{{ route('product_details', $product->id) }}">
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
@endsection
