@extends('admin.layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>My Profile</h1>
        <p class="admin-breadcrumb mb-0">Manage your account details and password.</p>
    </div>
</div>

<x-validation-errors />

<div class="row g-3">
    <div class="col-lg-7">
        <div class="admin-card mb-3">
            <div class="card-header-custom">Profile Information</div>
            <div class="card-body-custom">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-12 text-center">
                            <img id="avatarPreview" src="{{ $user->avatar_url }}" class="rounded-circle mb-3" width="100" height="100" style="object-fit:cover;">
                            <input type="file" name="avatar" class="form-control" accept="image/*" data-preview-target="#avatarPreview">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Name <span class="required-star">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Email <span class="required-star">*</span></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-admin-primary mt-4"><i class="fa-solid fa-floppy-disk me-2"></i>Save Changes</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="admin-card">
            <div class="card-header-custom">Change Password</div>
            <div class="card-body-custom">
                <form action="{{ route('admin.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label-admin">Current Password <span class="required-star">*</span></label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-admin">New Password <span class="required-star">*</span></label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-admin">Confirm New Password <span class="required-star">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-admin-primary"><i class="fa-solid fa-key me-2"></i>Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
