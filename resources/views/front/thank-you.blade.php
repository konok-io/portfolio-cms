@extends('front.layouts.app')

@section('seo_title', 'Thank You - Message Received')
@section('meta_description', 'Thank you for contacting us. Your message has been received and we will get back to you shortly.')

@section('content')
<section class="py-5 mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="thank-you-icon mb-4">
                    <i class="fas fa-check-circle text-success"></i>
                </div>
                <h1 class="mb-3">Thank You!</h1>
                <p class="lead text-muted mb-4">Your message has been sent successfully. I'll get back to you as soon as possible.</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('home') }}" class="btn btn-primary-custom">
                        <i class="fas fa-home me-2"></i>Back to Home
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary">
                        <i class="fas fa-envelope me-2"></i>Send Another Message
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .thank-you-icon i {
        font-size: 5rem;
        animation: bounceIn 0.6s ease-out;
    }
    @keyframes bounceIn {
        0% { transform: scale(0); opacity: 0; }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); opacity: 1; }
    }
</style>
@endpush
