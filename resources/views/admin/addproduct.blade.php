@extends('admin.maindesign')

@section('add_product')

    @if(session('product_added'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('product_added') }}
        </div>
    @endif

    <div class="container-fluid p-4">
        <h3 class="mb-4">Add New Product</h3>
        <form action="{{route('admin.postaddproduct')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group mb-3">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Enter Product Name">
            </div>
            <div class="form-group mb-3">
                <label for="author">Author</label>
                <input type="text" id="author" name="author" class="form-control" placeholder="Author name">
            </div>
            <div class="form-group mb-3">
                <label for="publisher">Publisher</label>
                <input type="text" id="publisher" name="publisher" class="form-control" placeholder="Publisher">
            </div>
            <div class="form-group mb-3">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" class="form-control" placeholder="ISBN">
            </div>
            <div class="form-group mb-3">
                <label for="pages">Pages</label>
                <input type="number" id="pages" name="pages" class="form-control" placeholder="Number of pages">
            </div>
            
            <div class="form-group mb-3">
                <label for="product_description">Product Description</label>
                <textarea name="product_description" id="product_description" class="form-control" rows="6" style="background-color: white; color: #333; width: 100%;">Product Description!....</textarea>
            </div>
            
            <div class="form-group mb-3">
                <label for="product_quantity">Product Quantity</label>
                <input type="number" id="product_quantity" name="product_quantity" class="form-control" placeholder="Enter Product Quantity">
            </div>
            
            <div class="form-group mb-3">
                <label for="product_price">Product Price</label>
                <input type="number" id="product_price" name="product_price" class="form-control" placeholder="Enter Product Price" step="0.01">
            </div>
            
            <div class="form-group mb-3">
                <label for="product_category">Product Categories 1</label>
                <input type="text" id="product_category" name="product_category" class="form-control" placeholder="Enter Product Categories">
            </div>

            <div class="form-group mb-3">
                <label for="product_category">Product Categories 2</label>
                <input type="text" id="product_category" name="product_category" class="form-control" placeholder="Enter Product Categories">
            </div> 

            <div class="form-group mb-3">
                <label for="product_image">Product Image</label>
                <input type="file" id="product_image" name="product_image" class="form-control">
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add Product</button>
            </div>
        </form>
    </div>

@endsection