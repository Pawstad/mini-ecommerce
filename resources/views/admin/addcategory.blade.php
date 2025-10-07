@extends('admin.maindesign')

@section('add_category')

    @if(session('category_added'))
        <div class="mb-4 bg-greeen-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('category_added') }}
        </div>
    @endif

    <div class="container-fluid p-4">
        <h3 class="mb-4">Add New Category</h3>
        <form action="{{route('admin.postaddcategory')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="category_name">Category Name</label>
                <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Enter Category Name">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add Category</button>
            </div>
        </form>
    </div>

@endsection