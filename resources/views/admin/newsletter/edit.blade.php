@extends('admin.layouts.app')

@section('title', 'Edit Campaign - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fa-solid fa-edit me-2 text-primary"></i>
                    Edit Campaign
                </h1>
                <a href="{{ route('admin.newsletter.index') }}" class="btn btn-outline-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back
                </a>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            @if($campaign->status === 'draft')
                <form action="{{ route('admin.newsletter.update', $campaign) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject Line <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                               id="subject" name="subject" value="{{ old('subject', $campaign->subject) }}" 
                               placeholder="Enter email subject" required>
                        @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="12">{{ old('content', $campaign->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-save me-2"></i>Update Campaign
                        </button>
                        <a href="{{ route('admin.newsletter.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            @else
                <div class="alert alert-warning">
                    <i class="fa-solid fa-exclamation-triangle me-2"></i>
                    This campaign cannot be edited because it has already been sent or is scheduled.
                </div>
                <a href="{{ route('admin.newsletter.index') }}" class="btn btn-outline-secondary">Back to Campaigns</a>
            @endif
        </div>
    </div>
</div>
@endsection
