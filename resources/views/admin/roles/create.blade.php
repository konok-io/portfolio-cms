@extends('admin.layouts.app')

@section('title', 'Add Role')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Add Role</h1>
        <p class="admin-breadcrumb mb-0"><a href="{{ route('admin.roles.index') }}">Roles</a> / Add New</p>
    </div>
</div>

<x-validation-errors />

<form action="{{ route('admin.roles.store') }}" method="POST">
    @csrf

    <div class="admin-card mb-3">
        <div class="card-body-custom">
            <label class="form-label-admin">Role Name <span class="required-star">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" style="max-width: 320px;" required>
        </div>
    </div>

    <div class="admin-card">
        <div class="card-header-custom">Permissions</div>
        <div class="card-body-custom">
            <div class="row g-3">
                @foreach($permissions->groupBy(fn($p) => trim(strstr($p->name, ' '))) as $module => $modulePermissions)
                    <div class="col-md-4">
                        <div class="border rounded-3 p-3 h-100">
                            <h6 class="text-capitalize mb-2">{{ trim($module) }}</h6>
                            @foreach($modulePermissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="perm_{{ $permission->id }}"
                                        {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label small text-capitalize" for="perm_{{ $permission->id }}">
                                        {{ trim(str_replace(trim($module), '', $permission->name)) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-admin-primary"><i class="fa-solid fa-floppy-disk me-2"></i>Save Role</button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
</form>

@endsection
