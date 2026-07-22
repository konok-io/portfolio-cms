@extends('front.layouts.app')

@section('title', PageContent::get('blog', 'page_title', app()->getLocale()) . ' | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', PageContent::get('blog', 'page_subtitle', app()->getLocale()))

@section('content')

<section class="section-padding section-alt" style="padding-top: 8rem;">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-eyebrow">{{ PageContent::get('blog', 'page_eyebrow', app()->getLocale()) }}</span>
            <h1 class="section-title">{{ PageContent::get('blog', 'page_title', app()->getLocale()) }}</h1>
            <p class="section-subtitle mx-auto">{{ PageContent::get('blog', 'page_subtitle', app()->getLocale()) }}</p>
        </div>

        <div class="row g-5">
            <div class="col-lg-8">
                {{-- Active Filter Info --}}
                @if(request('tag') || request('category') || request('search'))
                    <div class="mb-4">
                        <span class="badge bg-primary me-2">
                            {{ PageContent::get('blog', 'filter_label', app()->getLocale()) }}: 
                            @if(request('category')) Category: {{ request('category') }} @endif
                            @if(request('tag')) Tag: {{ request('tag') }} @endif
                            @if(request('search')) Search: "{{ request('search') }}" @endif
                        </span>
                        <a href="{{ route('blog.index') }}" class="btn btn-sm btn-outline-secondary">{{ PageContent::get('blog', 'filter_clear', app()->getLocale()) }}</a>
                    </div>
                @endif

                @if($blogs->isEmpty())
                    <div class="text-center py-5">
                        <i class="fa-solid fa-newspaper fa-3x text-muted mb-3"></i>
                        <p class="text-muted">{{ PageContent::get('blog', 'empty_text', app()->getLocale()) }}</p>
                        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">{{ PageContent::get('blog', 'empty_button', app()->getLocale()) }}</a>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($blogs as $blog)
                            <div class="col-md-6">
                                <div class="blog-card h-100">
                                    <div class="blog-img-wrap">
                                        <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title) }}" alt="{{ $blog->alt_text ?? $blog->title }}">
                                    </div>
                                    <div class="p-3">
                                        <div class="d-flex justify-content-between small text-muted mb-2">
                                            @if($blog->category)
                                                <a href="{{ route('blog.index', ['category' => $blog->category->slug]) }}" class="text-accent-custom fw-semibold text-decoration-none">
                                                    {{ $blog->category->name }}
                                                </a>
                                            @endif
                                            <span>{{ $blog->published_at?->format('M d, Y') }}</span>
                                        </div>
                                        <h6 class="mb-2"><a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark">{{ $blog->title }}</a></h6>
                                        <p class="text-muted small">{{ $blog->short_description }}</p>
                                        @if($blog->tags->isNotEmpty())
                                            <div class="mb-2">
                                                @foreach($blog->tags->take(3) as $tag)
                                                    <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" class="badge bg-secondary text-decoration-none">{{ $tag->name }}</a>
                                                @endforeach
                                            </div>
                                        @endif
                                        <a href="{{ route('blog.show', $blog->slug) }}" class="small text-primary-custom fw-semibold">
                                            Read More <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-5 d-flex justify-content-center">
                        {{ $blogs->links() }}
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="p-4 rounded-4 border shadow-sm bg-white mb-4">
                    <h6 class="mb-3">{{ PageContent::get('blog', 'sidebar_search', app()->getLocale()) }}</h6>
                    <form action="{{ route('blog.index') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control" placeholder="{{ PageContent::get('blog', 'sidebar_search_placeholder', app()->getLocale()) }}" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary-custom"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>

                @if($categories->isNotEmpty())
                    <div class="p-4 rounded-4 border shadow-sm bg-white mb-4">
                        <h6 class="mb-3">{{ PageContent::get('blog', 'sidebar_categories', app()->getLocale()) }}</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <a href="{{ route('blog.index', request()->except(['category'])) }}"
                                   class="d-flex justify-content-between text-decoration-none {{ !request('category') ? 'text-primary-custom fw-semibold' : 'text-dark' }}">
                                    <span><i class="fa-solid fa-chevron-right me-2 small"></i>{{ PageContent::get('blog', 'sidebar_all_categories', app()->getLocale()) }}</span>
                                </a>
                            </li>
                            @foreach($categories as $category)
                                <li class="mb-2">
                                    <a href="{{ route('blog.index', array_merge(request()->except(['category']), ['category' => $category->slug])) }}"
                                       class="d-flex justify-content-between text-decoration-none {{ request('category') === $category->slug ? 'text-primary-custom fw-semibold' : 'text-dark' }}">
                                        <span><i class="fa-solid fa-chevron-right me-2 small"></i>{{ $category->name }}</span>
                                        <span class="text-muted small">{{ $category->blogs()->where('status', 'published')->count() }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3 pt-3 border-top">
                            <a href="{{ route('blog.categories') }}" class="btn btn-sm btn-outline-primary w-100">
                                <i class="fa-solid fa-folder-open me-1"></i>{{ PageContent::get('blog', 'sidebar_view_categories', app()->getLocale()) }}
                            </a>
                        </div>
                    </div>
                @endif

                @if($tags->isNotEmpty())
                    <div class="p-4 rounded-4 border shadow-sm bg-white">
                        <h6 class="mb-3">{{ PageContent::get('blog', 'sidebar_tags', app()->getLocale()) }}</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($tags as $tag)
                                <a href="{{ route('blog.index', array_merge(request()->except(['tag']), ['tag' => $tag->slug])) }}"
                                   class="badge {{ request('tag') === $tag->slug ? 'bg-primary' : 'bg-secondary' }} text-decoration-none py-2 px-3">
                                    <i class="fa-solid fa-tag me-1"></i>{{ $tag->name }}
                                    <span class="ms-1">({{ $tag->blogs_count }})</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection
