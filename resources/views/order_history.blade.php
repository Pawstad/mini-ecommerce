@extends('main_design')

@section('order_history')
<div class="container mt-4 mb-5">
  <div class="row">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Riwayat Pesanan Anda</h2>
        <a href="{{ route('catalog.index') }}" class="btn btn-outline-primary">
          <i class="fa fa-shopping-bag"></i> Belanja Lagi
        </a>
      </div>
    </div>
  </div>

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fa fa-check-circle"></i> {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(count($orders) > 0)
    @foreach($orders as $date => $orderGroup)
      <div class="order-card mb-4">
        <div class="order-header">
          <div class="row align-items-center">
            <div class="col-md-6">
              <h5 class="mb-0">
                <i class="fa fa-calendar"></i> 
                {{ \Carbon\Carbon::parse($date)->format('d F Y') }}
              </h5>
            </div>
            <div class="col-md-6 text-md-end mt-2 mt-md-0">
              <span class="order-count">{{ count($orderGroup) }} Item</span>
            </div>
          </div>
        </div>
        
        <div class="order-body">
          @php $totalForDay = 0; @endphp
          
          @foreach($orderGroup as $index => $order)
            <div class="order-item {{ $index > 0 ? 'border-top' : '' }}">
              <div class="row align-items-center">
                <div class="col-md-2 col-3">
                  <div class="product-image">
                    @if($order->product && $order->product->product_image)
                      <img src="{{ asset('uploads/products/' . $order->product->product_image) }}" 
                           alt="{{ $order->product->product_name }}" 
                           class="img-fluid rounded">
                    @else
                      <div class="no-image">
                        <i class="fa fa-image"></i>
                      </div>
                    @endif
                  </div>
                </div>
                
                <div class="col-md-4 col-9">
                  <h6 class="product-name mb-1">
                    {{ $order->product->product_name ?? 'Produk tidak tersedia' }}
                  </h6>
                  <div class="product-meta">
                    <span class="text-muted">{{ $order->quantity }} x Rp{{ number_format($order->price, 0, ',', '.') }}</span>
                  </div>
                </div>
                
                <div class="col-md-3 col-6 mt-3 mt-md-0">
                  <div class="order-status">
                    <span class="status-badge status-{{ $order->status }}">
                      @if($order->status == 'pending')
                        <i class="fa fa-clock"></i> Menunggu
                      @elseif($order->status == 'processing')
                        <i class="fa fa-spinner"></i> Diproses
                      @elseif($order->status == 'completed')
                        <i class="fa fa-check-circle"></i> Selesai
                      @else
                        <i class="fa fa-times-circle"></i> {{ ucfirst($order->status) }}
                      @endif
                    </span>
                  </div>
                </div>
                
                <div class="col-md-3 col-6 mt-3 mt-md-0 text-md-end">
                  <div class="order-price">
                    <strong>Rp{{ number_format($order->total, 0, ',', '.') }}</strong>
                  </div>
                </div>
              </div>
            </div>
            @php $totalForDay += $order->total; @endphp
          @endforeach
          
          <div class="order-footer">
            <div class="row align-items-center">
              <div class="col-md-6">
                <span class="text-muted">Total Belanja</span>
              </div>
              <div class="col-md-6 text-md-end">
                <h5 class="mb-0 total-amount">Rp{{ number_format($totalForDay, 0, ',', '.') }}</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  @else
    <div class="empty-state">
      <div class="text-center py-5">
        <div class="empty-icon mb-4">
          <i class="fa fa-shopping-bag"></i>
        </div>
        <h4 class="mb-3">Belum Ada Pesanan</h4>
        <p class="text-muted mb-4">Anda belum memiliki riwayat pesanan. Mulai belanja sekarang!</p>
        <a href="{{ route('catalog.index') }}" class="btn btn-primary btn-lg">
          <i class="fa fa-shopping-cart"></i> Mulai Belanja
        </a>
      </div>
    </div>
  @endif
</div>
@endsection