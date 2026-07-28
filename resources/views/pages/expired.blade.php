@extends('mrh-license::layouts.license')

@section('title', 'License Expired')

@section('content')
    <div class="gate-emblem" data-state="warn" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>
        </svg>
    </div>

    <p class="gate-eyebrow" style="color:var(--amber-deep)">Renewal needed</p>
    <h1 class="gate-title">License expired</h1>
    <p class="gate-lead">
        This license has expired and its grace period has ended. Renew your license
        to restore access.
    </p>

    @isset($expiresAt)
        <div class="meta-row" style="justify-content:center;margin:0 0 22px">
            <span class="chip">Expired on <code>{{ $expiresAt }}</code></span>
        </div>
    @endisset

    <a href="{{ url('mrh-license/activate') }}" class="btn-activate" style="text-decoration:none">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
            <circle cx="7.5" cy="15.5" r="4.5"/><path d="M10.7 12.3 21 2"/><path d="M16 7l3 3"/>
        </svg>
        Enter a new license key
    </a>
@endsection
