@extends('admin.layouts.app')

@section('title', 'View Message')

@section('content')

<div class="admin-page-header">
    <div>
        <h1>Message Details</h1>
        <p class="admin-breadcrumb mb-0"><a href="{{ route('admin.messages.index') }}">Messages</a> / View</p>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="card-header-custom">{{ $message->subject ?: 'No Subject' }}</div>
            <div class="card-body-custom">
                <p class="text-muted small mb-3">Received {{ $message->created_at->format('M d, Y \a\t h:i A') }}</p>
                <p style="white-space: pre-wrap;">{{ $message->message }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card mb-3">
            <div class="card-header-custom">Sender Information</div>
            <div class="card-body-custom">
                <ul class="list-unstyled small mb-0">
                    <li class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Name</span><span class="fw-semibold">{{ $message->name }}</span>
                    </li>
                    <li class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted">Email</span><span class="fw-semibold">{{ $message->email }}</span>
                    </li>
                    @if($message->phone)
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Phone</span><span class="fw-semibold">{{ $message->phone }}</span>
                        </li>
                    @endif
                    <li class="d-flex justify-content-between py-2">
                        <span class="text-muted">IP Address</span><span class="fw-semibold">{{ $message->ip_address }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <a href="mailto:{{ $message->email }}" class="btn btn-admin-primary w-100 mb-2">
            <i class="fa-solid fa-reply me-2"></i>Reply via Email
        </a>
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" data-confirm-delete="Delete this message?">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-outline-danger w-100">
                <i class="fa-solid fa-trash me-2"></i>Delete Message
            </button>
        </form>
    </div>
</div>

@endsection
