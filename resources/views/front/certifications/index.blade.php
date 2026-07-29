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
        <div class="row g-4">
            @forelse($certifications as $cert)
                <div class="col-md-6 col-lg-3">
                    <div class="certification-card h-100 text-center p-4">
                        @if($cert->badge_image)
                            <img src="{{ asset('storage/' . $cert->badge_image) }}" 
                                 alt="{{ $cert->name }}" 
                                 class="cert-badge mb-3"
                                 style="width: 100px; height: 100px; object-fit: contain;">
                        @else
                            <div class="cert-icon mx-auto mb-3" style="width: 80px; height: 80px;">
                                <i class="fa-solid fa-certificate" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        <h5 class="mb-2">{{ $cert->name }}</h5>
                        <p class="small text-muted mb-1">{{ $cert->issuer }}</p>
                        <span class="small text-accent-custom">{{ $cert->issue_date?->format('M Y') }}</span>
                        @if($cert->description)
                            <p class="small text-muted mt-2">{{ $cert->description }}</p>
                        @endif
                        @if($cert->credential_url)
                            <div class="mt-3">
                                <a href="{{ $cert->credential_url }}" target="_blank" class="btn btn-outline-custom">
                                    <i class="fa-solid fa-external-link me-1"></i>Verify Certificate
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fa-solid fa-certificate text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">No certifications available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Stats Section - White (Section 2) --}}
<section class="section-padding section-2">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-md-4 col-lg-3">
                <div class="text-center">
                    <div class="mb-2">
                        <i class="fa-solid fa-certificate text-primary-custom" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ $certifications->count() }}+</h3>
                    <p class="text-muted mb-0">Certifications</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="text-center">
                    <div class="mb-2">
                        <i class="fa-solid fa-award text-primary-custom" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ $certifications->where('credential_url', '!=', null)->count() }}</h3>
                    <p class="text-muted mb-0">Verified</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="text-center">
                    <div class="mb-2">
                        <i class="fa-solid fa-star text-primary-custom" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ $certifications->pluck('issuer')->unique()->count() }}</h3>
                    <p class="text-muted mb-0">Issuing Organizations</p>
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
