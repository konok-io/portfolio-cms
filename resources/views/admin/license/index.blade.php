@extends('admin.layouts.app')
@section('title', 'License Information')

@section('content')
<style>
    .lic-hero{background:linear-gradient(135deg,#4F2FE8,#7C3AED 60%,#C026D3);border-radius:16px;padding:28px;color:#fff;margin-bottom:20px}
    .lic-hero h2{font-weight:700;font-size:24px;margin-bottom:6px;color:#fff}
    .lic-hero p{color:rgba(255,255,255,.85);font-size:14px;margin:0}
    .lic-card{background:#fff;border:1px solid #e2e2e8;border-radius:14px;padding:22px}
    [data-theme="dark"] .lic-card{background:#171433;border-color:#2C2860;color:#EDECFF}
    .lic-card h3{font-size:15px;font-weight:700;margin-bottom:16px;padding-bottom:10px;border-bottom:1px solid #e2e2e8}
    [data-theme="dark"] .lic-card h3{border-color:#2C2860}
    .lic-row{display:flex;justify-content:space-between;gap:16px;padding:9px 0;border-bottom:1px solid #f0f0f5;font-size:14px}
    [data-theme="dark"] .lic-row{border-color:#241f4d}
    .lic-row:last-child{border-bottom:0}
    .lic-row .lbl{color:#6b7280}
    [data-theme="dark"] .lic-row .lbl{color:#9B98C7}
    .lic-row .val{font-weight:500;font-family:monospace;text-align:right;word-break:break-all}
    .lic-badge{display:inline-flex;align-items:center;gap:6px;font-size:12px;font-weight:600;padding:4px 12px;border-radius:20px}
    .lic-badge.active,.lic-badge.grace{background:rgba(34,197,94,.12);color:#16a34a}
    .lic-badge.expired,.lic-badge.blocked,.lic-badge.pending{background:rgba(220,38,38,.12);color:#dc2626}
    .lic-note{background:rgba(79,47,232,.08);border:1px solid rgba(124,58,237,.3);border-radius:12px;padding:16px 18px;font-size:14px;line-height:1.7}
    [data-theme="dark"] .lic-note{background:rgba(79,47,232,.15);color:#EDECFF}
    .lic-note code{background:rgba(124,58,237,.15);padding:2px 7px;border-radius:5px;font-size:13px}
</style>

@if(!$license['installed'])
    <div class="lic-hero" style="background:linear-gradient(135deg,#3A356E,#1E1A44)">
        <h2>License package not installed</h2>
        <p>Install the MRH license package to see live activation and verification details here.</p>
    </div>
    <div class="lic-note">
        This project reads licence data from the separately-installed <code>mrh/license</code> package. Install it with Composer, then activate:<br><br>
        <code>composer require mrh/license</code><br>
        <code>php artisan vendor:publish --tag=mrh-license</code><br>
        <code>php artisan migrate</code><br>
        <code>php artisan mrh:license:activate YOUR-LICENSE-KEY</code><br><br>
        Once activated, this page will show your live licence status, domain binding, expiry and verification schedule.
    </div>
@else
    <div class="lic-hero">
        <h2>{{ $license['product'] }}</h2>
        <p>Licensed via MRH License Server @if($license['activated']) · Activated @endif</p>
    </div>

    @if($license['error'])
    <div class="lic-note" style="background:rgba(220,38,38,.1);border-color:rgba(220,38,38,.4)">
        Could not read licence status: {{ $license['error'] }}
    </div>
    @endif

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="lic-card">
                <h3>Status</h3>
                <div class="lic-row"><span class="lbl">License status</span>
                    <span class="val"><span class="lic-badge {{ strtolower($license['status']) }}">
                        <span style="width:7px;height:7px;border-radius:50%;background:currentColor;display:inline-block"></span> {{ ucfirst($license['status']) }}
                    </span></span>
                </div>
                <div class="lic-row"><span class="lbl">Activated</span><span class="val">{{ $license['activated'] ? 'Yes' : 'No' }}</span></div>
                <div class="lic-row"><span class="lbl">Server type</span><span class="val">{{ $license['server_type'] }}</span></div>
                <div class="lic-row"><span class="lbl">Bound domain</span><span class="val">{{ $license['domain'] }}</span></div>
                <div class="lic-row"><span class="lbl">Installation ID</span><span class="val">{{ $license['installation_id'] }}</span></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="lic-card">
                <h3>Validity &amp; verification</h3>
                <div class="lic-row"><span class="lbl">Expires at</span><span class="val">{{ $license['expires_at'] }}</span></div>
                <div class="lic-row"><span class="lbl">Last verified</span><span class="val">{{ $license['last_verified'] }}</span></div>
                <div class="lic-row"><span class="lbl">Next verify by</span><span class="val">{{ $license['next_verify'] }}</span></div>
                <div class="lic-row"><span class="lbl">Grace ends</span><span class="val">{{ $license['grace_ends'] }}</span></div>
            </div>
        </div>
    </div>
@endif
@endsection
