@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Attribute</h1>
    <form action="{{ route('admin.attributes.update', $attribute->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $attribute->name }}" required>
        </div>
        <div class="form-group">
            <label for="details">Details</label>
            <textarea name="details" class="form-control">{{ $attribute->details }}</textarea>
        </div>
        <div class="form-group">
            <label for="order">Order</label>
            <input type="number" name="order" class="form-control" value="{{ $attribute->order }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection 