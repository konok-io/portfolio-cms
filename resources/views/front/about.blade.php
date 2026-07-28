@extends('front.layouts.app')

@section('title', page_content('about', 'page_title', app()->getLocale()) . ' | ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('meta_description', $about->short_intro ?? 'Learn more about me, my background and approach.')

@section('content')

{{-- Page header --}}
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
            <span class="section-eyebrow">{{ page_content('about', 'page_eyebrow', app()->getLocale()) }}</span>
            <h1 class="section-title">{{ page_content('about', 'page_title', app()->getLocale()) }}</h1>
            <p class="section-subtitle mx-auto">{{ $about->short_intro ?? 'A little about who I am and what I do.' }}</p>
        </div>
    </div>
</section>

{{-- Intro: photo + bio --}}
<section class="section-padding section-2">
    <div class="container">
        <div class="row gy-5 align-items-stretch" style="--img-col: 30%; --text-col: 70%;">
            <div class="reveal-on-scroll d-flex align-items-stretch" style="width: var(--img-col); flex: 0 0 var(--img-col);">
                <img src="{{ $about->photo_url }}"
                     alt="{{ $about->name ?? 'Profile photo' }}"
                     class="img-fluid rounded-4 shadow-sm w-100" style="height: 100%; object-fit: cover;"
                     loading="eager"
                     width="400" height="500">
            </div>
            <div class="reveal-on-scroll" style="width: var(--text-col); flex: 0 0 var(--text-col);">
                <span class="section-eyebrow">{{ $about->title ?? 'Web Developer' }}</span>
                <h2 class="section-title mb-4">Hi, I'm {{ $about->name ?? 'Your Name' }}</h2>
                <div class="text-muted mb-4" style="text-align: justify; text-align-last: left; white-space: pre-wrap;">{!! $about->description ?? 'I am a dedicated developer focused on building reliable, user-friendly software.' !!}</div>

                <div class="row g-3 mb-4">
                    <div class="col-4">
                        <div class="d-flex flex-column gap-2">
                            @if($about->email ?? false)
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-envelope text-primary-custom"></i>
                                    <span class="small">{{ $about->email }}</span>
                                </div>
                            @endif
                            @if($about->address ?? false)
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-location-dot text-primary-custom"></i>
                                    <span class="small">{{ $about->address }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex flex-column gap-2">
                            @if($about->phone ?? false)
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-phone text-primary-custom"></i>
                                    <span class="small">{{ $about->phone }}</span>
                                </div>
                            @endif
                            @if($about->whatsapp ?? false)
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-primary-custom"></i>
                                    <span class="small">{{ $about->whatsapp }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="d-flex align-items-center gap-2 flex-wrap h-100" style="justify-content: flex-end;">
                            @if($about->linkedin ?? false)
                                <a href="{{ $about->linkedin }}" target="_blank" class="btn btn-sm btn-outline-custom d-flex align-items-center justify-content-center" style="width:36px;height:36px;padding:0;"><i class="fa-brands fa-linkedin-in"></i></a>
                            @endif
                            @if($about->github ?? false)
                                <a href="{{ $about->github }}" target="_blank" class="btn btn-sm btn-outline-custom d-flex align-items-center justify-content-center" style="width:36px;height:36px;padding:0;"><i class="fa-brands fa-github"></i></a>
                            @endif
                            @if($about->facebook ?? false)
                                <a href="{{ $about->facebook }}" target="_blank" class="btn btn-sm btn-outline-custom d-flex align-items-center justify-content-center" style="width:36px;height:36px;padding:0;"><i class="fa-brands fa-facebook-f"></i></a>
                            @endif
                            @if($about->twitter ?? false)
                                <a href="{{ $about->twitter }}" target="_blank" class="btn btn-sm btn-outline-custom d-flex align-items-center justify-content-center" style="width:36px;height:36px;padding:0;"><i class="fa-brands fa-x-twitter"></i></a>
                            @endif
                            @if($about->instagram ?? false)
                                <a href="{{ $about->instagram }}" target="_blank" class="btn btn-sm btn-outline-custom d-flex align-items-center justify-content-center" style="width:36px;height:36px;padding:0;"><i class="fa-brands fa-instagram"></i></a>
                            @endif
                            @if($about->cv_url ?? false)
                                <a href="{{ $about->cv_url }}" target="_blank" class="btn btn-sm btn-danger d-flex align-items-center justify-content-center gap-1" style="height:36px;padding:0 8px;white-space:nowrap;">
                                    <i class="fa-solid fa-file-lines"></i>
                                    <span style="font-size:11px;">CV</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="btn btn-primary-custom">
                    <i class="fa-solid fa-paper-plane me-2"></i>Hire Me
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Skills --}}
@if($skills->isNotEmpty())
<section id="skills" class="section-padding section-1">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-5 gap-3">
            <div class="text-center text-lg-start reveal-on-scroll">
                <span class="section-eyebrow">My Skills</span>
                <h2 class="section-title mb-2">Technologies I work with</h2>
                <p class="section-subtitle mx-auto mx-lg-0">A snapshot of the tools and languages I use to bring projects to life.</p>
            </div>
        </div>
        
        <style>
            .tech-stack-grid {
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                gap: 20px;
            }
            
            @media (max-width: 1200px) {
                .tech-stack-grid { grid-template-columns: repeat(4, 1fr); }
            }
            @media (max-width: 992px) {
                .tech-stack-grid { grid-template-columns: repeat(3, 1fr); }
            }
            @media (max-width: 768px) {
                .tech-stack-grid { grid-template-columns: repeat(2, 1fr); }
            }
            @media (max-width: 576px) {
                .tech-stack-grid { grid-template-columns: 1fr; }
            }
            
            .tech-card {
                background: #fff;
                border: 1px solid #d1d5db;
                border-radius: 16px;
                padding: 25px 15px;
                text-align: center;
                transition: all 0.3s;
                position: relative;
                overflow: hidden;
            }
            
            .tech-card::before {
                content: '';
                position: absolute;
                top: -30px;
                right: -30px;
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, #2563EB 0%, #3B82F6 100%);
                border-radius: 50%;
                opacity: 0.15;
                transition: all 0.3s;
            }
            
            .tech-card:hover {
                transform: translateY(-8px);
                border-color: #2563EB;
                box-shadow: 0 15px 40px rgba(37, 99, 235, 0.15);
            }
            
            .tech-card:hover::before {
                opacity: 0.3;
                top: -40px;
                right: -40px;
                width: 100px;
                height: 100px;
            }
            
            .tech-icon {
                font-size: 2.5rem;
                margin-bottom: 15px;
                color: #2563EB;
                transition: transform 0.3s;
            }
            
            .tech-card:hover .tech-icon {
                transform: scale(1.15);
            }
            
            .tech-name {
                color: #1a1a2e;
                font-weight: 600;
                margin-bottom: 5px;
                font-size: 1rem;
            }
            
            .tech-category {
                color: #6b7280;
                font-size: 0.8rem;
                margin-bottom: 10px;
            }
            
            .tech-percentage {
                background: #2563EB;
                color: #fff;
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 0.75rem;
                font-weight: 600;
                display: inline-block;
            }
            
            /* Dark Theme */
            [data-theme="dark"] .tech-card {
                background: #171433;
                border-color: rgba(103, 232, 249, 0.15);
            }
            
            [data-theme="dark"] .tech-name {
                color: #fff;
            }
            
            [data-theme="dark"] .tech-category {
                color: #a8a4c8;
            }
            
            [data-theme="dark"] .tech-card:hover {
                border-color: #67E8F9;
                box-shadow: 0 15px 40px rgba(103, 232, 249, 0.15);
            }
            
            [data-theme="dark"] .tech-card::before {
                background: linear-gradient(135deg, #67E8F9 0%, #67E8F9 100%);
            }
            
            [data-theme="dark"] .tech-icon {
                color: #67E8F9;
            }
            
            [data-theme="dark"] .tech-percentage {
                background: #67E8F9;
                color: #0A0A1F;
            }
        </style>
        
        <div class="tech-stack-grid">
            @foreach($skills as $skill)
                <div class="tech-card reveal-on-scroll">
                    <div class="tech-icon">
                        @if($skill->icon)
                            <i class="{{ $skill->icon }}"></i>
                        @else
                            <i class="fa-solid fa-code"></i>
                        @endif
                    </div>
                    <div class="tech-name">{{ $skill->name }}</div>
                    <div class="tech-category">{{ $skill->category ?? 'Technical' }}</div>
                    <div class="tech-percentage">{{ $skill->percentage }}%</div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Experience --}}
@if($experiences->isNotEmpty())
<section id="experience" class="section-padding section-2">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-4 reveal-on-scroll">
                <span class="section-eyebrow">Career Path</span>
                <h2 class="section-title">Work Experience</h2>
                <p class="section-subtitle">Roles and companies that have shaped how I build software today.</p>
            </div>
            <div class="col-lg-8">
                <div class="timeline">
                    @foreach($experiences->sortByDesc('duration') as $index => $experience)
                        <div class="timeline-item reveal-on-scroll" data-number="{{ str_pad($experiences->count() - $loop->iteration + 1, 2, '0', STR_PAD_LEFT) }}">
                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <h5 class="mb-1">{{ $experience->designation }}</h5>
                                <span class="badge bg-primary-custom">{{ $experience->duration }}</span>
                            </div>
                            <p class="text-primary-custom fw-semibold small mb-2">{{ $experience->company_name }}</p>
                            <p class="text-muted small mb-0">{{ $experience->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Education --}}
@if($educations->isNotEmpty())
<section id="education" class="section-padding section-2" style="background-color: var(--color-primary);">
    <div class="container">
        
        {{-- Education Horizontal Cards Style --}}
        <style>
            #education .section-eyebrow,
            #education .section-title,
            #education .section-subtitle {
                color: #fff;
            }
            #education .section-eyebrow {
                background: rgba(255,255,255,0.2);
            }
            .edu-hz-section {
                max-width: 900px;
                margin: 0 auto;
            }
            
            .edu-hz-list {
                display: flex;
                flex-direction: column;
                gap: 16px;
            }
            
            .edu-hz-card {
                background: #fff;
                border-radius: 16px;
                padding: 20px 24px;
                border: 1px solid #e2e8f0;
                display: flex;
                align-items: center;
                gap: 20px;
                transition: all 0.3s;
            }
            
            .edu-hz-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
                border-color: var(--color-secondary, #7c3aed);
            }
            
            .edu-hz-icon {
                width: 50px;
                height: 50px;
                background: var(--color-primary, #2563EB);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 1.1rem;
                flex-shrink: 0;
            }
            
            .edu-hz-content {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
            }
            
            .edu-hz-left {
                flex: 1;
            }
            
            .edu-hz-year {
                font-size: 0.75rem;
                color: var(--color-secondary, #7c3aed);
                font-weight: 700;
                margin-bottom: 4px;
            }
            
            .edu-hz-title {
                font-size: 1rem;
                font-weight: 700;
                color: #1e293b;
                margin-bottom: 4px;
            }
            
            .edu-hz-company {
                font-size: 0.85rem;
                color: #64748b;
            }
            
            .edu-hz-desc {
                font-size: 0.8rem;
                color: #475569;
                line-height: 1.5;
                max-width: 280px;
                text-align: right;
            }
            
            @media (max-width: 768px) {
                .edu-hz-card {
                    flex-direction: column;
                    text-align: center;
                }
                .edu-hz-content {
                    flex-direction: column;
                }
                .edu-hz-desc {
                    text-align: center;
                    max-width: 100%;
                }
            }
        </style>
        
        <div class="row gy-5">
            <div class="col-lg-4 reveal-on-scroll">
                <span class="section-eyebrow">Academic Background</span>
                <h2 class="section-title">Education</h2>
                <p class="section-subtitle">My academic foundation in computer science and technology.</p>
            </div>
            <div class="col-lg-8">
                <div class="edu-hz-list">
                    @foreach($educations->sortByDesc('duration') as $education)
                        <div class="edu-hz-card reveal-on-scroll">
                            <div class="edu-hz-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="edu-hz-content">
                                <div class="edu-hz-left">
                                    <div class="edu-hz-year">{{ $education->duration }}</div>
                                    <div class="edu-hz-title">{{ $education->degree }}</div>
                                    <div class="edu-hz-company">{{ $education->institute_name }}</div>
                                </div>
                                <div class="edu-hz-desc">{{ $education->description }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        
    </div>
</section>
@endif

{{-- Certifications --}}
@if($certifications->isNotEmpty())
<section id="certifications" class="section-padding section-1">
    <div class="container mb-4">
        <div class="text-center text-lg-start reveal-on-scroll">
            <span class="section-eyebrow">Credentials</span>
            <h2 class="section-title mb-2">Certifications & Badges</h2>
            <p class="section-subtitle mx-auto mx-lg-0">Professional certifications and achievements</p>
        </div>
    </div>

    <style>
        .cred-horizontal-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .cred-horizontal-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.3s;
            cursor: pointer;
            border: 1px solid #e2e8f0;
        }

        .cred-horizontal-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            border-color: var(--color-primary, #2563EB);
        }

        .cred-horizontal-icon {
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

        .cred-horizontal-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 6px;
        }

        .cred-horizontal-text {
            text-align: left;
            min-width: 0;
        }

        .cred-horizontal-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cred-horizontal-org {
            font-size: 0.75rem;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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

        [data-theme="dark"] .cred-horizontal-card {
            background: #1e293b;
            border-color: #334155;
        }
        [data-theme="dark"] .cred-horizontal-card:hover {
            border-color: var(--color-primary, #2563EB);
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);
        }
        [data-theme="dark"] .cred-horizontal-name {
            color: #f1f5f9;
        }
        [data-theme="dark"] .cred-horizontal-org {
            color: #94a3b8;
        }
    </style>

    <div class="container">
        <div class="cred-horizontal-grid">
            @foreach($certifications as $cert)
                @if($cert->credential_url)
                    <a href="{{ $cert->credential_url }}" target="_blank" class="cred-horizontal-card" style="text-decoration: none;">
                @else
                    <div class="cred-horizontal-card">
                @endif
                    <div class="cred-horizontal-icon">
                        @if($cert->badge_image)
                            <img src="{{ asset('storage/' . $cert->badge_image) }}" alt="{{ $cert->name }}" loading="lazy">
                        @else
                            <i class="fa-solid fa-certificate"></i>
                        @endif
                    </div>
                    <div class="cred-horizontal-text">
                        <div class="cred-horizontal-name">{{ $cert->name }}</div>
                        <div class="cred-horizontal-org">{{ $cert->issuer }}</div>
                    </div>
                @if($cert->credential_url)
                    </a>
                @else
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
