@extends('front.layouts.app')

@section('title', 'Portfolio | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', 'Browse a complete list of projects and case studies.')

@section('content')

<section class="section-padding bg-light-custom" style="padding-top: 8rem;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-eyebrow">Portfolio</span>
            <h1 class="section-title">All Projects</h1>
            <p class="section-subtitle mx-auto">Browse through a complete collection of my recent work, filtered by category.</p>
        </div>

        @if($categories->isNotEmpty())
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
                <a href="{{ route('projects.index') }}" class="filter-pill {{ request('category') ? '' : 'active' }}">All</a>
                @foreach($categories as $category)
                    <a href="{{ route('projects.index', ['category' => $category->slug]) }}"
                       class="filter-pill {{ request('category') === $category->slug ? 'active' : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif

        @if($projects->isEmpty())
            <div class="text-center py-5">
                <i class="fa-solid fa-folder-open fa-3x text-muted mb-3"></i>
                <p class="text-muted">No projects found in this category yet.</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($projects as $project)
                    <div class="col-md-6 col-lg-4">
                        <div class="project-card">
                            <div class="project-img-wrap">
                                @if($project->category)
                                    <span class="project-category-tag">{{ $project->category->name }}</span>
                                @endif
                                <img src="{{ $project->featured_image_url ?? 'https://placehold.co/600x450/2563EB/ffffff?text=' . urlencode($project->title) }}" alt="{{ $project->title }}">
                            </div>
                            <div class="p-3">
                                <h6 class="mb-1">{{ $project->title }}</h6>
                                @if($project->client_name)
                                    <p class="small text-muted mb-2">Client: {{ $project->client_name }}</p>
                                @endif
                                <a href="{{ route('projects.show', $project->slug) }}" class="small text-primary-custom fw-semibold">
                                    View Project <i class="fa-solid fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
