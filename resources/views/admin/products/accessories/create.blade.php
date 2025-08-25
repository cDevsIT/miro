@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add New Accessory</h1>
        <a href="{{ route('admin.accessories.index') }}" class="btn btn-secondary">Back to Accessories</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.accessories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror" 
                               id="thumbnail" name="thumbnail" required>
                        <label class="custom-file-label" for="thumbnail">Choose thumbnail file</label>
                    </div>
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        Allowed file types: jpeg, png, jpg, gif. Max size: 2MB
                    </small>
                </div>

                <div class="form-group">
                    <label for="order">Order</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror" 
                           id="order" name="order" value="{{ old('order', 0) }}">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create Accessory</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Update file input label with selected filename
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endpush
@endsection 