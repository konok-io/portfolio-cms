@extends('admin.layouts.app')

@section('title', 'Project Categories')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Project Categories</h1>
        <p class="admin-breadcrumb mb-0"><a href="{{ route('admin.projects.index') }}">Projects</a> / Categories</p>
    </div>
</div>

<x-validation-errors />

<div class="row g-3">
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header-custom">Add Category</div>
            <div class="card-body-custom">
                <form action="{{ route('admin.projects.categories.store') }}" method="POST">
                    @csrf
                    <label class="form-label-admin">Category Name <span class="required-star">*</span></label>
                    <input type="text" name="name" class="form-control mb-3" required>
                    <button type="submit" class="btn btn-admin-primary w-100">Add Category</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="admin-card">
            <div class="table-responsive">
                <table class="table table-admin mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th># Projects</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="fw-semibold">{{ $category->name }}</td>
                                <td><code>{{ $category->slug }}</code></td>
                                <td>{{ $category->projects()->count() }}</td>
                                <td class="text-end">
                                    <form action="{{ route('admin.projects.categories.destroy', $category) }}" method="POST" class="d-inline" data-confirm-delete="Delete this category? Projects will become uncategorized.">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No categories yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($categories->hasPages())
                <div class="p-3">{{ $categories->links() }}</div>
            @endif
        </div>
    </div>
</div>

@endsection
