@extends('admin.layouts.app')

@section('title', 'Create Page - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fa-solid fa-plus-circle me-2 text-primary"></i>
                    Create New Page
                </h1>
                <a href="{{ route('admin.custom-pages.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.custom-pages.store') }}" method="POST">
        @csrf
        
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="title" class="form-label">Page Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">URL Slug</label>
                            <div class="input-group">
                                <span class="input-group-text">/</span>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" 
                                       id="slug" name="slug" value="{{ old('slug') }}" placeholder="auto-generated-from-title">
                            </div>
                            <small class="text-muted">Leave empty to auto-generate from title</small>
                            @error('slug')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="15">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="template" class="form-label">Template</label>
                            <select class="form-select @error('template') is-invalid @enderror" id="template" name="template">
                                <option value="default" {{ old('template', 'default') == 'default' ? 'selected' : '' }}>Default</option>
                                <option value="full-width" {{ old('template') == 'full-width' ? 'selected' : '' }}>Full Width</option>
                            </select>
                            @error('template')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Options</label>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" 
                                       {{ old('is_published', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_published">Published</label>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" id="show_in_header" name="show_in_header" value="1" 
                                       {{ old('show_in_header') ? 'checked' : '' }}>
                                <label class="form-check-label" for="show_in_header">Show in Header Menu</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="show_in_footer" name="show_in_footer" value="1" 
                                       {{ old('show_in_footer') ? 'checked' : '' }}>
                                <label class="form-check-label" for="show_in_footer">Show in Footer Menu</label>
                            </div>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                   value="{{ old('sort_order', 0) }}">
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">SEO</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" 
                                   value="{{ old('meta_title') }}" maxlength="255">
                        </div>
                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" 
                                      rows="3" maxlength="500">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save me-2"></i>Create Page
                    </button>
                    <a href="{{ route('admin.custom-pages.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
