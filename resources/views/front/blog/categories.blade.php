@extends('front.layouts.app')

@section('seo_title', 'Blog Categories')

@section('content')
<section class="section-padding" style="padding-top: 8rem;">
    <div class="container">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </nav>

        <div class="text-center mb-5">
            <h1 class="section-title">Blog Categories</h1>
            <p class="lead text-muted">Browse articles by topic</p>
        </div>

        @if($categories->isEmpty())
            <div class="text-center py-5">
                <i class="fa-solid fa-folder-open fa-4x text-muted mb-4"></i>
                <p class="text-muted">No categories found.</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($categories as $category)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('blog.category', $category->slug) }}" class="text-decoration-none">
                            <div class="admin-card h-100 category-card">
                                <div class="card-body-custom">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="category-icon">
                                            <i class="fa-solid fa-folder"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-0 text-dark">{{ $category->name }}</h5>
                                            <small class="text-muted">{{ $category->blogs_count }} {{ Str::plural('article', $category->blogs_count) }}</small>
                                        </div>
                                    </div>
                                    @if($category->description)
                                        <p class="text-muted mb-0 small">{{ Str::limit($category->description, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<style>
.category-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.category-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.category-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #4F2FE8, #7C3AED);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}
.category-icon i {
    font-size: 1.5rem;
    color: white;
}
</style>
@endsection
