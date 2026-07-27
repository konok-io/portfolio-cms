{{-- Blog Card Design 1: Classic Card --}}
<div class="blog-card blog-card-style-1 h-100">
    <div class="blog-img-wrap">
        <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title) }}" alt="{{ $blog->alt_text ?? $blog->title }}">
    </div>
    <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            @if($blog->category)
                <a href="{{ route('blog.index', ['category' => $blog->category->slug]) }}" class="category-badge">
                    {{ $blog->category->name }}
                </a>
            @endif
            <span class="blog-date">{{ $blog->published_at?->format('M d, Y') }}</span>
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
        <a href="{{ route('blog.show', $blog->slug) }}" class="read-more-link">
            Read More <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</div>

<style>
.blog-card-style-1 {
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.blog-card-style-1:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    border-color: transparent;
}

.blog-card-style-1 .blog-img-wrap {
    aspect-ratio: 16/10;
    overflow: hidden;
}

.blog-card-style-1 .blog-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.blog-card-style-1:hover .blog-img-wrap img {
    transform: scale(1.05);
}

.blog-card-style-1 .category-badge {
    background: rgba(37, 99, 235, 0.1);
    color: #2563eb;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-1 .category-badge:hover {
    background: #2563eb;
    color: #fff;
}

.blog-card-style-1 .blog-date {
    font-size: 0.8rem;
    color: #6b7280;
}

.blog-card-style-1 .blog-title {
    font-weight: 700;
    line-height: 1.4;
}

.blog-card-style-1 .blog-title a {
    color: #1f2937;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-card-style-1 .blog-title a:hover {
    color: #2563eb;
}

.blog-card-style-1 .blog-excerpt {
    color: #6b7280;
    font-size: 0.9rem;
    line-height: 1.6;
}

.blog-card-style-1 .tag-pill {
    background: #f3f4f6;
    color: #6b7280;
    padding: 3px 10px;
    border-radius: 15px;
    font-size: 0.7rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-1 .tag-pill:hover {
    background: #e5e7eb;
    color: #374151;
}

.blog-card-style-1 .read-more-link {
    color: #2563eb;
    font-weight: 600;
    font-size: 0.85rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: gap 0.3s ease;
}

.blog-card-style-1 .read-more-link:hover {
    gap: 10px;
}

.blog-card-style-1 .read-more-link i {
    transition: transform 0.3s ease;
}

.blog-card-style-1:hover .read-more-link i {
    transform: translateX(4px);
}
</style>
