@extends('admin.maindesign')

@section('view_category')

    <div class="container-fluid p-4">
        <h3 class="mb-4">View Categories</h3>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin.editcategory', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.destroycategory', $category->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this category?');">
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