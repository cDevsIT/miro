@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Colors</h1>
        <a href="{{ route('admin.colors.create') }}" class="btn btn-primary">Add New Color</a>
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
                        <th>Color</th>
                        <th>Color Code</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($colors as $color)
                    <tr>
                        <td>{{ $color->name }}</td>
                        <td>
                            <div style="width: 30px; height: 30px; background-color: {{ $color->color_code }}; border-radius: 50%; border: 1px solid #ddd;"></div>
                        </td>
                        <td>{{ $color->color_code }}</td>
                        <td>{{ $color->order }}</td>
                        <td>
                            <a href="{{ route('admin.colors.edit', $color->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.colors.destroy', $color->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this color?')">
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