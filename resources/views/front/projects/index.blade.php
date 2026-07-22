@extends('front.layouts.app')

@section('title', 'Portfolio | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', 'Browse a complete list of projects and case studies.')

@section('content')

<section class="section-padding section-alt" style="padding-top: 8rem;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-eyebrow">Portfolio</span>
            <h1 class="section-title">All Projects</h1>
            <p class="section-subtitle mx-auto">Browse through a complete collection of my recent work, filtered by category or tag.</p>
        </div>

        {{-- Category Filter --}}
        @if($categories->isNotEmpty())
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                <a href="{{ route('projects.index', request()->except(['category', 'tag'])) }}" 
                   class="filter-pill {{ !request('category') ? 'active' : '' }}">All</a>
                @foreach($categories as $category)
                    <a href="{{ route('projects.index', array_merge(request()->except(['tag']), ['category' => $category->slug])) }}"
                       class="filter-pill {{ request('category') === $category->slug ? 'active' : '' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Tag Filter --}}
        @if($tags->isNotEmpty())
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
                @foreach($tags as $tag)
                    <a href="{{ route('projects.index', array_merge(request()->except(['tag']), ['tag' => $tag->slug])) }}"
                       class="filter-pill {{ request('tag') === $tag->slug ? 'active' : '' }}"
                       style="font-size: 0.85rem;">
                        <i class="fa-solid fa-tag me-1"></i>{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Active Filter Info --}}
        @if(request('tag') || request('category'))
            <div class="text-center mb-4">
                <span class="badge bg-primary">
                    Filter: {{ request('category') ? 'Category: ' . request('category') : '' }}
                    {{ request('tag') ? 'Tag: ' . request('tag') : '' }}
                    <a href="{{ route('projects.index') }}" class="text-white ms-2">&times;</a>
                </span>
            </div>
        @endif

        @if($projects->isEmpty())
            <div class="text-center py-5">
                <i class="fa-solid fa-folder-open fa-3x text-muted mb-3"></i>
                <p class="text-muted">No projects found with the selected filter.</p>
                <a href="{{ route('projects.index') }}" class="btn btn-outline-primary">View All Projects</a>
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
                                <img src="{{ $project->featured_image_url ?? 'https://placehold.co/600x450/2563EB/ffffff?text=' . urlencode($project->title) }}" alt="{{ $project->alt_text ?? $project->title }}">
                            </div>
                            <div class="p-3">
                                <h6 class="mb-1">{{ $project->title }}</h6>
                                @if($project->client_name)
                                    <p class="small text-muted mb-2">Client: {{ $project->client_name }}</p>
                                @endif
                                @if($project->tags->isNotEmpty())
                                    <div class="mb-2">
                                        @foreach($project->tags->take(3) as $tag)
                                            <span class="badge bg-secondary">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
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
