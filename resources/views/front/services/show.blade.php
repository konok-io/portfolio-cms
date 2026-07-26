@extends('front.layouts.app')

@section('title', $service->name . ' | ' . ($siteSetting->site_name ?? 'Services'))
@section('meta_description', $service->description ?? $service->name . ' service details.')

@php
    $breadcrumbs = [
        ['title' => 'Services', 'url' => route('services')],
        ['title' => $service->name, 'url' => null, 'active' => true]
    ];
@endphp

@section('content')

{{-- Page Header --}}
<section class="section-padding section-alt">
    <div class="container">
        <div class="text-center">
            <span class="section-eyebrow">Services</span>
            <h1 class="section-title">{{ $service->name }}</h1>
            <x-breadcrumb :items="$breadcrumbs" class="d-flex justify-content-center mt-3" />
        </div>
    </div>
</section>

{{-- Service Detail --}}
<section class="section-padding">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-8">
                @if($service->svg_icon || $service->icon)
                    <div class="icon-box mb-4" style="width: 80px; height: 80px;">
                        @if($service->svg_icon)
                            <span class="svg-icon" style="width: 40px; height: 40px;">{!! $service->svg_icon !!}</span>
                        @else
                            <i class="{{ $service->icon }}" style="font-size: 2rem;"></i>
                        @endif
                    </div>
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
                        <h4><i class="fa-solid fa-check text-primary-custom me-2"></i>What I Offer</h4>
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
                        <a href="{{ route('quote', ['service_id' => $service->id]) }}" class="btn btn-primary-custom w-100">
                            <i class="fa-solid fa-paper-plane me-2"></i>Request a Quote
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
                                    @if($related->slug)
                                        <a href="{{ route('services.show', $related->slug) }}" class="d-flex align-items-center gap-2 text-decoration-none text-dark">
                                            @if($related->svg_icon)
                                                <span class="svg-icon" style="width: 18px; height: 18px; color: var(--color-primary);">{!! $related->svg_icon !!}</span>
                                            @elseif($related->icon)
                                                <i class="{{ $related->icon }} text-primary-custom"></i>
                                            @else
                                                <i class="fa-solid fa-chevron-right text-primary-custom"></i>
                                            @endif
                                            <span>{{ $related->name }}</span>
                                        </a>
                                    @endif
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
