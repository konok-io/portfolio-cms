@extends('admin.layouts.app')

@section('title', 'Client Portal - ' . $clientPortal->project_name)

@section('content')

<div class="admin-page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>{{ $clientPortal->project_name }}</h1>
            <p class="admin-breadcrumb mb-0">
                <span class="badge bg-{{ $clientPortal->status_color }} me-2">{{ $clientPortal->status_label }}</span>
                {{ $clientPortal->name }} • {{ $clientPortal->email }}
            </p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.client-portals.edit', $clientPortal) }}" class="btn btn-secondary">
                <i class="fa-solid fa-edit me-1"></i>Edit
            </a>
            <a href="{{ route('admin.client-portals.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i>Back
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-4">
    {{-- Main Content --}}
    <div class="col-lg-8">
        {{-- Access Info --}}
        <div class="admin-card mb-4">
            <div class="card-header-custom">Access Information</div>
            <div class="card-body-custom">
                <div class="alert alert-info mb-3">
                    <i class="fa-solid fa-info-circle me-2"></i>
                    Share this link with your client to give them access to their project portal.
                </div>
                <div class="input-group">
                    <input type="text" class="form-control" id="accessUrl" value="{{ url('/client-portal/access') }}?token={{ $clientPortal->project_token }}" readonly>
                    <button class="btn btn-primary" onclick="copyAccessUrl()">
                        <i class="fa-solid fa-copy"></i> Copy
                    </button>
                </div>
                <small class="text-muted mt-2 d-block">Token: <code>{{ $clientPortal->project_token }}</code></small>
                <form method="POST" action="{{ route('admin.client-portals.regenerate-token', $clientPortal) }}" class="mt-2">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Generate new token? Old link will stop working.')">
                        <i class="fa-solid fa-refresh me-1"></i>Regenerate Token
                    </button>
                </form>
            </div>
        </div>

        {{-- Project Details --}}
        <div class="admin-card">
            <div class="card-header-custom">
                <span>Project Details</span>
            </div>
            <div class="card-body-custom">
                <form method="POST" action="{{ route('admin.client-portals.update', $clientPortal) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="in_progress" {{ $clientPortal->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="review" {{ $clientPortal->status === 'review' ? 'selected' : '' }}>Under Review</option>
                                <option value="completed" {{ $clientPortal->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="on_hold" {{ $clientPortal->status === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Progress (%)</label>
                            <input type="number" name="progress" class="form-control" min="0" max="100" value="{{ $clientPortal->progress }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Deadline</label>
                            <input type="date" name="deadline" class="form-control" value="{{ $clientPortal->deadline?->format('Y-m-d') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Notes (visible to client)</label>
                            <textarea name="notes" class="form-control" rows="3">{{ $clientPortal->notes }}</textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="fa-solid fa-save me-2"></i>Update Project
                    </button>
                </form>
            </div>
        </div>

        {{-- Files --}}
        <div class="admin-card mt-4">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <span>Project Files</span>
            </div>
            <div class="card-body-custom">
                @if($clientPortal->files && count($clientPortal->files) > 0)
                    <ul class="list-group">
                        @foreach($clientPortal->files as $file)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fa-solid fa-file me-2"></i>
                                    <a href="{{ $file['url'] }}" target="_blank">{{ $file['name'] }}</a>
                                    <br><small class="text-muted">Uploaded: {{ \Carbon\Carbon::parse($file['uploaded_at'])->format('M d, Y H:i') }}</small>
                                </div>
                                <a href="{{ $file['url'] }}" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-download"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted mb-0">No files uploaded yet.</p>
                @endif

                {{-- Add File Form --}}
                <hr>
                <h6>Add New File</h6>
                <form method="POST" action="{{ route('admin.client-portals.add-file', $clientPortal) }}" class="row g-2">
                    @csrf
                    <div class="col-md-4">
                        <input type="text" name="file_name" class="form-control" placeholder="File name" required>
                    </div>
                    <div class="col-md-6">
                        <input type="url" name="file_url" class="form-control" placeholder="File URL (https://...)" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header-custom">Client Information</div>
            <div class="card-body-custom">
                @if($clientPortal->user)
                    <div class="mb-3">
                        <label class="form-label text-muted small">Linked User</label>
                        <p class="mb-0">{{ $clientPortal->user->name }}</p>
                    </div>
                @endif
                <div class="mb-3">
                    <label class="form-label text-muted small">Name</label>
                    <p class="mb-0 fw-semibold">{{ $clientPortal->name }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small">Email</label>
                    <p class="mb-0">
                        <a href="mailto:{{ $clientPortal->email }}">{{ $clientPortal->email }}</a>
                    </p>
                </div>
                <hr>
                <div class="mb-0">
                    <label class="form-label text-muted small">Created</label>
                    <p class="mb-0">{{ $clientPortal->created_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Progress --}}
        <div class="admin-card mt-4">
            <div class="card-header-custom">Progress</div>
            <div class="card-body-custom text-center">
                <h2 class="mb-2">{{ $clientPortal->progress }}%</h2>
                <div class="progress mb-3" style="height: 12px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $clientPortal->progress }}%"></div>
                </div>
                @if($clientPortal->deadline)
                    <p class="mb-0 text-muted">
                        <i class="fa-solid fa-calendar me-1"></i>
                        Deadline: {{ $clientPortal->deadline->format('M d, Y') }}
                        @if($clientPortal->deadline->isPast())
                            <span class="text-danger">(Overdue)</span>
                        @elseif($clientPortal->deadline->diffInDays() < 7)
                            <span class="text-warning">({{ $clientPortal->deadline->diffInDays() }} days left)</span>
                        @endif
                    </p>
                @endif
            </div>
        </div>

        {{-- Actions --}}
        <div class="admin-card mt-4">
            <div class="card-header-custom">Actions</div>
            <div class="card-body-custom">
                <a href="mailto:{{ $clientPortal->email }}?subject=Re: {{ $clientPortal->project_name }}" class="btn btn-primary w-100 mb-2">
                    <i class="fa-solid fa-envelope me-2"></i>Email Client
                </a>
                <form method="POST" action="{{ route('admin.client-portals.destroy', $clientPortal) }}" onsubmit="return confirm('Delete this portal? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100">
                        <i class="fa-solid fa-trash me-2"></i>Delete Portal
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function copyAccessUrl() {
    const url = document.getElementById('accessUrl');
    url.select();
    document.execCommand('copy');
    alert('Link copied to clipboard!');
}
</script>

@endsection
