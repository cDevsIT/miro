@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Blogs</h1>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Blog
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($blogs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 80px;">Image</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Order</th>
                                <th>Created</th>
                                <th style="width: 150px;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td>
                                        @if($blog->feature_image)
                                            <img src="{{ asset('storage/' . $blog->feature_image) }}" 
                                                 alt="{{ $blog->title }}" 
                                                 class="img-thumbnail" 
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $blog->title }}</strong>
                                        <div class="text-muted small">
                                            {{ Str::limit($blog->intro, 80) }}
                                        </div>
                                    </td>
                                    <td>
                                        <code>{{ $blog->slug }}</code>
                                    </td>
                                    <td>
                                        @if($blog->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $blog->order }}</td>
                                    <td>
                                        <small>{{ $blog->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('blog.detail', $blog->slug) }}" 
                                               class="btn btn-sm btn-success" 
                                               title="View"
                                               target="_blank">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.blogs.edit', $blog) }}" 
                                               class="btn btn-sm btn-info" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.blogs.destroy', $blog) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger" 
                                                        title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $blogs->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No blogs found. Create your first blog!</p>
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Blog
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

