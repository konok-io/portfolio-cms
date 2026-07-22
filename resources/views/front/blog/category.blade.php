@extends('front.layouts.app')

@section('seo_title', $category->name . ' - Blog')

@section('content')
<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog.categories') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </nav>

        <div class="text-center mb-5">
            <span class="section-eyebrow">Category</span>
            <h1 class="section-title">{{ $category->name }}</h1>
            @if($category->description)
                <p class="lead text-muted">{{ $category->description }}</p>
            @endif
        </div>

        <div class="row g-4">
            {{-- Main Content --}}
            <div class="col-lg-8">
                @if($blogs->isEmpty())
                    <div class="text-center py-5">
                        <i class="fa-solid fa-newspaper fa-4x text-muted mb-4"></i>
                        <p class="text-muted">No articles in this category yet.</p>
                        <a href="{{ route('blog.index') }}" class="btn btn-primary-custom">Browse All Articles</a>
                    </div>
                @else
                    {{-- Tag Filter --}}
                    @if($tags->isNotEmpty())
                        <div class="mb-4">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('blog.category', $category->slug) }}" class="filter-pill {{ !request('tag') ? 'active' : '' }}">
                                    All
                                </a>
                                @foreach($tags as $tag)
                                    <a href="{{ route('blog.category', [$category->slug, 'tag' => $tag->slug]) }}" 
                                       class="filter-pill {{ request('tag') === $tag->slug ? 'active' : '' }}">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="row g-4">
                        @foreach($blogs as $blog)
                            <div class="col-md-6">
                                <article class="blog-card h-100">
                                    <div class="blog-img-wrap">
                                        <a href="{{ route('blog.show', $blog->slug) }}">
                                            <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title) }}" 
                                                 alt="{{ $blog->alt_text ?? $blog->title }}"
                                                 loading="lazy">
                                        </a>
                                        @if($blog->category)
                                            <span class="blog-category-badge">
                                                <a href="{{ route('blog.category', $blog->category->slug) }}">{{ $blog->category->name }}</a>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="p-3">
                                        <h5 class="blog-title">
                                            <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                                        </h5>
                                        <p class="text-muted small mb-2">
                                            <i class="fa-solid fa-calendar me-1"></i>
                                            {{ $blog->published_at?->format('M d, Y') ?? $blog->created_at->format('M d, Y') }}
                                            <span class="mx-2">|</span>
                                            <i class="fa-solid fa-eye me-1"></i>
                                            {{ number_format($blog->views) }} views
                                        </p>
                                        <p class="blog-excerpt">{{ Str::limit(strip_tags($blog->short_description ?: $blog->description), 120) }}</p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="author-info d-flex align-items-center gap-2">
                                                <img src="{{ $blog->author->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($blog->author->name ?? 'Admin') . '&background=2563EB&color=fff' }}" 
                                                     alt="{{ $blog->author->name ?? 'Admin' }}" 
                                                     class="rounded-circle" width="32" height="32">
                                                <span class="small">{{ $blog->author->name ?? 'Admin' }}</span>
                                            </div>
                                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-sm btn-outline-primary">
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>

                    @if($blogs->hasPages())
                        <div class="mt-5">
                            {{ $blogs->withQueryString()->links() }}
                        </div>
                    @endif
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="p-4 rounded-4 border shadow-sm sticky-top" style="top: 100px;">
                    <h6 class="mb-3">All Categories</h6>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('blog.categories') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <span>All Categories</span>
                        </a>
                        @foreach(\App\Models\BlogCategory::withCount(['blogs' => function ($q) { $q->published(); }])->having('blogs_count', '>', 0)->get() as $cat)
                            <a href="{{ route('blog.category', $cat->slug) }}" 
                               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $cat->id === $category->id ? 'active' : '' }}">
                                <span>{{ $cat->name }}</span>
                                <span class="badge bg-{{ $cat->id === $category->id ? 'light' : 'secondary' }} rounded-pill">{{ $cat->blogs_count }}</span>
                            </a>
                        @endforeach
                    </div>

                    @if($tags->isNotEmpty())
                        <h6 class="mb-3 mt-4">Popular Tags</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($tags->take(10) as $tag)
                                <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" class="badge bg-secondary text-decoration-none">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
