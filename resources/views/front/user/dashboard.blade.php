@extends('front.layouts.app')

@section('seo_title', 'Dashboard')

@section('content')
<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        
        <div class="row g-4">
            <div class="col-12">
                <h2 class="section-title mb-2">Welcome, {{ $user->name }}!</h2>
                <p class="text-muted">Manage your account and view your activity.</p>
            </div>
        </div>
        
        {{-- Stats --}}
        <div class="row g-3 mb-5">
            <div class="col-md-4">
                <div class="admin-card text-center">
                    <div class="card-body-custom">
                        <h3 class="mb-1 text-primary-custom">{{ $stats['comments_count'] }}</h3>
                        <p class="mb-0 text-muted">Total Comments</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="admin-card text-center">
                    <div class="card-body-custom">
                        <h3 class="mb-1 text-success">{{ $stats['approved_comments'] }}</h3>
                        <p class="mb-0 text-muted">Approved Comments</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="admin-card text-center">
                    <div class="card-body-custom">
                        <h3 class="mb-1 text-warning">{{ $stats['comments_count'] - $stats['approved_comments'] }}</h3>
                        <p class="mb-0 text-muted">Pending Comments</p>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Profile & Activity --}}
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="admin-card">
                    <div class="card-header-custom">Profile</div>
                    <div class="card-body-custom">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        
                        <form method="POST" action="{{ route('user.profile.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 text-center">
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="rounded-circle mb-3" width="100" height="100">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bio</label>
                                <textarea name="bio" class="form-control" rows="3" placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Website</label>
                                <input type="url" name="website" class="form-control" value="{{ old('website', $user->website) }}" placeholder="https://yoursite.com">
                            </div>
                            <button type="submit" class="btn btn-primary-custom w-100">
                                <i class="fa-solid fa-save me-2"></i>Update Profile
                            </button>
                        </form>
                    </div>
                </div>
                
                {{-- Password Change --}}
                <div class="admin-card mt-4">
                    <div class="card-header-custom">Change Password</div>
                    <div class="card-body-custom">
                        <form method="POST" action="{{ route('user.password.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-secondary w-100">
                                <i class="fa-solid fa-key me-2"></i>Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-8">
                <div class="admin-card">
                    <div class="card-header-custom">Your Comments</div>
                    <div class="card-body-custom p-0">
                        @if($userComments->isEmpty())
                            <div class="text-center py-5">
                                <i class="fa-solid fa-comments fa-3x text-muted mb-3"></i>
                                <p class="text-muted">You haven't posted any comments yet.</p>
                                <a href="{{ route('blog.index') }}" class="btn btn-primary-custom">Browse Blog</a>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Blog Post</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($userComments as $comment)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('blog.show', $comment->blog) }}" target="_blank">
                                                        {{ Str::limit($comment->blog->title, 30) }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <small>{{ Str::limit($comment->comment, 60) }}</small>
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($userComments->hasPages())
                                <div class="p-3">
                                    {{ $userComments->links() }}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                
                {{-- Quick Links --}}
                <div class="admin-card mt-4">
                    <div class="card-header-custom">Quick Links</div>
                    <div class="card-body-custom">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="{{ route('projects.index') }}" class="btn btn-outline-primary w-100">
                                    <i class="fa-solid fa-diagram-project me-2"></i>Browse Projects
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('blog.index') }}" class="btn btn-outline-primary w-100">
                                    <i class="fa-solid fa-blog me-2"></i>Browse Blog
                                </a>
                            </div>
                            <div class="col-md-4">
                                <form method="POST" action="{{ route('user.logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger w-100">
                                        <i class="fa-solid fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
