@extends('front.layouts.app')
@section('title', 'Client Testimonials - ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('content')
<section class="section-padding section-alt py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-eyebrow">Client Feedback</span>
            <h1 class="section-title">What Clients Say</h1>
            <p class="section-subtitle mx-auto">Read what my clients have to say about working with me.</p>
        </div>
        
        <div class="row g-4">
            @forelse($testimonials as $testimonial)
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card h-100 d-flex flex-column p-4">
                        <i class="fa-solid fa-quote-left quote-icon mb-3"></i>
                        <p class="text-muted flex-grow-1">{{ $testimonial->review }}</p>
                        @if($testimonial->hasVideo())
                            <a href="#" class="btn btn-sm btn-outline-primary mb-3 video-testimonial-btn" data-video="{{ $testimonial->getVideoEmbedUrl() }}">
                                <i class="fa-solid fa-play me-1"></i>Watch Video Review
                            </a>
                        @endif
                        <div class="star-rating mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-{{ $i <= $testimonial->rating ? 'solid' : 'regular' }} fa-star"></i>
                            @endfor
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->client_name }}" width="56" height="56" class="rounded-circle object-fit-cover" loading="lazy">
                            <div>
                                <h5 class="mb-0 h6">{{ $testimonial->client_name }}</h5>
                                <span class="small text-muted">{{ $testimonial->company }}</span>
                            </div>
                        </div>
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

<!-- Video Modal -->
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
