@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Categories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add Category</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Thumbnail</th>
                            <th>Banner</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <strong>{{ $category->name }}</strong>
                                </td>
                                <td>{{ ucfirst($category->type) }}</td>
                                <td>
                                    @if($category->thumbnail)
                                        <img src="{{ Storage::url($category->thumbnail) }}" alt="{{ $category->name }}" class="img-thumbnail" style="max-width: 100px;">
                                    @else
                                        <span class="text-muted">No thumbnail</span>
                                    @endif
                                </td>
                                <td>
                                    @if($category->banner)
                                        <img src="{{ Storage::url($category->banner) }}" alt="{{ $category->name }}" class="img-thumbnail" style="max-width: 100px;">
                                    @else
                                        <span class="text-muted">No banner</span>
                                    @endif
                                </td>
                                <td>{{ $category->order }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @if($category->children->count() > 0)
                                @foreach($category->children as $child)
                                    <tr class="table-light">
                                        <td>
                                            <div class="ms-4">
                                                <i class="fas fa-level-down-alt me-2"></i>
                                                {{ $child->name }}
                                            </div>
                                        </td>
                                        <td>{{ ucfirst($child->type) }}</td>
                                        <td>
                                            @if($child->thumbnail)
                                                <img src="{{ Storage::url($child->thumbnail) }}" alt="{{ $child->name }}" class="img-thumbnail" style="max-width: 100px;">
                                            @else
                                                <span class="text-muted">No thumbnail</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($child->banner)
                                                <img src="{{ Storage::url($child->banner) }}" alt="{{ $child->name }}" class="img-thumbnail" style="max-width: 100px;">
                                            @else
                                                <span class="text-muted">No banner</span>
                                            @endif
                                        </td>
                                        <td>{{ $child->order }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.categories.edit', $child) }}" class="btn btn-sm btn-primary">Edit</a>
                                                <form action="{{ route('admin.categories.destroy', $child) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 