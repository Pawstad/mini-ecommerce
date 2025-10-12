@extends('admin.maindesign')

@section('view_category')

    <div class="container-fluid p-4">
        <h3 class="mb-4">View Categories</h3>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">ID</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Category Name</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Created At</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Updated At</th>
                    <th style="padding: 12px; text-align: left; border-bottom: 1px solid #ddd;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 12px;">{{ $category->id }}</td>
                    <td style="padding: 12px;">{{ $category->category_name }}</td>
                    <td style="padding: 12px;">{{ $category->created_at }}</td>
                    <td style="padding: 12px;">{{ $category->updated_at }}</td>
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