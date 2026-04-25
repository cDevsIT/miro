@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Blog</h1>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Blogs
        </a>
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

    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" id="blogForm">
        @csrf
        @method('PUT')

        <!-- Basic Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">Basic Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Blog Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Page Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $blog->slug) }}" required>
                            <small class="text-muted">Auto-generates from title on blur. You can edit it.</small>
                        </div>

                        <div class="mb-3">
                            <label for="intro" class="form-label">Introduction <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="intro" name="intro" rows="4" required>{{ old('intro', $blog->intro) }}</textarea>
                            <small class="text-muted">A brief introduction that appears on the blog listing page.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                                    <select class="form-control" id="category" name="category" onchange="toggleProductCategory()" required>
                                        <option value="general" {{ old('category', $blog->category ?? 'general') === 'general' ? 'selected' : '' }}>General</option>
                                        <option value="product" {{ old('category', $blog->category ?? 'general') === 'product' ? 'selected' : '' }}>Product</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6" id="productCategoryWrapper" style="display: none;">
                                <div class="mb-3">
                                    <label for="product_category" class="form-label">Product Category <span class="text-danger">*</span></label>
                                    <select class="form-control" id="product_category" name="product_category">
                                        <option value="">Select product category</option>
                                        <option value="indoor_product" {{ old('product_category', $blog->product_category) === 'indoor_product' ? 'selected' : '' }}>Indoor Product</option>
                                        <option value="outdoor_product" {{ old('product_category', $blog->product_category) === 'outdoor_product' ? 'selected' : '' }}>Outdoor Product</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Order</label>
                                    <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $blog->order) }}" min="0">
                                    <small class="text-muted">Lower numbers appear first</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $blog->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="feature_image" class="form-label">Feature Image</label>
                            <input type="file" class="form-control" id="feature_image" name="feature_image" accept="image/*" onchange="previewFeatureImage(event)">
                            <small class="text-muted d-block">Leave empty to keep current image</small>
                            <small class="text-info"><i class="fas fa-info-circle"></i> Recommended size: 1920 × 980 px</small>
                        </div>
                        <div id="feature_image_preview" class="mt-2">
                            @if($blog->feature_image)
                                <img src="{{ asset('storage/' . $blog->feature_image) }}" class="image-preview" alt="Current Feature Image">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Sections -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Blog Sections</h5>
                <div class="position-relative">
                    <button type="button" class="btn btn-sm btn-primary" id="addSectionBtn" onclick="toggleSectionMenu()">
                        <i class="fas fa-plus"></i> Add Section <i class="fas fa-chevron-down ms-1"></i>
                    </button>
                    <div id="sectionMenu" class="section-menu" style="display: none;">
                        <button class="section-menu-item" type="button" onclick="addSection('full_image'); closeSectionMenu();">
                            <i class="fas fa-image"></i> Full Width Image
                        </button>
                        <button class="section-menu-item" type="button" onclick="addSection('text'); closeSectionMenu();">
                            <i class="fas fa-align-left"></i> Text Section
                        </button>
                        <button class="section-menu-item" type="button" onclick="addSection('right_image'); closeSectionMenu();">
                            <i class="fas fa-grip-horizontal"></i> Right Image
                        </button>
                        <button class="section-menu-item" type="button" onclick="addSection('left_image'); closeSectionMenu();">
                            <i class="fas fa-grip-horizontal fa-flip-horizontal"></i> Left Image
                        </button>
                        <button class="section-menu-item" type="button" onclick="addSection('double_image'); closeSectionMenu();">
                            <i class="fas fa-images"></i> Double Image
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="sections-container">
                    @if($blog->sections && count($blog->sections) > 0)
                        @foreach($blog->sections as $index => $section)
                            @php
                                $sectionId = "section-existing-{$index}";
                                $badgeClass = 'bg-primary';
                                $typeName = '';
                                
                                switch($section['type']) {
                                    case 'full_image':
                                        $typeName = 'Full Width Image';
                                        $badgeClass = 'bg-info';
                                        break;
                                    case 'text':
                                        $typeName = 'Text Section';
                                        $badgeClass = 'bg-success';
                                        break;
                                    case 'right_image':
                                        $typeName = 'Right Image';
                                        $badgeClass = 'bg-warning';
                                        break;
                                    case 'left_image':
                                        $typeName = 'Left Image';
                                        $badgeClass = 'bg-secondary';
                                        break;
                                    case 'double_image':
                                        $typeName = 'Double Image';
                                        $badgeClass = 'bg-dark';
                                        break;
                                }
                            @endphp
                            
                            <div class="section-card" id="{{ $sectionId }}" data-type="{{ $section['type'] }}">
                                <div class="section-header">
                                    <div>
                                        <i class="fas fa-grip-vertical sortable-handle"></i>
                                        <span class="section-type-badge {{ $badgeClass }} text-white ms-2">{{ $typeName }}</span>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeSection('{{ $sectionId }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                <div class="section-content">
                                    <input type="hidden" name="sections[{{ $index }}][type]" value="{{ $section['type'] }}">
                                    
                                    @if($section['type'] === 'full_image')
                                        @if(isset($section['image']))
                                            <input type="hidden" name="sections[{{ $index }}][existing_image]" value="{{ $section['image'] }}">
                                        @endif
                                        <div class="mb-3">
                                            <label class="form-label">Image</label>
                                            <input type="file" class="form-control" name="sections[{{ $index }}][image]" accept="image/*" onchange="previewImage(event, '{{ $sectionId }}')">
                                            <small class="text-muted d-block">Leave empty to keep current image</small>
                                            <small class="text-info"><i class="fas fa-info-circle"></i> Recommended size: 1630 × 790 px</small>
                                        </div>
                                        <div id="{{ $sectionId }}-preview">
                                            @if(isset($section['image']))
                                                <img src="{{ asset('storage/' . $section['image']) }}" class="image-preview" alt="Section Image">
                                            @endif
                                        </div>
                                        
                                    @elseif($section['type'] === 'text')
                                        <div class="mb-3">
                                            <label class="form-label">Section Title</label>
                                            <input type="text" class="form-control" name="sections[{{ $index }}][title]" value="{{ $section['title'] ?? '' }}" placeholder="Enter section title">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Content <span class="text-danger">*</span></label>
                                            <textarea class="form-control tinymce-editor" name="sections[{{ $index }}][text]" rows="5" data-required="true">{{ $section['text'] ?? '' }}</textarea>
                                        </div>
                                        
                                    @elseif($section['type'] === 'right_image')
                                        @if(isset($section['image']))
                                            <input type="hidden" name="sections[{{ $index }}][existing_image]" value="{{ $section['image'] }}">
                                        @endif
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Section Title</label>
                                                    <input type="text" class="form-control" name="sections[{{ $index }}][title]" value="{{ $section['title'] ?? '' }}" placeholder="Enter section title">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Content <span class="text-danger">*</span></label>
                                                    <textarea class="form-control tinymce-editor" name="sections[{{ $index }}][text]" rows="5" data-required="true">{{ $section['text'] ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" class="form-control" name="sections[{{ $index }}][image]" accept="image/*" onchange="previewImage(event, '{{ $sectionId }}')">
                                                    <small class="text-muted d-block">Leave empty to keep current image</small>
                                                    <small class="text-info"><i class="fas fa-info-circle"></i> Recommended size: 768 × 1152 px</small>
                                                </div>
                                                <div id="{{ $sectionId }}-preview">
                                                    @if(isset($section['image']))
                                                        <img src="{{ asset('storage/' . $section['image']) }}" class="image-preview" alt="Section Image">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                    @elseif($section['type'] === 'left_image')
                                        @if(isset($section['image']))
                                            <input type="hidden" name="sections[{{ $index }}][existing_image]" value="{{ $section['image'] }}">
                                        @endif
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Image</label>
                                                    <input type="file" class="form-control" name="sections[{{ $index }}][image]" accept="image/*" onchange="previewImage(event, '{{ $sectionId }}')">
                                                    <small class="text-muted d-block">Leave empty to keep current image</small>
                                                    <small class="text-info"><i class="fas fa-info-circle"></i> Recommended size: 768 × 1152 px</small>
                                                </div>
                                                <div id="{{ $sectionId }}-preview">
                                                    @if(isset($section['image']))
                                                        <img src="{{ asset('storage/' . $section['image']) }}" class="image-preview" alt="Section Image">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Section Title</label>
                                                    <input type="text" class="form-control" name="sections[{{ $index }}][title]" value="{{ $section['title'] ?? '' }}" placeholder="Enter section title">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Content <span class="text-danger">*</span></label>
                                                    <textarea class="form-control tinymce-editor" name="sections[{{ $index }}][text]" rows="5" data-required="true">{{ $section['text'] ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    @elseif($section['type'] === 'double_image')
                                        @if(isset($section['image_1']))
                                            <input type="hidden" name="sections[{{ $index }}][existing_image_1]" value="{{ $section['image_1'] }}">
                                        @endif
                                        @if(isset($section['image_2']))
                                            <input type="hidden" name="sections[{{ $index }}][existing_image_2]" value="{{ $section['image_2'] }}">
                                        @endif
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Image 1</label>
                                                    <input type="file" class="form-control" name="sections[{{ $index }}][image_1]" accept="image/*" onchange="previewDoubleImage(event, '{{ $sectionId }}', 1)">
                                                    <small class="text-muted d-block">Leave empty to keep current image</small>
                                                </div>
                                                <div id="{{ $sectionId }}-preview-1">
                                                    @if(isset($section['image_1']))
                                                        <img src="{{ asset('storage/' . $section['image_1']) }}" class="image-preview" alt="Section Image 1">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Image 2</label>
                                                    <input type="file" class="form-control" name="sections[{{ $index }}][image_2]" accept="image/*" onchange="previewDoubleImage(event, '{{ $sectionId }}', 2)">
                                                    <small class="text-muted d-block">Leave empty to keep current image</small>
                                                </div>
                                                <div id="{{ $sectionId }}-preview-2">
                                                    @if(isset($section['image_2']))
                                                        <img src="{{ asset('storage/' . $section['image_2']) }}" class="image-preview" alt="Section Image 2">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center py-4">No sections added yet. Click "Add Section" to start building your blog.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="text-end mb-4">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save"></i> Update Blog
            </button>
        </div>
    </form>
</div>

@push('scripts')
<style>
.section-card {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    margin-bottom: 20px;
    transition: all 0.3s;
}

.section-card:hover {
    border-color: #3B5998;
    box-shadow: 0 4px 8px rgba(59, 89, 152, 0.1);
}

.section-header {
    background-color: #f8f9fa;
    padding: 15px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 6px 6px 0 0;
}

.section-content {
    padding: 20px;
}

.section-type-badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.image-preview {
    max-width: 100%;
    max-height: 300px;
    margin-top: 10px;
    border-radius: 8px;
    border: 2px solid #e9ecef;
}

.sortable-handle {
    cursor: move;
    color: #6c757d;
}

.sortable-handle:hover {
    color: #3B5998;
}

.sortable-ghost {
    opacity: 0.4;
    background: #f8f9fa;
}

.sortable-chosen {
    opacity: 1;
}

.sortable-drag {
    opacity: 0.8;
    cursor: grabbing !important;
}

.section-menu {
    position: absolute;
    top: 100%;
    right: 0;
    margin-top: 5px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 6px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    min-width: 200px;
    z-index: 1000;
}

.section-menu-item {
    display: block;
    width: 100%;
    padding: 10px 16px;
    border: none;
    background: white;
    text-align: left;
    cursor: pointer;
    transition: background-color 0.2s;
    font-size: 14px;
    color: #333;
}

.section-menu-item:first-child {
    border-radius: 6px 6px 0 0;
}

.section-menu-item:last-child {
    border-radius: 0 0 6px 6px;
}

.section-menu-item:hover {
    background-color: #f8f9fa;
}

.section-menu-item i {
    width: 20px;
    margin-right: 8px;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="https://cdn.tiny.cloud/1/bk97uf7d0fzrilzdbres0q431wsnu5j94wpojic3vfnxqwhc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
let sectionCounter = {{ $blog->sections ? count($blog->sections) : 0 }};

function toggleSectionMenu() {
    const menu = document.getElementById('sectionMenu');
    if (menu.style.display === 'none' || menu.style.display === '') {
        menu.style.display = 'block';
    } else {
        menu.style.display = 'none';
    }
}

function closeSectionMenu() {
    const menu = document.getElementById('sectionMenu');
    menu.style.display = 'none';
}

// Close menu when clicking outside
document.addEventListener('click', function(event) {
    const menu = document.getElementById('sectionMenu');
    const btn = document.getElementById('addSectionBtn');
    
    if (menu && btn && !menu.contains(event.target) && !btn.contains(event.target)) {
        menu.style.display = 'none';
    }
});

function previewFeatureImage(event) {
    const preview = document.getElementById('feature_image_preview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="image-preview">`;
        }
        reader.readAsDataURL(file);
    }
}

function toggleProductCategory() {
    const category = document.getElementById('category');
    const wrapper = document.getElementById('productCategoryWrapper');
    const productCategory = document.getElementById('product_category');
    if (!category || !wrapper || !productCategory) return;

    if (category.value === 'product') {
        wrapper.style.display = '';
        productCategory.setAttribute('required', 'required');
    } else {
        wrapper.style.display = 'none';
        productCategory.removeAttribute('required');
        productCategory.value = '';
    }
}

function slugifyText(text) {
    return (text || '')
        .toString()
        .toLowerCase()
        .trim()
        .replace(/[\s\W-]+/g, '-')
        .replace(/^-+|-+$/g, '');
}

function addSection(type) {
    const container = document.getElementById('sections-container');
    
    // Remove empty message if it exists
    const emptyMessage = container.querySelector('p.text-muted');
    if (emptyMessage) {
        emptyMessage.remove();
    }
    
    const sectionId = `section-${sectionCounter}`;
    let sectionHTML = '';
    let badgeClass = 'bg-primary';
    let typeName = '';
    
    switch(type) {
        case 'full_image':
            typeName = 'Full Width Image';
            badgeClass = 'bg-info';
            sectionHTML = `
                <div class="section-card" id="${sectionId}" data-type="${type}">
                    <div class="section-header">
                        <div>
                            <i class="fas fa-grip-vertical sortable-handle"></i>
                            <span class="section-type-badge ${badgeClass} text-white ms-2">${typeName}</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeSection('${sectionId}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="section-content">
                        <input type="hidden" name="sections[${sectionCounter}][type]" value="${type}">
                        <div class="mb-3">
                            <label class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="sections[${sectionCounter}][image]" accept="image/*" onchange="previewImage(event, '${sectionId}')" required>
                            <small class="text-info"><i class="fas fa-info-circle"></i> Recommended size: 1630 × 790 px</small>
                        </div>
                        <div id="${sectionId}-preview"></div>
                    </div>
                </div>
            `;
            break;
            
        case 'text':
            typeName = 'Text Section';
            badgeClass = 'bg-success';
            sectionHTML = `
                <div class="section-card" id="${sectionId}" data-type="${type}">
                    <div class="section-header">
                        <div>
                            <i class="fas fa-grip-vertical sortable-handle"></i>
                            <span class="section-type-badge ${badgeClass} text-white ms-2">${typeName}</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeSection('${sectionId}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="section-content">
                        <input type="hidden" name="sections[${sectionCounter}][type]" value="${type}">
                        <div class="mb-3">
                            <label class="form-label">Section Title</label>
                            <input type="text" class="form-control" name="sections[${sectionCounter}][title]" placeholder="Enter section title">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea id="tinymce-${sectionCounter}-text" class="form-control tinymce-editor" name="sections[${sectionCounter}][text]" rows="5" data-required="true"></textarea>
                        </div>
                    </div>
                </div>
            `;
            break;
            
        case 'right_image':
            typeName = 'Right Image';
            badgeClass = 'bg-warning';
            sectionHTML = `
                <div class="section-card" id="${sectionId}" data-type="${type}">
                    <div class="section-header">
                        <div>
                            <i class="fas fa-grip-vertical sortable-handle"></i>
                            <span class="section-type-badge ${badgeClass} text-white ms-2">${typeName}</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeSection('${sectionId}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="section-content">
                        <input type="hidden" name="sections[${sectionCounter}][type]" value="${type}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Section Title</label>
                                    <input type="text" class="form-control" name="sections[${sectionCounter}][title]" placeholder="Enter section title">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Content <span class="text-danger">*</span></label>
                                    <textarea id="tinymce-${sectionCounter}-text" class="form-control tinymce-editor" name="sections[${sectionCounter}][text]" rows="5" data-required="true"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="sections[${sectionCounter}][image]" accept="image/*" onchange="previewImage(event, '${sectionId}')" required>
                                    <small class="text-info"><i class="fas fa-info-circle"></i> Recommended size: 768 × 1152 px</small>
                                </div>
                                <div id="${sectionId}-preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            break;
            
        case 'left_image':
            typeName = 'Left Image';
            badgeClass = 'bg-secondary';
            sectionHTML = `
                <div class="section-card" id="${sectionId}" data-type="${type}">
                    <div class="section-header">
                        <div>
                            <i class="fas fa-grip-vertical sortable-handle"></i>
                            <span class="section-type-badge ${badgeClass} text-white ms-2">${typeName}</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeSection('${sectionId}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="section-content">
                        <input type="hidden" name="sections[${sectionCounter}][type]" value="${type}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="sections[${sectionCounter}][image]" accept="image/*" onchange="previewImage(event, '${sectionId}')" required>
                                    <small class="text-info"><i class="fas fa-info-circle"></i> Recommended size: 768 × 1152 px</small>
                                </div>
                                <div id="${sectionId}-preview"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Section Title</label>
                                    <input type="text" class="form-control" name="sections[${sectionCounter}][title]" placeholder="Enter section title">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Content <span class="text-danger">*</span></label>
                                    <textarea id="tinymce-${sectionCounter}-text" class="form-control tinymce-editor" name="sections[${sectionCounter}][text]" rows="5" data-required="true"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            break;

        case 'double_image':
            typeName = 'Double Image';
            badgeClass = 'bg-dark';
            sectionHTML = `
                <div class="section-card" id="${sectionId}" data-type="${type}">
                    <div class="section-header">
                        <div>
                            <i class="fas fa-grip-vertical sortable-handle"></i>
                            <span class="section-type-badge ${badgeClass} text-white ms-2">${typeName}</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-danger" onclick="removeSection('${sectionId}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="section-content">
                        <input type="hidden" name="sections[${sectionCounter}][type]" value="${type}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Image 1 <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="sections[${sectionCounter}][image_1]" accept="image/*" onchange="previewDoubleImage(event, '${sectionId}', 1)" required>
                                </div>
                                <div id="${sectionId}-preview-1"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Image 2 <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="sections[${sectionCounter}][image_2]" accept="image/*" onchange="previewDoubleImage(event, '${sectionId}', 2)" required>
                                </div>
                                <div id="${sectionId}-preview-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            break;
    }
    
    container.insertAdjacentHTML('beforeend', sectionHTML);
    sectionCounter++;
    
    // Initialize TinyMCE for new textareas
    initializeTinyMCE();
    
    // Reinitialize sortable if needed
    if (!container.classList.contains('sortable-initialized')) {
        initializeSortable();
    }
    
    // Update indices after adding
    updateSectionIndices();
}

function removeSection(sectionId) {
    if (confirm('Are you sure you want to remove this section?')) {
        const section = document.getElementById(sectionId);
        section.remove();
        
        // Show empty message if no sections left
        const container = document.getElementById('sections-container');
        if (container.children.length === 0) {
            container.innerHTML = '<p class="text-muted text-center py-4">No sections added yet. Click "Add Section" to start building your blog.</p>';
        } else {
            // Update indices after removal
            updateSectionIndices();
        }
    }
}

function previewImage(event, sectionId) {
    const preview = document.getElementById(`${sectionId}-preview`);
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="image-preview">`;
        }
        reader.readAsDataURL(file);
    }
}

function previewDoubleImage(event, sectionId, num) {
    const preview = document.getElementById(`${sectionId}-preview-${num}`);
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="image-preview">`;
        };
        reader.readAsDataURL(file);
    }
}

function initializeTinyMCE() {
    // Find all textareas that need TinyMCE but don't have it yet
    document.querySelectorAll('.tinymce-editor').forEach(function(textarea) {
        // Check if this textarea already has TinyMCE
        if (!tinymce.get(textarea.id)) {
            // Generate a unique ID if it doesn't have one
            if (!textarea.id) {
                textarea.id = 'tinymce-' + Math.random().toString(36).substr(2, 9);
            }
            
            // Initialize TinyMCE for this specific textarea
            tinymce.init({
                target: textarea,
                plugins: 'lists link code',
                toolbar: 'undo redo | bold italic underline | bullist numlist | link | code',
                menubar: false,
                height: 200,
                content_css: '//www.tiny.cloud/css/codepen.min.css',
                paste_data_images: false,
                valid_elements: '*[*]',
                extended_valid_elements: 'span[*],div[*],p[*],a[*],img[*],ul[*],ol[*],li[*],strong[*],em[*],u[*],h1[*],h2[*],h3[*],h4[*],h5[*],h6[*],br[*],table[*],thead[*],tbody[*],tr[*],th[*],td[*],blockquote[*]',
                setup: function(editor) {
                    editor.on('init', function() {
                        console.log('TinyMCE initialized for:', editor.id);
                    });
                }
            });
        }
    });
}

// Initialize Sortable for drag and drop
function initializeSortable() {
    const container = document.getElementById('sections-container');
    if (container && !container.classList.contains('sortable-initialized')) {
        new Sortable(container, {
            animation: 150,
            handle: '.sortable-handle',
            ghostClass: 'sortable-ghost',
            chosenClass: 'sortable-chosen',
            dragClass: 'sortable-drag',
            onEnd: function(evt) {
                updateSectionIndices();
            }
        });
        container.classList.add('sortable-initialized');
    }
}

// Update section indices after reordering
function updateSectionIndices() {
    const sections = document.querySelectorAll('.section-card');
    sections.forEach((section, index) => {
        // Update all input names within this section
        const inputs = section.querySelectorAll('input[name^="sections["], textarea[name^="sections["], select[name^="sections["]');
        inputs.forEach(input => {
            const nameMatch = input.name.match(/sections\[\d+\]\[(.+)\]/);
            if (nameMatch) {
                input.name = `sections[${index}][${nameMatch[1]}]`;
            }
        });
    });
}

// Form validation before submission
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    if (titleInput && slugInput) {
        titleInput.addEventListener('blur', function() {
            if (!slugInput.value.trim()) {
                slugInput.value = slugifyText(titleInput.value);
            }
        });
    }
    toggleProductCategory();
    initializeTinyMCE();
    initializeSortable();
    
    // Add form submit validation
    const form = document.getElementById('blogForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            let firstError = null;
            
            // Sync all TinyMCE editors before validation
            tinymce.triggerSave();
            
            // Check all textareas marked as required
            document.querySelectorAll('textarea[data-required="true"]').forEach(function(textarea) {
                const editorId = textarea.id;
                const editor = tinymce.get(editorId);
                
                if (editor) {
                    const content = editor.getContent({format: 'text'}).trim();
                    if (!content) {
                        isValid = false;
                        if (!firstError) {
                            firstError = editor;
                        }
                        // Add visual feedback
                        editor.getContainer().style.border = '2px solid #dc3545';
                    } else {
                        // Remove error styling if content exists
                        editor.getContainer().style.border = '';
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required Content fields before submitting.');
                if (firstError) {
                    firstError.focus();
                }
                return false;
            }
        });
    }
});
</script>
@endpush
@endsection

