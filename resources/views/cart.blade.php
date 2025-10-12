@extends('main_design')
@section('cart')
<div class="container">
  <h2>Keranjang Saya</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @if(count($items) === 0)
    <p>Keranjang kosong.</p>
  @else
    <table class="table">
      <thead>
        <tr>
          <th>Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody>
        @php $grand = 0; @endphp
        @foreach($items as $it)
          <tr>
            <td>
              <div style="display:flex; align-items:center; gap:10px;">
                @if(!empty($it['product']->product_image))
                  <img src="{{ asset('uploads/products/' . $it['product']->product_image) }}" style="width:60px;" alt="">
                @endif
                <div>{{ $it['product']->product_name }}</div>
              </div>
              <form method="POST" action="{{ route('cart.remove') }}" style="display:inline-block; margin-left:10px;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $it['product']->id }}">
                <button class="btn btn-sm btn-link text-danger">Hapus</button>
              </form>
            </td>
            <td>Rp{{ number_format($it['product']->product_price,0,',','.') }}</td>
            <td>
              <div class="input-group" style="max-width:140px;">
                <button class="btn btn-outline-secondary btn-decrease" data-product="{{ $it['product']->id }}" type="button">-</button>
                <input type="number" class="form-control text-center item-qty-{{ $it['product']->id }}" value="{{ $it['quantity'] }}" min="1" style="max-width:60px;" />
                <button class="btn btn-outline-secondary btn-increase" data-product="{{ $it['product']->id }}" type="button">+</button>
              </div>
              <form method="POST" action="{{ route('cart.update') }}" class="d-none" id="update-form-{{ $it['product']->id }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $it['product']->id }}">
                <input type="hidden" name="quantity" class="form-qty-input-{{ $it['product']->id }}" value="{{ $it['quantity'] }}">
              </form>
            </td>
            <td>Rp{{ number_format($it['subtotal'],0,',','.') }}</td>
          </tr>
          @php $grand += $it['subtotal']; @endphp
        @endforeach
        <tr>
          <td colspan="3"><strong>Total</strong></td>
          <td><strong>Rp{{ number_format($grand,0,',','.') }}</strong></td>
        </tr>
      </tbody>
    </table>

    <div class="d-flex" style="gap:10px;">
      <a href="{{ route('checkout.form') }}" class="btn btn-primary">Checkout Sekarang</a>
      <form method="POST" action="{{ route('cart.clear') }}">
        @csrf
        <button class="btn btn-danger">Kosongkan Keranjang</button>
      </form>
    </div>
  @endif
</div>
@endsection

    @section('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      function updateQuantity(productId, newQty) {
        // update hidden input and submit form via fetch
        const form = document.getElementById('update-form-' + productId);
        const qtyInput = document.querySelector('.form-qty-input-' + productId);
        qtyInput.value = newQty;

        // send AJAX
        fetch("{{ route('cart.update') }}", {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ product_id: productId, quantity: newQty })
        }).then(r => r.json()).then(data => {
          if (data.success) {
            location.reload();
          } else {
            alert('Gagal memperbarui keranjang');
          }
        }).catch(err => {
          // fallback: submit form
          form.submit();
        });
      }

      document.querySelectorAll('.btn-increase').forEach(function(btn) {
        btn.addEventListener('click', function() {
          const productId = this.getAttribute('data-product');
          const input = document.querySelector('.item-qty-' + productId);
          let v = parseInt(input.value) || 1;
          input.value = v + 1;
          updateQuantity(productId, input.value);
        });
      });

      document.querySelectorAll('.btn-decrease').forEach(function(btn) {
        btn.addEventListener('click', function() {
          const productId = this.getAttribute('data-product');
          const input = document.querySelector('.item-qty-' + productId);
          let v = parseInt(input.value) || 1;
          if (v > 1) {
            input.value = v - 1;
            updateQuantity(productId, input.value);
          }
        });
      });
    });
    </script>
    @endsection
