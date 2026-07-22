@extends('front.layouts.app')

@section('title', $project->title . ' | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($project->description), 160))

@php
    $breadcrumbs = [
        ['title' => 'Portfolio', 'url' => route('projects.index')],
        ['title' => $project->title, 'url' => null, 'active' => true]
    ];
@endphp

@section('content')

<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        {{-- Breadcrumb --}}
        <x-front-breadcrumb :items="$breadcrumbs" />

        <div class="row g-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    @if($project->category)
                        <span class="section-eyebrow">{{ $project->category->name }}</span>
                    @endif
                    <h1 class="section-title">{{ $project->title }}</h1>
                </div>

                <img src="{{ $project->featured_image_url ?? 'https://placehold.co/1000x600/2563EB/ffffff?text=' . urlencode($project->title) }}"
                     alt="{{ $project->alt_text ?? $project->title }}" class="img-fluid rounded-4 shadow-sm mb-4 w-100" style="aspect-ratio: 16/9; object-fit: cover;" loading="lazy">

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
                    <div class="row g-3" id="projectGallery">
                        @foreach($project->gallery as $index => $image)
                            <div class="col-md-4 col-6">
                                <a href="{{ $image->image_url }}" class="gallery-item" data-bs-toggle="modal" data-bs-target="#galleryModal" data-image="{{ $image->image_url }}" data-title="{{ $project->title }} - Image {{ $index + 1 }}">
                                    <div class="position-relative overflow-hidden rounded-3">
                                        <img src="{{ $image->image_url }}" alt="Gallery image {{ $index + 1 }}" class="img-fluid w-100" style="aspect-ratio: 4/3; object-fit: cover;" loading="lazy">
                                        <div class="gallery-overlay">
                                            <i class="fa-solid fa-expand"></i>
                                        </div>
                                    </div>
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
                    
                    {{-- Statistics --}}
                    <div class="d-flex justify-content-between py-2 border-bottom">
                        <span class="text-muted"><i class="fa-solid fa-eye me-1"></i> Views</span>
                        <span class="fw-semibold">{{ number_format($project->view_count ?? 0) }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-2 border-bottom mb-4">
                        <span class="text-muted"><i class="fa-solid fa-download me-1"></i> Downloads</span>
                        <span class="fw-semibold">{{ number_format($project->download_count ?? 0) }}</span>
                    </div>

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

/* Gallery Lightbox Styles */
.gallery-item {
    display: block;
    cursor: pointer;
}
.gallery-item .gallery-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.gallery-item .gallery-overlay i {
    color: white;
    font-size: 1.5rem;
}
.gallery-item:hover .gallery-overlay {
    opacity: 1;
}
.gallery-item:hover img {
    transform: scale(1.05);
}
.gallery-item img {
    transition: transform 0.3s ease;
}
</style>

{{-- Gallery Lightbox Modal --}}
<div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h6 class="modal-title" id="galleryModalLabel"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img src="" id="galleryModalImage" class="img-fluid" alt="Gallery image">
            </div>
            <div class="modal-footer justify-content-between border-0">
                <button type="button" class="btn btn-outline-light" id="galleryPrev">
                    <i class="fa-solid fa-chevron-left"></i> Previous
                </button>
                <span class="text-muted"><span id="currentIndex">1</span> / <span id="totalImages">{{ $project->gallery->count() }}</span></span>
                <button type="button" class="btn btn-outline-light" id="galleryNext">
                    Next <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('galleryModal');
    const modalImage = document.getElementById('galleryModalImage');
    const modalTitle = document.getElementById('galleryModalLabel');
    const currentIndexEl = document.getElementById('currentIndex');
    const totalImages = {{ $project->gallery->count() }};
    const galleryItems = document.querySelectorAll('.gallery-item');
    let currentIndex = 0;

    const images = Array.from(galleryItems).map(item => ({
        image: item.dataset.image,
        title: item.dataset.title
    }));

    function updateModal(index) {
        currentIndex = index;
        modalImage.src = images[index].image;
        modalTitle.textContent = images[index].title;
        currentIndexEl.textContent = index + 1;
    }

    galleryItems.forEach((item, index) => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            currentIndex = index;
            updateModal(currentIndex);
            new bootstrap.Modal(modal).show();
        });
    });

    document.getElementById('galleryPrev')?.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateModal(currentIndex);
    });

    document.getElementById('galleryNext')?.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateModal(currentIndex);
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!modal.classList.contains('show')) return;
        if (e.key === 'ArrowLeft') {
            document.getElementById('galleryPrev')?.click();
        } else if (e.key === 'ArrowRight') {
            document.getElementById('galleryNext')?.click();
        }
    });
});
</script>
@endsection
