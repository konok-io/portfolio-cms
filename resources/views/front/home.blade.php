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
                <span class="hero-eyebrow"><i class="fa-solid fa-circle-check"></i> Available for new projects</span>
                <h1 class="hero-title">
                    Hi, I'm {{ $about->name ?? 'Your Name' }} —<br>
                    <span class="text-primary-custom">{{ $about->title ?? 'Web Developer' }}</span>
                </h1>
                <p class="lead text-muted mb-4" style="max-width: 560px;">
                    {{ $about->short_intro ?? 'I design and build modern, high-performing web applications tailored to your business goals.' }}
                </p>
                <div class="d-flex flex-wrap gap-3">
                    @if($about->cv_url ?? false)
                        <a href="{{ $about->cv_url }}" class="btn btn-primary-custom" download>
                            <i class="fa-solid fa-download me-2"></i>Download CV
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2">
                <div class="hero-photo-frame">
                    <img src="{{ $about->hero_photo_url ?? $about->photo_url }}"
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
     2. ABOUT ME
     ========================================================= --}}
<section id="about" class="section-padding">
    <div class="container">
        <div class="row gy-5 align-items-stretch" style="--img-col: 30%; --text-col: 70%;">
            <div class="reveal-on-scroll d-flex align-items-stretch" style="width: var(--img-col); flex: 0 0 var(--img-col);">
                <img src="{{ $about->photo_url ?? 'https://ui-avatars.com/api/?name=About&size=500&background=0F172A&color=fff' }}"
                     alt="About {{ $about->name ?? '' }}" class="img-fluid rounded-4 shadow-sm w-100" style="height: 100%; object-fit: cover;">
            </div>
            <div class="reveal-on-scroll is-visible" style="width: var(--text-col); flex: 0 0 var(--text-col);">
                <span class="section-eyebrow">About Me</span>
                <h2 class="section-title mb-4">A little about my background &amp; approach</h2>
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
            </div>
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
<section id="services" class="section-padding">
    <div class="container">
        <div class="text-center mb-5 reveal-on-scroll">
            <span class="section-eyebrow">What I Offer</span>
            <h2 class="section-title">Services built around your goals</h2>
            <p class="section-subtitle mx-auto">End-to-end web development services to help your idea reach production.</p>
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
<section id="education" class="section-padding">
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
                            <img src="{{ $project->featured_image_url ?? 'https://placehold.co/600x450/2563EB/ffffff?text=' . urlencode($project->title) }}" alt="{{ $project->title }}">
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
        <div class="row g-4">
            @foreach($testimonials as $testimonial)
                <div class="col-md-6 col-lg-4 reveal-on-scroll">
                    <div class="testimonial-card h-100 d-flex flex-column">
                        <i class="fa-solid fa-quote-left quote-icon mb-3"></i>
                        <p class="text-muted small flex-grow-1">{{ $testimonial->review }}</p>
                        <div class="star-rating mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-{{ $i <= $testimonial->rating ? 'solid' : 'regular' }} fa-star"></i>
                            @endfor
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->client_name }}" width="48" height="48" class="rounded-circle object-fit-cover">
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
</section>
@endif

{{-- =========================================================
     9. BLOG POSTS
     ========================================================= --}}
@if($blogs->isNotEmpty())
<section id="blog" class="section-padding section-alt">
    <div class="container">
        <div class="text-center mb-5 reveal-on-scroll">
            <span class="section-eyebrow">From the Blog</span>
            <h2 class="section-title">Latest Articles</h2>
        </div>
        <div class="row g-4">
            @foreach($blogs as $blog)
                <div class="col-md-6 col-lg-4 reveal-on-scroll">
                    <div class="blog-card h-100">
                        <div class="blog-img-wrap">
                            <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title) }}" alt="{{ $blog->title }}">
                        </div>
                        <div class="p-3">
                            @if($blog->category)
                                <span class="small text-accent-custom fw-semibold">{{ $blog->category->name }}</span>
                            @endif
                            <h6 class="mt-1 mb-2"><a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark">{{ $blog->title }}</a></h6>
                            <p class="text-muted small">{{ $blog->short_description }}</p>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="small text-primary-custom fw-semibold">
                                Read More <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('blog.index') }}" class="btn btn-outline-custom">View All Articles</a>
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
                <span class="section-eyebrow">Get In Touch</span>
                <h2 class="section-title mb-4">Let's build something great together</h2>
                <p class="text-muted mb-4">Have a project in mind or just want to say hello? Fill out the form and I'll get back to you shortly.</p>

                <div class="d-flex flex-column gap-3">
                    @if($about->email ?? false)
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box mb-0" style="width:48px;height:48px;"><i class="fa-solid fa-envelope"></i></div>
                            <div>
                                <div class="small text-muted">Email</div>
                                <div class="fw-semibold">{{ $about->email }}</div>
                            </div>
                        </div>
                    @endif
                    @if($about->phone ?? false)
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box mb-0" style="width:48px;height:48px;"><i class="fa-solid fa-phone"></i></div>
                            <div>
                                <div class="small text-muted">Phone</div>
                                <div class="fw-semibold">{{ $about->phone }}</div>
                            </div>
                        </div>
                    @endif
                    @if($about->address ?? false)
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box mb-0" style="width:48px;height:48px;"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <div class="small text-muted">Location</div>
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
                                <label class="form-label small fw-semibold">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">Subject</label>
                                <input type="text" name="subject" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold">Message</label>
                                <textarea name="message" rows="5" class="form-control" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary-custom w-100">
                                    <i class="fa-solid fa-paper-plane me-2"></i>Send Message
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
