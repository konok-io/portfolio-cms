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
    
    <style>
        .cert-horizontal-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        
        .cert-horizontal-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s;
            cursor: pointer;
            border: 1px solid #e2e8f0;
            text-decoration: none;
        }
        
        .cert-horizontal-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            border-color: var(--color-primary, #2563EB);
        }
        
        .cert-horizontal-icon {
            width: 50px;
            height: 50px;
            background: var(--color-primary, #2563EB);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #fff;
            flex-shrink: 0;
        }
        
        .cert-horizontal-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 6px;
        }
        
        .cert-horizontal-text {
            text-align: left;
            min-width: 0;
        }
        
        .cert-horizontal-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .cert-horizontal-org {
            font-size: 0.75rem;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        @media (max-width: 992px) {
            .cert-horizontal-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            .cert-horizontal-grid {
                grid-template-columns: 1fr;
            }
        }
        
        [data-theme="dark"] .cert-horizontal-card {
            background: #1e293b;
            border-color: #334155;
        }
        [data-theme="dark"] .cert-horizontal-card:hover {
            border-color: var(--color-primary, #2563EB);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);
        }
        [data-theme="dark"] .cert-horizontal-name {
            color: #f1f5f9;
        }
        [data-theme="dark"] .cert-horizontal-org {
            color: #94a3b8;
        }
    </style>
    
    <div class="container">
        @if($certifications->isNotEmpty())
        <div class="cert-horizontal-grid">
            @foreach($certifications as $cert)
                @if($cert->credential_url)
                    <a href="{{ $cert->credential_url }}" target="_blank" class="cert-horizontal-card">
                @else
                    <div class="cert-horizontal-card">
                @endif
                    <div class="cert-horizontal-icon">
                        @if($cert->badge_image)
                            <img src="{{ asset('storage/' . $cert->badge_image) }}" alt="{{ $cert->name }}">
                        @else
                            <i class="fa-solid fa-certificate"></i>
                        @endif
                    </div>
                    <div class="cert-horizontal-text">
                        <div class="cert-horizontal-name">{{ $cert->name }}</div>
                        <div class="cert-horizontal-org">{{ $cert->issuer }}</div>
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
                        <i class="fa-solid fa-building text-primary-custom" style="font-size: 2.5rem;"></i>
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
