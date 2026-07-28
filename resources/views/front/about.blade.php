@extends('front.layouts.app')

@section('title', page_content('about', 'page_title', app()->getLocale()) . ' | ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('meta_description', $about->short_intro ?? 'Learn more about me, my background and approach.')

@section('content')

{{-- Page header --}}
<section class="page-title-section section-padding">
    <div class="container">
        <div class="text-center mb-5">
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
                     class="img-fluid rounded-4 shadow-sm w-100" style="height: 100%; object-fit: cover;">
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
<section class="section-padding section-1">
    <div class="container">
        <div class="text-center mb-5 reveal-on-scroll">
            <span class="section-eyebrow">My Skills</span>
            <h2 class="section-title">Technologies I work with</h2>
            <p class="section-subtitle mx-auto">A snapshot of the tools and languages I use to bring projects to life.</p>
        </div>
        <div class="row g-4">
            @foreach($skills as $skill)
                <div class="col-md-6 reveal-on-scroll">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-semibold">
                            @if($skill->icon)<i class="{{ $skill->icon }} me-2 text-primary-custom"></i>@endif
                            {{ $skill->name }}
                        </span>
                        <span class="text-muted small">{{ $skill->percentage }}%</span>
                    </div>
                    <div class="skill-progress">
                        <div class="skill-progress-bar" data-percentage="{{ $skill->percentage }}"></div>
                    </div>
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
            
            .edu-hz-text {
                text-align: left;
            }
            
            .edu-hz-degree {
                font-weight: 600;
                color: #1e293b;
                margin-bottom: 2px;
                font-size: 1rem;
            }
            
            .edu-hz-institution {
                color: #64748b;
                font-size: 0.85rem;
            }
            
            .edu-hz-duration {
                background: rgba(37, 99, 235, 0.1);
                color: var(--color-primary, #2563EB);
                padding: 6px 12px;
                border-radius: 50px;
                font-size: 0.75rem;
                font-weight: 600;
                white-space: nowrap;
                flex-shrink: 0;
            }
            
            @media (max-width: 576px) {
                .edu-hz-content {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 8px;
                }
                .edu-hz-card {
                    flex-direction: column;
                    text-align: center;
                    gap: 12px;
                }
                .edu-hz-text {
                    text-align: center;
                }
            }
        </style>
        
        <div class="edu-hz-section">
            <div class="edu-hz-list">
                @foreach($educations as $education)
                    <div class="edu-hz-card reveal-on-scroll">
                        <div class="edu-hz-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="edu-hz-content">
                            <div class="edu-hz-text">
                                <div class="edu-hz-degree">{{ $education->degree }}</div>
                                <div class="edu-hz-institution">{{ $education->institution }}</div>
                            </div>
                            <span class="edu-hz-duration">{{ $education->duration }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

@endsection
