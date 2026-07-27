{{-- Blog Card Design 7: Rounded Pill Style --}}
<div class="blog-card blog-card-style-7 h-100">
    <div class="blog-img-wrap">
        <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title) }}" alt="{{ $blog->alt_text ?? $blog->title }}">
        <div class="floating-badge">
            @if($blog->category)
                <a href="{{ route('blog.index', ['category' => $blog->category->slug]) }}" class="category-badge">
                    {{ $blog->category->name }}
                </a>
            @endif
        </div>
    </div>
    <div class="blog-content p-4">
        <span class="blog-date">{{ $blog->published_at?->format('M d, Y') }}</span>
        <h5 class="blog-title mt-2 mb-2">
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
        <a href="{{ route('blog.show', $blog->slug) }}" class="read-more-btn">
            Read More
        </a>
    </div>
</div>

<style>
.blog-card-style-7 {
    border-radius: 32px;
    overflow: hidden;
    background: #fff;
    border: 1px solid #e5e7eb;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.blog-card-style-7:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 25px 50px rgba(99, 102, 241, 0.15);
    border-color: #6366f1;
}

.blog-card-style-7 .blog-img-wrap {
    position: relative;
    aspect-ratio: 1/1;
    overflow: hidden;
    border-radius: 24px 24px 0 0;
}

.blog-card-style-7 .blog-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.blog-card-style-7:hover .blog-img-wrap img {
    transform: scale(1.1);
}

.blog-card-style-7 .floating-badge {
    position: absolute;
    top: 12px;
    right: 12px;
}

.blog-card-style-7 .category-badge {
    background: #6366f1;
    color: #fff;
    padding: 6px 16px;
    border-radius: 25px;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
    transition: all 0.3s ease;
}

.blog-card-style-7 .category-badge:hover {
    background: #4f46e5;
    transform: translateY(-2px);
}

.blog-card-style-7 .blog-date {
    font-size: 0.8rem;
    color: #9ca3af;
    font-weight: 500;
}

.blog-card-style-7 .blog-title {
    font-weight: 800;
    line-height: 1.3;
}

.blog-card-style-7 .blog-title a {
    color: #1e1b4b;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-card-style-7 .blog-title a:hover {
    color: #6366f1;
}

.blog-card-style-7 .blog-excerpt {
    color: #6b7280;
    font-size: 0.85rem;
    line-height: 1.6;
}

.blog-card-style-7 .tag-pill {
    background: #f0f0ff;
    color: #6366f1;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-7 .tag-pill:hover {
    background: #6366f1;
    color: #fff;
}

.blog-card-style-7 .read-more-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 12px 24px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: #fff;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-7 .read-more-btn:hover {
    background: linear-gradient(135deg, #4f46e5, #7c3aed);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
}
</style>
