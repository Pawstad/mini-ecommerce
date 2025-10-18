@extends('main_design')
<base href="/public">
@section('product_details')
    <!-- product detail section -->
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="product_img-box">
              <div class="main_img-container">
                @if($product->product_image)
                <img src="{{ asset('uploads/products/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="img-fluid">
                @else
                <img src="{{ asset('front_end/images/b1.jpg') }}" alt="no image" class="img-fluid">
                @endif
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="product_detail-box">
              <h2 class="product_title">{{ $product->product_name }}</h2>
              
              <div class="product_meta">
                <p class="product_author"><strong>Penulis:</strong> {{ $product->author ?? 'Tidak tersedia' }}</p>
                <p class="product_publisher"><strong>Penerbit:</strong> {{ $product->publisher ?? 'Tidak tersedia' }}</p>
                <p class="product_isbn"><strong>ISBN:</strong> {{ $product->isbn ?? 'Tidak tersedia' }}</p>
                <p class="product_pages"><strong>Halaman:</strong> {{ $product->pages ?? 'Tidak tersedia' }}</p>

                <!-- ✅ Tambahan kategori -->
                <p class="product_categories">
                  <strong>Kategori:</strong>
                  @if($product->categories && $product->categories->count() > 0)
                      @foreach($product->categories as $category)
                          <span class="badge bg-secondary">{{ $category->category_name }}</span>
                      @endforeach
                  @else
                      <span class="text-muted">Tidak ada kategori</span>
                  @endif
                </p>
              </div>

              <div class="product_price">
                <h3>Rp{{ number_format($product->product_price, 0, ',', '.') }}</h3>
              </div>

              <div class="product_stock mb-3">
                <strong>Stok Tersedia:</strong> 
                <span class="{{ $product->product_quantity > 0 ? 'text-success' : 'text-danger' }}">
                  {{ $product->product_quantity }} buku
                </span>
              </div>

              <div class="product_description">
                <h4>Deskripsi Buku</h4>
                <p>{{ $product->product_description ?? 'Deskripsi belum tersedia untuk buku ini.' }}</p>
              </div>

              <div class="product_actions">
                <div class="quantity_selector mb-3">
                  <label for="quantity"><strong>Jumlah:</strong></label>
                  <div class="input-group quantity-group" style="max-width: 150px;">
                    <button class="btn btn-outline-secondary quantity-minus" type="button">-</button>
                    <input type="number" class="form-control text-center quantity-input" value="1" min="1" max="{{ $product->product_quantity }}">
                    <button class="btn btn-outline-secondary quantity-plus" type="button">+</button>
                  </div>
                </div>

                <div class="action_buttons">
                  <form method="POST" action="{{ route('cart.add') }}" style="display:inline-block; margin-right:8px;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" class="form-quantity" value="1">
                    <button type="submit" class="btn btn-add-to-cart" {{ $product->product_quantity == 0 ? 'disabled' : '' }}>
                      <i class="fa fa-shopping-cart"></i> 
                      {{ $product->product_quantity > 0 ? 'Tambah ke Keranjang' : 'Stok Habis' }}
                    </button>
                  </form>

                  <form method="POST" action="{{ route('checkout.buy_now') }}" style="display:inline-block;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" class="form-quantity-buy" value="1">
                    <button type="submit" class="btn btn-buy-now" {{ $product->product_quantity == 0 ? 'disabled' : '' }}>
                      <i class="fa fa-bolt"></i> Beli Sekarang
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- end product detail section -->

  <script src="{{ asset('front_end/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('front_end/js/bootstrap.js') }}"></script>
  <script src="{{ asset('front_end/js/custom.js') }}"></script>

@endsection