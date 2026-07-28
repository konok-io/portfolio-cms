@extends('admin.layouts.app')

@section('title', 'Projects')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Projects</h1>
        <p class="admin-breadcrumb mb-0">Manage your portfolio projects.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.projects.categories') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-tags me-2"></i>Categories
        </a>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-admin-primary">
            <i class="fa-solid fa-plus me-2"></i>Add Project
        </a>
    </div>
</div>

<div class="admin-card mb-3">
    <div class="card-body-custom">
        <form action="{{ route('admin.projects.index') }}" method="GET" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by title..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="ongoing" {{ request('status') === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="on_hold" {{ request('status') === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-admin-primary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-admin mb-0">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr>
                        <td>
                            <img src="{{ $project->featured_image_url ?? 'https://placehold.co/100x100/2563EB/ffffff?text=' . substr($project->title, 0, 1) }}" class="thumb" alt="{{ $project->title }}">
                        </td>
                        <td class="fw-semibold">{{ $project->title }}</td>
                        <td>{{ $project->category->name ?? '—' }}</td>
                        <td><span class="badge bg-light text-dark border text-capitalize">{{ str_replace('_', ' ', $project->status) }}</span></td>
                        <td>
                            @if($project->is_featured)
                                <span class="badge bg-warning-subtle text-warning">Featured</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('projects.show', $project->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="d-inline" data-confirm-delete="Delete this project and all its images?">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No projects found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($projects->hasPages())
        <div class="p-3">{{ $projects->links() }}</div>
    @endif
</div>

@endsection
