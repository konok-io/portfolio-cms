@extends('front.layouts.app')

@section('title', page_content('services', 'page_title', app()->getLocale()) . ' | ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('meta_description', page_content('services', 'page_subtitle', app()->getLocale()))

@section('content')

{{-- Page header --}}
<section class="section-padding section-12">
    <div class="container">
        <div class="text-center">
            <span class="section-eyebrow">{{ page_content('services', 'page_eyebrow', app()->getLocale()) }}</span>
            <h1 class="section-title">{{ page_content('services', 'page_title', app()->getLocale()) }}</h1>
            <p class="section-subtitle mx-auto">{{ page_content('services', 'page_subtitle', app()->getLocale()) }}</p>
        </div>
    </div>
</section>

{{-- Services grid --}}
<section class="section-padding section-1">
    <div class="container">
        @if($services->isNotEmpty())
            <div class="services-grid">
                @foreach($services as $index => $service)
                    <div class="service-card reveal-on-scroll">
                        <span class="service-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        
                        <div class="card-left">
                            <div class="icon-box">
                                @if($service->svg_icon)
                                    {!! $service->svg_icon !!}
                                @else
                                    <i class="{{ $service->icon ?? 'fa-solid fa-gear' }}"></i>
                                @endif
                            </div>
                            <a href="{{ route('services.show', $service->slug ?? Str::slug($service->name)) }}" class="btn-view">
                                {{ page_content('services', 'page_button', app()->getLocale()) }} <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                        
                        <div class="card-right">
                            <h3>{{ $service->name }}</h3>
                            <p>{{ Str::limit($service->description, 120) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-muted py-5">
                <i class="fa-solid fa-gear fa-2x mb-3 d-block"></i>
                {{ page_content('services', 'empty_text', app()->getLocale()) }}
            </div>
        @endif

        {{-- Call to action --}}
        <div class="text-center mt-5 reveal-on-scroll">
            <h4 class="mb-3">{{ page_content('services', 'cta_heading', app()->getLocale()) }}</h4>
            <a href="{{ route('quote') }}" class="btn btn-primary-custom">
                <i class="fa-solid fa-paper-plane me-2"></i>{{ page_content('services', 'cta_button', app()->getLocale()) }}
            </a>
        </div>
    </div>
</section>

@endsection
