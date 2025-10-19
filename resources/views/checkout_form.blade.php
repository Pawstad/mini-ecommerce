@extends('main_design')

@section('checkout_form')
<div class="container">
  <h2>Form Checkout</h2>

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <form method="POST" action="{{ route('checkout') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="receiver_name">Nama Penerima</label>
      <input type="text" class="form-control" name="receiver_name" id="receiver_name" required>
    </div>
    <div class="form-group">
      <label for="receiver_address">Alamat Penerima</label>
      <textarea class="form-control" name="receiver_address" id="receiver_address" rows="3" required></textarea>
    </div>
    <div class="form-group">
      <label for="receiver_phone">No. Telepon</label>
      <input type="text" class="form-control" name="receiver_phone" id="receiver_phone" required>
    </div>
    <div class="form-group">
      <label for="payment_proof">Unggah Bukti Pembayaran (jpg, png, pdf)</label>
      <p>Transfer ke bank BRA : 9089812312</p>
      <input type="file" class="form-control-file" name="payment_proof" id="payment_proof" accept="image/*,.pdf" required>
    </div>

    <button class="btn btn-success" type="submit">Konfirmasi Pembayaran & Checkout</button>
  </form>
</div>
@endsection
