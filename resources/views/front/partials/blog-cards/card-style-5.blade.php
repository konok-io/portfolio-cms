{{-- Blog Card Design 5: Side Accent Card --}}
<div class="blog-card blog-card-style-5 h-100">
    <div class="row g-0 h-100">
        <div class="col-4">
            <div class="blog-img-wrap h-100">
                <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title) }}" alt="{{ $blog->alt_text ?? $blog->title }}">
            </div>
        </div>
        <div class="col-8">
            <div class="blog-content p-3 d-flex flex-column justify-content-center h-100">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    @if($blog->category)
                        <a href="{{ route('blog.index', ['category' => $blog->category->slug]) }}" class="category-badge">
                            {{ $blog->category->name }}
                        </a>
                    @endif
                    <span class="blog-date">{{ $blog->published_at?->format('M d, Y') }}</span>
                </div>
                <h6 class="blog-title mb-2">
                    <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                </h6>
                <p class="blog-excerpt">{{ $blog->short_description }}</p>
                @if($blog->tags->isNotEmpty())
                    <div class="blog-tags mt-auto">
                        @foreach($blog->tags->take(2) as $tag)
                            <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" class="tag-pill">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card-accent"></div>
</div>

<style>
.blog-card-style-5 {
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
    position: relative;
}

.blog-card-style-5 .card-accent {
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #10b981, #059669);
    transform: scaleY(0);
    transform-origin: top;
    transition: transform 0.3s ease;
}

.blog-card-style-5:hover {
    transform: translateY(-3px) translateX(5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    border-color: transparent;
}

.blog-card-style-5:hover .card-accent {
    transform: scaleY(1);
}

.blog-card-style-5 .blog-img-wrap {
    overflow: hidden;
}

.blog-card-style-5 .blog-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.blog-card-style-5:hover .blog-img-wrap img {
    transform: scale(1.1);
}

.blog-card-style-5 .category-badge {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    padding: 2px 10px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-5 .category-badge:hover {
    background: #10b981;
    color: #fff;
}

.blog-card-style-5 .blog-date {
    font-size: 0.75rem;
    color: #6b7280;
}

.blog-card-style-5 .blog-title {
    font-weight: 700;
    line-height: 1.4;
}

.blog-card-style-5 .blog-title a {
    color: #1f2937;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-card-style-5 .blog-title a:hover {
    color: #10b981;
}

.blog-card-style-5 .blog-excerpt {
    color: #6b7280;
    font-size: 0.8rem;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.blog-card-style-5 .tag-pill {
    background: #f3f4f6;
    color: #6b7280;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.65rem;
    text-decoration: none;
}

@media (max-width: 576px) {
    .blog-card-style-5 .col-4 {
        flex: 0 0 40%;
        max-width: 40%;
    }
    .blog-card-style-5 .col-8 {
        flex: 0 0 60%;
        max-width: 60%;
    }
}
</style>
