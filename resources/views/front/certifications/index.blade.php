@extends('front.layouts.app')
@section('title', 'Certifications & Badges - ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('content')

{{-- Page Title Section --}}
<section class="page-title-section section-padding">
    <div class="shape-container">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
        <div class="shape shape-6"></div>
        <div class="shape shape-7"></div>
        <div class="shape shape-8"></div>
    </div>

    <div class="container">
        <div class="text-center mb-0">
            <span class="section-eyebrow text-white">Credentials</span>
            <h1 class="section-title text-white">Certifications & Badges</h1>
            <p class="section-subtitle mx-auto">Professional certifications and achievements that validate my expertise.</p>
        </div>
    </div>
</section>

{{-- Certifications Grid - Light Blue (Section 1) --}}
<section class="section-padding section-1">
    <div class="container">
        @if($certifications->isNotEmpty())
        <div class="cred-horizontal-grid">
            @foreach($certifications as $cert)
                @if($cert->credential_url)
                    <a href="{{ $cert->credential_url }}" target="_blank" class="cred-horizontal-card" style="text-decoration: none;">
                @else
                    <div class="cred-horizontal-card">
                @endif
                    <div class="cred-horizontal-icon">
                        @if($cert->badge_image)
                            <img src="{{ asset('storage/' . $cert->badge_image) }}" alt="{{ $cert->name }}">
                        @else
                            <i class="fa-solid fa-certificate"></i>
                        @endif
                    </div>
                    <div class="cred-horizontal-text">
                        <div class="cred-horizontal-name">{{ $cert->name }}</div>
                        <div class="cred-horizontal-org">{{ $cert->issuer }}</div>
                        @if($cert->issue_date)
                            <div class="cred-horizontal-date">{{ $cert->issue_date?->format('M Y') }}</div>
                        @endif
                    </div>
                @if($cert->credential_url)
                    </a>
                @else
                    </div>
                @endif
            @endforeach
        </div>
        @else
            <div class="text-center py-5">
                <i class="fa-solid fa-certificate text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">No certifications available at the moment.</p>
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    .cred-horizontal-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }
    
    .cred-horizontal-date {
        font-size: 0.7rem;
        color: var(--color-primary);
        margin-top: 2px;
    }
    
    /* Section 1 background styles for horizontal cards */
    .section-1 .cred-horizontal-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
    }
    
    .section-1 .cred-horizontal-card:hover {
        border-color: var(--color-primary, #2563EB);
    }
    
    .section-1 .cred-horizontal-name {
        color: #1e293b;
    }
    
    .section-1 .cred-horizontal-org {
        color: #64748b;
    }
    
    /* Section 2 background styles - blue section */
    .section-2 .cred-horizontal-card {
        background: #eff6ff;
        border: 1px solid #dbeafe;
    }
    
    .section-2 .cred-horizontal-card:hover {
        border-color: var(--color-primary, #2563EB);
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.15);
    }
    
    .section-2 .cred-horizontal-name {
        color: #1e293b;
    }
    
    .section-2 .cred-horizontal-org {
        color: #64748b;
    }
    
    /* Dark mode for section 1 */
    [data-theme="dark"] .section-1 .cred-horizontal-card {
        background: #1e293b;
        border-color: #334155;
    }
    
    [data-theme="dark"] .section-1 .cred-horizontal-card:hover {
        border-color: var(--color-primary, #2563EB);
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);
    }
    
    [data-theme="dark"] .section-1 .cred-horizontal-name {
        color: #f1f5f9;
    }
    
    [data-theme="dark"] .section-1 .cred-horizontal-org {
        color: #94a3b8;
    }
    
    /* Dark mode for section 2 */
    [data-theme="dark"] .section-2 .cred-horizontal-card {
        background: #252547;
        border-color: #3b3b6d;
    }
    
    [data-theme="dark"] .section-2 .cred-horizontal-card:hover {
        border-color: var(--color-primary, #2563EB);
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.25);
    }
    
    [data-theme="dark"] .section-2 .cred-horizontal-name {
        color: #f1f5f9;
    }
    
    [data-theme="dark"] .section-2 .cred-horizontal-org {
        color: #94a3b8;
    }
    
    @media (max-width: 992px) {
        .cred-horizontal-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        .cred-horizontal-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

{{-- Stats Section - White (Section 2) --}}
<section class="section-padding section-2">
    <div class="container">
        <div class="cred-horizontal-grid">
            <div class="cred-horizontal-card">
                <div class="cred-horizontal-icon">
                    <i class="fa-solid fa-certificate"></i>
                </div>
                <div class="cred-horizontal-text">
                    <div class="cred-horizontal-name">{{ $certifications->count() }}+</div>
                    <div class="cred-horizontal-org">Certifications</div>
                </div>
            </div>
            <div class="cred-horizontal-card">
                <div class="cred-horizontal-icon">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div class="cred-horizontal-text">
                    <div class="cred-horizontal-name">{{ $certifications->where('credential_url', '!=', null)->count() }}</div>
                    <div class="cred-horizontal-org">Verified</div>
                </div>
            </div>
            <div class="cred-horizontal-card">
                <div class="cred-horizontal-icon">
                    <i class="fa-solid fa-building"></i>
                </div>
                <div class="cred-horizontal-text">
                    <div class="cred-horizontal-name">{{ $certifications->pluck('issuer')->unique()->count() }}</div>
                    <div class="cred-horizontal-org">Issuing Organizations</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Why Get Certified Section - Light Blue (Section 3) --}}
<section class="section-padding section-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h3 class="mb-3">Why Certifications Matter</h3>
                <p class="text-muted mb-4">Professional certifications demonstrate commitment to continuous learning and expertise in specific domains. They provide validated proof of skills that employers and clients can trust.</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fa-solid fa-check-circle text-primary-custom me-2"></i>Validated expertise and knowledge</li>
                    <li class="mb-2"><i class="fa-solid fa-check-circle text-primary-custom me-2"></i>Competitive advantage in the market</li>
                    <li class="mb-2"><i class="fa-solid fa-check-circle text-primary-custom me-2"></i>Continuous professional development</li>
                    <li class="mb-2"><i class="fa-solid fa-check-circle text-primary-custom me-2"></i>Industry recognition and credibility</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="text-center p-4" style="background: rgba(37, 99, 235, 0.05); border-radius: 12px;">
                    <i class="fa-solid fa-graduation-cap text-primary-custom mb-3" style="font-size: 4rem;"></i>
                    <h4>Lifetime Learning</h4>
                    <p class="text-muted mb-0">Each certification represents hours of study, practice, and real-world application.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section - White (Section 4) --}}
<section class="section-padding section-2">
    <div class="container">
        <div class="text-center">
            <h3 class="mb-3">Ready to work together?</h3>
            <p class="text-muted mb-4">Let's discuss your next project and make it happen.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary-custom">
                <i class="fa-solid fa-envelope me-2"></i>Work With Me
            </a>
        </div>
    </div>
</section>
@endsection
