@extends('front.layouts.app')

@section('title', ($blog->meta_title ?: $blog->title) . ' | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', $blog->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($blog->description), 160))
@section('meta_keywords', $blog->meta_keywords)

@php
    $breadcrumbs = [
        ['title' => 'Blog', 'url' => route('blog.index')],
        ['title' => $blog->title, 'url' => null, 'active' => true]
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
                     alt="{{ $blog->title }}" class="img-fluid rounded-4 shadow-sm mb-4 w-100" style="aspect-ratio: 16/9; object-fit: cover;" loading="lazy">

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
                
                {{-- Comments Section --}}
                <div class="mt-5 pt-4 border-top" id="comments">
                    <h5 class="mb-4">
                        <i class="fa-solid fa-comments me-2"></i>Comments ({{ $blog->allComments->where('is_approved', true)->count() }})
                    </h5>
                    
                    {{-- Comment Form --}}
                    <div class="card mb-4">
                        <div class="card-body p-4">
                            <h6 class="mb-3">Leave a Comment</h6>
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <form method="POST" action="{{ route('blog.comments.store', $blog) }}">
                                @csrf
                                
                                {{-- Honeypot spam protection - hidden from users --}}
                                <div class="honeypot-field" aria-hidden="true">
                                    <input type="text" name="homepage" tabindex="-1" autocomplete="off">
                                </div>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Name *</label>
                                        <input type="text" name="name" class="form-control" required placeholder="Your name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email *</label>
                                        <input type="email" name="email" class="form-control" required placeholder="your@email.com">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Website</label>
                                        <input type="url" name="website" class="form-control" placeholder="https://yoursite.com">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Comment *</label>
                                        <textarea name="comment" class="form-control" rows="4" required placeholder="Share your thoughts..."></textarea>
                                    </div>
                                    <div class="col-12">
                                        @if($siteSetting->isRecaptchaEnabled())
                                            <div class="mb-3">
                                                <div class="g-recaptcha" data-sitekey="{{ $siteSetting->recaptcha_site_key }}"></div>
                                                @error('recaptcha')
                                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        @endif
                                        <button type="submit" class="btn btn-primary-custom">
                                            <i class="fa-solid fa-paper-plane me-2"></i>Post Comment
                                        </button>
                                        <small class="text-muted ms-2">Your comment will be reviewed before publishing.</small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    {{-- Comments List --}}
                    @php
                        $approvedComments = $blog->comments->where('is_approved', true)->whereNull('parent_id');
                    @endphp
                    @if($approvedComments->isEmpty())
                        <p class="text-muted">No comments yet. Be the first to share your thoughts!</p>
                    @else
                        @foreach($approvedComments as $comment)
                            <div class="comment-item mb-4">
                                <div class="d-flex gap-3">
                                    <div class="flex-shrink-0">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->name) }}&background=4F2FE8&color=fff" alt="{{ $comment->name }}" width="48" height="48" class="rounded-circle">
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="bg-light rounded-3 p-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <strong>{{ $comment->name }}</strong>
                                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-0">{{ $comment->comment }}</p>
                                        </div>
                                        @if($comment->replies->where('is_approved', true)->isNotEmpty())
                                            @foreach($comment->replies->where('is_approved', true) as $reply)
                                                <div class="d-flex gap-3 mt-3 ms-4">
                                                    <div class="flex-shrink-0">
                                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($reply->name) }}&background=3A356E&color=fff" alt="{{ $reply->name }}" width="36" height="36" class="rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="bg-light rounded-3 p-3">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <strong>{{ $reply->name }}</strong>
                                                                <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                                            </div>
                                                            <p class="mb-0">{{ $reply->comment }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
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

@push('scripts')
@if($siteSetting->isRecaptchaEnabled())
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif
@endpush
