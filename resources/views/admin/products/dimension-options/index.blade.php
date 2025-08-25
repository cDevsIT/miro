@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Dimension Options</h1>
        <a href="{{ route('admin.dimension-options.create') }}" class="btn btn-primary">Add New Dimension Option</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="GET" action="" class="mb-3">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" name="search" class="form-control admin-search-input" placeholder="Search by Name" value="{{ request('search') }}">
                    @if(request('search'))
                        <a href="{{ route('admin.dimension-options.index') }}" class="clear-search">&times;</a>
                    @endif
                    <button class="btn btn-outline-secondary me-2" type="submit">Search</button>
                </div>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Thumbnail</th>
                        <th>Diagram</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dimensionOptions as $option)
                    <tr>
                        <td>{{ $option->name }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $option->thumbnail) }}" 
                                 alt="{{ $option->name }} thumbnail" 
                                 style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $option->diagram) }}" 
                                 alt="{{ $option->name }} diagram" 
                                 style="width: auto; height: 50px; object-fit: cover;">
                        </td>
                        <td>
                            <a href="{{ route('admin.dimension-options.edit', $option->id) }}" 
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.dimension-options.destroy', $option->id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this dimension option?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $dimensionOptions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 