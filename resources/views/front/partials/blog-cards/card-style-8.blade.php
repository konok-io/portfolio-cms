{{-- Blog Card Design 8: Image Focus Card --}}
<div class="blog-card blog-card-style-8 h-100">
    <div class="blog-img-wrap">
        <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title) }}" alt="{{ $blog->alt_text ?? $blog->title }}">
        <div class="img-overlay">
            <div class="overlay-content">
                @if($blog->category)
                    <a href="{{ route('blog.index', ['category' => $blog->category->slug]) }}" class="category-badge">
                        {{ $blog->category->name }}
                    </a>
                @endif
                <div class="meta-info mt-3">
                    <span class="blog-date">{{ $blog->published_at?->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-content">
        <div class="content-inner">
            <h5 class="blog-title mb-2">
                <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
            </h5>
            <p class="blog-excerpt">{{ $blog->short_description }}</p>
            @if($blog->tags->isNotEmpty())
                <div class="blog-tags mb-3">
                    @foreach($blog->tags->take(3) as $tag)
                        <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" class="tag-pill">{{ $tag->name }}</a>
                    @endforeach
                </div>
            @endif
            <a href="{{ route('blog.show', $blog->slug) }}" class="read-more-link">
                <span>Read Article</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<style>
.blog-card-style-8 {
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    border: 1px solid #e5e7eb;
    transition: all 0.4s ease;
}

.blog-card-style-8:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0,0,0,0.15);
    border-color: transparent;
}

.blog-card-style-8 .blog-img-wrap {
    position: relative;
    aspect-ratio: 16/12;
    overflow: hidden;
}

.blog-card-style-8 .blog-img-wrap > img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.blog-card-style-8:hover .blog-img-wrap > img {
    transform: scale(1.15);
}

.blog-card-style-8 .img-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(180deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0.6) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
    display: flex;
    align-items: flex-end;
}

.blog-card-style-8:hover .img-overlay {
    opacity: 1;
}

.blog-card-style-8 .overlay-content {
    padding: 20px;
    width: 100%;
}

.blog-card-style-8 .category-badge {
    background: #f59e0b;
    color: #fff;
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
}

.blog-card-style-8 .blog-date {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.9);
}

.blog-card-style-8 .content-inner {
    padding: 20px;
}

.blog-card-style-8 .blog-title {
    font-weight: 700;
    line-height: 1.4;
}

.blog-card-style-8 .blog-title a {
    color: #1f2937;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-card-style-8 .blog-title a:hover {
    color: #f59e0b;
}

.blog-card-style-8 .blog-excerpt {
    color: #6b7280;
    font-size: 0.85rem;
    line-height: 1.6;
}

.blog-card-style-8 .tag-pill {
    background: #fef3c7;
    color: #d97706;
    padding: 3px 10px;
    border-radius: 15px;
    font-size: 0.7rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-8 .tag-pill:hover {
    background: #f59e0b;
    color: #fff;
}

.blog-card-style-8 .read-more-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #f59e0b;
    font-weight: 700;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-8 .read-more-link:hover {
    gap: 12px;
    color: #d97706;
}

.blog-card-style-8 .read-more-link i {
    transition: transform 0.3s ease;
}

.blog-card-style-8:hover .read-more-link i {
    transform: translateX(4px);
}
</style>
