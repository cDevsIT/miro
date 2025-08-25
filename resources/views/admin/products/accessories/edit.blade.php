@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Accessory</h1>
        <a href="{{ route('admin.accessories.index') }}" class="btn btn-secondary">Back to Accessories</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.accessories.update', $accessory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $accessory->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    @if($accessory->thumbnail)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $accessory->thumbnail) }}" 
                                 alt="Current thumbnail" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    @endif
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror" 
                               id="thumbnail" name="thumbnail">
                        <label class="custom-file-label" for="thumbnail">
                            {{ $accessory->thumbnail ? 'Change thumbnail' : 'Choose thumbnail file' }}
                        </label>
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
                           id="order" name="order" value="{{ old('order', $accessory->order) }}">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Accessory</button>
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