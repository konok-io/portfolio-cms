@extends('front.layouts.app')

@section('title', ($about->name ?? 'Portfolio') . ' | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', $about->short_intro ?? 'Professional portfolio website.')

@section('content')

{{-- =========================================================
     1. HERO SECTION
     ========================================================= --}}
<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-7 order-2 order-lg-1">
                <span class="hero-eyebrow"><i class="fa-solid fa-circle-check"></i> {{ page_content('home', 'hero_eyebrow', app()->getLocale()) }}</span>
                <h1 class="hero-title">
                    Hi, I'm {{ $about->name ?? 'Your Name' }} —<br>
                    <span class="text-primary-custom">
                        <span id="typed-text"></span><span class="cursor">|</span>
                    </span>
                </h1>
                <p class="lead text-muted mb-4" style="max-width: 560px;">
                    {{ $about->short_intro ?? 'I design and build modern, high-performing web applications tailored to your business goals.' }}
                </p>
                <div class="d-flex flex-wrap gap-3" style="position: relative; z-index: 1;">
                    <a href="{{ route('contact') }}" class="btn btn-primary-custom">
                        <i class="fa-solid fa-paper-plane me-2"></i>{{ page_content('home', 'hero_button_hire', app()->getLocale()) }}
                    </a>
                    @if($about->cv_url ?? false)
                        <a href="{{ $about->cv_url }}" class="btn btn-outline-custom" download>
                            <i class="fa-solid fa-download me-2"></i>{{ page_content('home', 'hero_button_cv', app()->getLocale()) }}
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2">
                <div class="hero-photo-frame">
                    <img src="{{ $about->hero_photo_url ?? $about->photo_url }}" loading="eager"
                         alt="{{ $about->name ?? 'Profile photo' }}"
                         style="object-fit: cover;">
                    <div class="badge-floating">
                        <div class="icon-box mb-0" style="width:44px;height:44px;font-size:1.1rem;">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <div>
                            <div class="fw-bold">{{ $experiences->count() }}+</div>
                            <div class="small text-muted">Years Experience</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================
     2. WHY CHOOSE ME - Design 2: Premium Gradient Cards
     ========================================================= --}}
@if($whyChooseMe->isNotEmpty())
<section id="about" class="section-padding section-alt">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-eyebrow">
                <i class="fas fa-star"></i>
                {{ __('Why Choose Me') }}
            </span>
            <h2 class="section-title">{{ $whyChooseMeTitle }}</h2>
            <p class="section-subtitle mx-auto">{{ $whyChooseMeSubtitle }}</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            @foreach($whyChooseMe as $index => $item)
            <div class="col-lg-4 col-md-6">
                <div class="why-h-card reveal-on-scroll">
                    <span class="card-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    <div class="why-h-icon">
                        <i class="{{ $item->icon }}"></i>
                    </div>
                    <h3>{{ $item->title }}</h3>
                    <p>{{ $item->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
    /* Design 2: Premium Gradient Cards */
    :root {
        --why-primary: #2563EB;
        --why-primary-dark: #1d4ed8;
        --why-primary-light: #60a5fa;
        --why-primary-glow: rgba(37, 99, 235, 0.1);
        --why-text-dark: #1a1a2e;
        --why-text-body: #4b5563;
        --why-bg-white: #ffffff;
        --why-border: #e2e8f0;
    }

    .why-h-card {
        background: var(--why-bg-white);
        border-radius: 20px;
        padding: 30px 25px;
        border: 1px solid var(--why-border);
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .why-h-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--why-primary), var(--why-primary-dark));
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 0;
    }

    .why-h-card::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--why-primary), var(--why-primary-light));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .why-h-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(37, 99, 235, 0.2);
        border-color: transparent;
    }

    .why-h-card:hover::before {
        opacity: 1;
    }

    .why-h-card:hover::after {
        transform: scaleX(1);
    }

    .why-h-icon {
        width: 65px;
        height: 65px;
        background: var(--why-primary-glow);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--why-primary);
        font-size: 1.5rem;
        margin-bottom: 18px;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .why-h-card:hover .why-h-icon {
        background: rgba(255,255,255,0.2);
        color: #fff;
        transform: scale(1.1) rotate(-5deg);
    }

    .why-h-card h3 {
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 10px;
        transition: color 0.3s ease;
        position: relative;
        z-index: 1;
        color: var(--why-text-dark);
    }

    .why-h-card:hover h3 { color: #fff; }

    .why-h-card p {
        font-size: 0.9rem;
        line-height: 1.6;
        color: var(--why-text-body);
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        margin: 0;
    }

    .why-h-card:hover p { 
        color: rgba(255,255,255,0.9);
    }

    .card-number {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 3rem;
        font-weight: 800;
        color: var(--why-primary-glow);
        line-height: 1;
        transition: all 0.3s ease;
        z-index: 1;
    }

    .why-h-card:hover .card-number {
        color: rgba(255,255,255,0.15);
    }
</style>

{{-- =========================================================
     3. SKILLS
     ========================================================= --}}
@if($skills->isNotEmpty())
<section id="skills" class="section-padding section-tint">
    <div class="container">
        <div class="text-center mb-5 reveal-on-scroll">
            <span class="section-eyebrow">{{ $skillsSectionTitle }}</span>
            <h2 class="section-title mb-2">{{ $skillsTitle }}</h2>
            <p class="section-subtitle mx-auto">{{ $skillsSubtitle }}</p>
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
                border: 1px solid rgba(37, 99, 235, 0.1);
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
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, #2563EB, #3B82F6);
                opacity: 0;
                transition: opacity 0.3s;
            }
            
            .tech-card:hover {
                transform: translateY(-8px);
                border-color: #2563EB;
                box-shadow: 0 15px 40px rgba(37, 99, 235, 0.15);
            }
            
            .tech-card:hover::before {
                opacity: 1;
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
                background: linear-gradient(90deg, #67E8F9, #67E8F9);
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
            @foreach($skills->take(5) as $skill)
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

{{-- =========================================================
     4. SERVICES
     ========================================================= --}}
@if($services->isNotEmpty())
<section id="services" class="section-padding section-alt">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-5 gap-3">
            <div class="text-center text-lg-start reveal-on-scroll">
                <span class="section-eyebrow">{{ page_content('home', 'services_eyebrow', app()->getLocale()) }}</span>
                <h2 class="section-title mb-2">{{ page_content('home', 'services_title', app()->getLocale()) }}</h2>
                <p class="section-subtitle mx-auto mx-lg-0">{{ page_content('home', 'services_subtitle', app()->getLocale()) }}</p>
            </div>
            <a href="{{ route('services') }}" class="btn btn-outline-custom flex-shrink-0 reveal-on-scroll">
                {{ page_content('services', 'view_all', app()->getLocale()) }} <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
        </div>
        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-md-6 col-lg-4 reveal-on-scroll">
                    <div class="service-card h-100">
                        <div class="icon-box">
                            @if($service->svg_icon)
                                <span class="svg-icon">{!! $service->svg_icon !!}</span>
                            @elseif($service->icon)
                                <i class="{{ $service->icon }}"></i>
                            @else
                                <i class="fa-solid fa-gear"></i>
                            @endif
                        </div>
                        <h5 class="mb-2">{{ $service->name }}</h5>
                        <p class="text-muted small mb-3">{{ Str::limit($service->description, 100) }}</p>
                        <a href="{{ route('services.show', $service->slug ?? Str::slug($service->name)) }}" class="btn btn-sm btn-outline-custom">
                            {{ page_content('services', 'page_button', app()->getLocale()) }} <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =========================================================
     5. EXPERIENCE
     ========================================================= --}}
@if($experiences->isNotEmpty())
<section id="experience" class="section-padding section-tint">
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

{{-- =========================================================
     6. EDUCATION
     ========================================================= --}}
@if($educations->isNotEmpty())
<section id="education" class="section-padding section-tint">
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

{{-- =========================================================
     7. PORTFOLIO PROJECTS
     ========================================================= --}}
@if($projects->isNotEmpty())
<section id="portfolio" class="section-padding section-alt">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-5 gap-3">
            <div class="text-center text-lg-start reveal-on-scroll">
                <span class="section-eyebrow">Recent Work</span>
                <h2 class="section-title mb-2">Selected Projects</h2>
                <p class="section-subtitle mx-auto mx-lg-0">A few of the projects I've recently designed and built.</p>
            </div>
            <a href="{{ route('projects.index') }}" class="btn btn-outline-custom flex-shrink-0 reveal-on-scroll">View All Projects</a>
        </div>
        <div class="row g-4">
            @foreach($projects as $project)
                <div class="col-md-6 col-lg-3 reveal-on-scroll">
                    <div class="project-card">
                        <div class="project-img-wrap">
                            @if($project->category)
                                <span class="project-category-tag">{{ $project->category->name }}</span>
                            @endif
                            <img src="{{ $project->featured_image_url ?? 'https://placehold.co/600x450/2563EB/ffffff?text=' . urlencode($project->title) }}" alt="{{ $project->alt_text ?? $project->title }}" loading="lazy">
                        </div>
                        <div class="p-3">
                            <h6 class="mb-1">{{ $project->title }}</h6>
                            <a href="{{ route('projects.show', $project->slug) }}" class="small text-primary-custom fw-semibold">
                                View Project <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =========================================================
     8. TESTIMONIALS
     ========================================================= --}}
@if($testimonials->isNotEmpty())
<section id="testimonials" class="section-padding section-tint">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-5 gap-3">
            <div class="text-center text-lg-start reveal-on-scroll">
                <span class="section-eyebrow">Client Feedback</span>
                <h2 class="section-title mb-0">What clients say about working with me</h2>
            </div>
            @if($testimonials->count() > 3)
            <a href="{{ route('testimonials') }}" class="btn btn-outline-custom flex-shrink-0 reveal-on-scroll">
                View All Feedback <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
            @endif
        </div>
        <div id="testimonialCarousel" class="carousel slide reveal-on-scroll" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                @foreach($testimonials->chunk(3) as $index => $testimonialGroup)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="row g-4">
                            @foreach($testimonialGroup as $testimonial)
                                <div class="col-md-6 col-lg-4">
                                    <div class="testimonial-card h-100 d-flex flex-column">
                                        <i class="fa-solid fa-quote-left quote-icon mb-3"></i>
                                        <p class="text-muted small flex-grow-1">{{ $testimonial->review }}</p>
                                        @if($testimonial->hasVideo())
                                            <a href="#" class="btn btn-sm btn-outline-primary mb-2 video-testimonial-btn" data-video="{{ $testimonial->getVideoEmbedUrl() }}">
                                                <i class="fa-solid fa-play me-1"></i>Watch Video
                                            </a>
                                        @endif
                                        <div class="star-rating mb-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fa-{{ $i <= $testimonial->rating ? 'solid' : 'regular' }} fa-star"></i>
                                            @endfor
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->client_name }}" width="48" height="48" class="rounded-circle object-fit-cover" loading="lazy">
                                            <div>
                                                <h6 class="mb-0">{{ $testimonial->client_name }}</h6>
                                                <span class="small text-muted">{{ $testimonial->company }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            @if($testimonials->count() > 3)
                <div class="carousel-indicators custom-carousel-indicators">
                    @foreach($testimonials->chunk(3) as $index => $group)
                        <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- =========================================================
     8.5 CERTIFICATIONS & BADGES
     ========================================================= --}}
@if($certifications->isNotEmpty())
<section id="certifications" class="section-padding section-tint">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-5 gap-3">
            <div class="text-center text-lg-start reveal-on-scroll">
                <span class="section-eyebrow">Credentials</span>
                <h2 class="section-title mb-2">Certifications & Badges</h2>
                <p class="text-muted mx-auto mx-lg-0 mb-0">Professional certifications and achievements</p>
            </div>
            @if($certifications->count() > 4)
            <a href="{{ route('certifications') }}" class="btn btn-outline-custom flex-shrink-0 reveal-on-scroll">
                View All <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
            @endif
        </div>
        <div class="row g-4">
            @foreach($certifications->take(4) as $cert)
                <div class="col-md-6 col-lg-3 reveal-on-scroll">
                    <div class="certification-card h-100 text-center p-4">
                        @if($cert->badge_image)
                            <img src="{{ asset('storage/' . $cert->badge_image) }}" 
                                 alt="{{ $cert->name }}" 
                                 class="cert-badge mb-3"
                                 style="width: 80px; height: 80px; object-fit: contain;">
                        @else
                            <div class="cert-icon mb-3">
                                <i class="fa-solid fa-certificate"></i>
                            </div>
                        @endif
                        <h6 class="mb-2">{{ $cert->name }}</h6>
                        <p class="small text-muted mb-1">{{ $cert->issuer }}</p>
                        <span class="small text-accent-custom">{{ $cert->issue_date?->format('M Y') }}</span>
                        @if($cert->credential_url)
                            <div class="mt-2">
                                <a href="{{ $cert->credential_url }}" target="_blank" class="btn btn-sm btn-outline-custom">
                                    <i class="fa-solid fa-external-link me-1"></i>Verify
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =========================================================
     9. BLOG POSTS
     ========================================================= --}}
@if($blogs->isNotEmpty())
<section id="blog" class="section-padding section-tint">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-5 gap-3">
            <div class="text-center text-lg-start reveal-on-scroll">
                <span class="section-eyebrow">{{ page_content('home', 'blog_eyebrow', app()->getLocale()) }}</span>
                <h2 class="section-title mb-0">{{ page_content('home', 'blog_title', app()->getLocale()) }}</h2>
            </div>
            <a href="{{ route('blog.index') }}" class="btn btn-outline-custom flex-shrink-0 reveal-on-scroll">{{ page_content('home', 'blog_button', app()->getLocale()) }}</a>
        </div>
        <div class="row g-4">
            @foreach($blogs as $blog)
                <div class="col-md-6 col-lg-4 reveal-on-scroll">
                    <div class="blog-card h-100">
                        <div class="blog-img-wrap">
                            <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title) }}" alt="{{ $blog->alt_text ?? $blog->title }}" loading="lazy">
                        </div>
                        <div class="p-3">
                            @if($blog->category)
                                <span class="small text-accent-custom fw-semibold">{{ $blog->category->name }}</span>
                            @endif
                            <h6 class="mt-1 mb-2"><a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark">{{ $blog->title }}</a></h6>
                            <p class="text-muted small">{{ $blog->short_description }}</p>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="small text-primary-custom fw-semibold">
                                {{ page_content('home', 'blog_card_link', app()->getLocale()) }} <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =========================================================
     10. CONTACT FORM
     ========================================================= --}}
<section id="contact" class="section-padding section-alt">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5 reveal-on-scroll">
                <span class="section-eyebrow">{{ page_content('home', 'contact_eyebrow', app()->getLocale()) }}</span>
                <h2 class="section-title mb-4">{{ page_content('home', 'contact_title', app()->getLocale()) }}</h2>
                <p class="text-muted mb-4">{{ page_content('home', 'contact_text', app()->getLocale()) }}</p>

                <div class="d-flex flex-column gap-3">
                    @if($about->email ?? false)
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box mb-0" style="width:48px;height:48px;"><i class="fa-solid fa-envelope"></i></div>
                            <div>
                                <div class="small text-muted">{{ page_content('home', 'contact_label_email', app()->getLocale()) }}</div>
                                <div class="fw-semibold">{{ $about->email }}</div>
                            </div>
                        </div>
                    @endif
                    @if($about->phone ?? false)
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box mb-0" style="width:48px;height:48px;"><i class="fa-solid fa-phone"></i></div>
                            <div>
                                <div class="small text-muted">{{ page_content('home', 'contact_label_phone', app()->getLocale()) }}</div>
                                <div class="fw-semibold">{{ $about->phone }}</div>
                            </div>
                        </div>
                    @endif
                    @if($about->address ?? false)
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box mb-0" style="width:48px;height:48px;"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <div class="small text-muted">{{ page_content('home', 'contact_label_location', app()->getLocale()) }}</div>
                                <div class="fw-semibold">{{ $about->address }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-7 reveal-on-scroll">
                <div class="p-4 p-md-5 rounded-4 shadow-sm border">
                    <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">{{ page_content('home', 'contact_form_name', app()->getLocale()) }}</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">{{ page_content('home', 'contact_form_email', app()->getLocale()) }}</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">{{ page_content('home', 'contact_form_phone', app()->getLocale()) }}</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">{{ page_content('home', 'contact_form_subject', app()->getLocale()) }}</label>
                                <input type="text" name="subject" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold">{{ page_content('home', 'contact_form_message', app()->getLocale()) }}</label>
                                <textarea name="message" rows="5" class="form-control" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary-custom w-100">
                                    <i class="fa-solid fa-paper-plane me-2"></i>{{ page_content('home', 'contact_form_button', app()->getLocale()) }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .cursor {
        animation: blink 1s infinite;
    }
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0; }
    }
    
    /* Modern Testimonial Dots - Compact */
    .custom-carousel-indicators {
        position: relative;
        margin-top: 1rem;
        margin-bottom: 0;
        justify-content: center;
        gap: 4px;
    }
    .custom-carousel-indicators button {
        width: 6px !important;
        height: 6px !important;
        border-radius: 50% !important;
        border: none !important;
        background: #dee2e6 !important;
        opacity: 1 !important;
        transition: all 0.3s ease !important;
        padding: 0 !important;
        margin: 0 2px !important;
        min-width: 6px !important;
        min-height: 6px !important;
    }
    .custom-carousel-indicators button:hover {
        background: #adb5bd !important;
        transform: scale(1.3) !important;
    }
    .custom-carousel-indicators button.active {
        background: var(--bs-primary) !important;
        width: 18px !important;
        border-radius: 3px !important;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typedText = document.getElementById('typed-text');
    if (!typedText) return;
    
    const phrases = [
        @foreach(range(1, 6) as $i)
        '{{ page_content('home', 'typing_text_' . $i, app()->getLocale()) ?: '' }}',
        @endforeach
    ].filter(text => text.trim() !== '');
    
    let phraseIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let typeSpeed = 100;
    
    function type() {
        const currentPhrase = phrases[phraseIndex];
        
        if (isDeleting) {
            typedText.textContent = currentPhrase.substring(0, charIndex - 1);
            charIndex--;
            typeSpeed = 50;
        } else {
            typedText.textContent = currentPhrase.substring(0, charIndex + 1);
            charIndex++;
            typeSpeed = 100;
        }
        
        if (!isDeleting && charIndex === currentPhrase.length) {
            typeSpeed = 2000;
            isDeleting = true;
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            phraseIndex = (phraseIndex + 1) % phrases.length;
            typeSpeed = 500;
        }
        
        setTimeout(type, typeSpeed);
    }
    
    setTimeout(type, 1000);
});
</script>
@endpush
