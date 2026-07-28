@extends('mrh-license::layouts.license')

@section('title', 'License Suspended')

@section('content')
    <div class="gate-emblem" data-state="danger" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/><path d="M4.9 4.9l14.2 14.2"/>
        </svg>
    </div>

    <p class="gate-eyebrow" style="color:var(--danger-tx)">Access paused</p>
    <h1 class="gate-title">License suspended</h1>
    <p class="gate-lead">
        This application's license has been suspended, usually an account or billing
        issue. Contact your provider to restore access.
    </p>

    @isset($supportEmail)
        <a href="mailto:{{ $supportEmail }}" class="btn-activate" style="text-decoration:none">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 6L2 7"/>
            </svg>
            Contact support
        </a>
    @endisset
@endsection
