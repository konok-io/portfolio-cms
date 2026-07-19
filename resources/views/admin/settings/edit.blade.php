@extends('admin.layouts.app')

@section('title', 'Site Settings')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Site Settings</h1>
        <p class="admin-breadcrumb mb-0">Global settings for your website.</p>
    </div>
</div>

<x-validation-errors />

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-3">
        <div class="col-lg-8">
            <div class="admin-card mb-3">
                <div class="card-header-custom">General</div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label-admin">Website Name <span class="required-star">*</span></label>
                            <input type="text" name="site_name" class="form-control" value="{{ old('site_name', $setting->site_name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $setting->email) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $setting->phone) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Address</label>
                            <textarea name="address" class="form-control" rows="2">{{ old('address', $setting->address) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Google Map Embed Code</label>
                            <textarea name="google_map" class="form-control" rows="3" placeholder="<iframe src=...></iframe>">{{ old('google_map', $setting->google_map) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-card">
                <div class="card-header-custom">Social Links</div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-facebook me-1"></i> Facebook</label>
                            <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $setting->facebook) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-x-twitter me-1"></i> Twitter / X</label>
                            <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $setting->twitter) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-linkedin me-1"></i> LinkedIn</label>
                            <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $setting->linkedin) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-github me-1"></i> GitHub</label>
                            <input type="url" name="github" class="form-control" value="{{ old('github', $setting->github) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-instagram me-1"></i> Instagram</label>
                            <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $setting->instagram) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin"><i class="fa-brands fa-youtube me-1"></i> YouTube</label>
                            <input type="url" name="youtube" class="form-control" value="{{ old('youtube', $setting->youtube) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-3">
                <div class="card-header-custom">Logo</div>
                <div class="card-body-custom text-center">
                    @if($setting->logo_url)
                        <img src="{{ $setting->logo_url }}" id="logoPreview" class="mb-3" style="max-height:60px;">
                    @else
                        <img id="logoPreview" src="https://placehold.co/200x60/f1f5f9/64748b?text=Logo" class="mb-3 w-100">
                    @endif
                    <input type="file" name="logo" class="form-control" accept="image/*" data-preview-target="#logoPreview">
                    <hr>
                    <label class="form-label text-start w-100 fw-semibold">Show in header</label>
                    <select name="header_display" class="form-select">
                        <option value="text" {{ ($setting->header_display ?? 'text') === 'text' ? 'selected' : '' }}>Website name (text) only</option>
                        <option value="logo" {{ ($setting->header_display ?? 'text') === 'logo' ? 'selected' : '' }}>Logo only</option>
                        <option value="both" {{ ($setting->header_display ?? 'text') === 'both' ? 'selected' : '' }}>Logo + website name</option>
                    </select>
                    <small class="text-muted d-block mt-2 text-start">Choose what appears in the site header. "Logo only" needs a logo uploaded.</small>
                </div>
            </div>

            <div class="admin-card mb-3">
                <div class="card-header-custom">Favicon</div>
                <div class="card-body-custom text-center">
                    @if($setting->favicon_url)
                        <img src="{{ $setting->favicon_url }}" id="faviconPreview" class="mb-3" style="width:48px;height:48px;">
                    @else
                        <img id="faviconPreview" src="https://placehold.co/48x48/f1f5f9/64748b?text=Fav" class="mb-3">
                    @endif
                    <input type="file" name="favicon" class="form-control" accept="image/*" data-preview-target="#faviconPreview">
                </div>
            </div>

            <button type="submit" class="btn btn-admin-primary w-100 py-2">
                <i class="fa-solid fa-floppy-disk me-2"></i>Save Settings
            </button>
        </div>
    </div>
</form>

@endsection
