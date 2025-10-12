@extends('main_design')

@section('checkout_success')
<div class="container mt-4">
  <div class="card">
    <div class="card-body">
      <h2>Terima kasih! Pesanan Anda telah diterima.</h2>
      <p>Kami telah menerima konfirmasi pembayaran Anda. Berikut ringkasan pesanan:</p>

      @if(!empty($orders) && count($orders) > 0)
        <table class="table">
          <thead>
            <tr>
              <th>Produk</th>
              <th>Jumlah</th>
              <th>Harga</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @php $grand = 0; @endphp
            @foreach($orders as $order)
              <tr>
                <td>{{ optional($order->product)->product_name ?? 'Produk tidak ditemukan' }}</td>
                <td>{{ $order->quantity }}</td>
                <td>Rp{{ number_format($order->price,0,',','.') }}</td>
                <td>Rp{{ number_format($order->total,0,',','.') }}</td>
              </tr>
              @php $grand += $order->total; @endphp
            @endforeach
            <tr>
              <td colspan="3"><strong>Grand Total</strong></td>
              <td><strong>Rp{{ number_format($grand,0,',','.') }}</strong></td>
            </tr>
          </tbody>
        </table>

        <p>Nama penerima: <strong>{{ $orders[0]->receiver_name ?? '-' }}</strong></p>
        <p>Alamat penerima: <strong>{{ $orders[0]->receiver_address ?? '-' }}</strong></p>
        <p>Nomor telepon: <strong>{{ $orders[0]->receiver_phone ?? '-' }}</strong></p>

        @if(!empty($orders[0]->payment_proof))
          <p>Bukti pembayaran: <a href="{{ asset('storage/' . $orders[0]->payment_proof) }}" target="_blank">Lihat bukti</a></p>
        @endif

      @else
        <p>Tidak ada detail pesanan tersedia.</p>
      @endif

      <div class="mt-3">
        <a href="{{ route('index') }}" class="btn btn-primary">Kembali ke Beranda</a>
        <a href="{{ route('catalog.index') }}" class="btn btn-secondary">Lihat Katalog</a>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('main_design')
@section('checkout_success')
<div class="container">
  <h2>Checkout Berhasil</h2>
  <p>Terima kasih, pesanan Anda telah dibuat.</p>

  <h4>Rincian Pesanan</h4>
  <ul>
    @foreach($orders as $order)
      <li>{{ $order->product->product_name ?? 'Produk tidak ditemukan' }} — Jumlah: {{ $order->quantity }} — Total: Rp{{ number_format($order->total,0,',','.') }}</li>
    @endforeach
  </ul>

  <a href="{{ route('index') }}" class="btn btn-secondary">Kembali ke Beranda</a>
</div>
@endsection
