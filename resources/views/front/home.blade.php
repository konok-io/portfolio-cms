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
                <span class="hero-eyebrow"><i class="fa-solid fa-circle-check"></i> {{ PageContent::get('home', 'hero_eyebrow', app()->getLocale()) }}</span>
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
                        <i class="fa-solid fa-paper-plane me-2"></i>{{ PageContent::get('home', 'hero_button_hire', app()->getLocale()) }}
                    </a>
                    @if($about->cv_url ?? false)
                        <a href="{{ $about->cv_url }}" class="btn btn-outline-custom" download>
                            <i class="fa-solid fa-download me-2"></i>{{ PageContent::get('home', 'hero_button_cv', app()->getLocale()) }}
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
                            <div class="small text-muted">{{ PageContent::get('home', 'hero_badge', app()->getLocale()) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================
     2. WHY CHOOSE ME
     ========================================================= --}}
<section id="about" class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-eyebrow">{{ PageContent::get('home', 'why_eyebrow', app()->getLocale()) }}</span>
            <h2 class="section-title">{{ PageContent::get('home', 'why_title', app()->getLocale()) }}</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm reveal-on-scroll">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mx-auto mb-3" style="width:60px;height:60px;">
                            <i class="fa-solid fa-code"></i>
                        </div>
                        <h5 class="card-title mb-2">{{ PageContent::get('home', 'why_card1_title', app()->getLocale()) }}</h5>
                        <p class="card-text text-muted small">{{ PageContent::get('home', 'why_card1_text', app()->getLocale()) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm reveal-on-scroll">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mx-auto mb-3" style="width:60px;height:60px;">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <h5 class="card-title mb-2">{{ PageContent::get('home', 'why_card2_title', app()->getLocale()) }}</h5>
                        <p class="card-text text-muted small">{{ PageContent::get('home', 'why_card2_text', app()->getLocale()) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm reveal-on-scroll">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mx-auto mb-3" style="width:60px;height:60px;">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <h5 class="card-title mb-2">{{ PageContent::get('home', 'why_card3_title', app()->getLocale()) }}</h5>
                        <p class="card-text text-muted small">{{ PageContent::get('home', 'why_card3_text', app()->getLocale()) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5 reveal-on-scroll">
            <a href="{{ route('about') }}" class="btn btn-outline-custom">
                <i class="fa-solid fa-user me-2"></i>Learn More About Me
            </a>
        </div>
    </div>
</section>

{{-- =========================================================
     3. SKILLS
     ========================================================= --}}
@if($skills->isNotEmpty())
<section id="skills" class="section-padding section-alt">
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

{{-- =========================================================
     4. SERVICES
     ========================================================= --}}
@if($services->isNotEmpty())
<section id="services" class="section-padding section-tint">
    <div class="container">
        <div class="text-center mb-5 reveal-on-scroll">
            <span class="section-eyebrow">{{ PageContent::get('home', 'services_eyebrow', app()->getLocale()) }}</span>
            <h2 class="section-title">{{ PageContent::get('home', 'services_title', app()->getLocale()) }}</h2>
            <p class="section-subtitle mx-auto">{{ PageContent::get('home', 'services_subtitle', app()->getLocale()) }}</p>
        </div>
        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-md-6 col-lg-4 reveal-on-scroll">
                    <div class="service-card">
                        <div class="icon-box">
                            <i class="{{ $service->icon ?? 'fa-solid fa-gear' }}"></i>
                        </div>
                        <h5 class="mb-2">{{ $service->name }}</h5>
                        <p class="text-muted small mb-0">{{ $service->description }}</p>
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
<section id="experience" class="section-padding section-alt">
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
<section id="education" class="section-padding section-accent-tint">
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
<section id="portfolio" class="section-padding section-dark-tint">
    <div class="container">
        <div class="text-center mb-5 reveal-on-scroll">
            <span class="section-eyebrow">Recent Work</span>
            <h2 class="section-title">Selected Projects</h2>
            <p class="section-subtitle mx-auto">A few of the projects I've recently designed and built.</p>
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
        <div class="text-center mt-5">
            <a href="{{ route('projects.index') }}" class="btn btn-outline-custom">View All Projects</a>
        </div>
    </div>
</section>
@endif

{{-- =========================================================
     8. TESTIMONIALS
     ========================================================= --}}
@if($testimonials->isNotEmpty())
<section id="testimonials" class="section-padding">
    <div class="container">
        <div class="text-center mb-5 reveal-on-scroll">
            <span class="section-eyebrow">Client Feedback</span>
            <h2 class="section-title">What clients say about working with me</h2>
        </div>
        <div id="testimonialCarousel" class="carousel slide reveal-on-scroll" data-bs-ride="carousel">
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
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle p-3" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    </div>
</section>
@endif

{{-- =========================================================
     8.5 CERTIFICATIONS & BADGES
     ========================================================= --}}
@if($certifications->isNotEmpty())
<section id="certifications" class="section-padding section-alt">
    <div class="container">
        <div class="text-center mb-5 reveal-on-scroll">
            <span class="section-eyebrow">Credentials</span>
            <h2 class="section-title">Certifications & Badges</h2>
            <p class="text-muted">Professional certifications and achievements</p>
        </div>
        <div class="row g-4">
            @foreach($certifications as $cert)
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
        <div class="text-center mb-5 reveal-on-scroll">
            <span class="section-eyebrow">{{ PageContent::get('home', 'blog_eyebrow', app()->getLocale()) }}</span>
            <h2 class="section-title">{{ PageContent::get('home', 'blog_title', app()->getLocale()) }}</h2>
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
                                {{ PageContent::get('home', 'blog_card_link', app()->getLocale()) }} <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('blog.index') }}" class="btn btn-outline-custom">{{ PageContent::get('home', 'blog_button', app()->getLocale()) }}</a>
        </div>
    </div>
</section>
@endif

{{-- =========================================================
     10. CONTACT FORM
     ========================================================= --}}
<section id="contact" class="section-padding">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5 reveal-on-scroll">
                <span class="section-eyebrow">{{ PageContent::get('home', 'contact_eyebrow', app()->getLocale()) }}</span>
                <h2 class="section-title mb-4">{{ PageContent::get('home', 'contact_title', app()->getLocale()) }}</h2>
                <p class="text-muted mb-4">{{ PageContent::get('home', 'contact_text', app()->getLocale()) }}</p>

                <div class="d-flex flex-column gap-3">
                    @if($about->email ?? false)
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box mb-0" style="width:48px;height:48px;"><i class="fa-solid fa-envelope"></i></div>
                            <div>
                                <div class="small text-muted">{{ PageContent::get('home', 'contact_label_email', app()->getLocale()) }}</div>
                                <div class="fw-semibold">{{ $about->email }}</div>
                            </div>
                        </div>
                    @endif
                    @if($about->phone ?? false)
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box mb-0" style="width:48px;height:48px;"><i class="fa-solid fa-phone"></i></div>
                            <div>
                                <div class="small text-muted">{{ PageContent::get('home', 'contact_label_phone', app()->getLocale()) }}</div>
                                <div class="fw-semibold">{{ $about->phone }}</div>
                            </div>
                        </div>
                    @endif
                    @if($about->address ?? false)
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box mb-0" style="width:48px;height:48px;"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <div class="small text-muted">{{ PageContent::get('home', 'contact_label_location', app()->getLocale()) }}</div>
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
                                <label class="form-label small fw-semibold">{{ PageContent::get('home', 'contact_form_name', app()->getLocale()) }}</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">{{ PageContent::get('home', 'contact_form_email', app()->getLocale()) }}</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">{{ PageContent::get('home', 'contact_form_phone', app()->getLocale()) }}</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">{{ PageContent::get('home', 'contact_form_subject', app()->getLocale()) }}</label>
                                <input type="text" name="subject" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold">{{ PageContent::get('home', 'contact_form_message', app()->getLocale()) }}</label>
                                <textarea name="message" rows="5" class="form-control" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary-custom w-100">
                                    <i class="fa-solid fa-paper-plane me-2"></i>{{ PageContent::get('home', 'contact_form_button', app()->getLocale()) }}
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
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typedText = document.getElementById('typed-text');
    if (!typedText) return;
    
    const phrases = [
        '{{ $about->title ?? "Web Developer" }}',
        'Laravel Expert',
        'Full Stack Developer',
        'UI/UX Enthusiast'
    ];
    
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
