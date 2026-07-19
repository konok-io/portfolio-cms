@extends('admin.layouts.app')

@section('title', 'Add Blog Post')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Add Blog Post</h1>
        <p class="admin-breadcrumb mb-0"><a href="{{ route('admin.blog.index') }}">Blog</a> / Add New</p>
    </div>
</div>

<x-validation-errors />

<form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-custom">Post Content</div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label-admin">Title <span class="required-star">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-admin">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" placeholder="Auto-generated">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Short Description</label>
                            <textarea name="short_description" class="form-control" rows="2" maxlength="500">{{ old('short_description') }}</textarea>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label-admin mb-0">Full Description <span class="required-star">*</span></label>
                                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openFileManager()">
                                    <i class="fa-solid fa-image me-1"></i>Insert Image from Gallery
                                </button>
                            </div>
                            <textarea name="description" id="description" class="form-control" rows="10">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header-custom">SEO Settings</div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label-admin">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Meta Keywords</label>
                            <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords') }}" placeholder="comma, separated, keywords">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="2" maxlength="500">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-custom">Publish</div>
                <div class="card-body-custom">
                    <label class="form-label-admin">Status</label>
                    <select name="status" class="form-select mb-3">
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', 'published') === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    <label class="form-label-admin">Published Date</label>
                    <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at') }}">
                    <small class="text-muted d-block mt-2">Leave blank to publish immediately.</small>
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-custom">Category</div>
                <div class="card-body-custom">
                    <select name="blog_category_id" class="form-select">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('blog_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-custom">Featured Image</div>
                <div class="card-body-custom text-center">
                    <img id="featuredPreview" src="https://placehold.co/400x300/e2e8f0/64748b?text=No+Image" class="rounded-3 mb-3 w-100" style="aspect-ratio:4/3; object-fit:cover;">
                    <input type="file" name="featured_image" class="form-control" accept="image/*" data-preview-target="#featuredPreview">
                    <small class="text-muted d-block mt-2">JPG, PNG or WEBP. Max 2MB.</small>
                </div>
            </div>

            <button type="submit" class="btn btn-admin-primary w-100 py-2">
                <i class="fa-solid fa-floppy-disk me-2"></i>Save Post
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
