@extends('front.layouts.app')

@section('title', 'Coming Soon')

@section('content')
<section class="py-5" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="coming-soon-icon mb-4">
                    <i class="fas fa-clock"></i>
                </div>
                <h1 class="mb-3">Coming Soon</h1>
                <p class="lead text-muted mb-5">We're working on something exciting. Stay tuned!</p>
                
                <div class="countdown-container mb-5">
                    <div class="row justify-content-center gap-3">
                        <div class="col-5 col-md-3">
                            <div class="countdown-box p-3 bg-light rounded">
                                <span class="countdown-number" id="days">00</span>
                                <span class="countdown-label d-block small text-muted">Days</span>
                            </div>
                        </div>
                        <div class="col-5 col-md-3">
                            <div class="countdown-box p-3 bg-light rounded">
                                <span class="countdown-number" id="hours">00</span>
                                <span class="countdown-label d-block small text-muted">Hours</span>
                            </div>
                        </div>
                        <div class="col-5 col-md-3">
                            <div class="countdown-box p-3 bg-light rounded">
                                <span class="countdown-number" id="minutes">00</span>
                                <span class="countdown-label d-block small text-muted">Minutes</span>
                            </div>
                        </div>
                        <div class="col-5 col-md-3">
                            <div class="countdown-box p-3 bg-light rounded">
                                <span class="countdown-number" id="seconds">00</span>
                                <span class="countdown-label d-block small text-muted">Seconds</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="social-links">
                    <p class="text-muted mb-3">Follow us for updates:</p>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fab fa-twitter me-2"></i>Twitter
                        </a>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fab fa-linkedin me-2"></i>LinkedIn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Set countdown to 7 days from now
    const countdownDate = new Date();
    countdownDate.setDate(countdownDate.getDate() + 7);
    
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = countdownDate - now;
        
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        document.getElementById('days').textContent = String(days).padStart(2, '0');
        document.getElementById('hours').textContent = String(hours).padStart(2, '0');
        document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
        document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
    }
    
    setInterval(updateCountdown, 1000);
    updateCountdown();
</script>
@endpush

@push('styles')
<style>
    .coming-soon-icon i {
        font-size: 5rem;
        color: var(--color-primary);
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    .countdown-box {
        background: var(--color-light) !important;
    }
    .countdown-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--color-secondary);
    }
</style>
@endpush
