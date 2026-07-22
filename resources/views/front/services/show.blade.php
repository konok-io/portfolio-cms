@extends('front.layouts.app')

@section('title', $service->name . ' | ' . ($siteSetting->site_name ?? 'Services'))
@section('meta_description', $service->description ?? $service->name . ' service details.')

@section('content')

{{-- Page Header --}}
<section class="section-padding section-alt">
    <div class="container">
        <div class="text-center">
            <span class="section-eyebrow">Services</span>
            <h1 class="section-title">{{ $service->name }}</h1>
            <nav aria-label="breadcrumb" class="d-flex justify-content-center mt-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('services') }}">Services</a></li>
                    <li class="breadcrumb-item active">{{ $service->name }}</li>
                </ol>
            </nav>
        </div>
    </div>
</section>

{{-- Service Detail --}}
<section class="section-padding">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-8">
                @if($service->image)
                    <img src="{{ $service->image }}" alt="{{ $service->name }}" class="img-fluid rounded-4 mb-4 w-100">
                @endif
                
                @if($service->content)
                    <div class="service-content">
                        {!! $service->content !!}
                    </div>
                @else
                    <p class="text-muted">{{ $service->description ?? 'Detailed information about this service coming soon.' }}</p>
                @endif
                
                {{-- Features List --}}
                @if($service->description)
                    <div class="mt-4">
                        <h4><i class="{{ $service->icon ?? 'fa-solid fa-check' }} text-primary-custom me-2"></i>What I Offer</h4>
                        <div class="mt-3">
                            @foreach(explode("\n", $service->description) as $point)
                                @if(trim($point))
                                    <div class="d-flex align-items-start gap-2 mb-2">
                                        <i class="fa-solid fa-check text-success mt-1"></i>
                                        <span>{{ trim($point) }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            
            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">Interested in this service?</h5>
                        <p class="text-muted small mb-3">Let's discuss your project and see how I can help you achieve your goals.</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary-custom w-100">
                            <i class="fa-solid fa-paper-plane me-2"></i>Get in Touch
                        </a>
                    </div>
                </div>
                
                {{-- Related Services --}}
                @if($relatedServices->isNotEmpty())
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3">Other Services</h5>
                            <div class="d-flex flex-column gap-2">
                                @foreach($relatedServices as $related)
                                    <a href="{{ route('services.show', $related->slug) }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
                                        <i class="{{ $related->icon ?? 'fa-solid fa-chevron-right' }} text-primary-custom"></i>
                                        <span>{{ $related->name }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="section-padding section-tint">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">Ready to get started?</h2>
            <p class="text-muted mb-4">Let's work together to bring your vision to life.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary-custom">
                <i class="fa-solid fa-paper-plane me-2"></i>Contact Me
            </a>
        </div>
    </div>
</section>

@endsection
