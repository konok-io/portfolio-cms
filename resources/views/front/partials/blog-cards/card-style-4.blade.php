{{-- Blog Card Design 4: Overlay Card --}}
<div class="blog-card blog-card-style-4 h-100">
    <div class="blog-img-wrap">
        <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title) }}" alt="{{ $blog->alt_text ?? $blog->title }}">
        <div class="blog-overlay">
            <div class="overlay-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    @if($blog->category)
                        <a href="{{ route('blog.index', ['category' => $blog->category->slug]) }}" class="category-badge">
                            {{ $blog->category->name }}
                        </a>
                    @endif
                    <span class="blog-date">{{ $blog->published_at?->format('M d, Y') }}</span>
                </div>
                <h5 class="blog-title mb-2">
                    <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                </h5>
                <p class="blog-excerpt">{{ $blog->short_description }}</p>
                @if($blog->tags->isNotEmpty())
                    <div class="blog-tags">
                        @foreach($blog->tags->take(3) as $tag)
                            <a href="{{ route('blog.index', ['tag' => $tag->slug]) }}" class="tag-pill">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                @endif
                <a href="{{ route('blog.show', $blog->slug) }}" class="read-more-link mt-3">
                    Read More <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.blog-card-style-4 {
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.blog-card-style-4:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    border-color: transparent;
}

.blog-card-style-4 .blog-img-wrap {
    position: relative;
    aspect-ratio: 4/3;
    overflow: hidden;
}

.blog-card-style-4 .blog-img-wrap > img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.blog-card-style-4:hover .blog-img-wrap > img {
    transform: scale(1.1);
}

.blog-card-style-4 .blog-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(180deg, rgba(15, 23, 42, 0.1) 0%, rgba(15, 23, 42, 0.95) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
    display: flex;
    align-items: flex-end;
}

.blog-card-style-4:hover .blog-overlay {
    opacity: 1;
}

.blog-card-style-4 .overlay-content {
    padding: 24px;
    width: 100%;
    color: #fff;
}

.blog-card-style-4 .category-badge {
    background: #fff;
    color: #2563eb;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
}

.blog-card-style-4 .blog-date {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.8);
}

.blog-card-style-4 .blog-title {
    font-weight: 700;
    line-height: 1.4;
}

.blog-card-style-4 .blog-title a {
    color: #fff;
    text-decoration: none;
}

.blog-card-style-4 .blog-excerpt {
    color: rgba(255,255,255,0.9);
    font-size: 0.85rem;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.blog-card-style-4 .tag-pill {
    background: rgba(255,255,255,0.2);
    color: #fff;
    padding: 3px 10px;
    border-radius: 15px;
    font-size: 0.7rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-4 .tag-pill:hover {
    background: rgba(255,255,255,0.3);
}

.blog-card-style-4 .read-more-link {
    color: #fff;
    font-weight: 600;
    font-size: 0.85rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: gap 0.3s ease;
}

.blog-card-style-4:hover .read-more-link {
    gap: 10px;
}
</style>
