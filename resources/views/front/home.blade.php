@extends('front.layouts.app')

@section('title', ($about->name ?? 'Portfolio') . ' | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', $about->short_intro ?? 'Professional portfolio website.')

@section('content')

{{-- =========================================================
     1. HERO
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
     2. WHY CHOOSE ME (About)
     ========================================================= --}}
@if($whyChooseMe->isNotEmpty())
<section id="about" class="section-padding section-alt">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-5 gap-3">
            <div class="text-center text-lg-start reveal-on-scroll">
                <span class="section-eyebrow">
                    <i class="fas fa-star"></i>
                    {{ __('Why Choose Me') }}
                </span>
                <h2 class="section-title mb-2">{{ $whyChooseMeTitle }}</h2>
                <p class="section-subtitle mx-auto mx-lg-0">{{ $whyChooseMeSubtitle }}</p>
            </div>
            <a href="{{ route('about') }}" class="btn btn-outline-custom flex-shrink-0 reveal-on-scroll">
                <i class="fa-solid fa-user me-2"></i>{{ __('Learn More About Me') }}
            </a>
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
        --why-border: #d1d5db;
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

    /* Dark Mode - Why Choose Me Cards */
    [data-theme="dark"] .why-h-card {
        background: #1f1f3a;
        border-color: #2d2d52;
    }

    [data-theme="dark"] .why-h-card h3 {
        color: #e5e7eb;
    }

    [data-theme="dark"] .why-h-card p {
        color: #9ca3af;
    }

    [data-theme="dark"] .why-h-card .card-number {
        color: rgba(37, 99, 235, 0.15);
    }
</style>

{{-- =========================================================
     3. SKILLS
     ========================================================= --}}
@if($skills->isNotEmpty())
<section id="skills" class="section-padding section-tint">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-5 gap-3">
            <div class="text-center text-lg-start reveal-on-scroll">
                <span class="section-eyebrow">{{ $skillsSectionTitle }}</span>
                <h2 class="section-title mb-2">{{ $skillsTitle }}</h2>
                <p class="section-subtitle mx-auto mx-lg-0">{{ $skillsSubtitle }}</p>
            </div>
            <a href="{{ route('about') }}" class="btn btn-outline-custom flex-shrink-0 reveal-on-scroll">
                <i class="fa-solid fa-eye me-2"></i>{{ __('View All Skills') }}
            </a>
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
     4. SERVICES (What I Do)
     ========================================================= --}}
@include('front.partials.what-i-do')

{{-- =========================================================
     5. PORTFOLIO PROJECTS
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
     6. EXPERIENCE
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
     7. EDUCATION
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
     9. CERTIFICATIONS & BADGES
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
     10. BLOG POSTS
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
     11. PRICING PLANS (Design 10: Split/Two Column Layout)
     ========================================================= --}}
@if($pricingPlans->isNotEmpty())
<section id="pricing" class="pricing-split-section">
    <div class="container">
        <div class="pricing-split-row" style="align-items: flex-start;">
            {{-- Left Side: Text Content --}}
            <div class="pricing-split-left reveal-on-scroll">
                <h2 class="pricing-split-title">{{ $settings['pricing_title'] ?? 'Simple, Fair Pricing' }}</h2>
                <p class="pricing-split-desc">{{ $settings['pricing_subtitle'] ?? 'Choose the plan that fits your needs. 14-day free trial included.' }}</p>
                
                {{-- Monthly/Yearly Toggle --}}
                <div class="pricing-split-toggle">
                    <label class="pricing-toggle-option active" onclick="togglePricingPeriod('monthly')">
                        <input type="radio" name="pricing_period" value="monthly" checked>
                        <span>Monthly</span>
                    </label>
                    <label class="pricing-toggle-option" onclick="togglePricingPeriod('yearly')">
                        <input type="radio" name="pricing_period" value="yearly">
                        <span>Yearly</span>
                        <span class="pricing-save-badge">-20%</span>
                    </label>
                </div>
            </div>
            
            {{-- Right Side: Pricing Cards --}}
            <div class="pricing-split-right">
                <div class="pricing-split-grid">
                    @foreach($pricingPlans as $plan)
                    <div class="pricing-split-card {{ $plan->is_highlighted ? 'featured' : '' }} reveal-on-scroll" style="animation-delay: {{ $loop->index * 0.1 }}s">
                        @if($plan->badge)
                        <span class="pricing-split-badge">{{ $plan->badge }}</span>
                        @endif
                        
                        <h3 class="pricing-split-plan-name">{{ $plan->name }}</h3>
                        <p class="pricing-split-plan-desc">{{ $plan->description }}</p>
                        
                        <div class="pricing-split-price">
                            <span class="pricing-split-currency">{!! $plan->currency === 'BDT' ? '৳' : ($plan->currency === 'USD' ? '$' : $plan->currency) !!}</span>
                            <span class="pricing-split-amount" 
                                  data-monthly="{{ (int)$plan->monthly_price }}" 
                                  data-yearly="{{ (int)($plan->yearly_price ?: $plan->monthly_price * 0.8) }}">
                                {{ (int)$plan->monthly_price }}
                            </span>
                            <span class="pricing-split-period">/{{ __('mo') }}</span>
                        </div>
                        
                        <ul class="pricing-split-features">
                            @foreach($plan->getFeaturesArray() as $feature)
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <span>{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>
                        
                        @if($plan->button_url)
                        <a href="{{ $plan->button_url }}" class="pricing-split-btn {{ $plan->is_highlighted ? 'btn-primary-split' : 'btn-outline-split' }}">
                            {{ $plan->button_text ?: __('Get Started') }}
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* ===== PRICING SPLIT SECTION (Design 10) ===== */
    .pricing-split-section {
        padding: 80px 0;
        background: linear-gradient(135deg, var(--section-alt-bg, #f8fafc) 0%, var(--bg-color, #ffffff) 100%);
    }
    
    .pricing-split-row {
        display: flex;
        align-items: center;
        gap: 60px;
    }
    
    /* Left Side */
    .pricing-split-left {
        flex: 0 0 35%;
        max-width: 380px;
    }
    
    .pricing-split-eyebrow {
        display: inline-block;
        background: linear-gradient(135deg, var(--color-primary, #4f46e5), var(--color-secondary, #06b6d4));
        color: white;
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
    }
    
    .pricing-split-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-color, #0f172a);
        margin-bottom: 12px;
        line-height: 1.2;
    }
    
    .pricing-split-desc {
        font-size: 0.95rem;
        color: #64748b;
        margin-bottom: 25px;
        line-height: 1.6;
    }
    
    /* Toggle */
    .pricing-split-toggle {
        display: inline-flex;
        background: var(--card-bg, white);
        border-radius: 50px;
        padding: 6px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    
    .pricing-toggle-option {
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        padding: 10px 18px;
        border-radius: 50px;
        transition: all 0.3s;
    }
    
    .pricing-toggle-option input {
        display: none;
    }
    
    .pricing-toggle-option span:first-of-type {
        font-weight: 600;
        font-size: 0.85rem;
        color: #64748b;
        transition: color 0.3s;
    }
    
    .pricing-toggle-option.active {
        background: linear-gradient(135deg, var(--color-primary, #4f46e5), var(--color-secondary, #06b6d4));
    }
    
    .pricing-toggle-option.active span:first-of-type {
        color: white;
    }
    
    .pricing-save-badge {
        background: #d1fae5;
        color: #059669;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 700;
    }
    
    .pricing-toggle-option.active .pricing-save-badge {
        background: rgba(255,255,255,0.3);
        color: white;
    }
    
    /* Right Side */
    .pricing-split-right {
        flex: 1;
    }
    
    .pricing-split-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
    }
    
    /* Card */
    .pricing-split-card {
        background: var(--card-bg, white);
        border-radius: 16px;
        padding: 20px;
        padding-bottom: 16px;
        position: relative;
        transition: all 0.3s;
        border: 1px solid #d1d5db;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    .pricing-split-card:hover {
        border-color: var(--color-primary, #4f46e5);
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }
    
    .pricing-split-card.featured {
        background: linear-gradient(135deg, var(--color-primary, #4f46e5), var(--color-secondary, #06b6d4));
        color: white;
        border: none;
        box-shadow: 0 20px 40px rgba(79, 70, 229, 0.25);
        transform: scale(1.02);
    }
    
    .pricing-split-card.featured:hover {
        transform: scale(1.02);
        box-shadow: 0 25px 50px rgba(79, 70, 229, 0.35);
    }
    
    .pricing-split-badge {
        position: absolute;
        top: -10px;
        right: 20px;
        background: #fbbf24;
        color: #92400e;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
    }
    
    .pricing-split-plan-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-color, #0f172a);
        margin-bottom: 4px;
    }
    
    .pricing-split-card.featured .pricing-split-plan-name {
        color: white;
    }
    
    .pricing-split-plan-desc {
        font-size: 0.75rem;
        color: #64748b;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    
    .pricing-split-card.featured .pricing-split-plan-desc {
        color: rgba(255,255,255,0.8);
    }
    
    .pricing-split-price {
        display: flex;
        align-items: baseline;
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border-color, #e5e7eb);
    }
    
    .pricing-split-card.featured .pricing-split-price {
        border-color: rgba(255,255,255,0.2);
    }
    
    .pricing-split-currency {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--color-primary, #4f46e5);
        align-self: flex-start;
        margin-top: 4px;
    }
    
    .pricing-split-card.featured .pricing-split-currency {
        color: white;
    }
    
    .pricing-split-amount {
        font-size: 1.75rem;
        font-weight: 900;
        color: var(--text-color, #0f172a);
        line-height: 1;
    }
    
    .pricing-split-card.featured .pricing-split-amount {
        color: white;
    }
    
    .pricing-split-period {
        font-size: 0.7rem;
        color: #64748b;
        margin-left: 2px;
    }
    
    .pricing-split-card.featured .pricing-split-period {
        color: rgba(255,255,255,0.8);
    }
    
    .pricing-split-features {
        list-style: none;
        padding: 0;
        margin: 0 0 15px 0;
    }
    
    .pricing-split-features li {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 5px 0;
        font-size: 0.75rem;
        color: #475569;
    }
    
    .pricing-split-card.featured .pricing-split-features li {
        color: rgba(255,255,255,0.95);
    }
    
    .pricing-split-features li i {
        width: 16px;
        height: 16px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.55rem;
        flex-shrink: 0;
    }
    
    .pricing-split-card.featured .pricing-split-features li i {
        background: rgba(255,255,255,0.25);
    }
    
    /* Buttons */
    .btn-outline-split {
        display: block;
        background: var(--section-alt-bg, #f8fafc);
        border: 1px solid var(--color-primary, #4f46e5);
        color: var(--color-primary, #4f46e5);
        padding: 8px 14px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s;
        width: 100%;
    }
    
    .btn-outline-split:hover {
        background: var(--color-primary, #4f46e5);
        color: white;
    }
    
    .btn-primary-split {
        display: block;
        background: white;
        border: none;
        color: var(--color-primary, #4f46e5);
        padding: 8px 14px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s;
        width: 100%;
    }
    
    .btn-primary-split:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        color: var(--color-primary, #4f46e5);
    }
    
    /* Dark Mode */
    [data-theme="dark"] .pricing-split-section {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }
    
    [data-theme="dark"] .pricing-split-card {
        background: #1e293b;
        border-color: #334155;
    }
    
    [data-theme="dark"] .pricing-split-title,
    [data-theme="dark"] .pricing-split-amount {
        color: white;
    }
    
    [data-theme="dark"] .pricing-split-plan-name {
        color: white;
    }
    
    [data-theme="dark"] .pricing-split-plan-desc,
    [data-theme="dark"] .pricing-split-features li,
    [data-theme="dark"] .pricing-split-period {
        color: #94a3b8;
    }
    
    [data-theme="dark"] .btn-outline-split {
        background: #1e293b;
        color: white;
        border-color: #6366f1;
    }
    
    [data-theme="dark"] .btn-outline-split:hover {
        background: #6366f1;
        color: white;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .pricing-split-row {
            flex-direction: column;
            gap: 40px;
        }
        
        .pricing-split-left {
            flex: none;
            max-width: 100%;
            text-align: center;
        }
        
        .pricing-split-toggle {
            justify-content: center;
        }
    }
    
    @media (max-width: 576px) {
        .pricing-split-grid {
            grid-template-columns: 1fr;
        }
        
        .pricing-split-card.featured {
            transform: scale(1);
        }
        
        .pricing-split-card.featured:hover {
            transform: translateY(-5px);
        }
    }
</style>

<script>
    function togglePricingPeriod(period) {
        const options = document.querySelectorAll('.pricing-toggle-option');
        const amounts = document.querySelectorAll('.pricing-split-amount');
        const periods = document.querySelectorAll('.pricing-split-period');
        
        options.forEach(opt => opt.classList.remove('active'));
        event.currentTarget.classList.add('active');
        
        amounts.forEach(el => {
            const monthly = el.dataset.monthly;
            const yearly = el.dataset.yearly;
            el.textContent = period === 'yearly' ? yearly : monthly;
        });
        
        periods.forEach(el => {
            el.textContent = '/' + (period === 'yearly' ? 'yr' : 'mo');
        });
    }
</script>
@endif

{{-- =========================================================
     12. FAQ SECTION (Design 8: Split Layout Pro)
     ========================================================= --}}
@if($faqs->isNotEmpty())
<section id="faq" class="faq-split-section">
    <div class="container">
        <div class="row g-4 faq-split-row">
            {{-- Left Side - Info Card --}}
            <div class="col-lg-3">
                <div class="faq-split-card reveal-on-scroll h-100">
                    <div class="faq-card-icon">
                        <i class="fas fa-question"></i>
                    </div>
                    <h3 class="faq-card-title">Frequently Asked Questions</h3>
                    <p class="faq-card-desc">Quick answers to common questions about my services.</p>
                    
                    <div class="faq-card-divider"></div>
                    
                    <p class="faq-card-contact-label">Need more help?</p>
                    <a href="mailto:{{ $settings['contact_email'] ?? 'contact@example.com' }}" class="faq-card-email">
                        <i class="fas fa-envelope me-2"></i>
                        {{ $settings['contact_email'] ?? 'contact@example.com' }}
                    </a>
                </div>
            </div>
            
            {{-- Right Side - FAQ List --}}
            <div class="col-lg-9">
                <div class="faq-split-list reveal-on-scroll h-100">
                    @foreach($faqs as $index => $faq)
                    <div class="faq-split-item {{ $index === 0 ? 'active' : '' }}" data-faq-id="{{ $faq->id }}">
                        <div class="faq-split-question">
                            <div class="faq-split-icon">
                                <i class="fas {{ $index === 0 ? 'fa-minus' : 'fa-plus' }}"></i>
                            </div>
                            <span>{{ $faq->question }}</span>
                        </div>
                        <div class="faq-split-answer">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* ===== FAQ SPLIT SECTION ===== */
    .faq-split-section {
        padding: 50px 0;
        background: var(--section-alt-bg, #f8fafc);
    }
    
    .faq-split-row {
        align-items: stretch;
    }
    
    /* Left Card - Simple Blue */
    .faq-split-card {
        background: #2563eb;
        border-radius: 16px;
        padding: 30px;
        height: 100%;
        display: flex;
        flex-direction: column;
        color: white;
    }
    
    .faq-card-icon {
        width: 50px;
        height: 50px;
        background: rgba(255,255,255,0.15);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        margin-bottom: 15px;
    }
    
    .faq-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: white;
        margin-bottom: 8px;
    }
    
    .faq-card-desc {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.8);
        margin-bottom: 20px;
        line-height: 1.5;
    }
    
    .faq-card-divider {
        height: 1px;
        background: rgba(255,255,255,0.2);
        margin: 15px 0;
    }
    
    .faq-card-contact-label {
        font-size: 0.85rem;
        color: rgba(255,255,255,0.8);
        margin-bottom: 8px;
    }
    
    .faq-card-email {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        background: rgba(255,255,255,0.15);
        border-radius: 8px;
        color: white;
        text-decoration: none;
        font-size: 0.85rem;
        transition: all 0.3s;
    }
    
    .faq-card-email:hover {
        background: rgba(255,255,255,0.25);
        color: white;
    }
    
    /* Right Card - FAQ List */
    .faq-split-list {
        background: var(--card-bg, white);
        border-radius: 16px;
        padding: 25px;
        border: 1px solid #d1d5db;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    /* FAQ List */
    .faq-split-list {
        background: var(--card-bg, white);
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #d1d5db;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .faq-split-item {
        border-bottom: 1px solid #e5e7eb;
        padding: 14px 0;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .faq-split-item:last-child {
        border-bottom: none;
    }
    
    .faq-split-item.active {
        border-bottom: 2px solid #2563eb;
    }
    
    .faq-split-question {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .faq-split-icon {
        width: 30px;
        height: 30px;
        background: #2563eb;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.65rem;
        flex-shrink: 0;
        transition: all 0.3s;
    }
    
    .faq-split-item:not(.active) .faq-split-icon {
        background: #f1f5f9;
        color: #2563eb;
    }
    
    .faq-split-question span {
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--text-color, #0f172a);
        flex-grow: 1;
    }
    
    .faq-split-answer {
        padding-left: 42px;
        padding-top: 8px;
        display: none;
    }
    
    .faq-split-item.active .faq-split-answer {
        display: block;
    }
    
    .faq-split-answer p {
        font-size: 0.85rem;
        color: #64748b;
        margin: 0;
        line-height: 1.5;
    }
    
    .faq-split-answer a {
        color: #2563eb;
        text-decoration: none;
    }
    
    .faq-split-answer a:hover {
        text-decoration: underline;
    }
    
    /* Hover Effect */
    .faq-split-item:hover .faq-split-question span {
        color: #2563eb;
    }
    
    /* Dark Mode */
    [data-theme="dark"] .faq-split-section {
        background: #0f172a;
    }
    
    [data-theme="dark"] .faq-split-list {
        background: #1e293b;
        border-color: #334155;
    }
    
    [data-theme="dark"] .faq-split-card {
        background: #1e40af;
    }
    
    [data-theme="dark"] .faq-split-question span {
        color: white;
    }
    
    [data-theme="dark"] .faq-split-answer p {
        color: #94a3b8;
    }
    
    [data-theme="dark"] .faq-split-item {
        border-color: #334155;
    }
    
    [data-theme="dark"] .faq-split-item:not(.active) .faq-split-icon {
        background: #334155;
        color: #60a5fa;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .faq-split-card {
            position: static;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-split-item');
        
        faqItems.forEach(item => {
            item.addEventListener('click', function() {
                const isActive = this.classList.contains('active');
                
                // Close all
                faqItems.forEach(i => {
                    i.classList.remove('active');
                    i.querySelector('.faq-split-icon i').className = 'fas fa-plus';
                });
                
                // Open clicked (if it wasn't already open)
                if (!isActive) {
                    this.classList.add('active');
                    this.querySelector('.faq-split-icon i').className = 'fas fa-minus';
                }
            });
        });
    });
</script>
@endif

{{-- =========================================================
     13. RESUME CTA
     ========================================================= --}}
<section id="resume-cta" class="section-padding section-tint">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 reveal-on-scroll">
                <span class="section-eyebrow">My Resume</span>
                <h2 class="section-title mb-3">Want to see my full profile?</h2>
                <p class="text-muted mb-4">Get a comprehensive overview of my skills, experience, education, and certifications. Download or preview my resume in multiple professional templates.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('resume') }}" class="btn btn-primary-custom">
                        <i class="fa-solid fa-eye me-2"></i>View Resume
                    </a>
                    <a href="{{ route('resume.preview') }}" target="_blank" class="btn btn-outline-custom">
                        <i class="fa-solid fa-file-pdf me-2"></i>Preview PDF
                    </a>
                </div>
            </div>
            <div class="col-lg-5 reveal-on-scroll">
                <div class="text-center">
                    <div class="resume-preview-box p-4 bg-white rounded-4 shadow-sm">
                        <i class="fa-solid fa-file-lines text-primary-custom" style="font-size: 4rem;"></i>
                        <h5 class="mt-3 mb-2">Professional Resume</h5>
                        <p class="text-muted small mb-0">Multiple templates available</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================
     14. CONTACT
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
    
    /* Resume Preview Box */
    .resume-preview-box {
        transition: all 0.3s ease;
    }
    .resume-preview-box:hover {
        transform: scale(1.05);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
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
