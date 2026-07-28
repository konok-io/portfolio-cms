@extends('admin.layouts.app')

@section('title', 'Comments Management')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Comments Management</h1>
        <p class="admin-breadcrumb mb-0">Manage blog post comments</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Stats Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="admin-card text-center">
            <div class="card-body-custom">
                <h3 class="mb-1">{{ $stats['total'] }}</h3>
                <p class="mb-0 text-muted">Total Comments</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="admin-card text-center">
            <div class="card-body-custom">
                <h3 class="mb-1 text-warning">{{ $stats['pending'] }}</h3>
                <p class="mb-0 text-muted">Pending Approval</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="admin-card text-center">
            <div class="card-body-custom">
                <h3 class="mb-1 text-success">{{ $stats['approved'] }}</h3>
                <p class="mb-0 text-muted">Approved</p>
            </div>
        </div>
    </div>
</div>

{{-- Filter --}}
<div class="admin-card mb-4">
    <div class="card-body-custom">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                </select>
            </div>
            <div class="col-md-4">
                <select name="blog_id" class="form-select">
                    <option value="">All Blog Posts</option>
                    @foreach($blogs as $blog)
                        <option value="{{ $blog->id }}" {{ request('blog_id') == $blog->id ? 'selected' : '' }}>{{ Str::limit($blog->title, 40) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

{{-- Comments List --}}
<div class="admin-card">
    <div class="card-header-custom">Comments ({{ $comments->total() }})</div>
    <div class="card-body-custom p-0">
        @if($comments->isEmpty())
            <div class="text-center py-5">
                <i class="fa-solid fa-comments fa-3x text-muted mb-3"></i>
                <p class="text-muted">No comments found.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>Blog Post</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th style="width:180px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>
                                    <strong>{{ $comment->name }}</strong><br>
                                    <small class="text-muted">{{ $comment->email }}</small>
                                </td>
                                <td>
                                    <small>{{ Str::limit($comment->comment, 80) }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('blog.show', $comment->blog) }}" target="_blank">
                                        {{ Str::limit($comment->blog->title, 30) }}
                                    </a>
                                </td>
                                <td>
                                    @if($comment->is_approved)
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $comment->created_at->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    @if(!$comment->is_approved)
                                        <form method="POST" action="{{ route('admin.comments.approve', $comment) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success" title="Approve">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.comments.reject', $comment) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning" title="Reject">
                                                <i class="fa-solid fa-ban"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" class="d-inline" onsubmit="return confirm('Delete this comment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $comments->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
