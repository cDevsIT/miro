@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Reflector Colors</h1>
        <a href="{{ route('admin.reflector-colors.create') }}" class="btn btn-primary">Add New Reflector Color</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Thumbnail</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reflectorColors as $reflectorColor)
                    <tr>
                        <td>{{ $reflectorColor->name }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $reflectorColor->thumbnail) }}" 
                                 alt="{{ $reflectorColor->name }}" 
                                 style="width: 60px; height: 50px; object-fit: cover;">
                        </td>
                        <td>{{ $reflectorColor->order }}</td>
                        <td>
                            <a href="{{ route('admin.reflector-colors.edit', $reflectorColor->id) }}" 
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.reflector-colors.destroy', $reflectorColor->id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this reflector color?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 