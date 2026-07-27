@extends('front.layouts.app')

@section('title', page_content('about', 'page_title', app()->getLocale()) . ' | ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('meta_description', $about->short_intro ?? 'Learn more about me, my background and approach.')

@section('content')

{{-- Page header --}}
<section class="section-padding section-1">
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
<section class="exp-section section-padding section-2">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-4 reveal-on-scroll">
                <div class="exp-header">
                    <span class="exp-eyebrow">
                        <i class="fas fa-briefcase"></i>
                        {{ __('Career Path') }}
                    </span>
                    <h2 class="exp-title">{{ __('Work Experience') }}</h2>
                    <p class="exp-subtitle">Roles and companies that have shaped how I build software today.</p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="exp-timeline">
                    @foreach($experiences as $index => $experience)
                        <div class="exp-card reveal-on-scroll">
                            <div class="exp-card-left">
                                <div class="exp-year">{{ str_replace('-', '<br>', $experience->duration) }}</div>
                            </div>
                            <div class="exp-card-right">
                                <div class="exp-card-header">
                                    <h3>{{ $experience->designation }}</h3>
                                    <span class="exp-duration-badge">{{ $experience->duration }}</span>
                                </div>
                                <div class="exp-company">
                                    <div class="exp-company-icon">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <span>{{ $experience->company_name }}</span>
                                </div>
                                <p>{{ $experience->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Experience Section - Premium Design */
    .exp-section {
        position: relative;
    }
    
    .exp-header {
        position: sticky;
        top: 100px;
    }
    
    .exp-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(37, 99, 235, 0.1);
        color: var(--color-primary);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .exp-title {
        font-family: var(--font-heading);
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--color-secondary);
        margin-bottom: 15px;
        line-height: 1.2;
    }
    
    .exp-subtitle {
        color: var(--text-muted);
        font-size: 1.1rem;
        line-height: 1.6;
    }
    
    .exp-timeline {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    
    .exp-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 30px 35px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        display: flex;
        gap: 30px;
        align-items: flex-start;
        transition: all 0.3s ease;
        position: relative;
    }
    
    /* Exp Card Border-Radius Shape Decoration */
    .exp-card::before {
        content: '';
        position: absolute;
        top: -3px;
        left: -3px;
        right: -3px;
        bottom: -3px;
        background: linear-gradient(135deg, 
            rgba(37, 99, 235, 0.2) 0%, 
            rgba(249, 115, 22, 0.15) 50%, 
            rgba(37, 99, 235, 0.2) 100%);
        border-radius: 23px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    
    .exp-card:hover::before {
        opacity: 1;
    }
    
    .exp-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(37, 99, 235, 0.12);
        border-color: rgba(37, 99, 235, 0.3);
    }
    
    .exp-card-left {
        flex-shrink: 0;
    }
    
    .exp-year {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 0.85rem;
        text-align: center;
        line-height: 1.2;
    }
    
    .exp-card-right {
        flex: 1;
    }
    
    .exp-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .exp-card-header h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--color-secondary);
        margin: 0;
    }
    
    .exp-duration-badge {
        background: var(--bg-tertiary);
        color: var(--text-secondary);
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .exp-company {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
    }
    
    .exp-company-icon {
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .exp-company-icon i {
        color: #fff;
        font-size: 0.75rem;
    }
    
    .exp-company span {
        color: var(--color-primary);
        font-weight: 600;
        font-size: 0.95rem;
    }
    
    .exp-card-right p {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.6;
        margin: 0;
    }
    
    /* Dark Mode - Experience */
    [data-theme="dark"] .exp-eyebrow {
        background: rgba(37, 99, 235, 0.15);
        color: var(--color-primary-light);
    }
    
    [data-theme="dark"] .exp-duration-badge {
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-muted);
    }
    
    [data-theme="dark"] .exp-card:hover {
        box-shadow: 0 20px 40px rgba(37, 99, 235, 0.15);
    }
    
    @media (max-width: 768px) {
        .exp-card {
            flex-direction: column;
            gap: 20px;
        }
        
        .exp-header {
            position: relative;
            top: 0;
        }
        
        .exp-title {
            font-size: 2rem;
        }
    }
</style>
@endif

{{-- Education --}}
@if($educations->isNotEmpty())
<section class="section-padding section-1">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-4 reveal-on-scroll">
                <span class="section-eyebrow">Academic Background</span>
                <h2 class="section-title">Education</h2>
                <p class="section-subtitle">My academic foundation in computer science and technology.</p>
            </div>
            <div class="col-lg-8">
                <div class="timeline">
                    @foreach($educations as $education)
                        <div class="timeline-item reveal-on-scroll">
                            <div class="d-flex justify-content-between flex-wrap gap-2">
                                <h5 class="mb-1">{{ $education->degree }}</h5>
                                <span class="badge bg-secondary-custom">{{ $education->duration }}</span>
                            </div>
                            <p class="text-primary-custom fw-semibold small mb-2">{{ $education->institute_name }}</p>
                            <p class="text-muted small mb-0">{{ $education->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@endsection
