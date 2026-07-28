@extends('front.layouts.app')

@section('seo_title', $siteSetting->getComingSoonTitle() . ' - ' . $siteSetting->site_name)
@section('meta_description', $siteSetting->getComingSoonMessage())

@section('content')
<section class="py-5" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="coming-soon-icon mb-4">
                    <i class="fas fa-clock"></i>
                </div>
                <h1 class="mb-3">{{ $siteSetting->getComingSoonTitle() }}</h1>
                <p class="lead text-muted mb-5">{{ $siteSetting->getComingSoonMessage() }}</p>
                
                @if($siteSetting->getComingSoonDate())
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
                @endif

                <div class="social-links">
                    <p class="text-muted mb-3">Follow us for updates:</p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        @if($siteSetting->facebook)
                            <a href="{{ $siteSetting->facebook }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary" aria-label="Follow us on Facebook">
                                <i class="fab fa-facebook me-2"></i>Facebook
                            </a>
                        @endif
                        @if($siteSetting->twitter)
                            <a href="{{ $siteSetting->twitter }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary" aria-label="Follow us on Twitter">
                                <i class="fab fa-twitter me-2"></i>Twitter
                            </a>
                        @endif
                        @if($siteSetting->linkedin)
                            <a href="{{ $siteSetting->linkedin }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary" aria-label="Connect on LinkedIn">
                                <i class="fab fa-linkedin me-2"></i>LinkedIn
                            </a>
                        @endif
                        @if($siteSetting->instagram)
                            <a href="{{ $siteSetting->instagram }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary" aria-label="Follow us on Instagram">
                                <i class="fab fa-instagram me-2"></i>Instagram
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@if($siteSetting->getComingSoonDate())
@push('scripts')
<script>
    // Set countdown to configured date
    const countdownDate = new Date('{{ $siteSetting->getComingSoonDate()->toIsoStringString() }}').getTime();
    
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = countdownDate - now;
        
        if (distance < 0) {
            document.getElementById('days').textContent = '00';
            document.getElementById('hours').textContent = '00';
            document.getElementById('minutes').textContent = '00';
            document.getElementById('seconds').textContent = '00';
            return;
        }
        
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
@endif

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
