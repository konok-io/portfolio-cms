@extends('mrh-license::layouts.license')

@section('title', 'Verification Failed')

@section('content')
    <div class="gate-emblem" data-state="danger" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12.5a9 9 0 0 1 14 0"/><path d="M8.5 15.5a5 5 0 0 1 7 0"/>
            <path d="M12 19h.01"/><path d="M3 3l18 18"/>
        </svg>
    </div>

    <p class="gate-eyebrow" style="color:var(--danger-tx)">Connection lost</p>
    <h1 class="gate-title">Verification failed</h1>
    <p class="gate-lead">
        The license server couldn't be reached beyond the allowed grace period, so
        access is locked for safety. It resumes automatically once the connection returns.
    </p>

    @isset($graceEndedAt)
        <div class="meta-row" style="justify-content:center;margin:0 0 22px">
            <span class="chip">Grace ended <code>{{ $graceEndedAt }}</code></span>
        </div>
    @endisset

    <button type="button" class="btn-activate" onclick="window.location.reload()">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12a9 9 0 1 1-2.6-6.4"/><path d="M21 3v6h-6"/>
        </svg>
        Retry now
    </button>
@endsection
