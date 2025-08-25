@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add New Product</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back to Products</a>
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
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Basic Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="title_suffix" class="form-label">Title Suffix</label>
                                    <input type="text" class="form-control" id="title_suffix" name="title_suffix" value="{{ old('title_suffix') }}" >
                                </div>

                                <div class="mb-3">
                                    <label for="model_number" class="form-label">Model Number</label>
                                    <input type="text" class="form-control" id="model_number" name="model_number" value="{{ old('model_number') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Thumbnail</label>
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" required>
                                </div>

                                <div class="mb-3">
                                    <label for="product_images" class="form-label">Product Images</label>
                                    <input type="file" class="form-control" id="product_images" name="product_images[]" accept="image/*" multiple>
                                    <small class="text-muted">You can select multiple images</small>
                                </div>

                                <div class="row">                                   
                                    <div class="mb-3 col-6">
                                        <label for="order" class="form-label">Order</label>
                                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                                    </div>

                                    <div class="mb-3 col-6 text-end d-flex align-items-end justify-content-center gap-4">
                                        <label for="is_active" class="form-label mb-0">Status</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Technical Operation & Electrical Data</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($attributes as $attribute)
                                                <tr>
                                                    <td>{{ $attribute->name }}</td>
                                                    <td>
                                                    <input type="text" class="form-control" 
                                                        name="product_attributes[{{ $attribute->id }}]" 
                                                        value="{{ old('product_attributes.' . $attribute->id) }}"
                                                        placeholder="Enter {{ $attribute->name }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Additional Information</h5>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Categories</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="row">
                                        @foreach($categories as $category)
                                            @if(is_null($category->parent_id))
                                                <div class="col-12 mb-2">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                               id="category_{{ $category->id }}"
                                                               name="categories[]"
                                                               value="{{ $category->id }}"
                                                               {{ in_array($category->id, old('categories', isset($product) ? $product->categories->pluck('id')->toArray() : [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="category_{{ $category->id }}">
                                                            {{ $category->name }}
                                                        </label>
                                                    </div>
                                                    @if($category->children && $category->children->count() > 0)
                                                        <div class="ms-4">
                                                            @foreach($category->children as $child)
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input"
                                                                           id="category_{{ $child->id }}"
                                                                           name="categories[]"
                                                                           value="{{ $child->id }}"
                                                                           {{ in_array($child->id, old('categories', isset($product) ? $product->categories->pluck('id')->toArray() : [])) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="category_{{ $child->id }}">
                                                                        {{ $child->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                </div>
                                </div>
                          

                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Other Options</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Colors</label>
                                            <div class="row">
                                                @foreach($colors as $color)
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" 
                                                                id="color_{{ $color->id }}" 
                                                                name="colors[]" 
                                                                value="{{ $color->id }}"
                                                                {{ in_array($color->id, old('colors', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="color_{{ $color->id }}">
                                                                {{ $color->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Reflector Colors</label>
                                            <div class="row">
                                                @foreach($reflectorColors as $color)
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" 
                                                                id="reflector_color_{{ $color->id }}" 
                                                                name="reflector_colors[]" 
                                                                value="{{ $color->id }}"
                                                                {{ in_array($color->id, old('reflector_colors', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="reflector_color_{{ $color->id }}">
                                                                {{ $color->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Dimension Options</label>
                                            <div class="row">
                                                @foreach($dimensionOptions as $option)
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" 
                                                                id="dimension_{{ $option->id }}" 
                                                                name="dimension_options[]" 
                                                                value="{{ $option->id }}"
                                                                {{ in_array($option->id, old('dimension_options', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="dimension_{{ $option->id }}">
                                                                {{ $option->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Family Products</label>
                                            <div class="row">
                                                @foreach($familyProducts as $family)
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" 
                                                                id="family_{{ $family->id }}" 
                                                                name="family_products[]" 
                                                                value="{{ $family->id }}"
                                                                {{ in_array($family->id, old('family_products', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="family_{{ $family->id }}">
                                                                {{ $family->model_no }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Accessories</label>
                                            <div class="row">
                                                @foreach($accessories as $accessory)
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" 
                                                                id="accessory_{{ $accessory->id }}" 
                                                                name="accessories[]" 
                                                                value="{{ $accessory->id }}"
                                                                {{ in_array($accessory->id, old('accessories', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="accessory_{{ $accessory->id }}">
                                                                {{ $accessory->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label font-weight-bold">Installation Methods</label>
                                            <div class="row">
                                                @foreach($installationMethods as $method)
                                                    <div class="col-md-6">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" 
                                                                id="method_{{ $method->id }}" 
                                                                name="installation_methods[]" 
                                                                value="{{ $method->id }}"
                                                                {{ in_array($method->id, old('installation_methods', [])) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="method_{{ $method->id }}">
                                                                {{ $method->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="brochure" class="form-label font-weight-bold">Upload Brochure (PDF)</label>
                                            <input type="file" class="form-control" id="brochure" name="brochure" accept="application/pdf">
                                            <small class="text-muted">Only PDF files are allowed.</small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="view_3d" class="form-label font-weight-bold">Upload 3D View (PDF)</label>
                                            <input type="file" class="form-control" id="view_3d" name="view_3d" accept="application/pdf">
                                            <small class="text-muted">Only PDF files are allowed.</small>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>

                

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Create Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/bk97uf7d0fzrilzdbres0q431wsnu5j94wpojic3vfnxqwhc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#description',
        plugins: 'table lists link code',
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | link | code',
        menubar: 'file edit view insert format tools table help',
        height: 300,
        valid_elements: '*[*]', // allow all HTML elements and attributes
        content_css: '//www.tiny.cloud/css/codepen.min.css'
    });
</script>
@endpush
@endsection 