@extends('front.layouts.app')

@section('title', ($blog->meta_title ?: $blog->title) . ' | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', $blog->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($blog->description), 160))
@section('meta_keywords', $blog->meta_keywords)

{{-- Article Structured Data --}}
@section('jsonld')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "{{ $blog->title }}",
    "description": "{{ $blog->short_description ?? \Illuminate\Support\Str::limit(strip_tags($blog->description), 160) }}",
    "image": "{{ $blog->featured_image_url ?? '' }}",
    "datePublished": "{{ $blog->published_at?->toIso8601String() }}",
    "dateModified": "{{ $blog->updated_at?->toIso8601String() }}",
    "author": {
        "@type": "Person",
        "name": "{{ $blog->author?->name ?? $siteSetting->site_name ?? 'Author' }}",
        "url": "{{ url('/') }}"
    },
    "publisher": {
        "@type": "Organization",
        "name": "{{ $siteSetting->site_name ?? 'Portfolio CMS' }}",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ $siteSetting && $siteSetting->favicon ? asset('storage/' . $siteSetting->favicon) : url('/favicon.ico') }}"
        }
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ route('blog.show', $blog->slug) }}"
    }
}
</script>
@endsection

@section('content')

<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
                @if($blog->category)
                    <li class="breadcrumb-item"><a href="{{ route('blog.index', ['category' => $blog->category->slug]) }}">{{ $blog->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($blog->title, 30) }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    @if($blog->category)
                        <span class="section-eyebrow">{{ $blog->category->name }}</span>
                    @endif
                    <h1 class="section-title">{{ $blog->title }}</h1>
                    <div class="d-flex flex-wrap gap-4 small text-muted mt-3">
                        <span><i class="fa-solid fa-user me-1"></i>{{ $blog->author->name ?? 'Admin' }}</span>
                        <span><i class="fa-regular fa-calendar me-1"></i>{{ $blog->published_at?->format('M d, Y') }}</span>
                        <span><i class="fa-regular fa-clock me-1"></i>{{ ceil(strlen(strip_tags($blog->description)) / 1000) }} min read</span>
                        <span><i class="fa-regular fa-eye me-1"></i>{{ $blog->views }} views</span>
                    </div>
                </div>

                <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/1000x600/0F172A/ffffff?text=' . urlencode($blog->title) }}"
                     alt="{{ $blog->title }}" class="img-fluid rounded-4 shadow-sm mb-4 w-100" style="aspect-ratio: 16/9; object-fit: cover;">

                <article class="content-body">
                    {!! $blog->description !!}
                </article>

                {{-- Social Share Buttons - Professional --}}
                <div class="share-section mt-4 pt-4 border-top">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <h6 class="mb-1 share-title">Share this article</h6>
                            <p class="text-muted small mb-0">If you found this helpful, share it with your network</p>
                        </div>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="share-btn facebook" title="Share on Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                                <span>Facebook</span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" target="_blank" class="share-btn twitter" title="Share on Twitter">
                                <i class="fa-brands fa-x-twitter"></i>
                                <span>Twitter</span>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($blog->title) }}" target="_blank" class="share-btn linkedin" title="Share on LinkedIn">
                                <i class="fa-brands fa-linkedin-in"></i>
                                <span>LinkedIn</span>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($blog->title . ' ' . request()->url()) }}" target="_blank" class="share-btn whatsapp" title="Share on WhatsApp">
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

                @if($relatedBlogs->isNotEmpty())
                    <div class="mt-5 pt-4 border-top">
                        <h5 class="mb-4">Related Articles</h5>
                        <div class="row g-4">
                            @foreach($relatedBlogs as $related)
                                <div class="col-md-4">
                                    <div class="blog-card h-100">
                                        <div class="blog-img-wrap">
                                            <img src="{{ $related->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($related->title) }}" alt="{{ $related->title }}">
                                        </div>
                                        <div class="p-3">
                                            <h6 class="mb-2"><a href="{{ route('blog.show', $related->slug) }}" class="text-decoration-none text-dark">{{ $related->title }}</a></h6>
                                            <a href="{{ route('blog.show', $related->slug) }}" class="small text-primary-custom fw-semibold">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="p-4 rounded-4 border shadow-sm sticky-top" style="top: 100px;">
                    <h6 class="mb-3">About the Author</h6>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ $blog->author->avatar_url ?? 'https://ui-avatars.com/api/?name=Admin&background=2563EB&color=fff' }}" alt="Author" width="56" height="56" class="rounded-circle object-fit-cover">
                        <div>
                            <h6 class="mb-0">{{ $blog->author->name ?? 'Admin' }}</h6>
                            <span class="small text-muted">Author</span>
                        </div>
                    </div>
                    <a href="{{ route('home') }}#contact" class="btn btn-primary-custom w-100">Get in Touch</a>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <a href="{{ route('blog.index') }}" class="btn btn-outline-custom">
                <i class="fa-solid fa-arrow-left me-2"></i>Back to Blog
            </a>
        </div>
    </div>
</section>

@endsection
