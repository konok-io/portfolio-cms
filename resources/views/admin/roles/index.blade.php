@extends('admin.layouts.app')

@section('title', 'Roles & Permissions')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Roles &amp; Permissions</h1>
        <p class="admin-breadcrumb mb-0">Manage admin panel roles and their permissions.</p>
    </div>
    <a href="{{ route('admin.roles.create') }}" class="btn btn-admin-primary">
        <i class="fa-solid fa-plus me-2"></i>Add Role
    </a>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-admin mb-0">
            <thead>
                <tr>
                    <th>Role Name</th>
                    <th>Permissions</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $role)
                    <tr>
                        <td class="fw-semibold">{{ $role->name }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $role->permissions->count() }} permissions</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                            @if($role->name !== 'Admin')
                                <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="d-inline" data-confirm-delete="Delete this role?">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center text-muted py-4">No roles found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
