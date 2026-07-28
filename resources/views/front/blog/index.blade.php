@extends('front.layouts.app')

@section('title', page_content('blog', 'page_title', app()->getLocale()) . ' | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', page_content('blog', 'page_subtitle', app()->getLocale()))

@section('content')

{{-- Page header --}}
<section class="page-title-section section-padding">
    <div class="shape-container">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
        <div class="shape shape-6"></div>
        <div class="shape shape-7"></div>
        <div class="shape shape-8"></div>
    </div>

    <div class="container">
        <div class="text-center mb-0">
            <span class="section-eyebrow">{{ page_content('blog', 'page_eyebrow', app()->getLocale()) }}</span>
            <h1 class="section-title">{{ page_content('blog', 'page_title', app()->getLocale()) }}</h1>
            <p class="section-subtitle mx-auto">{{ page_content('blog', 'page_subtitle', app()->getLocale()) }}</p>
        </div>
    </div>
</section>

{{-- Blog content --}}
<section class="section-padding section-2">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                {{-- Active Filter Info --}}
                @if(request('tag') || request('category') || request('search'))
                    <div class="mb-4">
                        <span class="badge bg-primary me-2">
                            {{ page_content('blog', 'filter_label', app()->getLocale()) }}: 
                            @if(request('category')) Category: {{ request('category') }} @endif
                            @if(request('tag')) Tag: {{ request('tag') }} @endif
                            @if(request('search')) Search: "{{ request('search') }}" @endif
                        </span>
                        <a href="{{ route('blog.index') }}" class="btn btn-sm btn-outline-secondary">{{ page_content('blog', 'filter_clear', app()->getLocale()) }}</a>
                    </div>
                @endif

                @if($blogs->isEmpty())
                    <div class="text-center py-5">
                        <i class="fa-solid fa-newspaper fa-3x text-muted mb-3"></i>
                        <p class="text-muted">{{ page_content('blog', 'empty_text', app()->getLocale()) }}</p>
                        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">{{ page_content('blog', 'empty_button', app()->getLocale()) }}</a>
                    </div>
                @else
                    <style>
                        .blog-horizontal-row {
                            display: grid;
                            grid-template-columns: repeat(2, 1fr);
                            gap: 24px;
                        }
                        
                        .blog-horizontal-card {
                            display: flex;
                            flex-direction: row;
                            background: #ffffff;
                            border-radius: 16px;
                            overflow: hidden;
                            transition: all 0.3s ease;
                            border: 1px solid #e2e8f0;
                            min-height: 200px;
                        }
                        
                        .blog-horizontal-card:hover {
                            box-shadow: 0 15px 35px rgba(37, 99, 235, 0.12);
                            border-color: var(--color-primary, #2563EB);
                            transform: translateY(-5px);
                        }
                        
                        .blog-horizontal-img {
                            width: 35%;
                            min-width: 140px;
                            flex-shrink: 0;
                            position: relative;
                            overflow: hidden;
                            background: #e2e8f0;
                        }
                        
                        .blog-horizontal-img img {
                            position: absolute;
                            top: 0;
                            left: 0;
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            object-position: center;
                            transition: transform 0.4s ease;
                        }
                        
                        .blog-horizontal-card:hover .blog-horizontal-img img {
                            transform: scale(1.05);
                        }
                        
                        .blog-horizontal-content {
                            width: 65%;
                            padding: 16px 20px;
                            display: flex;
                            flex-direction: column;
                            justify-content: center;
                        }
                        
                        .blog-horizontal-badge {
                            display: inline-block;
                            background: var(--color-primary, #2563EB);
                            color: #fff;
                            padding: 3px 10px;
                            border-radius: 20px;
                            font-size: 0.65rem;
                            font-weight: 600;
                            margin-bottom: 8px;
                            width: fit-content;
                        }
                        
                        .blog-horizontal-title {
                            font-size: 0.95rem;
                            font-weight: 700;
                            color: var(--color-secondary, #0F172A);
                            margin-bottom: 6px;
                            line-height: 1.3;
                            transition: color 0.3s ease;
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                        }
                        
                        .blog-horizontal-card:hover .blog-horizontal-title {
                            color: var(--color-primary, #2563EB);
                        }
                        
                        .blog-horizontal-excerpt {
                            color: #64748b;
                            font-size: 0.8rem;
                            line-height: 1.5;
                            margin-bottom: 10px;
                            flex: 1;
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                        }
                        
                        .blog-horizontal-meta {
                            display: flex;
                            justify-content: space-between;
                            font-size: 0.7rem;
                            color: #94a3b8;
                        }
                        
                        .blog-horizontal-meta span {
                            display: flex;
                            align-items: center;
                            gap: 4px;
                        }
                        
                        .blog-horizontal-meta i {
                            color: var(--color-primary, #2563EB);
                            font-size: 0.65rem;
                        }
                        
                        .blog-horizontal-link {
                            display: inline-flex;
                            align-items: center;
                            gap: 4px;
                            color: var(--color-primary, #2563EB);
                            font-weight: 600;
                            font-size: 0.75rem;
                            text-decoration: none;
                            margin-top: 8px;
                            transition: gap 0.3s ease;
                        }
                        
                        .blog-horizontal-link:hover {
                            gap: 8px;
                            color: var(--color-primary-dark, #1d4ed8);
                        }
                        
                        @media (max-width: 992px) {
                            .blog-horizontal-row {
                                grid-template-columns: 1fr;
                            }
                            .blog-horizontal-card {
                                flex-direction: column;
                            }
                            .blog-horizontal-img {
                                width: 100%;
                                height: 180px;
                            }
                        }
                        
                        [data-theme="dark"] .blog-horizontal-card {
                            background: #1e293b;
                            border-color: #334155;
                        }
                        [data-theme="dark"] .blog-horizontal-title {
                            color: #f1f5f9;
                        }
                        [data-theme="dark"] .blog-horizontal-excerpt {
                            color: #94a3b8;
                        }
                        [data-theme="dark"] .blog-horizontal-meta {
                            color: #64748b;
                        }
                    </style>

                    <div class="blog-horizontal-row">
                        @foreach($blogs as $blog)
                            <div class="blog-horizontal-card reveal-on-scroll">
                                <div class="blog-horizontal-img">
                                    <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/2563EB/ffffff?text=' . urlencode($blog->title) }}" 
                                         alt="{{ $blog->alt_text ?? $blog->title }}" 
                                         loading="lazy">
                                </div>
                                <div class="blog-horizontal-content">
                                    @if($blog->category)
                                        <span class="blog-horizontal-badge">{{ $blog->category->name }}</span>
                                    @endif
                                    <h3 class="blog-horizontal-title">{{ $blog->title }}</h3>
                                    <p class="blog-horizontal-excerpt">{{ $blog->short_description }}</p>
                                    <div class="blog-horizontal-meta">
                                        <span>
                                            <i class="far fa-calendar-alt"></i>
                                            {{ $blog->published_at?->format('M d, Y') }}
                                        </span>
                                        <span>
                                            <i class="far fa-eye"></i>
                                            {{ $blog->views ?? 0 }}
                                        </span>
                                    </div>
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="blog-horizontal-link">
                                        Read More
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
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
                    <h6 class="mb-3">{{ page_content('blog', 'sidebar_search', app()->getLocale()) }}</h6>
                    <form action="{{ route('blog.index') }}" method="GET" class="d-flex gap-2">
                        <input type="text" name="search" class="form-control" placeholder="{{ page_content('blog', 'sidebar_search_placeholder', app()->getLocale()) }}" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary-custom"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>

                @if($categories->isNotEmpty())
                    <div class="p-4 rounded-4 border shadow-sm bg-white mb-4">
                        <h6 class="mb-3">{{ page_content('blog', 'sidebar_categories', app()->getLocale()) }}</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <a href="{{ route('blog.index', request()->except(['category'])) }}"
                                   class="d-flex justify-content-between text-decoration-none {{ !request('category') ? 'text-primary-custom fw-semibold' : 'text-dark' }}">
                                    <span><i class="fa-solid fa-chevron-right me-2 small"></i>{{ page_content('blog', 'sidebar_all_categories', app()->getLocale()) }}</span>
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
                                <i class="fa-solid fa-folder-open me-1"></i>{{ page_content('blog', 'sidebar_view_categories', app()->getLocale()) }}
                            </a>
                        </div>
                    </div>
                @endif

                @if($tags->isNotEmpty())
                    <div class="p-4 rounded-4 border shadow-sm bg-white">
                        <h6 class="mb-3">{{ page_content('blog', 'sidebar_tags', app()->getLocale()) }}</h6>
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
