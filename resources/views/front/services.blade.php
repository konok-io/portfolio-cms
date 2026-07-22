@extends('front.layouts.app')

@section('title', PageContent::get('services', 'page_title', app()->getLocale()) . ' | ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('meta_description', PageContent::get('services', 'page_subtitle', app()->getLocale()))

@section('content')

{{-- Page header --}}
<section class="section-padding section-alt">
    <div class="container">
        <div class="text-center">
            <span class="section-eyebrow">{{ PageContent::get('services', 'page_eyebrow', app()->getLocale()) }}</span>
            <h1 class="section-title">{{ PageContent::get('services', 'page_title', app()->getLocale()) }}</h1>
            <p class="section-subtitle mx-auto">{{ PageContent::get('services', 'page_subtitle', app()->getLocale()) }}</p>
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
                        <a href="{{ route('services.show', $service->slug ?? Str::slug($service->name)) }}" class="text-decoration-none">
                            <div class="service-card h-100">
                                <div class="icon-box">
                                    <i class="{{ $service->icon ?? 'fa-solid fa-gear' }}"></i>
                                </div>
                                <h5 class="mb-2">{{ $service->name }}</h5>
                                <p class="text-muted small mb-3">{{ Str::limit($service->description, 100) }}</p>
                                <span class="btn btn-sm btn-outline-custom mt-auto">{{ PageContent::get('services', 'page_button', app()->getLocale()) }} <i class="fa-solid fa-arrow-right ms-1"></i></span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-muted py-5">
                <i class="fa-solid fa-gear fa-2x mb-3 d-block"></i>
                {{ PageContent::get('services', 'empty_text', app()->getLocale()) }}
            </div>
        @endif

        {{-- Call to action --}}
        <div class="text-center mt-5 reveal-on-scroll">
            <h4 class="mb-3">{{ PageContent::get('services', 'cta_heading', app()->getLocale()) }}</h4>
            <a href="{{ route('quote') }}" class="btn btn-primary-custom">
                <i class="fa-solid fa-paper-plane me-2"></i>{{ PageContent::get('services', 'cta_button', app()->getLocale()) }}
            </a>
        </div>
    </div>
</section>

@endsection
