@extends('front.layouts.app')

@section('title', $project->title . ' | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($project->description), 160))

@section('content')

<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Portfolio</a></li>
                @if($project->category)
                    <li class="breadcrumb-item"><a href="{{ route('projects.index', ['category' => $project->category->slug]) }}">{{ $project->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($project->title, 30) }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    @if($project->category)
                        <span class="section-eyebrow">{{ $project->category->name }}</span>
                    @endif
                    <h1 class="section-title">{{ $project->title }}</h1>
                </div>

                <img src="{{ $project->featured_image_url ?? 'https://placehold.co/1000x600/2563EB/ffffff?text=' . urlencode($project->title) }}"
                     alt="{{ $project->alt_text ?? $project->title }}" class="img-fluid rounded-4 shadow-sm mb-4 w-100" style="aspect-ratio: 16/9; object-fit: cover;">

                <div class="content-body">
                    {!! $project->description !!}
                </div>

                @if($project->hasVideo())
                    <div class="mt-4">
                        <h5 class="mb-3"><i class="fa-solid fa-play-circle me-2 text-primary-custom"></i>Project Demo</h5>
                        <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm">
                            <iframe src="{{ $project->getVideoEmbedUrl() }}" allowfullscreen></iframe>
                        </div>
                    </div>
                @endif

                {{-- Social Share Buttons - Professional --}}
                <div class="share-section mt-4 pt-4 border-top">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <h6 class="mb-1 share-title">Share this project</h6>
                            <p class="text-muted small mb-0">Like this project? Share it with others</p>
                        </div>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="share-btn facebook" title="Share on Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                                <span>Facebook</span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($project->title) }}" target="_blank" class="share-btn twitter" title="Share on Twitter">
                                <i class="fa-brands fa-x-twitter"></i>
                                <span>Twitter</span>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($project->title) }}" target="_blank" class="share-btn linkedin" title="Share on LinkedIn">
                                <i class="fa-brands fa-linkedin-in"></i>
                                <span>LinkedIn</span>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($project->title . ' ' . request()->url()) }}" target="_blank" class="share-btn whatsapp" title="Share on WhatsApp">
                                <i class="fa-brands fa-whatsapp"></i>
                                <span>WhatsApp</span>
                            </a>
                            <button onclick="copyLink()" class="share-btn copy-link" title="Copy Link">
                                <i class="fa-solid fa-link"></i>
                                <span>Copy</span>
                            </button>
                        </div>
                    </div>
                </div>

                @if($project->gallery->isNotEmpty())
                    <h5 class="mt-5 mb-3">Project Gallery</h5>
                    <div class="row g-3">
                        @foreach($project->gallery as $image)
                            <div class="col-md-4">
                                <a href="{{ $image->image_url }}" target="_blank">
                                    <img src="{{ $image->image_url }}" alt="Gallery image" class="img-fluid rounded-3" style="aspect-ratio: 4/3; object-fit: cover; width: 100%;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="p-4 rounded-4 border shadow-sm sticky-top" style="top: 100px;">
                    <h6 class="mb-3">Project Details</h6>
                    <ul class="list-unstyled small mb-4">
                        @if($project->client_name)
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">Client</span>
                                <span class="fw-semibold">{{ $project->client_name }}</span>
                            </li>
                        @endif
                        <li class="d-flex justify-content-between py-2 border-bottom">
                            <span class="text-muted">Status</span>
                            <span class="fw-semibold text-capitalize">{{ str_replace('_', ' ', $project->status) }}</span>
                        </li>
                        @if($project->category)
                            <li class="d-flex justify-content-between py-2 border-bottom">
                                <span class="text-muted">Category</span>
                                <span class="fw-semibold">{{ $project->category->name }}</span>
                            </li>
                        @endif
                    </ul>

                    @if($project->technologies_array)
                        <h6 class="mb-2 small text-muted">Technologies Used</h6>
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            @foreach($project->technologies_array as $tech)
                                <span class="badge bg-light-custom text-dark border">{{ $tech }}</span>
                            @endforeach
                        </div>
                    @endif

                    @if($project->tags->isNotEmpty())
                        <h6 class="mb-2 small text-muted">Tags</h6>
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            @foreach($project->tags as $tag)
                                <a href="{{ route('projects.index', ['tag' => $tag->slug]) }}" class="badge bg-secondary text-decoration-none">{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    @endif

                    @if($project->project_url)
                        <a href="{{ $project->project_url }}" target="_blank" class="btn btn-primary-custom w-100">
                            <i class="fa-solid fa-arrow-up-right-from-square me-2"></i>Visit Live Site
                        </a>
                    @endif
                </div>
            </div>
        </div>

        @if($relatedProjects->isNotEmpty())
            <div class="mt-5 pt-4 border-top">
                <h4 class="mb-4">Related Projects</h4>
                <div class="row g-4">
                    @foreach($relatedProjects as $related)
                        <div class="col-md-4">
                            <div class="project-card">
                                <div class="project-img-wrap">
                                    <img src="{{ $related->featured_image_url ?? 'https://placehold.co/600x450/2563EB/ffffff?text=' . urlencode($related->title) }}" alt="{{ $related->alt_text ?? $related->title }}" loading="lazy">
                                </div>
                                <div class="p-3">
                                    <h6 class="mb-1">{{ $related->title }}</h6>
                                    @if($related->tags->isNotEmpty())
                                        <div class="mb-2">
                                            @foreach($related->tags->take(2) as $tag)
                                                <span class="badge bg-secondary" style="font-size: 0.7rem;">{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <a href="{{ route('projects.show', $related->slug) }}" class="small text-primary-custom fw-semibold">
                                        View Project <i class="fa-solid fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Prev/Next Navigation --}}
        @if($prevProject || $nextProject)
            <div class="project-nav mt-5 pt-4 border-top">
                <div class="row g-3">
                    <div class="col-6">
                        @if($prevProject)
                            <a href="{{ route('projects.show', $prevProject->slug) }}" class="project-nav-btn">
                                <div class="d-flex align-items-center gap-3">
                                    <i class="fa-solid fa-chevron-left"></i>
                                    <div class="text-start">
                                        <div class="small text-muted">Previous</div>
                                        <div class="fw-semibold">{{ $prevProject->title }}</div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="col-6">
                        @if($nextProject)
                            <a href="{{ route('projects.show', $nextProject->slug) }}" class="project-nav-btn text-end">
                                <div class="d-flex align-items-center justify-content-end gap-3">
                                    <div class="text-end">
                                        <div class="small text-muted">Next</div>
                                        <div class="fw-semibold">{{ $nextProject->title }}</div>
                                    </div>
                                    <i class="fa-solid fa-chevron-right"></i>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        
        <div class="mt-4">
            <a href="{{ route('projects.index') }}" class="btn btn-outline-custom">
                <i class="fa-solid fa-arrow-left me-2"></i>Back to Portfolio
            </a>
        </div>
    </div>
</section>

<style>
.project-nav-btn {
    display: block;
    padding: 1rem;
    border: 1px solid var(--color-border);
    border-radius: 12px;
    text-decoration: none;
    color: inherit;
    transition: all 0.2s;
}
.project-nav-btn:hover {
    border-color: var(--color-primary);
    background: var(--color-primary-tint);
}
</style>

@endsection
