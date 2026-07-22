@extends('admin.layouts.app')

@section('title', 'Service Request Details')

@section('content')

<div class="admin-page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Service Request</h1>
            <p class="admin-breadcrumb mb-0">{{ $request->created_at->format('M d, Y H:i') }}</p>
        </div>
        <div>
            <a href="{{ route('admin.service-requests.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left me-1"></i>Back
            </a>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row g-4">
    {{-- Main Details --}}
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header-custom">
                <span>Request Details</span>
                @if($request->status === 'pending')
                    <span class="badge bg-warning">Pending</span>
                @elseif($request->status === 'in_progress')
                    <span class="badge bg-info">In Progress</span>
                @elseif($request->status === 'completed')
                    <span class="badge bg-success">Completed</span>
                @else
                    <span class="badge bg-secondary">Cancelled</span>
                @endif
            </div>
            <div class="card-body-custom">
                {{-- Status Update Form --}}
                <form method="POST" action="{{ route('admin.service-requests.status', $request) }}" class="mb-4">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Update Status</label>
                            <select name="status" class="form-select">
                                <option value="pending" {{ $request->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ $request->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ $request->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $request->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </div>
                    </div>
                </form>

                <h5 class="mb-3">Message</h5>
                <div class="p-3 bg-light rounded-3">
                    <p class="mb-0" style="white-space: pre-wrap;">{{ $request->message }}</p>
                </div>

                <hr>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Service Interest</label>
                        <p class="mb-0">
                            @if($request->service)
                                <a href="{{ route('services.show', $request->service) }}" target="_blank">
                                    {{ $request->service->title }}
                                </a>
                            @else
                                <span class="text-muted">General Inquiry</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Budget</label>
                        <p class="mb-0">{{ $request->budget_label }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Client Info --}}
    <div class="col-lg-4">
        <div class="admin-card">
            <div class="card-header-custom">Client Information</div>
            <div class="card-body-custom">
                <div class="mb-3">
                    <label class="form-label text-muted small">Name</label>
                    <p class="mb-0 fw-semibold">{{ $request->name }}</p>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small">Email</label>
                    <p class="mb-0">
                        <a href="mailto:{{ $request->email }}">{{ $request->email }}</a>
                    </p>
                </div>
                @if($request->phone)
                    <div class="mb-3">
                        <label class="form-label text-muted small">Phone</label>
                        <p class="mb-0">
                            <a href="tel:{{ $request->phone }}">{{ $request->phone }}</a>
                        </p>
                    </div>
                @endif
                @if($request->company)
                    <div class="mb-3">
                        <label class="form-label text-muted small">Company</label>
                        <p class="mb-0">{{ $request->company }}</p>
                    </div>
                @endif
                <hr>
                <div class="mb-0">
                    <label class="form-label text-muted small">Submitted</label>
                    <p class="mb-0">{{ $request->created_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="admin-card mt-4">
            <div class="card-header-custom">Actions</div>
            <div class="card-body-custom">
                <a href="mailto:{{ $request->email }}?subject=Re: Your Quote Request" class="btn btn-primary w-100 mb-2">
                    <i class="fa-solid fa-envelope me-2"></i>Reply via Email
                </a>
                <form method="POST" action="{{ route('admin.service-requests.destroy', $request) }}" onsubmit="return confirm('Are you sure you want to delete this request?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100">
                        <i class="fa-solid fa-trash me-2"></i>Delete Request
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
