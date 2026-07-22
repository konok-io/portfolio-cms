@extends('admin.layouts.app')

@section('title', 'Create Client Portal')

@section('content')

<div class="admin-page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Create Client Portal</h1>
            <p class="admin-breadcrumb mb-0">Create a new client project portal</p>
        </div>
        <a href="{{ route('admin.client-portals.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i>Back
        </a>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="admin-card">
    <div class="card-body-custom">
        <form method="POST" action="{{ route('admin.client-portals.store') }}">
            @csrf
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Link to User (Optional)</label>
                    <select name="user_id" class="form-select">
                        <option value="">No user linked</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Client Name *</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}" placeholder="John Doe">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Client Email *</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="john@example.com">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Project Name *</label>
                    <input type="text" name="project_name" class="form-control" required value="{{ old('project_name') }}" placeholder="Website Redesign">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="in_progress" {{ old('status', 'in_progress') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="review" {{ old('status') === 'review' ? 'selected' : '' }}>Under Review</option>
                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="on_hold" {{ old('status') === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Progress (%)</label>
                    <input type="number" name="progress" class="form-control" min="0" max="100" value="{{ old('progress', 0) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Deadline</label>
                    <input type="date" name="deadline" class="form-control" value="{{ old('deadline') }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control" rows="4" placeholder="Internal notes about this project...">{{ old('notes') }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-4">
                <i class="fa-solid fa-save me-2"></i>Create Portal
            </button>
        </form>
    </div>
</div>

@endsection
