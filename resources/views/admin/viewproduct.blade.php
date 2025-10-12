@extends('admin.maindesign')

@section('view_product')
<div class="container-fluid p-4">
    <h3 class="mb-4">View Products</h3>
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td><img src="{{ asset('uploads/products/' . $product->product_image) }}" style="width:80px;" alt=""></td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->category->category_name ?? '-' }}</td>
                <td>{{ $product->product_quantity }}</td>
                <td>Rp{{ number_format($product->product_price,0,',','.') }}</td>
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
