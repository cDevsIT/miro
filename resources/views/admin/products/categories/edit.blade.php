@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Category</h1>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="parent_id" class="form-label">Parent Category (Optional)</label>
                    <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                        <option value="">None (Root Category)</option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
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
                    <textarea class="form-control @error('details') is-invalid @enderror" id="details" name="details" rows="3">{{ old('details', $category->details) }}</textarea>
                    @error('details')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 type-field">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="indoor" {{ old('type', $category->type) == 'indoor' ? 'selected' : '' }}>Indoor</option>
                        <option value="outdoor" {{ old('type', $category->type) == 'outdoor' ? 'selected' : '' }}>Outdoor</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Thumbnail</label>
                    @if($category->thumbnail)
                        <div class="mb-2">
                            <div class="position-relative d-inline-block">
                                <img src="{{ Storage::url($category->thumbnail) }}" alt="{{ $category->name }}" class="img-thumbnail" style="max-width: 200px;">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-image"
                                    data-image-type="thumbnail"
                                    data-url="{{ route('admin.categories.delete-image', ['category' => $category->id, 'type' => 'thumbnail']) }}"
                                    style="z-index:2;">
                                    ×
                                </button>
                            </div>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*">
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="banner" class="form-label">Main Banner (Legacy)</label>
                    @if($category->banner)
                        <div class="mb-2">
                            <div class="position-relative d-inline-block">
                                <img src="{{ Storage::url($category->banner) }}" alt="{{ $category->name }}" class="img-thumbnail" style="max-width: 200px;">
                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-image"
                                    data-image-type="banner"
                                    data-url="{{ route('admin.categories.delete-image', ['category' => $category->id, 'type' => 'banner']) }}"
                                    style="z-index:2;">
                                    ×
                                </button>
                            </div>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('banner') is-invalid @enderror" id="banner" name="banner" accept="image/*">
                    <small class="form-text text-muted">This is the legacy single banner field. Use the carousel banners below for the new carousel feature.</small>
                    @error('banner')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Carousel Banners</label>
                    
                    @if($category->banners->count() > 0)
                        <div class="mb-3">
                            <h6>Current Banners:</h6>
                            <div class="row" id="banners-container">
                                @foreach($category->banners as $banner)
                                    <div class="col-md-3 mb-2" data-banner-id="{{ $banner->id }}">
                                        <div class="position-relative">
                                            <img src="{{ Storage::url($banner->image_path) }}" alt="{{ $banner->alt_text }}" class="img-thumbnail" style="width: 100%; height: 150px; object-fit: cover;">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-banner"
                                                data-banner-id="{{ $banner->id }}"
                                                data-url="{{ route('admin.categories.banners.destroy', ['category' => $category->id, 'banner' => $banner->id]) }}"
                                                style="z-index:2;">
                                                ×
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <input type="file" class="form-control @error('banners.*') is-invalid @enderror" id="banners" name="banners[]" accept="image/*" multiple>
                    <small class="form-text text-muted">Select multiple images to add to the carousel. These will be added to the existing banners.</small>
                    @error('banners.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Read More Link (Optional)</label>
                    <input type="url" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link', $category->link) }}" placeholder="https://example.com">
                    <small class="form-text text-muted">If provided, a "Read more" button will be shown on the frontend.</small>
                    @error('link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="order" class="form-label">Order</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $category->order) }}">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Category</button>
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

    // Handle image deletion
    document.querySelectorAll('.delete-image').forEach(function(button) {
        button.addEventListener('click', function() {
            if (!confirm('Are you sure you want to delete this image?')) return;

            const url = this.getAttribute('data-url');
            const imageType = this.getAttribute('data-image-type');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    // Remove the image container
                    this.closest('.position-relative').remove();
                } else {
                    response.json().then(data => {
                        alert(data.message || 'Failed to delete image.');
                    }).catch(() => {
                        alert('Failed to delete image.');
                    });
                }
            })
            .catch(() => alert('Failed to delete image.'));
        });
    });

    // Handle banner deletion
    document.querySelectorAll('.delete-banner').forEach(function(button) {
        button.addEventListener('click', function() {
            if (!confirm('Are you sure you want to delete this banner?')) return;

            const url = this.getAttribute('data-url');
            const bannerId = this.getAttribute('data-banner-id');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    // Remove the banner container
                    this.closest('.col-md-3').remove();
                } else {
                    response.json().then(data => {
                        alert(data.message || 'Failed to delete banner.');
                    }).catch(() => {
                        alert('Failed to delete banner.');
                    });
                }
            })
            .catch(() => alert('Failed to delete banner.'));
        });
    });
});
</script>
@endpush
@endsection 