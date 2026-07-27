{{-- Blog Card Design 6: Magazine Style --}}
<div class="blog-card blog-card-style-6 h-100">
    <div class="blog-img-wrap">
        @if($blog->category)
            <a href="{{ route('blog.index', ['category' => $blog->category->slug]) }}" class="category-badge">
                {{ $blog->category->name }}
            </a>
        @endif
        <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title) }}" alt="{{ $blog->alt_text ?? $blog->title }}">
        <div class="img-overlay"></div>
    </div>
    <div class="blog-content p-4">
        <div class="d-flex align-items-center mb-3">
            <span class="blog-date">
                <i class="fa-regular fa-calendar me-1"></i>{{ $blog->published_at?->format('M d, Y') }}
            </span>
            <span class="read-time ms-3">
                <i class="fa-regular fa-clock me-1"></i>5 min read
            </span>
        </div>
        <h5 class="blog-title mb-3">
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
        <div class="author-info d-flex align-items-center">
            <div class="author-avatar me-2">
                <i class="fa-solid fa-user"></i>
            </div>
            <span class="author-name">Author</span>
            <a href="{{ route('blog.show', $blog->slug) }}" class="read-more-link ms-auto">
                Read <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<style>
.blog-card-style-6 {
    border-radius: 20px;
    overflow: hidden;
    background: #fff;
    border: 1px solid #e5e7eb;
    transition: all 0.4s ease;
}

.blog-card-style-6:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0,0,0,0.12);
    border-color: transparent;
}

.blog-card-style-6 .blog-img-wrap {
    position: relative;
    aspect-ratio: 16/10;
    overflow: hidden;
}

.blog-card-style-6 .blog-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.blog-card-style-6:hover .blog-img-wrap img {
    transform: scale(1.1);
}

.blog-card-style-6 .img-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50%;
    background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
    pointer-events: none;
}

.blog-card-style-6 .category-badge {
    position: absolute;
    top: 16px;
    left: 16px;
    z-index: 2;
    background: #ef4444;
    color: #fff;
    padding: 6px 14px;
    border-radius: 25px;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-6 .category-badge:hover {
    background: #dc2626;
    transform: translateY(-2px);
}

.blog-card-style-6 .blog-date,
.blog-card-style-6 .read-time {
    font-size: 0.8rem;
    color: #6b7280;
}

.blog-card-style-6 .blog-title {
    font-weight: 800;
    line-height: 1.3;
    font-size: 1.15rem;
}

.blog-card-style-6 .blog-title a {
    color: #1f2937;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-card-style-6 .blog-title a:hover {
    color: #2563eb;
}

.blog-card-style-6 .blog-excerpt {
    color: #6b7280;
    font-size: 0.9rem;
    line-height: 1.6;
}

.blog-card-style-6 .tag-pill {
    background: #f3f4f6;
    color: #6b7280;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.7rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-6 .tag-pill:hover {
    background: #2563eb;
    color: #fff;
}

.blog-card-style-6 .author-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6b7280;
}

.blog-card-style-6 .author-name {
    font-size: 0.85rem;
    font-weight: 500;
    color: #374151;
}

.blog-card-style-6 .read-more-link {
    color: #2563eb;
    font-weight: 600;
    font-size: 0.85rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: gap 0.3s ease;
}

.blog-card-style-6:hover .read-more-link {
    gap: 8px;
}
</style>
