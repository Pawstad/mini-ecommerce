
@extends('main_design')

@section('order_history')
<div class="container mt-4">
  <h2 class="mb-4">Riwayat Pesanan Anda</h2>

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @if(count($orders) > 0)
    @foreach($orders as $date => $orderGroup)
      <div class="card mb-4">
        <div class="card-header">
          <h5>Pesanan Tanggal: {{ \Carbon\Carbon::parse($date)->format('d F Y') }}</h5>
        </div>
        <div class="card-body">
          @php $totalForDay = 0; @endphp
          
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Produk</th>
                  <th>Gambar</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Subtotal</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($orderGroup as $order)
                  <tr>
                    <td>{{ $order->product->product_name ?? 'Produk tidak tersedia' }}</td>
                    <td>
                      @if($order->product && $order->product->product_image)
                        <img src="{{ asset('uploads/products/' . $order->product->product_image) }}" alt="{{ $order->product->product_name }}" width="50">
                      @else
                        <span class="text-muted">No image</span>
                      @endif
                    </td>
                    <td>Rp{{ number_format($order->price, 0, ',', '.') }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>
                      <span class="badge {{ $order->status == 'pending' ? 'bg-warning' : ($order->status == 'processing' ? 'bg-info' : ($order->status == 'completed' ? 'bg-success' : 'bg-secondary')) }}">
                        {{ ucfirst($order->status) }}
                      </span>
                    </td>
                  </tr>
                  @php $totalForDay += $order->total; @endphp
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4" class="text-end"><strong>Total:</strong></td>
                  <td colspan="2"><strong>Rp{{ number_format($totalForDay, 0, ',', '.') }}</strong></td>
                </tr>
              </tfoot>
            </table>
          </div>
          
          <div class="mt-3">
            <h6>Informasi Pengiriman:</h6>
            <p><strong>Nama:</strong> {{ $orderGroup->first()->receiver_name }}</p>
            <p><strong>Alamat:</strong> {{ $orderGroup->first()->receiver_address }}</p>
            <p><strong>Telepon:</strong> {{ $orderGroup->first()->receiver_phone }}</p>
            
            @if($orderGroup->first()->payment_proof)
              <p>
                <strong>Bukti Pembayaran:</strong> 
                <a href="{{ route('order.proof_public', $orderGroup->first()->id) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                  <i class="fa fa-file"></i> Lihat Bukti Pembayaran
                </a>
              </p>
            @endif
          </div>
        </div>
      </div>
    @endforeach
  @else
    <div class="alert alert-info">
      <p>Anda belum memiliki riwayat pesanan.</p>
      <a href="{{ route('catalog.index') }}" class="btn btn-primary mt-3">Mulai Belanja</a>
    </div>
  @endif
</div>
@endsection