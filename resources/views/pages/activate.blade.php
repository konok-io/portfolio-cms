@extends('mrh-license::layouts.license')

@section('title', 'Activate License')

@section('content')
    <div class="gate-emblem" aria-hidden="true">
        {{-- key emblem --}}
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round">
            <circle cx="7.5" cy="15.5" r="4.5"/>
            <path d="M10.7 12.3 21 2"/>
            <path d="M16 7l3 3"/>
            <path d="M18 5l3 3"/>
        </svg>
    </div>

    <p class="gate-eyebrow">Activation Required</p>
    <h1 class="gate-title">Activate your license</h1>
    <p class="gate-lead">
        This installation isn't activated yet. Enter your license key to unlock the application.
    </p>

    @if (session('mrh_license_error'))
        <div class="gate-alert" role="alert">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/>
            </svg>
            <span>{{ session('mrh_license_error') }}</span>
        </div>
    @endif

    @if (session()->has('errors') && $errors->any())
        <div class="gate-alert" role="alert">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/>
            </svg>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('mrh-license/activate') }}">
        @csrf
        <div class="field">
            <label for="license_key" class="field-label">License key</label>
            <input
                type="text"
                class="field-input"
                id="license_key"
                name="license_key"
                value="{{ old('license_key') }}"
                placeholder="XXXX-XXXX-XXXX-XXXX"
                autocomplete="off"
                spellcheck="false"
                autofocus
                required>

            <div class="meta-row">
                <span class="chip">
                    <span class="dot pulse"></span>
                    {{ ucfirst($serverType ?? 'unknown') }} environment
                </span>
                @isset($domain)
                    <span class="chip">Domain <code>{{ $domain }}</code></span>
                @endisset
            </div>
        </div>

        <button type="submit" class="btn-activate">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            Activate license
        </button>
    </form>
@endsection
