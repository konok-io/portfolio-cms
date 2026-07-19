@extends('front.layouts.app')

@section('title', ($blog->meta_title ?: $blog->title) . ' | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', $blog->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($blog->description), 160))
@section('meta_keywords', $blog->meta_keywords)

@section('content')

<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    @if($blog->category)
                        <span class="section-eyebrow">{{ $blog->category->name }}</span>
                    @endif
                    <h1 class="section-title">{{ $blog->title }}</h1>
                    <div class="d-flex gap-4 small text-muted mt-3">
                        <span><i class="fa-solid fa-user me-1"></i>{{ $blog->author->name ?? 'Admin' }}</span>
                        <span><i class="fa-regular fa-calendar me-1"></i>{{ $blog->published_at?->format('M d, Y') }}</span>
                        <span><i class="fa-regular fa-eye me-1"></i>{{ $blog->views }} views</span>
                    </div>
                </div>

                <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/1000x600/0F172A/ffffff?text=' . urlencode($blog->title) }}"
                     alt="{{ $blog->title }}" class="img-fluid rounded-4 shadow-sm mb-4 w-100" style="aspect-ratio: 16/9; object-fit: cover;">

                <article class="content-body">
                    {!! $blog->description !!}
                </article>

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
