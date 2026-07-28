@extends('admin.layouts.app')

@section('title', 'Subscribers - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">
                <i class="fa-solid fa-users me-2 text-primary"></i>
                Newsletter Subscribers
            </h1>
            <div>
                <a href="{{ route('admin.subscribers.export') }}" class="btn btn-success">
                    <i class="fa-solid fa-download me-1"></i> Export CSV
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="fa-solid fa-users text-primary"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0">{{ $stats['total'] }}</h4>
                            <small class="text-muted">Total Subscribers</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="fa-solid fa-check-circle text-success"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0">{{ $stats['active'] }}</h4>
                            <small class="text-muted">Active Subscribers</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                <i class="fa-solid fa-user-minus text-danger"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0">{{ $stats['unsubscribed'] }}</h4>
                            <small class="text-muted">Unsubscribed</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.subscribers.index') }}" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search by email..." 
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="filter" class="form-select">
                        <option value="">All Subscribers</option>
                        <option value="active" {{ request('filter') === 'active' ? 'selected' : '' }}>Active Only</option>
                        <option value="inactive" {{ request('filter') === 'inactive' ? 'selected' : '' }}>Unsubscribed</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-filter me-1"></i> Filter
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.subscribers.index') }}" class="btn btn-secondary w-100">
                        <i class="fa-solid fa-rotate-left me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Subscribers Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($subscribers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Email</th>
                                <th>Subscribed At</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscribers as $subscriber)
                                <tr>
                                    <td>
                                        <strong>{{ $subscriber->email }}</strong>
                                    </td>
                                    <td>
                                        {{ $subscriber->subscribed_at ? $subscriber->subscribed_at->format('M d, Y H:i') : 'N/A' }}
                                    </td>
                                    <td>
                                        @if($subscriber->unsubscribed_at)
                                            <span class="badge bg-danger">Unsubscribed</span>
                                        @elseif($subscriber->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this subscriber?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $subscribers->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fa-solid fa-users-slash text-muted display-1"></i>
                    <p class="text-muted mt-3">No subscribers found.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
