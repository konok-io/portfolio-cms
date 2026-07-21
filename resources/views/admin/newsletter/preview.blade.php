@extends('layouts.app')

@section('title', 'Preview Campaign - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">
                <i class="fa-solid fa-eye me-2 text-primary"></i>
                Campaign Preview
            </h1>
            <a href="{{ route('admin.newsletter.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i>Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Subject:</strong> {{ $campaign->subject }}
                        </div>
                        <div>
                            @switch($campaign->status)
                                @case('draft')
                                    <span class="badge bg-secondary">Draft</span>
                                    @break
                                @case('scheduled')
                                    <span class="badge bg-info">Scheduled</span>
                                    @break
                                @case('sending')
                                    <span class="badge bg-warning">Sending...</span>
                                    @break
                                @case('sent')
                                    <span class="badge bg-success">Sent</span>
                                    @break
                                @case('failed')
                                    <span class="badge bg-danger">Failed</span>
                                    @break
                            @endswitch
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="newsletter-preview">
                        {!! $campaign->content !!}
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex gap-2">
                        @if($campaign->status === 'draft')
                            <a href="{{ route('admin.newsletter.edit', $campaign) }}" class="btn btn-primary">
                                <i class="fa-solid fa-edit me-2"></i>Edit
                            </a>
                            <form action="{{ route('admin.newsletter.send', $campaign) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success" onclick="return confirm('Send this campaign?')">
                                    <i class="fa-solid fa-paper-plane me-2"></i>Send Campaign
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('admin.newsletter.index') }}" class="btn btn-outline-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.newsletter-preview {
    font-family: Arial, sans-serif;
    line-height: 1.6;
}
.newsletter-preview h1, .newsletter-preview h2, .newsletter-preview h3 {
    margin-top: 1rem;
    margin-bottom: 0.5rem;
}
.newsletter-preview p {
    margin-bottom: 1rem;
}
.newsletter-preview img {
    max-width: 100%;
    height: auto;
}
.newsletter-preview a {
    color: #2563eb;
}
</style>
@endpush
