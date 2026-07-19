@extends('front.layouts.app')

@section('title', 'Services | ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('meta_description', 'Services I offer — end-to-end web development to help your idea reach production.')

@section('content')

{{-- Page header --}}
<section class="section-padding bg-light-custom">
    <div class="container">
        <div class="text-center">
            <span class="section-eyebrow">What I Offer</span>
            <h1 class="section-title">Services</h1>
            <p class="section-subtitle mx-auto">End-to-end web development services to help your idea reach production.</p>
        </div>
    </div>
</section>

{{-- Services grid --}}
<section class="section-padding">
    <div class="container">
        @if($services->isNotEmpty())
            <div class="row g-4">
                @foreach($services as $service)
                    <div class="col-md-6 col-lg-4 reveal-on-scroll">
                        <div class="service-card h-100">
                            <div class="icon-box">
                                <i class="{{ $service->icon ?? 'fa-solid fa-gear' }}"></i>
                            </div>
                            <h5 class="mb-2">{{ $service->name }}</h5>
                            <p class="text-muted small mb-0">{{ $service->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-muted py-5">
                <i class="fa-solid fa-gear fa-2x mb-3 d-block"></i>
                No services have been added yet.
            </div>
        @endif

        {{-- Call to action --}}
        <div class="text-center mt-5 reveal-on-scroll">
            <h4 class="mb-3">Have a project in mind?</h4>
            <a href="{{ route('home') }}#contact" class="btn btn-primary-custom">
                <i class="fa-solid fa-paper-plane me-2"></i>Hire Me
            </a>
        </div>
    </div>
</section>

@endsection
