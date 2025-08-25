@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Family Products</h1>
        <a href="{{ route('admin.family-products.create') }}" class="btn btn-primary">Add New Family Product</a>
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
                    <input type="text" name="search" class="form-control admin-search-input" placeholder="Search by Model Number" value="{{ request('search') }}">
                    @if(request('search'))
                        <a href="{{ route('admin.family-products.index') }}" class="clear-search">&times;</a>
                    @endif
                    <button class="btn btn-outline-secondary me-2" type="submit">Search</button>
                </div>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>Model No</th>
                        <th>Power</th>
                        <th>Dimensions</th>
                        <th>Cut Hole</th>
                        <th>Voltage</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($familyProducts as $product)
                    <tr>
                        <td>{{ $product->model_no }}</td>
                        <td>{{ $product->power }}</td>
                        <td>
                            @if(!empty($product->dimensions_lwh))
                                {{ $product->dimensions_lwh }}
                            @elseif(!empty($product->dimensions_qh))
                                {{ $product->dimensions_qh }}
                            @endif
                        </td>
                        <td>
                            @if(!empty($product->cut_hole_in_mm))
                                {{ $product->cut_hole_in_mm }}
                            @elseif(!empty($product->cut_hole_in_diameter))
                                {{ $product->cut_hole_in_diameter }}
                            @endif
                        </td>
                        <td>{{ $product->voltage }}</td>
                        <td>
                            <a href="{{ route('admin.family-products.edit', $product->id) }}" 
                               class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.family-products.destroy', $product->id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this family product?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center mt-4">
                {{ $familyProducts->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 