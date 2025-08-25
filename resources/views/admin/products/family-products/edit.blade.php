@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Family Product</h1>
        <a href="{{ route('admin.family-products.index') }}" class="btn btn-secondary">Back to Family Products</a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.family-products.update', $familyProduct->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="model_no">Model No</label>
                    <input type="text" class="form-control @error('model_no') is-invalid @enderror" 
                           id="model_no" name="model_no" value="{{ old('model_no', $familyProduct->model_no) }}" required>
                    @error('model_no')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="power">Power</label>
                    <input type="text" class="form-control @error('power') is-invalid @enderror" 
                           id="power" name="power" value="{{ old('power', $familyProduct->power) }}" >
                    @error('power')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slot">Slot</label>
                    <input type="text" class="form-control @error('slot') is-invalid @enderror" 
                           id="slot" name="slot" value="{{ old('slot', $familyProduct->slot) }}">
                    @error('slot')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dimensions_lwh">Dimensions (L X W X H)</label>
                    <input type="text" class="form-control @error('dimensions_lwh') is-invalid @enderror" 
                           id="dimensions_lwh" name="dimensions_lwh" value="{{ old('dimensions_lwh', $familyProduct->dimensions_lwh) }}" >
                    @error('dimensions_lwh')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                <div class="form-group">
                    <label for="dimensions_qh">Dimensions (Ø X H)</label>
                    <input type="text" class="form-control @error('dimensions_qh') is-invalid @enderror" 
                           id="dimensions_qh" name="dimensions_qh" value="{{ old('dimensions_qh', $familyProduct->dimensions_qh) }}" >
                    @error('dimensions_qh')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group"></div>
                    <label for="cut_hole_in_mm">Cut Hole In MM</label>
                    <input type="text" class="form-control @error('cut_hole_in_mm') is-invalid @enderror" 
                           id="cut_hole_in_mm" name="cut_hole_in_mm" value="{{ old('cut_hole_in_mm', $familyProduct->cut_hole_in_mm) }}" >
                    @error('cut_hole_in_mm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="cut_hole_in_diameter">Cut Hole In Diameter</label>
                    <input type="text" class="form-control @error('cut_hole_in_diameter') is-invalid @enderror" 
                           id="cut_hole_in_diameter" name="cut_hole_in_diameter" value="{{ old('cut_hole_in_diameter', $familyProduct->cut_hole_in_diameter) }}" >
                    @error('cut_hole_in_diameter')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mounting_type">Mounting Type</label>
                    <input type="text" class="form-control @error('mounting_type') is-invalid @enderror" 
                           id="mounting_type" name="mounting_type" value="{{ old('mounting_type', $familyProduct->mounting_type) }}" >
                    @error('mounting_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="voltage">Voltage</label>
                    <input type="text" class="form-control @error('voltage') is-invalid @enderror" 
                           id="voltage" name="voltage" value="{{ old('voltage', $familyProduct->voltage) }}" >
                    @error('voltage')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Family Product</button>
            </form>
        </div>
    </div>
</div>
@endsection 