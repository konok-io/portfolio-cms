@extends('admin.layouts.app')

@section('title', 'Client Portals')

@section('content')

<div class="admin-page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Client Portals</h1>
            <p class="admin-breadcrumb mb-0">Manage client project portals</p>
        </div>
        <a href="{{ route('admin.client-portals.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i>Create Portal
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Filter --}}
<div class="admin-card mb-4">
    <div class="card-body-custom">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="review" {{ request('status') === 'review' ? 'selected' : '' }}>Under Review</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="on_hold" {{ request('status') === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.client-portals.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

{{-- Portals List --}}
<div class="admin-card">
    <div class="card-header-custom">Portals ({{ $portals->total() }})</div>
    <div class="card-body-custom p-0">
        @if($portals->isEmpty())
            <div class="text-center py-5">
                <i class="fa-solid fa-users fa-3x text-muted mb-3"></i>
                <p class="text-muted">No client portals found.</p>
                <a href="{{ route('admin.client-portals.create') }}" class="btn btn-primary">Create First Portal</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Project</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Deadline</th>
                            <th style="width:150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($portals as $portal)
                            <tr>
                                <td>
                                    <strong>{{ $portal->name }}</strong><br>
                                    <small class="text-muted">{{ $portal->email }}</small>
                                    @if($portal->user)
                                        <br><small class="text-muted">{{ $portal->user->name }}</small>
                                    @endif
                                </td>
                                <td>{{ $portal->project_name }}</td>
                                <td>
                                    <span class="badge bg-{{ $portal->status_color }}">{{ $portal->status_label }}</span>
                                </td>
                                <td>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $portal->progress }}%"></div>
                                    </div>
                                    <small class="text-muted">{{ $portal->progress }}%</small>
                                </td>
                                <td>
                                    @if($portal->deadline)
                                        {{ $portal->deadline->format('M d, Y') }}
                                    @else
                                        <span class="text-muted">No deadline</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.client-portals.show', $portal) }}" class="btn btn-sm btn-primary" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.client-portals.edit', $portal) }}" class="btn btn-sm btn-secondary" title="Edit">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.client-portals.destroy', $portal) }}" class="d-inline" onsubmit="return confirm('Delete this portal?')">
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
                {{ $portals->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
