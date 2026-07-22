@extends('front.layouts.app')

@section('title', 'Search: ' . $query . ' - ' . ($siteSetting->site_name ?? 'Portfolio'))

@section('content')
<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="section-title">Search Results</h1>
            <p class="text-muted">Found {{ $totalResults }} results for "{{ $query }}"</p>
        </div>

        <!-- Search Form -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-6">
                <form action="{{ route('search') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="q" class="form-control form-control-lg" 
                           placeholder="Search projects, blogs, services..." 
                           value="{{ $query }}" required>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        @if($totalResults > 0)
            <div class="row g-4">
                <!-- Projects -->
                @if($projects->isNotEmpty())
                    <div class="col-12">
                        <h4 class="mb-4"><i class="fa-solid fa-folder-open text-primary-custom me-2"></i>Projects ({{ $projects->count() }})</h4>
                        <div class="row g-3 mb-5">
                            @foreach($projects as $project)
                                <div class="col-md-6 col-lg-4">
                                    <div class="project-card h-100">
                                        <div class="project-img-wrap">
                                            <img src="{{ $project->featured_image_url ?? 'https://placehold.co/600x450/2563EB/ffffff?text=Project' }}" alt="{{ $project->title }}">
                                        </div>
                                        <div class="p-3">
                                            <h6 class="mb-1">{{ $project->title }}</h6>
                                            <p class="text-muted small">{{ Str::limit($project->short_description, 80) }}</p>
                                            <a href="{{ route('projects.show', $project->slug) }}" class="small text-primary-custom fw-semibold">
                                                View Project <i class="fa-solid fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Blog Posts -->
                @if($blogs->isNotEmpty())
                    <div class="col-12">
                        <h4 class="mb-4"><i class="fa-solid fa-newspaper text-primary-custom me-2"></i>Blog Posts ({{ $blogs->count() }})</h4>
                        <div class="row g-3 mb-5">
                            @foreach($blogs as $blog)
                                <div class="col-md-6 col-lg-4">
                                    <div class="blog-card h-100">
                                        <div class="blog-img-wrap">
                                            <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=Blog' }}" alt="{{ $blog->title }}">
                                        </div>
                                        <div class="p-3">
                                            @if($blog->category)
                                                <span class="small text-accent-custom fw-semibold">{{ $blog->category->name }}</span>
                                            @endif
                                            <h6 class="mt-1 mb-2">{{ $blog->title }}</h6>
                                            <p class="text-muted small">{{ Str::limit($blog->short_description, 80) }}</p>
                                            <a href="{{ route('blog.show', $blog->slug) }}" class="small text-primary-custom fw-semibold">
                                                Read More <i class="fa-solid fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Services -->
                @if($services->isNotEmpty())
                    <div class="col-12">
                        <h4 class="mb-4"><i class="fa-solid fa-briefcase text-primary-custom me-2"></i>Services ({{ $services->count() }})</h4>
                        <div class="row g-3 mb-5">
                            @foreach($services as $service)
                                <div class="col-md-6 col-lg-4">
                                    <div class="service-card h-100 p-4">
                                        @if($service->icon)
                                            <div class="service-icon mb-3">
                                                <i class="{{ $service->icon }}"></i>
                                            </div>
                                        @endif
                                        <h6 class="mb-2">{{ $service->title }}</h6>
                                        <p class="text-muted small">{{ Str::limit($service->short_description, 80) }}</p>
                                        <a href="{{ route('services') }}" class="small text-primary-custom fw-semibold">
                                            View Service <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Pages -->
                @if($pages->isNotEmpty())
                    <div class="col-12">
                        <h4 class="mb-4"><i class="fa-solid fa-file-lines text-primary-custom me-2"></i>Pages ({{ $pages->count() }})</h4>
                        <div class="row g-3">
                            @foreach($pages as $page)
                                <div class="col-md-6">
                                    <div class="card border-0 shadow-sm h-100 p-3">
                                        <h6 class="mb-2">{{ $page->title }}</h6>
                                        <p class="text-muted small mb-2">{{ Str::limit(strip_tags($page->content), 100) }}</p>
                                        <a href="{{ route('page.show', $page->slug) }}" class="small text-primary-custom fw-semibold">
                                            View Page <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center py-5">
                <i class="fa-solid fa-search text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-4">No results found</h4>
                <p class="text-muted">Try different keywords or browse our sections</p>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="{{ route('projects.index') }}" class="btn btn-outline-primary">Browse Projects</a>
                    <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">Browse Blog</a>
                    <a href="{{ route('services') }}" class="btn btn-outline-primary">Browse Services</a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
