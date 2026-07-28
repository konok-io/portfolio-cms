@extends('front.layouts.app')
@section('title', 'Client Testimonials - ' . ($siteSetting->site_name ?? 'Portfolio'))

@section('seo_title', 'Client Testimonials - ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('meta_description', 'Read what my clients have to say about working with me. Client testimonials and reviews.')

@push('styles')
<style>
    /* Page Title Section */
    .page-title-section {
        background: var(--color-primary, #2563EB);
        padding: 80px 0 60px;
        position: relative;
        overflow: hidden;
    }
    
    .page-title-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .page-title-section::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }
    
    .page-title-section .section-eyebrow {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .page-title-section h1 {
        color: #ffffff;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.75rem;
    }
    
    .page-title-section .section-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }
    
    @media (max-width: 768px) {
        .page-title-section {
            padding: 60px 0 40px;
        }
        .page-title-section h1 {
            font-size: 2rem;
        }
    }

    /* Testimonial Card Styles */
    .testimonial-card {
        background: #eff6ff;
        border-radius: 16px;
        height: 100%;
        transition: all 0.3s;
        border: 1px solid #e2e8f0;
        padding: 10px;
    }
    
    .testimonial-card:hover {
        box-shadow: 0 15px 35px rgba(37, 99, 235, 0.15);
        border-color: var(--color-primary, #2563EB);
    }
    
    .testimonial-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        margin-bottom: 10px;
    }
    
    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .testimonial-avatar {
        width: 48px;
        height: 48px;
        background: var(--color-primary, #2563EB);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
        overflow: hidden;
        flex-shrink: 0;
    }
    
    .testimonial-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .testimonial-author-info {
        display: flex;
        flex-direction: column;
    }
    
    .testimonial-name {
        font-size: 0.9rem;
        font-weight: 700;
        color: #1e293b;
    }
    
    .testimonial-role {
        font-size: 0.75rem;
        color: #64748b;
    }
    
    .testimonial-rating {
        display: flex;
        gap: 2px;
    }
    
    .testimonial-rating i {
        color: #f59e0b;
        font-size: 0.85rem;
    }
    
    .testimonial-body {
        background: #ffffff;
        border-radius: 8px;
        padding: 10px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }
    
    .testimonial-quote-icon {
        color: var(--color-primary, #2563EB);
        font-size: 1.2rem;
        flex-shrink: 0;
        margin-top: 2px;
    }
    
    .testimonial-text {
        font-size: 0.9rem;
        color: #475569;
        line-height: 1.7;
        margin: 0;
    }

    /* Video Button */
    .video-testimonial-btn {
        background: var(--color-primary, #2563EB);
        color: #fff;
        border: none;
        font-size: 0.8rem;
        padding: 6px 12px;
        border-radius: 6px;
        margin-bottom: 10px;
    }
    
    .video-testimonial-btn:hover {
        background: #1d4ed8;
        color: #fff;
    }

    /* Dark Mode */
    [data-theme="dark"] .testimonial-card {
        background: #1e293b;
        border-color: #334155;
    }
    [data-theme="dark"] .testimonial-card:hover {
        border-color: var(--color-primary, #2563EB);
        box-shadow: 0 15px 35px rgba(37, 99, 235, 0.2);
    }
    [data-theme="dark"] .testimonial-header {
        background: rgba(37, 99, 235, 0.15);
        border-color: #334155;
    }
    [data-theme="dark"] .testimonial-name {
        color: #f1f5f9;
    }
    [data-theme="dark"] .testimonial-text {
        color: #cbd5e1;
    }
    [data-theme="dark"] .testimonial-body {
        background: #0f172a;
    }
</style>
@endpush

@section('content')
{{-- Page Title Section --}}
<section class="page-title-section section-padding">
    <div class="shape-container">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
        <div class="shape shape-6"></div>
        <div class="shape shape-7"></div>
        <div class="shape shape-8"></div>
    </div>

    <div class="container">
        <div class="text-center mb-0">
            <span class="section-eyebrow">Client Feedback</span>
            <h1 class="section-title">What Clients Say</h1>
            <p class="section-subtitle mx-auto">Read what my clients have to say about working with me.</p>
        </div>
    </div>
</section>

{{-- Testimonials Section --}}
<section class="section-padding">
    <div class="container">
        <div class="row g-4">
            @forelse($testimonials as $testimonial)
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <div class="testimonial-author">
                                <div class="testimonial-avatar">
                                    @if($testimonial->photo_url)
                                        <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->client_name }}">
                                    @else
                                        {{ substr($testimonial->client_name, 0, 1) }}
                                    @endif
                                </div>
                                <div class="testimonial-author-info">
                                    <span class="testimonial-name">{{ $testimonial->client_name }}</span>
                                    <span class="testimonial-role">{{ $testimonial->company }}</span>
                                </div>
                            </div>
                            <div class="testimonial-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        <div class="testimonial-body">
                            <i class="fas fa-quote-left testimonial-quote-icon"></i>
                            <p class="testimonial-text">{{ $testimonial->review }}</p>
                        </div>
                        @if($testimonial->hasVideo())
                            <a href="#" class="video-testimonial-btn" data-video="{{ $testimonial->getVideoEmbedUrl() }}">
                                <i class="fa-solid fa-play me-1"></i>Watch Video
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fa-solid fa-quote-left text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">No testimonials available at the moment.</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-5">
            <a href="{{ route('contact') }}" class="btn btn-primary-custom">
                <i class="fa-solid fa-envelope me-2"></i>Work With Me
            </a>
        </div>
    </div>
</section>

{{-- Video Modal --}}
<div class="modal fade" id="videoModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header border-0">
                <h5 class="modal-title text-white">Video Testimonial</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe id="videoFrame" src="" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.video-testimonial-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const videoUrl = this.dataset.video;
            document.getElementById('videoFrame').src = videoUrl;
            new bootstrap.Modal(document.getElementById('videoModal')).show();
        });
    });
    
    document.getElementById('videoModal').addEventListener('hidden.bs.modal', function() {
        document.getElementById('videoFrame').src = '';
    });
});
</script>
@endpush
