@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Dimension Option</h1>
        <a href="{{ route('admin.dimension-options.index') }}" class="btn btn-secondary">Back to Dimension Options</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.dimension-options.update', $dimensionOption) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $dimensionOption->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    @if($dimensionOption->thumbnail)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $dimensionOption->thumbnail) }}" alt="Current thumbnail" style="max-width: 200px; max-height: 200px;">
                        </div>
                    @endif
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail">
                        <label class="custom-file-label" for="thumbnail">Choose new file (optional)</label>
                    </div>
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Allowed file types: jpeg, png, jpg, gif. Max size: 2MB</small>
                </div>

                <div class="form-group">
                    <label for="diagram">Diagram</label>
                    @if($dimensionOption->diagram)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $dimensionOption->diagram) }}" alt="Current diagram" style="max-width: 200px; max-height: 200px;">
                        </div>
                    @endif
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('diagram') is-invalid @enderror" id="diagram" name="diagram">
                        <label class="custom-file-label" for="diagram">Choose new file (optional)</label>
                    </div>
                    @error('diagram')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Allowed file types: jpeg, png, jpg, gif. Max size: 2MB</small>
                </div>

                <div class="form-group">
                    <label for="order">Order</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $dimensionOption->order) }}" min="0">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Lower numbers will appear first in the list</small>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update Dimension Option</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Update file input labels with selected filenames
    document.querySelectorAll('.custom-file-input').forEach(input => {
        input.addEventListener('change', function(e) {
            var fileName = e.target.files[0]?.name || '';
            var nextSibling = e.target.nextElementSibling;
            if(nextSibling) nextSibling.innerText = fileName;
        });
    });
</script>
@endpush
@endsection 