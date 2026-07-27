{{-- Blog Card Design 9: Modern Dark Card --}}
<div class="blog-card blog-card-style-9 h-100">
    <div class="blog-img-wrap">
        <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title) }}" alt="{{ $blog->alt_text ?? $blog->title }}">
        <div class="img-gradient"></div>
        @if($blog->category)
            <a href="{{ route('blog.index', ['category' => $blog->category->slug]) }}" class="category-badge">
                {{ $blog->category->name }}
            </a>
        @endif
        <span class="blog-date">{{ $blog->published_at?->format('M d, Y') }}</span>
    </div>
    <div class="blog-content p-4">
        <div class="content-wrapper">
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
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('blog.show', $blog->slug) }}" class="read-more-btn">
                    Read More
                </a>
                <div class="share-icon">
                    <i class="fa-solid fa-share-nodes"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.blog-card-style-9 {
    border-radius: 20px;
    overflow: hidden;
    background: linear-gradient(145deg, #1e293b, #0f172a);
    border: 1px solid #334155;
    transition: all 0.4s ease;
}

.blog-card-style-9:hover {
    transform: translateY(-10px) rotateX(2deg);
    box-shadow: 0 30px 60px rgba(0,0,0,0.4);
    border-color: #475569;
}

.blog-card-style-9 .blog-img-wrap {
    position: relative;
    aspect-ratio: 16/9;
    overflow: hidden;
}

.blog-card-style-9 .blog-img-wrap > img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.blog-card-style-9:hover .blog-img-wrap > img {
    transform: scale(1.1);
}

.blog-card-style-9 .img-gradient {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 60%;
    background: linear-gradient(to top, rgba(15, 23, 42, 0.9), transparent);
    pointer-events: none;
}

.blog-card-style-9 .category-badge {
    position: absolute;
    top: 16px;
    left: 16px;
    background: linear-gradient(135deg, #06b6d4, #0891b2);
    color: #fff;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    z-index: 2;
}

.blog-card-style-9 .blog-date {
    position: absolute;
    bottom: 16px;
    right: 16px;
    font-size: 0.8rem;
    color: rgba(255,255,255,0.8);
    z-index: 2;
}

.blog-card-style-9 .blog-title {
    font-weight: 700;
    line-height: 1.4;
}

.blog-card-style-9 .blog-title a {
    color: #f1f5f9;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-card-style-9 .blog-title a:hover {
    color: #06b6d4;
}

.blog-card-style-9 .blog-excerpt {
    color: #94a3b8;
    font-size: 0.85rem;
    line-height: 1.6;
}

.blog-card-style-9 .tag-pill {
    background: rgba(6, 182, 212, 0.15);
    color: #06b6d4;
    padding: 3px 10px;
    border-radius: 15px;
    font-size: 0.7rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-9 .tag-pill:hover {
    background: rgba(6, 182, 212, 0.3);
}

.blog-card-style-9 .read-more-btn {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
    color: #fff;
    padding: 8px 20px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.8rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-9 .read-more-btn:hover {
    background: linear-gradient(135deg, #0891b2, #0e7490);
    transform: translateY(-2px);
}

.blog-card-style-9 .share-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    cursor: pointer;
    transition: all 0.3s ease;
}

.blog-card-style-9 .share-icon:hover {
    background: #06b6d4;
    color: #fff;
}
</style>
