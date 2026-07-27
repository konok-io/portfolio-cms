{{-- Blog Card Design 2: Horizontal Card --}}
<div class="blog-card blog-card-style-2 h-100">
    <div class="row g-0 h-100">
        <div class="col-md-5">
            <div class="blog-img-wrap h-100">
                <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title) }}" alt="{{ $blog->alt_text ?? $blog->title }}">
            </div>
        </div>
        <div class="col-md-7">
            <div class="blog-content p-4 d-flex flex-column justify-content-center h-100">
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
    </div>
</div>

<style>
.blog-card-style-2 {
    border-radius: 16px;
    overflow: hidden;
    background: #fff;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.blog-card-style-2:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    border-color: transparent;
}

.blog-card-style-2 .blog-img-wrap {
    overflow: hidden;
    position: relative;
}

.blog-card-style-2 .blog-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.blog-card-style-2:hover .blog-img-wrap img {
    transform: scale(1.08);
}

.blog-card-style-2 .blog-content {
    background: #fff;
}

.blog-card-style-2 .category-badge {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
}

.blog-card-style-2 .blog-date {
    font-size: 0.8rem;
    color: #6b7280;
}

.blog-card-style-2 .blog-title {
    font-weight: 700;
    line-height: 1.4;
}

.blog-card-style-2 .blog-title a {
    color: #1f2937;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-card-style-2 .blog-title a:hover {
    color: #2563eb;
}

.blog-card-style-2 .blog-excerpt {
    color: #6b7280;
    font-size: 0.85rem;
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.blog-card-style-2 .tag-pill {
    background: #f3f4f6;
    color: #6b7280;
    padding: 3px 10px;
    border-radius: 15px;
    font-size: 0.7rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-2 .tag-pill:hover {
    background: #2563eb;
    color: #fff;
}

.blog-card-style-2 .read-more-link {
    color: #2563eb;
    font-weight: 600;
    font-size: 0.85rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
}

.blog-card-style-2:hover .read-more-link {
    gap: 10px;
}

@media (max-width: 768px) {
    .blog-card-style-2 .row {
        flex-direction: column;
    }
    .blog-card-style-2 .blog-img-wrap {
        aspect-ratio: 16/9;
    }
}
</style>
