@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Edit Testimonial</h1>
        <p class="admin-breadcrumb mb-0"><a href="{{ route('admin.testimonials.index') }}">Testimonials</a> / Edit</p>
    </div>
</div>

<x-validation-errors />

<form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-admin">Client Name <span class="required-star">*</span></label>
                            <input type="text" name="client_name" class="form-control" value="{{ old('client_name', $testimonial->client_name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Company</label>
                            <input type="text" name="company" class="form-control" value="{{ old('company', $testimonial->company) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-admin">Rating <span class="required-star">*</span></label>
                            <select name="rating" class="form-select" required>
                                @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-admin d-block">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label-admin">Sort Order</label>
                            <input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $testimonial->sort_order) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Review <span class="required-star">*</span></label>
                            <textarea name="review" class="form-control" rows="5" required>{{ old('review', $testimonial->review) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-custom">Client Photo</div>
                <div class="card-body-custom text-center">
                    <img id="photoPreview" src="{{ $testimonial->photo_url }}" class="rounded-circle mb-3" width="120" height="120" style="object-fit:cover;">
                    <input type="file" name="photo" class="form-control" accept="image/*" data-preview-target="#photoPreview">
                </div>
            </div>

            <button type="submit" class="btn btn-admin-primary w-100 py-2">
                <i class="fa-solid fa-floppy-disk me-2"></i>Update Testimonial
            </button>
        </div>
    </div>
</form>

@endsection
