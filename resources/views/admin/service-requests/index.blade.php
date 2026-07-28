@extends('admin.layouts.app')

@section('title', 'Service Requests')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Service Requests</h1>
        <p class="admin-breadcrumb mb-0">Manage quote/inquiry requests</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Stats Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="admin-card text-center">
            <div class="card-body-custom">
                <h3 class="mb-1">{{ $requests->total() }}</h3>
                <p class="mb-0 text-muted">Total Requests</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card text-center">
            <div class="card-body-custom">
                <h3 class="mb-1 text-warning">{{ $requests->where('status', 'pending')->count() }}</h3>
                <p class="mb-0 text-muted">Pending</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card text-center">
            <div class="card-body-custom">
                <h3 class="mb-1 text-info">{{ $requests->where('status', 'in_progress')->count() }}</h3>
                <p class="mb-0 text-muted">In Progress</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="admin-card text-center">
            <div class="card-body-custom">
                <h3 class="mb-1 text-success">{{ $requests->where('status', 'completed')->count() }}</h3>
                <p class="mb-0 text-muted">Completed</p>
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
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.service-requests.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

{{-- Requests List --}}
<div class="admin-card">
    <div class="card-header-custom">Requests ({{ $requests->total() }})</div>
    <div class="card-body-custom p-0">
        @if($requests->isEmpty())
            <div class="text-center py-5">
                <i class="fa-solid fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">No requests found.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Service</th>
                            <th>Budget</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th style="width:120px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                            <tr>
                                <td>
                                    <strong>{{ $request->name }}</strong><br>
                                    <small class="text-muted">{{ $request->email }}</small>
                                    @if($request->company)
                                        <br><small>{{ $request->company }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($request->service)
                                        <a href="{{ route('services.show', $request->service) }}" target="_blank">
                                            {{ $request->service->title }}
                                        </a>
                                    @else
                                        <span class="text-muted">General Inquiry</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $request->budget_label }}</span>
                                </td>
                                <td>
                                    @if($request->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($request->status === 'in_progress')
                                        <span class="badge bg-info">In Progress</span>
                                    @elseif($request->status === 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-secondary">Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    <small class="text-muted">{{ $request->created_at->format('M d, Y') }}</small>
                                </td>
                                <td>
                                    <a href="{{ route('admin.service-requests.show', $request) }}" class="btn btn-sm btn-primary" title="View">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.service-requests.destroy', $request) }}" class="d-inline" onsubmit="return confirm('Delete this request?')">
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
                {{ $requests->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
