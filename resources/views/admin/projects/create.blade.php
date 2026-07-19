@extends('admin.layouts.app')

@section('title', 'Add Project')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Add Project</h1>
        <p class="admin-breadcrumb mb-0"><a href="{{ route('admin.projects.index') }}">Projects</a> / Add New</p>
    </div>
</div>

<x-validation-errors />

<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-custom">Project Information</div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label-admin">Project Title <span class="required-star">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-admin">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="Auto-generated">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Category</label>
                            <select name="project_category_id" class="form-select">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('project_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Status <span class="required-star">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="ongoing" {{ old('status') === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="on_hold" {{ old('status') === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Client Name</label>
                            <input type="text" name="client_name" class="form-control" value="{{ old('client_name') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Project URL</label>
                            <input type="url" name="project_url" class="form-control" value="{{ old('project_url') }}" placeholder="https://">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Technologies Used</label>
                            <input type="text" name="technologies" class="form-control" value="{{ old('technologies') }}" placeholder="Laravel, Vue.js, MySQL (comma separated)">
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label-admin mb-0">Description</label>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openFileManager()">
                                    <i class="fa-solid fa-image me-1"></i>Insert Image from Gallery
                                </button>
                            </div>
                            <textarea name="description" id="description" class="form-control" rows="8">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header-custom">Gallery Images</div>
                <div class="card-body-custom">
                    <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
                    <small class="text-muted">You can select multiple images. Save the project first to add more later.</small>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-custom">Featured Image</div>
                <div class="card-body-custom text-center">
                    <img id="featuredPreview" src="https://placehold.co/400x300/e2e8f0/64748b?text=No+Image" class="rounded-3 mb-3 w-100" style="aspect-ratio:4/3; object-fit:cover;">
                    <input type="file" name="featured_image" class="form-control" accept="image/*" data-preview-target="#featuredPreview">
                    <small class="text-muted d-block mt-2">JPG, PNG or WEBP. Max 2MB.</small>
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-custom">Options</div>
                <div class="card-body-custom">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Mark as Featured</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active (visible on site)</label>
                    </div>
                    <label class="form-label-admin">Sort Order</label>
                    <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', 0) }}">
                </div>
            </div>

            <button type="submit" class="btn btn-admin-primary w-100 py-2">
                <i class="fa-solid fa-floppy-disk me-2"></i>Save Project
            </button>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    let descriptionEditor;
    ClassicEditor.create(document.querySelector('#description'))
        .then(editor => { descriptionEditor = editor; })
        .catch(console.error);

    window.addEventListener('message', function (e) {
        if (typeof e.data === 'string' && e.data.startsWith('http') && descriptionEditor) {
            descriptionEditor.model.change(writer => {
                const imageElement = writer.createElement('imageBlock', { src: e.data });
                descriptionEditor.model.insertContent(imageElement, descriptionEditor.model.document.selection);
            });
        }
    });
</script>
@endpush
