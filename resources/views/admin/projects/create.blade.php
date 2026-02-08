@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create New Project</h1>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Projects</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" id="projectForm">
        @csrf

        <div class="card mb-4">
            <div class="card-header"><h5 class="mb-0">Basic Information</h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Project Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtitle / Tagline</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle') }}" placeholder="e.g. Lighting Dreams, Inspiring Growth">
                        </div>
                        <div class="mb-3">
                            <label for="intro" class="form-label">Description</label>
                            <textarea class="form-control" id="intro" name="intro" rows="4">{{ old('intro') }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Order</label>
                                    <input type="number" class="form-control" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label d-block">Status</label>
                                    <div class="form-check form-switch">
                                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="feature_image" class="form-label">Feature Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="feature_image" name="feature_image" accept="image/*" required onchange="previewFeatureImage(event)">
                            <small class="text-info"><i class="fas fa-info-circle"></i> Recommended: 1920 × 980 px</small>
                        </div>
                        <div id="feature_image_preview" class="mt-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header"><h5 class="mb-0">Project Info</h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="info_location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="info_location" name="info_location" value="{{ old('info_location') }}" placeholder="e.g. Badda, Dhaka, Bangladesh">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="info_client" class="form-label">Client</label>
                            <input type="text" class="form-control" id="info_client" name="info_client" value="{{ old('info_client') }}" placeholder="e.g. BRAC University">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="info_year" class="form-label">Year</label>
                            <input type="text" class="form-control" id="info_year" name="info_year" value="{{ old('info_year') }}" placeholder="e.g. 2024">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="info_photographs" class="form-label">Photographs</label>
                            <input type="text" class="form-control" id="info_photographs" name="info_photographs" value="{{ old('info_photographs') }}" placeholder="e.g. Alvi Muhtasim">
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
                    <p class="text-muted text-center py-4">No sections added yet. Click "Add Section" to start building your project.</p>
                </div>
            </div>
        </div>

        <div class="text-end mb-5 d-flex justify-content-between align-items-center">
            <div class="position-relative">
                <button type="button" class="btn btn-md btn-primary" id="addSectionBtn" onclick="toggleSectionMenu()">
                    <i class="fas fa-plus"></i> Add Section <i class="fas fa-chevron-up ms-1"></i>
                </button>
                <div id="sectionMenu" class="section-menu" style="display: none;">
                    <button class="section-menu-item" type="button" onclick="addSection('full_image'); closeSectionMenu();"><i class="fas fa-image"></i> Full Width Image</button>
                    <button class="section-menu-item" type="button" onclick="addSection('text'); closeSectionMenu();"><i class="fas fa-align-left"></i> Text Section</button>
                    <button class="section-menu-item" type="button" onclick="addSection('right_image'); closeSectionMenu();"><i class="fas fa-grip-horizontal"></i> Right Image</button>
                    <button class="section-menu-item" type="button" onclick="addSection('left_image'); closeSectionMenu();"><i class="fas fa-grip-horizontal fa-flip-horizontal"></i> Left Image</button>
                    <button class="section-menu-item" type="button" onclick="addSection('double_image'); closeSectionMenu();"><i class="fas fa-images"></i> Double Image</button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-md"><i class="fas fa-save"></i> Create Project</button>
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
var sectionCounter=0;
function toggleSectionMenu(){var m=document.getElementById('sectionMenu');m.style.display=(m.style.display==='none'||m.style.display==='')?'block':'none';}
function closeSectionMenu(){document.getElementById('sectionMenu').style.display='none';}
document.addEventListener('click',function(e){var m=document.getElementById('sectionMenu'),b=document.getElementById('addSectionBtn');if(m&&b&&!m.contains(e.target)&&!b.contains(e.target))m.style.display='none';});
function previewFeatureImage(e){var p=document.getElementById('feature_image_preview'),f=e.target.files[0];if(f){var r=new FileReader();r.onload=function(ev){p.innerHTML='<img src="'+ev.target.result+'" class="image-preview">';};r.readAsDataURL(f);}}
function addSection(type){
    var container=document.getElementById('sections-container');
    var empty=container.querySelector('p.text-muted');if(empty)empty.remove();
    var sectionId='section-'+sectionCounter, badgeClass='bg-primary', typeName='', sectionHTML='';
    if(type==='full_image'){typeName='Full Width Image';badgeClass='bg-info';sectionHTML='<div class="section-card" id="'+sectionId+'" data-type="'+type+'"><div class="section-header"><div><i class="fas fa-grip-vertical sortable-handle"></i><span class="section-type-badge '+badgeClass+' text-white ms-2">'+typeName+'</span></div><button type="button" class="btn btn-sm btn-danger" onclick="removeSection(\''+sectionId+'\')"><i class="fas fa-trash"></i></button></div><div class="section-content"><input type="hidden" name="sections['+sectionCounter+'][type]" value="'+type+'"><div class="mb-3"><label class="form-label">Image <span class="text-danger">*</span></label><input type="file" class="form-control" name="sections['+sectionCounter+'][image]" accept="image/*" onchange="previewImage(event,\''+sectionId+'\')" required><small class="text-info"><i class="fas fa-info-circle"></i> Recommended: 1630 × 790 px</small></div><div id="'+sectionId+'-preview"></div></div></div>';}
    else if(type==='text'){typeName='Text Section';badgeClass='bg-success';sectionHTML='<div class="section-card" id="'+sectionId+'" data-type="'+type+'"><div class="section-header"><div><i class="fas fa-grip-vertical sortable-handle"></i><span class="section-type-badge '+badgeClass+' text-white ms-2">'+typeName+'</span></div><button type="button" class="btn btn-sm btn-danger" onclick="removeSection(\''+sectionId+'\')"><i class="fas fa-trash"></i></button></div><div class="section-content"><input type="hidden" name="sections['+sectionCounter+'][type]" value="'+type+'"><div class="mb-3"><label class="form-label">Section Title</label><input type="text" class="form-control" name="sections['+sectionCounter+'][title]" placeholder="Enter section title"></div><div class="mb-3"><label class="form-label">Content <span class="text-danger">*</span></label><textarea id="tinymce-'+sectionCounter+'-text" class="form-control tinymce-editor" name="sections['+sectionCounter+'][text]" rows="5" data-required="true"></textarea></div></div></div>';}
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
    var form=document.getElementById('projectForm');
    if(form)form.addEventListener('submit',function(e){tinymce.triggerSave();var valid=true;document.querySelectorAll('textarea[data-required="true"]').forEach(function(ta){var ed=tinymce.get(ta.id);if(ed&&!ed.getContent({format:'text'}).trim()){valid=false;ed.getContainer().style.border='2px solid #dc3545';}else if(ed)ed.getContainer().style.border='';});if(!valid){e.preventDefault();alert('Please fill in all required Content fields.');return false;}});
});
</script>
@endpush
@endsection
