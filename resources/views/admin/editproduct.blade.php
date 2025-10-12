@extends('admin.maindesign')

@section('edit_product')
<div class="container-fluid p-4">
    <h3 class="mb-4">Edit Product</h3>
    <form action="{{ route('admin.updateproduct', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="product_name" class="form-control" value="{{ $product->product_name }}">
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="{{ $product->author }}">
        </div>
        <div class="form-group">
            <label>Publisher</label>
            <input type="text" name="publisher" class="form-control" value="{{ $product->publisher }}">
        </div>
        <div class="form-group">
            <label>ISBN</label>
            <input type="text" name="isbn" class="form-control" value="{{ $product->isbn }}">
        </div>
        <div class="form-group">
            <label>Pages</label>
            <input type="number" name="pages" class="form-control" value="{{ $product->pages }}">
        </div>
        <div class="form-group mb-3">
            <label for="product_description">Product Description</label>
            <textarea name="product_description" id="product_description" class="form-control" rows="6" style="background-color: white; color: #333; width: 100%;">{{ $product->product_description }}</textarea>
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="product_quantity" class="form-control" value="{{ $product->product_quantity }}">
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="text" name="product_price" class="form-control" value="{{ $product->product_price }}">
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="product_category" class="form-control">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->product_category == $cat->id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="product_image" class="form-control-file">
            @if($product->product_image)
                <div class="mt-2"><img src="{{ asset('uploads/products/' . $product->product_image) }}" style="width:120px;" alt=""></div>
            @endif
        </div>
        <button class="btn btn-primary">Update Product</button>
    </form>
</div>
@endsection
