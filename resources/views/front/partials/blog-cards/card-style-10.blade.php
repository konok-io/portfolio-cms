{{-- Blog Card Design 10: Gradient Border Card --}}
<div class="blog-card blog-card-style-10 h-100">
    <div class="gradient-border">
        <div class="blog-img-wrap">
            <img src="{{ $blog->featured_image_url ?? 'https://placehold.co/600x400/0F172A/ffffff?text=' . urlencode($blog->title) }}" alt="{{ $blog->alt_text ?? $blog->title }}">
            <div class="img-overlay"></div>
            @if($blog->category)
                <a href="{{ route('blog.index', ['category' => $blog->category->slug]) }}" class="category-badge">
                    {{ $blog->category->name }}
                </a>
            @endif
        </div>
        <div class="blog-content p-4">
            <div class="meta-row mb-3">
                <span class="blog-date">
                    <i class="fa-regular fa-calendar me-1"></i>{{ $blog->published_at?->format('M d, Y') }}
                </span>
            </div>
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
                <span>Continue Reading</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<style>
.blog-card-style-10 {
    padding: 4px;
    background: linear-gradient(135deg, #2563eb, #7c3aed, #ec4899, #2563eb);
    background-size: 300% 300%;
    animation: gradientMove 8s ease infinite;
    border-radius: 24px;
    transition: all 0.4s ease;
}

.blog-card-style-10:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(37, 99, 235, 0.3);
}

@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.blog-card-style-10 .gradient-border {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    height: 100%;
}

.blog-card-style-10:hover .gradient-border {
    background: #fff;
}

.blog-card-style-10 .blog-img-wrap {
    position: relative;
    aspect-ratio: 16/10;
    overflow: hidden;
}

.blog-card-style-10 .blog-img-wrap > img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.blog-card-style-10:hover .blog-img-wrap > img {
    transform: scale(1.08);
}

.blog-card-style-10 .img-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(37, 99, 235, 0.1), rgba(124, 58, 237, 0.1));
    opacity: 0;
    transition: opacity 0.4s ease;
}

.blog-card-style-10:hover .img-overlay {
    opacity: 1;
}

.blog-card-style-10 .category-badge {
    position: absolute;
    top: 16px;
    left: 16px;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    color: #fff;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
}

.blog-card-style-10 .category-badge:hover {
    background: linear-gradient(135deg, #1d4ed8, #6d28d9);
}

.blog-card-style-10 .blog-date {
    font-size: 0.8rem;
    color: #6b7280;
}

.blog-card-style-10 .blog-title {
    font-weight: 700;
    line-height: 1.4;
}

.blog-card-style-10 .blog-title a {
    color: #1f2937;
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-card-style-10 .blog-title a:hover {
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.blog-card-style-10 .blog-excerpt {
    color: #6b7280;
    font-size: 0.9rem;
    line-height: 1.6;
}

.blog-card-style-10 .tag-pill {
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.08), rgba(124, 58, 237, 0.08));
    color: #7c3aed;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.7rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-10 .tag-pill:hover {
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    color: #fff;
}

.blog-card-style-10 .read-more-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.blog-card-style-10:hover .read-more-link {
    gap: 12px;
}

.blog-card-style-10 .read-more-link i {
    color: #2563eb;
    -webkit-text-fill-color: #2563eb;
    transition: transform 0.3s ease;
}

.blog-card-style-10:hover .read-more-link i {
    transform: translateX(4px);
}
</style>
