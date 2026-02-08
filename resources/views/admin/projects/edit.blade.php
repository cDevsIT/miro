@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Project</h1>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Projects</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" id="projectForm">
        @csrf
        @method('PUT')

        <div class="card mb-4">
            <div class="card-header"><h5 class="mb-0">Basic Information</h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Project Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $project->title) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtitle / Tagline (h2)</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle', $project->subtitle) }}">
                        </div>
                        <div class="mb-3">
                            <label for="intro" class="form-label">Description</label>
                            <textarea class="form-control" id="intro" name="intro" rows="4">{{ old('intro', $project->intro) }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Order</label>
                                    <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $project->order) }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}>
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
                            <small class="text-info"><i class="fas fa-info-circle"></i> Recommended: 1920 × 980 px</small>
                        </div>
                        <div id="feature_image_preview" class="mt-2">
                            @if($project->feature_image)
                                <img src="{{ asset('storage/' . $project->feature_image) }}" class="image-preview" alt="Current Feature Image">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header"><h5 class="mb-0">Project Info (project-details-info)</h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="info_location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="info_location" name="info_location" value="{{ old('info_location', $project->info_location) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="info_client" class="form-label">Client</label>
                            <input type="text" class="form-control" id="info_client" name="info_client" value="{{ old('info_client', $project->info_client) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="info_year" class="form-label">Year</label>
                            <input type="text" class="form-control" id="info_year" name="info_year" value="{{ old('info_year', $project->info_year) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="info_photographs" class="form-label">Photographs</label>
                            <input type="text" class="form-control" id="info_photographs" name="info_photographs" value="{{ old('info_photographs', $project->info_photographs) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Project Sections</h5>
            </div>
            <div class="card-body">
                <div id="sections-container">
                    @if($project->sections && count($project->sections) > 0)
                        @foreach($project->sections as $index => $section)
                            @php
                                $sectionId = "section-existing-{$index}";
                                $badgeClass = 'bg-primary';
                                $typeName = '';
                                switch($section['type'] ?? '') {
                                    case 'full_image': $typeName = 'Full Width Image'; $badgeClass = 'bg-info'; break;
                                    case 'text': $typeName = 'Text Section'; $badgeClass = 'bg-success'; break;
                                    case 'right_image': $typeName = 'Right Image'; $badgeClass = 'bg-warning'; break;
                                    case 'left_image': $typeName = 'Left Image'; $badgeClass = 'bg-secondary'; break;
                                    case 'double_image': $typeName = 'Double Image'; $badgeClass = 'bg-dark'; break;
                                }
                            @endphp
                            <div class="section-card" id="{{ $sectionId }}" data-type="{{ $section['type'] ?? '' }}">
                                <div class="section-header">
                                    <div><i class="fas fa-grip-vertical sortable-handle"></i><span class="section-type-badge {{ $badgeClass }} text-white ms-2">{{ $typeName }}</span></div>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeSection('{{ $sectionId }}')"><i class="fas fa-trash"></i></button>
                                </div>
                                <div class="section-content">
                                    <input type="hidden" name="sections[{{ $index }}][type]" value="{{ $section['type'] ?? '' }}">
                                    @if(($section['type'] ?? '') === 'full_image')
                                        @if(isset($section['image']))<input type="hidden" name="sections[{{ $index }}][existing_image]" value="{{ $section['image'] }}">@endif
                                        <div class="mb-3"><label class="form-label">Image</label><input type="file" class="form-control" name="sections[{{ $index }}][image]" accept="image/*" onchange="previewImage(event, '{{ $sectionId }}')"><small class="text-muted">Leave empty to keep current</small></div>
                                        <div id="{{ $sectionId }}-preview">@if(isset($section['image']))<img src="{{ asset('storage/' . $section['image']) }}" class="image-preview" alt="Section">@endif</div>
                                    @elseif(($section['type'] ?? '') === 'text')
                                        <div class="mb-3"><label class="form-label">Section Title</label><input type="text" class="form-control" name="sections[{{ $index }}][title]" value="{{ $section['title'] ?? '' }}"></div>
                                        <div class="mb-3"><label class="form-label">Content <span class="text-danger">*</span></label><textarea id="tinymce-{{ $index }}-text" class="form-control tinymce-editor" name="sections[{{ $index }}][text]" rows="5" data-required="true">{{ $section['text'] ?? '' }}</textarea></div>
                                    @elseif(in_array($section['type'] ?? '', ['right_image', 'left_image']))
                                        @if(isset($section['image']))<input type="hidden" name="sections[{{ $index }}][existing_image]" value="{{ $section['image'] }}">@endif
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3"><label class="form-label">Section Title</label><input type="text" class="form-control" name="sections[{{ $index }}][title]" value="{{ $section['title'] ?? '' }}"></div>
                                                <div class="mb-3"><label class="form-label">Content <span class="text-danger">*</span></label><textarea id="tinymce-{{ $index }}-text" class="form-control tinymce-editor" name="sections[{{ $index }}][text]" rows="5" data-required="true">{{ $section['text'] ?? '' }}</textarea></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3"><label class="form-label">Image</label><input type="file" class="form-control" name="sections[{{ $index }}][image]" accept="image/*" onchange="previewImage(event, '{{ $sectionId }}')"><small class="text-muted">Leave empty to keep current</small></div>
                                                <div id="{{ $sectionId }}-preview">@if(isset($section['image']))<img src="{{ asset('storage/' . $section['image']) }}" class="image-preview" alt="Section">@endif</div>
                                            </div>
                                        </div>
                                    @elseif(($section['type'] ?? '') === 'double_image')
                                        @if(isset($section['image_1']))<input type="hidden" name="sections[{{ $index }}][existing_image_1]" value="{{ $section['image_1'] }}">@endif
                                        @if(isset($section['image_2']))<input type="hidden" name="sections[{{ $index }}][existing_image_2]" value="{{ $section['image_2'] }}">@endif
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3"><label class="form-label">Image 1</label><input type="file" class="form-control" name="sections[{{ $index }}][image_1]" accept="image/*" onchange="previewDoubleImage(event, '{{ $sectionId }}', 1)"><small class="text-muted">Leave empty to keep current</small></div>
                                                <div id="{{ $sectionId }}-preview-1">@if(isset($section['image_1']))<img src="{{ asset('storage/' . $section['image_1']) }}" class="image-preview" alt="Section 1">@endif</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3"><label class="form-label">Image 2</label><input type="file" class="form-control" name="sections[{{ $index }}][image_2]" accept="image/*" onchange="previewDoubleImage(event, '{{ $sectionId }}', 2)"><small class="text-muted">Leave empty to keep current</small></div>
                                                <div id="{{ $sectionId }}-preview-2">@if(isset($section['image_2']))<img src="{{ asset('storage/' . $section['image_2']) }}" class="image-preview" alt="Section 2">@endif</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center py-4">No sections added yet. Click "Add Section" to start building your project.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="text-end mb-5 d-flex justify-content-between align-items-center">
            <div class="position-relative">
                <button type="button" class="btn btn-md btn-primary" id="addSectionBtn" onclick="toggleSectionMenu()"><i class="fas fa-plus"></i> Add Section <i class="fas fa-chevron-up ms-1"></i></button>
                <div id="sectionMenu" class="section-menu" style="display: none;">
                    <button class="section-menu-item" type="button" onclick="addSection('full_image'); closeSectionMenu();"><i class="fas fa-image"></i> Full Width Image</button>
                    <button class="section-menu-item" type="button" onclick="addSection('text'); closeSectionMenu();"><i class="fas fa-align-left"></i> Text Section</button>
                    <button class="section-menu-item" type="button" onclick="addSection('right_image'); closeSectionMenu();"><i class="fas fa-grip-horizontal"></i> Right Image</button>
                    <button class="section-menu-item" type="button" onclick="addSection('left_image'); closeSectionMenu();"><i class="fas fa-grip-horizontal fa-flip-horizontal"></i> Left Image</button>
                    <button class="section-menu-item" type="button" onclick="addSection('double_image'); closeSectionMenu();"><i class="fas fa-images"></i> Double Image</button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-md"><i class="fas fa-save"></i> Update Project</button>
        </div>
    </form>
</div>

@push('scripts')
<style>
.section-card{border:2px solid #e9ecef;border-radius:8px;margin-bottom:20px;transition:all .3s}.section-card:hover{border-color:#3B5998;box-shadow:0 4px 8px rgba(59,89,152,.1)}.section-header{background:#f8f9fa;padding:15px;border-bottom:1px solid #e9ecef;display:flex;justify-content:space-between;align-items:center;border-radius:6px 6px 0 0}.section-content{padding:20px}.section-type-badge{padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600}.image-preview{max-width:100%;max-height:300px;margin-top:10px;border-radius:8px;border:2px solid #e9ecef}.sortable-handle{cursor:move;color:#6c757d}.sortable-handle:hover{color:#3B5998}.sortable-ghost{opacity:.4;background:#f8f9fa}.sortable-drag{opacity:.8;cursor:grabbing!important}.section-menu{position:absolute;bottom:36px;margin-top:5px;background:#fff;border:1px solid #ddd;border-radius:6px;box-shadow:0 4px 12px rgba(0,0,0,.15);min-width:200px;z-index:1000}.section-menu-item{display:block;width:100%;padding:10px 16px;border:none;background:#fff;text-align:left;cursor:pointer;font-size:14px;color:#333}.section-menu-item:hover{background:#f8f9fa}.section-menu-item i{width:20px;margin-right:8px}
</style>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script src="https://cdn.tiny.cloud/1/bk97uf7d0fzrilzdbres0q431wsnu5j94wpojic3vfnxqwhc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
var sectionCounter = {{ $project->sections ? count($project->sections) : 0 }};
function toggleSectionMenu(){var m=document.getElementById('sectionMenu');m.style.display=(m.style.display==='none'||m.style.display==='')?'block':'none';}
function closeSectionMenu(){document.getElementById('sectionMenu').style.display='none';}
document.addEventListener('click',function(e){var m=document.getElementById('sectionMenu'),b=document.getElementById('addSectionBtn');if(m&&b&&!m.contains(e.target)&&!b.contains(e.target))m.style.display='none';});
function previewFeatureImage(e){var p=document.getElementById('feature_image_preview'),f=e.target.files[0];if(f){var r=new FileReader();r.onload=function(ev){p.innerHTML='<img src="'+ev.target.result+'" class="image-preview">';};r.readAsDataURL(f);}}
function addSection(type){
    var container=document.getElementById('sections-container');
    var empty=container.querySelector('p.text-muted');if(empty)empty.remove();
    var sectionId='section-'+sectionCounter, badgeClass='bg-primary', typeName='', sectionHTML='';
    if(type==='full_image'){typeName='Full Width Image';badgeClass='bg-info';sectionHTML='<div class="section-card" id="'+sectionId+'" data-type="'+type+'"><div class="section-header"><div><i class="fas fa-grip-vertical sortable-handle"></i><span class="section-type-badge '+badgeClass+' text-white ms-2">'+typeName+'</span></div><button type="button" class="btn btn-sm btn-danger" onclick="removeSection(\''+sectionId+'\')"><i class="fas fa-trash"></i></button></div><div class="section-content"><input type="hidden" name="sections['+sectionCounter+'][type]" value="'+type+'"><div class="mb-3"><label class="form-label">Image <span class="text-danger">*</span></label><input type="file" class="form-control" name="sections['+sectionCounter+'][image]" accept="image/*" onchange="previewImage(event,\''+sectionId+'\')" required><small class="text-info"><i class="fas fa-info-circle"></i> Recommended: 1630 × 790 px</small></div><div id="'+sectionId+'-preview"></div></div></div>';}
    else if(type==='text'){typeName='Text Section';badgeClass='bg-success';sectionHTML='<div class="section-card" id="'+sectionId+'" data-type="'+type+'"><div class="section-header"><div><i class="fas fa-grip-vertical sortable-handle"></i><span class="section-type-badge '+badgeClass+' text-white ms-2">'+typeName+'</span></div><button type="button" class="btn btn-sm btn-danger" onclick="removeSection(\''+sectionId+'\')"><i class="fas fa-trash"></i></button></div><div class="section-content"><input type="hidden" name="sections['+sectionCounter+'][type]" value="'+type+'"><div class="mb-3"><label class="form-label">Section Title</label><input type="text" class="form-control" name="sections['+sectionCounter+'][title]"></div><div class="mb-3"><label class="form-label">Content <span class="text-danger">*</span></label><textarea id="tinymce-'+sectionCounter+'-text" class="form-control tinymce-editor" name="sections['+sectionCounter+'][text]" rows="5" data-required="true"></textarea></div></div></div>';}
    else if(type==='right_image'){typeName='Right Image';badgeClass='bg-warning';sectionHTML='<div class="section-card" id="'+sectionId+'" data-type="'+type+'"><div class="section-header"><div><i class="fas fa-grip-vertical sortable-handle"></i><span class="section-type-badge '+badgeClass+' text-white ms-2">'+typeName+'</span></div><button type="button" class="btn btn-sm btn-danger" onclick="removeSection(\''+sectionId+'\')"><i class="fas fa-trash"></i></button></div><div class="section-content"><input type="hidden" name="sections['+sectionCounter+'][type]" value="'+type+'"><div class="row"><div class="col-md-6"><div class="mb-3"><label class="form-label">Section Title</label><input type="text" class="form-control" name="sections['+sectionCounter+'][title]"></div><div class="mb-3"><label class="form-label">Content <span class="text-danger">*</span></label><textarea id="tinymce-'+sectionCounter+'-text" class="form-control tinymce-editor" name="sections['+sectionCounter+'][text]" rows="5" data-required="true"></textarea></div></div><div class="col-md-6"><div class="mb-3"><label class="form-label">Image <span class="text-danger">*</span></label><input type="file" class="form-control" name="sections['+sectionCounter+'][image]" accept="image/*" onchange="previewImage(event,\''+sectionId+'\')" required><small class="text-info"><i class="fas fa-info-circle"></i> Recommended: 768 × 1152 px</small></div><div id="'+sectionId+'-preview"></div></div></div></div></div>';}
    else if(type==='left_image'){typeName='Left Image';badgeClass='bg-secondary';sectionHTML='<div class="section-card" id="'+sectionId+'" data-type="'+type+'"><div class="section-header"><div><i class="fas fa-grip-vertical sortable-handle"></i><span class="section-type-badge '+badgeClass+' text-white ms-2">'+typeName+'</span></div><button type="button" class="btn btn-sm btn-danger" onclick="removeSection(\''+sectionId+'\')"><i class="fas fa-trash"></i></button></div><div class="section-content"><input type="hidden" name="sections['+sectionCounter+'][type]" value="'+type+'"><div class="row"><div class="col-md-6"><div class="mb-3"><label class="form-label">Image <span class="text-danger">*</span></label><input type="file" class="form-control" name="sections['+sectionCounter+'][image]" accept="image/*" onchange="previewImage(event,\''+sectionId+'\')" required><small class="text-info"><i class="fas fa-info-circle"></i> Recommended: 768 × 1152 px</small></div><div id="'+sectionId+'-preview"></div></div><div class="col-md-6"><div class="mb-3"><label class="form-label">Section Title</label><input type="text" class="form-control" name="sections['+sectionCounter+'][title]"></div><div class="mb-3"><label class="form-label">Content <span class="text-danger">*</span></label><textarea id="tinymce-'+sectionCounter+'-text" class="form-control tinymce-editor" name="sections['+sectionCounter+'][text]" rows="5" data-required="true"></textarea></div></div></div></div></div>';}
    else if(type==='double_image'){typeName='Double Image';badgeClass='bg-dark';sectionHTML='<div class="section-card" id="'+sectionId+'" data-type="'+type+'"><div class="section-header"><div><i class="fas fa-grip-vertical sortable-handle"></i><span class="section-type-badge '+badgeClass+' text-white ms-2">'+typeName+'</span></div><button type="button" class="btn btn-sm btn-danger" onclick="removeSection(\''+sectionId+'\')"><i class="fas fa-trash"></i></button></div><div class="section-content"><input type="hidden" name="sections['+sectionCounter+'][type]" value="'+type+'"><div class="row"><div class="col-md-6"><div class="mb-3"><label class="form-label">Image 1 <span class="text-danger">*</span></label><input type="file" class="form-control" name="sections['+sectionCounter+'][image_1]" accept="image/*" onchange="previewDoubleImage(event,\''+sectionId+'\',1)" required></div><div id="'+sectionId+'-preview-1"></div></div><div class="col-md-6"><div class="mb-3"><label class="form-label">Image 2 <span class="text-danger">*</span></label><input type="file" class="form-control" name="sections['+sectionCounter+'][image_2]" accept="image/*" onchange="previewDoubleImage(event,\''+sectionId+'\',2)" required></div><div id="'+sectionId+'-preview-2"></div></div></div></div></div>';}
    container.insertAdjacentHTML('beforeend',sectionHTML);
    sectionCounter++;
    initializeTinyMCE();
    if(!container.classList.contains('sortable-initialized')){new Sortable(container,{animation:150,handle:'.sortable-handle',ghostClass:'sortable-ghost',chosenClass:'sortable-chosen',dragClass:'sortable-drag',onEnd:function(){updateSectionIndices();}});container.classList.add('sortable-initialized');}
    updateSectionIndices();
}
function removeSection(sectionId){if(!confirm('Remove this section?'))return;var el=document.getElementById(sectionId);el.remove();var c=document.getElementById('sections-container');if(c.children.length===0)c.innerHTML='<p class="text-muted text-center py-4">No sections added yet. Click "Add Section" to start building your project.</p>';else updateSectionIndices();}
function previewImage(event,sectionId){var p=document.getElementById(sectionId+'-preview'),f=event.target.files[0];if(f){var r=new FileReader();r.onload=function(e){p.innerHTML='<img src="'+e.target.result+'" class="image-preview">';};r.readAsDataURL(f);}}
function previewDoubleImage(event,sectionId,num){var p=document.getElementById(sectionId+'-preview-'+num),f=event.target.files[0];if(f){var r=new FileReader();r.onload=function(e){p.innerHTML='<img src="'+e.target.result+'" class="image-preview">';};r.readAsDataURL(f);}}
function initializeTinyMCE(){document.querySelectorAll('.tinymce-editor').forEach(function(ta){if(!tinymce.get(ta.id)){if(!ta.id)ta.id='tinymce-'+Math.random().toString(36).substr(2,9);tinymce.init({target:ta,plugins:'lists link code',toolbar:'undo redo | bold italic underline | bullist numlist | link | code',menubar:false,height:200,content_css:'//www.tiny.cloud/css/codepen.min.css',paste_data_images:false});}});}
function updateSectionIndices(){document.querySelectorAll('.section-card').forEach(function(section,index){section.querySelectorAll('input[name^="sections["], textarea[name^="sections["]').forEach(function(input){var m=input.name.match(/sections\[\d+\]\[(.+)\]/);if(m)input.name='sections['+index+']['+m[1]+']';});});}
document.addEventListener('DOMContentLoaded',function(){
    if(!document.getElementById('sections-container').classList.contains('sortable-initialized')&&document.querySelector('.section-card')){new Sortable(document.getElementById('sections-container'),{animation:150,handle:'.sortable-handle',ghostClass:'sortable-ghost',chosenClass:'sortable-chosen',dragClass:'sortable-drag',onEnd:function(){updateSectionIndices();}});document.getElementById('sections-container').classList.add('sortable-initialized');}
    initializeTinyMCE();
    var form=document.getElementById('projectForm');
    if(form)form.addEventListener('submit',function(e){tinymce.triggerSave();var valid=true;document.querySelectorAll('textarea[data-required="true"]').forEach(function(ta){var ed=tinymce.get(ta.id);if(ed&&!ed.getContent({format:'text'}).trim()){valid=false;ed.getContainer().style.border='2px solid #dc3545';}else if(ed)ed.getContainer().style.border='';});if(!valid){e.preventDefault();alert('Please fill in all required Content fields.');return false;}});
});
</script>
@endpush
@endsection
