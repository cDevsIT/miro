@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add Category</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="parent_id" class="form-label">Parent Category (Optional)</label>
                    <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                        <option value="">None (Root Category)</option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="details" class="form-label">Details</label>
                    <textarea class="form-control @error('details') is-invalid @enderror" id="details" name="details" rows="3">{{ old('details') }}</textarea>
                    @error('details')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 type-field">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="indoor" {{ old('type') == 'indoor' ? 'selected' : '' }}>Indoor</option>
                        <option value="outdoor" {{ old('type') == 'outdoor' ? 'selected' : '' }}>Outdoor</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="banner" class="form-label">Main Banner (Legacy)</label>
                    <input type="file" class="form-control @error('banner') is-invalid @enderror" id="banner" name="banner" accept="image/*">
                    <small class="form-text text-muted">This is the legacy single banner field. Use the multiple banners below for carousel.</small>
                    @error('banner')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="banners" class="form-label">Carousel Banners</label>
                    
                    <div class="mb-3">
                        <h6>Uploaded Banners:</h6>
                        <div class="row" id="banners-preview-container">
                            <!-- Preview will be shown here -->
                        </div>
                    </div>
                    
                    <input type="file" class="form-control @error('banners.*') is-invalid @enderror" id="banners" name="banners[]" accept="image/*" multiple>
                    <small class="form-text text-muted">Select multiple images for the carousel. These will be displayed in order.</small>
                    @error('banners.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Read More Link (Optional)</label>
                    <input type="url" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}" placeholder="https://example.com">
                    <small class="form-text text-muted">If provided, a "Read more" button will be shown on the frontend.</small>
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label">Order</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', 0) }}">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create Category</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const parentSelect = document.getElementById('parent_id');
    const typeField = document.querySelector('.type-field');
    const typeSelect = document.getElementById('type');
    const bannersInput = document.getElementById('banners');
    const bannersPreviewContainer = document.getElementById('banners-preview-container');

    function toggleTypeField() {
        if (parentSelect.value) {
            typeField.style.display = 'none';
            typeSelect.removeAttribute('required');
        } else {
            typeField.style.display = 'block';
            typeSelect.setAttribute('required', 'required');
        }
    }

    // Initial check
    toggleTypeField();

    // Listen for changes
    parentSelect.addEventListener('change', toggleTypeField);

    // Handle banner file preview
    bannersInput.addEventListener('change', function(e) {
        const files = e.target.files;
        bannersPreviewContainer.innerHTML = ''; // Clear existing previews

        if (files.length > 0) {
            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewDiv = document.createElement('div');
                        previewDiv.className = 'col-md-3 mb-2';
                        previewDiv.innerHTML = `
                            <div class="position-relative">
                                <img src="${e.target.result}" alt="Banner ${index + 1}" class="img-thumbnail" style="width: 100%; height: 150px; object-fit: cover;">
                                <div class="position-absolute top-0 start-0 m-1">
                                    <span class="badge bg-primary">${index + 1}</span>
                                </div>
                            </div>
                        `;
                        bannersPreviewContainer.appendChild(previewDiv);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
});
</script>
@endpush
@endsection 