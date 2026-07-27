@extends('layouts.front')

@section('title', 'Blog Card Designs Preview')

@section('content')
<section class="section-padding section-1">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="section-title">Blog Card Design Collection</h1>
            <p class="section-subtitle">10 beautiful blog card designs to choose from</p>
        </div>
    </div>
</section>

{{-- Design 1 --}}
<section class="section-padding section-2">
    <div class="container">
        <div class="design-header mb-4">
            <h3 class="design-number">01</h3>
            <h4 class="design-title">Classic Card</h4>
            <p class="design-desc">Standard card with image top, content below. Clean and familiar.</p>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                @include('front.partials.blog-cards.card-style-1', ['blog' => (object)[
                    'title' => 'Getting Started with Laravel 10',
                    'short_description' => 'Learn the fundamentals of Laravel 10 and build your first web application with this comprehensive guide.',
                    'featured_image_url' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&h=400&fit=crop',
                    'category' => (object)['name' => 'Laravel', 'slug' => 'laravel'],
                    'tags' => collect([['name' => 'PHP', 'slug' => 'php'], ['name' => 'Tutorial', 'slug' => 'tutorial']]),
                    'published_at' => now()
                ]])
            </div>
        </div>
    </div>
</section>

{{-- Design 2 --}}
<section class="section-padding section-1">
    <div class="container">
        <div class="design-header mb-4">
            <h3 class="design-number">02</h3>
            <h4 class="design-title">Horizontal Card</h4>
            <p class="design-desc">Image on the left, content on the right. Great for list views.</p>
        </div>
        <div class="row">
            <div class="col-lg-8 mb-4">
                @include('front.partials.blog-cards.card-style-2', ['blog' => (object)[
                    'title' => 'Building Modern Web Apps with React',
                    'short_description' => 'Discover how to build responsive and interactive web applications using React and modern JavaScript features.',
                    'featured_image_url' => 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=600&h=400&fit=crop',
                    'category' => (object)['name' => 'React', 'slug' => 'react'],
                    'tags' => collect([['name' => 'JavaScript', 'slug' => 'javascript'], ['name' => 'Frontend', 'slug' => 'frontend']]),
                    'published_at' => now()
                ]])
            </div>
        </div>
    </div>
</section>

{{-- Design 3 --}}
<section class="section-padding section-2">
    <div class="container">
        <div class="design-header mb-4">
            <h3 class="design-number">03</h3>
            <h4 class="design-title">Minimal Text Card</h4>
            <p class="design-desc">No image, text-focused design with left accent border.</p>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                @include('front.partials.blog-cards.card-style-3', ['blog' => (object)[
                    'title' => '10 Tips for Better Code Quality',
                    'short_description' => 'Improve your coding skills with these essential tips for writing cleaner, more maintainable code.',
                    'featured_image_url' => null,
                    'category' => (object)['name' => 'Best Practices', 'slug' => 'best-practices'],
                    'tags' => collect([['name' => 'Coding', 'slug' => 'coding'], ['name' => 'Tips', 'slug' => 'tips']]),
                    'published_at' => now()
                ]])
            </div>
        </div>
    </div>
</section>

{{-- Design 4 --}}
<section class="section-padding section-1">
    <div class="container">
        <div class="design-header mb-4">
            <h3 class="design-number">04</h3>
            <h4 class="design-title">Overlay Card</h4>
            <p class="design-desc">Image with overlay content that reveals on hover.</p>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                @include('front.partials.blog-cards.card-style-4', ['blog' => (object)[
                    'title' => 'Mastering CSS Grid Layout',
                    'short_description' => 'A complete guide to CSS Grid including practical examples and real-world use cases.',
                    'featured_image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&h=400&fit=crop',
                    'category' => (object)['name' => 'CSS', 'slug' => 'css'],
                    'tags' => collect([['name' => 'Layout', 'slug' => 'layout'], ['name' => 'Design', 'slug' => 'design']]),
                    'published_at' => now()
                ]])
            </div>
        </div>
    </div>
</section>

{{-- Design 5 --}}
<section class="section-padding section-2">
    <div class="container">
        <div class="design-header mb-4">
            <h3 class="design-number">05</h3>
            <h4 class="design-title">Side Accent Card</h4>
            <p class="design-desc">Compact horizontal card with green accent on hover.</p>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-4">
                @include('front.partials.blog-cards.card-style-5', ['blog' => (object)[
                    'title' => 'Node.js Performance Optimization',
                    'short_description' => 'Learn how to optimize your Node.js applications for better performance and scalability.',
                    'featured_image_url' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=600&h=400&fit=crop',
                    'category' => (object)['name' => 'Node.js', 'slug' => 'nodejs'],
                    'tags' => collect([['name' => 'Backend', 'slug' => 'backend'], ['name' => 'Performance', 'slug' => 'performance']]),
                    'published_at' => now()
                ]])
            </div>
        </div>
    </div>
</section>

{{-- Design 6 --}}
<section class="section-padding section-1">
    <div class="container">
        <div class="design-header mb-4">
            <h3 class="design-number">06</h3>
            <h4 class="design-title">Magazine Style</h4>
            <p class="design-desc">Feature-rich card with author info, read time, and elevated shadow.</p>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                @include('front.partials.blog-cards.card-style-6', ['blog' => (object)[
                    'title' => 'The Future of Artificial Intelligence',
                    'short_description' => 'Explore how AI is shaping the future of technology and what it means for developers.',
                    'featured_image_url' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=600&h=400&fit=crop',
                    'category' => (object)['name' => 'AI', 'slug' => 'ai'],
                    'tags' => collect([['name' => 'Technology', 'slug' => 'technology'], ['name' => 'Future', 'slug' => 'future']]),
                    'published_at' => now()
                ]])
            </div>
        </div>
    </div>
</section>

{{-- Design 7 --}}
<section class="section-padding section-2">
    <div class="container">
        <div class="design-header mb-4">
            <h3 class="design-number">07</h3>
            <h4 class="design-title">Rounded Pill Style</h4>
            <p class="design-desc">Fully rounded corners with square image and pill-shaped button.</p>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                @include('front.partials.blog-cards.card-style-7', ['blog' => (object)[
                    'title' => 'Modern JavaScript ES2024 Features',
                    'short_description' => 'Stay ahead with the latest JavaScript features and syntax improvements.',
                    'featured_image_url' => 'https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?w=600&h=400&fit=crop',
                    'category' => (object)['name' => 'JavaScript', 'slug' => 'javascript'],
                    'tags' => collect([['name' => 'ES2024', 'slug' => 'es2024'], ['name' => 'Modern', 'slug' => 'modern']]),
                    'published_at' => now()
                ]])
            </div>
        </div>
    </div>
</section>

{{-- Design 8 --}}
<section class="section-padding section-1">
    <div class="container">
        <div class="design-header mb-4">
            <h3 class="design-number">08</h3>
            <h4 class="design-title">Image Focus Card</h4>
            <p class="design-desc">Large image with overlay details that reveal on hover.</p>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                @include('front.partials.blog-cards.card-style-8', ['blog' => (object)[
                    'title' => 'Cybersecurity Best Practices for 2024',
                    'short_description' => 'Protect your applications with these essential security practices and patterns.',
                    'featured_image_url' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=600&h=400&fit=crop',
                    'category' => (object)['name' => 'Security', 'slug' => 'security'],
                    'tags' => collect([['name' => 'Protection', 'slug' => 'protection'], ['name' => 'DevOps', 'slug' => 'devops']]),
                    'published_at' => now()
                ]])
            </div>
        </div>
    </div>
</section>

{{-- Design 9 --}}
<section class="section-padding section-2">
    <div class="container">
        <div class="design-header mb-4">
            <h3 class="design-number">09</h3>
            <h4 class="design-title">Modern Dark Card</h4>
            <p class="design-desc">Dark theme card with gradient background and cyan accents.</p>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                @include('front.partials.blog-cards.card-style-9', ['blog' => (object)[
                    'title' => 'Docker Containerization Guide',
                    'short_description' => 'Master Docker and containerize your applications for consistent deployments.',
                    'featured_image_url' => 'https://images.unsplash.com/photo-1605745341112-85968b19335b?w=600&h=400&fit=crop',
                    'category' => (object)['name' => 'DevOps', 'slug' => 'devops'],
                    'tags' => collect([['name' => 'Docker', 'slug' => 'docker'], ['name' => 'Containers', 'slug' => 'containers']]),
                    'published_at' => now()
                ]])
            </div>
        </div>
    </div>
</section>

{{-- Design 10 --}}
<section class="section-padding section-1">
    <div class="container">
        <div class="design-header mb-4">
            <h3 class="design-number">10</h3>
            <h4 class="design-title">Gradient Border Card</h4>
            <p class="design-desc">Animated gradient border with text gradient effects.</p>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                @include('front.partials.blog-cards.card-style-10', ['blog' => (object)[
                    'title' => 'GraphQL vs REST API Comparison',
                    'short_description' => 'A comprehensive comparison between GraphQL and REST APIs for modern applications.',
                    'featured_image_url' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600&h=400&fit=crop',
                    'category' => (object)['name' => 'API', 'slug' => 'api'],
                    'tags' => collect([['name' => 'GraphQL', 'slug' => 'graphql'], ['name' => 'REST', 'slug' => 'rest']]),
                    'published_at' => now()
                ]])
            </div>
        </div>
    </div>
</section>

<style>
.design-header {
    display: flex;
    align-items: baseline;
    gap: 20px;
    padding-bottom: 20px;
    border-bottom: 2px solid #e5e7eb;
}

.design-number {
    font-size: 3rem;
    font-weight: 800;
    color: #e5e7eb;
    line-height: 1;
}

.design-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
}

.design-desc {
    color: #6b7280;
    margin: 0;
    flex: 1;
}

@media (max-width: 768px) {
    .design-header {
        flex-wrap: wrap;
        gap: 10px;
    }
    .design-number {
        font-size: 2rem;
        width: 100%;
    }
    .design-title {
        width: 100%;
    }
}
</style>
@endsection
