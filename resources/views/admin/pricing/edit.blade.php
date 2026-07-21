@extends('layouts.app')

@section('title', 'Edit Pricing Plan - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fa-solid fa-edit me-2 text-primary"></i>
                    Edit Pricing Plan
                </h1>
                <a href="{{ route('admin.pricing.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <form action="{{ route('admin.pricing.update', $pricing) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label for="name" class="form-label">Plan Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $pricing->name) }}" 
                               placeholder="e.g. Basic, Pro, Enterprise" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="badge" class="form-label">Badge (Optional)</label>
                        <input type="text" class="form-control @error('badge') is-invalid @enderror" 
                               id="badge" name="badge" value="{{ old('badge', $pricing->badge) }}" 
                               placeholder="e.g. Popular, Best Value">
                        @error('badge')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="2" 
                              placeholder="Brief description of this plan">{{ old('description', $pricing->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="monthly_price" class="form-label">Monthly Price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('monthly_price') is-invalid @enderror" 
                               id="monthly_price" name="monthly_price" value="{{ old('monthly_price', $pricing->monthly_price) }}" 
                               step="0.01" min="0" required>
                        @error('monthly_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="yearly_price" class="form-label">Yearly Price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('yearly_price') is-invalid @enderror" 
                               id="yearly_price" name="yearly_price" value="{{ old('yearly_price', $pricing->yearly_price) }}" 
                               step="0.01" min="0" required>
                        @error('yearly_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="currency" class="form-label">Currency</label>
                        <select class="form-select @error('currency') is-invalid @enderror" id="currency" name="currency">
                            <option value="USD" {{ old('currency', $pricing->currency) == 'USD' ? 'selected' : '' }}>USD ($)</option>
                            <option value="EUR" {{ old('currency', $pricing->currency) == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                            <option value="GBP" {{ old('currency', $pricing->currency) == 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                            <option value="BDT" {{ old('currency', $pricing->currency) == 'BDT' ? 'selected' : '' }}>BDT (৳)</option>
                            <option value="INR" {{ old('currency', $pricing->currency) == 'INR' ? 'selected' : '' }}>INR (₹)</option>
                        </select>
                        @error('currency')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="features" class="form-label">Features (One per line)</label>
                    <textarea class="form-control @error('features') is-invalid @enderror" 
                              id="features" name="features" rows="6" 
                              placeholder="Feature 1&#10;Feature 2&#10;Feature 3">{{ old('features', implode("\n", $pricing->getFeaturesArray())) }}</textarea>
                    <small class="text-muted">Enter one feature per line</small>
                    @error('features')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="button_text" class="form-label">Button Text</label>
                        <input type="text" class="form-control @error('button_text') is-invalid @enderror" 
                               id="button_text" name="button_text" value="{{ old('button_text', $pricing->button_text) }}">
                        @error('button_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="button_url" class="form-label">Button URL</label>
                        <input type="url" class="form-control @error('button_url') is-invalid @enderror" 
                               id="button_url" name="button_url" value="{{ old('button_url', $pricing->button_url) }}" 
                               placeholder="https://example.com/contact">
                        @error('button_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                               id="sort_order" name="sort_order" value="{{ old('sort_order', $pricing->sort_order) }}">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Options</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="is_highlighted" name="is_highlighted" value="1" 
                                   {{ old('is_highlighted', $pricing->is_highlighted) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_highlighted">Highlighted (Featured)</label>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" 
                                   {{ old('is_active', $pricing->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save me-2"></i>Update Plan
                    </button>
                    <a href="{{ route('admin.pricing.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
