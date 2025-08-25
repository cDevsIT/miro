@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add New Dimension Option</h1>
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
            <form action="{{ route('admin.dimension-options.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label for="diagram">Diagram</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('diagram') is-invalid @enderror" 
                               id="diagram" name="diagram" required>
                        <label class="custom-file-label" for="diagram">Choose diagram file</label>
                    </div>
                    @error('diagram')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">
                        Allowed file types: jpeg, png, jpg, gif. Max size: 2MB
                    </small>
                </div>

                <div class="form-group">
                    <label for="order">Order</label>
                    <input type="number" class="form-control" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                    <small class="form-text text-muted">Lower numbers will appear first in the list</small>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Create Dimension Option</button>
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
            var fileName = e.target.files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    });
</script>
@endpush
@endsection 