@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Attributes</h1>
    <a href="{{ route('admin.attributes.create') }}" class="btn btn-primary">Add New Attribute</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Details</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attributes as $attribute)
            <tr>
                <td>{{ $attribute->name }}</td>
                <td>{{ $attribute->details }}</td>
                <td>{{ $attribute->order }}</td>
                <td>
                    <a href="{{ route('admin.attributes.edit', $attribute->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.attributes.destroy', $attribute->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 