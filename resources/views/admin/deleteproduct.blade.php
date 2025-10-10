@extends('admin.maindesign')

@section('delete_product')
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid p-4">
        <h3 class="mb-4">Delete Products</h3>
        <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif;" class="table">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">ID</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Name</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Description</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Quantity</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Price</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Category</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Product Image</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 12px;">{{ $product->id }}</td>
                    <td style="padding: 12px;">{{ $product->product_name }}</td>
                    <td style="padding: 12px;">{{ $product->product_description }}</td>
                    <td style="padding: 12px;">{{ $product->product_quantity }}</td>
                    <td style="padding: 12px;">{{ $product->product_price }}</td>
                    <td style="padding: 12px;">{{ $product->category->category_name }}</td>
                    <td style="padding: 12px;">
                        <img style="width: 150px;" src="{{ asset('uploads/products/' . $product->product_image) }}" alt="{{ $product->product_name }}">
                    </td>
                    <td>
                        <form action="{{ route('admin.destroyproduct', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                            
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection