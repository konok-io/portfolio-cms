@extends('admin.layouts.app')

@section('title', 'SEO Settings')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>SEO Settings</h1>
        <p class="admin-breadcrumb mb-0">Default meta tags used across your website.</p>
    </div>
</div>

<x-validation-errors />

<form action="{{ route('admin.seo.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="card-header-custom">Default Meta Tags</div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label-admin">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $seo->meta_title) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3" maxlength="500">{{ old('meta_description', $seo->meta_description) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Meta Keywords</label>
                            <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $seo->meta_keywords) }}" placeholder="comma, separated, keywords">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-custom">Open Graph Image</div>
                <div class="card-body-custom text-center">
                    <img id="ogPreview" src="{{ $seo->og_image_url ?? 'https://placehold.co/400x300/e2e8f0/64748b?text=OG+Image' }}" class="rounded-3 mb-3 w-100" style="aspect-ratio:4/3; object-fit:cover;">
                    <input type="file" name="og_image" class="form-control" accept="image/*" data-preview-target="#ogPreview">
                    <small class="text-muted d-block mt-2">Used when your site is shared on social media.</small>
                </div>
            </div>

            <button type="submit" class="btn btn-admin-primary w-100 py-2">
                <i class="fa-solid fa-floppy-disk me-2"></i>Save SEO Settings
            </button>
        </div>
    </div>
</form>

@endsection
