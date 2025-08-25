@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Add New Attribute</h1>
    <form action="{{ route('admin.attributes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="details">Details</label>
            <textarea name="details" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="order">Order</label>
            <input type="number" name="order" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection 