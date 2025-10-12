@extends('admin.maindesign')

@section('edit_category')
<div class="container-fluid p-4">
    <h3 class="mb-4">Edit Category</h3>
    <form action="{{ route('admin.updatecategory', $category->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}">
        </div>
        <button class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection
