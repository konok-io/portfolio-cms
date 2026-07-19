@extends('admin.layouts.app')

@section('title', 'Blog Posts')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Blog Posts</h1>
        <p class="admin-breadcrumb mb-0">Manage your blog articles.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.blog.categories') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-tags me-2"></i>Categories
        </a>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-admin-primary">
            <i class="fa-solid fa-plus me-2"></i>Add Post
        </a>
    </div>
</div>

<div class="admin-card mb-3">
    <div class="card-body-custom">
        <form action="{{ route('admin.blog.index') }}" method="GET" class="row g-2">
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
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
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
                    <th>Author</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                    <tr>
                        <td><img src="{{ $blog->featured_image_url ?? 'https://placehold.co/100x100/0F172A/ffffff?text=' . substr($blog->title, 0, 1) }}" class="thumb" alt="{{ $blog->title }}"></td>
                        <td class="fw-semibold">{{ \Illuminate\Support\Str::limit($blog->title, 40) }}</td>
                        <td>{{ $blog->category->name ?? '—' }}</td>
                        <td>{{ $blog->author->name ?? '—' }}</td>
                        <td>
                            @if($blog->status === 'published')
                                <span class="badge bg-success-subtle text-success">Published</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">Draft</span>
                            @endif
                        </td>
                        <td>{{ $blog->views }}</td>
                        <td class="text-end">
                            <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.blog.edit', $blog) }}" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.blog.destroy', $blog) }}" method="POST" class="d-inline" data-confirm-delete="Delete this blog post?">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">No blog posts found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($blogs->hasPages())
        <div class="p-3">{{ $blogs->links() }}</div>
    @endif
</div>

@endsection
