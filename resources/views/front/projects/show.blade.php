@extends('front.layouts.app')

@section('title', $project->title . ' | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($project->description), 160))

@section('content')

<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    @if($project->category)
                        <span class="section-eyebrow">{{ $project->category->name }}</span>
                    @endif
                    <h1 class="section-title">{{ $project->title }}</h1>
                </div>

                <img src="{{ $project->featured_image_url ?? 'https://placehold.co/1000x600/2563EB/ffffff?text=' . urlencode($project->title) }}"
                     alt="{{ $project->title }}" class="img-fluid rounded-4 shadow-sm mb-4 w-100" style="aspect-ratio: 16/9; object-fit: cover;">

                <div class="content-body">
                    {!! $project->description !!}
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
                                    <img src="{{ $related->featured_image_url ?? 'https://placehold.co/600x450/2563EB/ffffff?text=' . urlencode($related->title) }}" alt="{{ $related->title }}">
                                </div>
                                <div class="p-3">
                                    <h6 class="mb-1">{{ $related->title }}</h6>
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

        <div class="mt-5">
            <a href="{{ route('projects.index') }}" class="btn btn-outline-custom">
                <i class="fa-solid fa-arrow-left me-2"></i>Back to Portfolio
            </a>
        </div>
    </div>
</section>

@endsection
