@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Accessories</h1>
        <a href="{{ route('admin.accessories.create') }}" class="btn btn-primary">Add New Accessory</a>
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
                        <a href="{{ route('admin.accessories.index') }}" class="clear-search">&times;</a>
                    @endif
                    <button class="btn btn-outline-secondary me-2" type="submit">Search</button>
                </div>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Name</th>
                        <th>Thumbnail</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accessories as $accessory)
                    <tr>
                        <td>{{ $accessory->order }}</td>
                        <td>{{ $accessory->name }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $accessory->thumbnail) }}" 
                                 alt="{{ $accessory->name }}" 
                                 style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>
                            <a href="{{ route('admin.accessories.edit', $accessory->id) }}" 
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.accessories.destroy', $accessory->id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this accessory?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $accessories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 