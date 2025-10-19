@extends('admin.maindesign')

@section('view_product')
<div class="container-fluid p-4">
    <h3 class="mb-4">View Products</h3>
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr  style="background-color: #f2f2f2;">
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">ID</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Image</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Name</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Category</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Qty</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Price</th>
                <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr style="border-bottom: 1px solid #ddd;">
                <td style="padding: 12px;">{{ $product->id }}</td>
                <td style="padding: 12px;"><img src="{{ asset('uploads/products/' . $product->product_image) }}" style="width:80px;" alt=""></td>
                <td style="padding: 12px;">{{ $product->product_name }}</td>
                <td style="padding: 12px;">
                    @if($product->categories->count() > 0)
                        {{ $product->categories->pluck('category_name')->join(', ') }}
                    @else
                        -
                    @endif
                </td>
                <td style="padding: 12px;">{{ $product->product_quantity }}</td>
                <td style="padding: 12px;">Rp{{ number_format($product->product_price,0,',','.') }}</td>
                <td>
                    <a href="{{ route('admin.editproduct', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('admin.destroyproduct', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this product?');">
                        @csrf
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
