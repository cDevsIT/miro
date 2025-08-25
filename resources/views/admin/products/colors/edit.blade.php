@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Color</h1>
        <a href="{{ route('admin.colors.index') }}" class="btn btn-secondary">Back to Colors</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.colors.update', $color->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Color Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $color->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="color_code">Color Code</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('color_code') is-invalid @enderror" id="color_code" name="color_code" value="{{ old('color_code', $color->color_code) }}" placeholder="#000000" required>
                        <div class="input-group-append">
                            <div id="color_preview" style="width: 40px; height: 38px; border-radius: 4px; border: 1px solid #ddd; margin-left: 10px;"></div>
                        </div>
                    </div>
                    @error('color_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="order">Order</label>
                    <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $color->order) }}">
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Color</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const colorInput = document.getElementById('color_code');
    const colorPreview = document.getElementById('color_preview');

    function updateColorPreview() {
        const color = colorInput.value;
        // Check if the color is a valid hex code
        if (/^#[0-9A-F]{6}$/i.test(color)) {
            colorPreview.style.backgroundColor = color;
        } else {
            colorPreview.style.backgroundColor = '#000000';
        }
    }

    // Update preview on input
    colorInput.addEventListener('input', updateColorPreview);
    
    // Initial preview
    updateColorPreview();
</script>
@endpush
@endsection 