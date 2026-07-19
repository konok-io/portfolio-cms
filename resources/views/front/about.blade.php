@extends('front.layouts.app')

@section('title', 'About ' . ($about->name ?? '') . ' | ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('meta_description', $about->short_intro ?? 'Learn more about me, my background and approach.')

@section('content')

{{-- Page header --}}
<section class="section-padding bg-light-custom">
    <div class="container">
        <div class="text-center">
            <span class="section-eyebrow">Get to know me</span>
            <h1 class="section-title">About Me</h1>
            <p class="section-subtitle mx-auto">{{ $about->short_intro ?? 'A little about who I am and what I do.' }}</p>
        </div>
    </div>
</section>

{{-- Intro: photo + bio --}}
<section class="section-padding">
    <div class="container">
        <div class="row gy-5 align-items-center">
            <div class="col-lg-5 reveal-on-scroll">
                <img src="{{ $about->photo_url }}"
                     alt="{{ $about->name ?? 'Profile photo' }}"
                     class="img-fluid rounded-4 shadow-sm w-100" style="object-fit: cover;">
            </div>
            <div class="col-lg-7 reveal-on-scroll">
                <span class="section-eyebrow">{{ $about->title ?? 'Web Developer' }}</span>
                <h2 class="section-title mb-4">Hi, I'm {{ $about->name ?? 'Your Name' }}</h2>
                <p class="text-muted mb-4">{{ strip_tags($about->description ?? 'I am a dedicated developer focused on building reliable, user-friendly software.') }}</p>

                <div class="row g-3 mb-4">
                    @if($about->email ?? false)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-envelope text-primary-custom"></i>
                                <span class="small">{{ $about->email }}</span>
                            </div>
                        </div>
                    @endif
                    @if($about->phone ?? false)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-phone text-primary-custom"></i>
                                <span class="small">{{ $about->phone }}</span>
                            </div>
                        </div>
                    @endif
                    @if($about->address ?? false)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-location-dot text-primary-custom"></i>
                                <span class="small">{{ $about->address }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="d-flex flex-wrap gap-2 mb-4">
                    @if($about->linkedin ?? false)
                        <a href="{{ $about->linkedin }}" target="_blank" class="btn btn-sm btn-outline-custom"><i class="fa-brands fa-linkedin-in"></i></a>
                    @endif
                    @if($about->github ?? false)
                        <a href="{{ $about->github }}" target="_blank" class="btn btn-sm btn-outline-custom"><i class="fa-brands fa-github"></i></a>
                    @endif
                    @if($about->facebook ?? false)
                        <a href="{{ $about->facebook }}" target="_blank" class="btn btn-sm btn-outline-custom"><i class="fa-brands fa-facebook-f"></i></a>
                    @endif
                    @if($about->twitter ?? false)
                        <a href="{{ $about->twitter }}" target="_blank" class="btn btn-sm btn-outline-custom"><i class="fa-brands fa-x-twitter"></i></a>
                    @endif
                    @if($about->instagram ?? false)
                        <a href="{{ $about->instagram }}" target="_blank" class="btn btn-sm btn-outline-custom"><i class="fa-brands fa-instagram"></i></a>
                    @endif
                </div>

                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('home') }}#contact" class="btn btn-primary-custom">
                        <i class="fa-solid fa-paper-plane me-2"></i>Hire Me
                    </a>
                    @if($about->cv_url ?? false)
                        <a href="{{ $about->cv_url }}" class="btn btn-outline-custom" download>
                            <i class="fa-solid fa-download me-2"></i>Download CV
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Skills --}}
@if($skills->isNotEmpty())
<section class="section-padding bg-light-custom">
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
<section class="section-padding">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-4 reveal-on-scroll">
                <span class="section-eyebrow">Career Path</span>
                <h2 class="section-title">Work Experience</h2>
                <p class="section-subtitle">Roles and companies that have shaped how I build software today.</p>
            </div>
            <div class="col-lg-8">
                <div class="timeline">
                    @foreach($experiences as $experience)
                        <div class="timeline-item reveal-on-scroll">
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
<section class="section-padding bg-light-custom">
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
