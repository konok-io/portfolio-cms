@extends('front.layouts.app')

@section('title', page_content('services', 'page_title', app()->getLocale()) . ' | ' . ($siteSetting->site_name ?? 'Portfolio'))
@section('meta_description', page_content('services', 'page_subtitle', app()->getLocale()))

@section('content')

{{-- Page header --}}
<section class="section-padding section-alt">
    <div class="container">
        <div class="text-center">
            <span class="section-eyebrow">{{ page_content('services', 'page_eyebrow', app()->getLocale()) }}</span>
            <h1 class="section-title">{{ page_content('services', 'page_title', app()->getLocale()) }}</h1>
            <p class="section-subtitle mx-auto">{{ page_content('services', 'page_subtitle', app()->getLocale()) }}</p>
        </div>
    </div>
</section>

{{-- Services grid --}}
<section class="section-padding section-tint">
    <div class="container">
        @if($services->isNotEmpty())
            <div class="services-grid">
                @foreach($services as $index => $service)
                    <div class="service-card-new reveal-on-scroll">
                        <span class="service-card-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        
                        <div class="service-icon-col">
                            <div class="service-icon-new">
                                @if($service->svg_icon)
                                    <span class="svg-icon">{!! $service->svg_icon !!}</span>
                                @elseif($service->icon)
                                    <i class="{{ $service->icon }}"></i>
                                @else
                                    <i class="fa-solid fa-gear"></i>
                                @endif
                            </div>
                            <a href="{{ route('services.show', $service->slug ?? Str::slug($service->name)) }}" class="service-btn">
                                {{ page_content('services', 'page_button', app()->getLocale()) }} <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                        
                        <div class="service-content">
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

<style>
    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    }
    
    .service-card-new {
        background: var(--bg-white);
        border-radius: 16px;
        padding: 30px;
        display: flex;
        gap: 20px;
        align-items: flex-start;
        border: 1px solid var(--border);
        transition: all 0.3s ease;
        position: relative;
    }
    
    .service-card-new:hover {
        border-color: var(--primary);
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.1);
        transform: translateY(-5px);
    }
    
    .service-card-number {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 3rem;
        font-weight: 900;
        color: var(--primary-glow);
        line-height: 1;
        transition: all 0.3s ease;
    }
    
    .service-card-new:hover .service-card-number {
        color: rgba(37, 99, 235, 0.15);
    }
    
    .service-icon-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }
    
    .service-icon-new {
        width: 60px;
        height: 60px;
        background: var(--primary-glow);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.4rem;
        transition: all 0.3s ease;
    }
    
    .service-card-new:hover .service-icon-new {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: #fff;
    }
    
    .service-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        padding: 6px 12px;
        background: transparent;
        color: var(--primary);
        border: 1px solid var(--primary);
        border-radius: 15px;
        text-decoration: none;
        font-size: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    .service-btn:hover {
        background: var(--primary);
        color: #fff;
    }
    
    .service-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .service-content h3 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: var(--text-dark);
    }
    
    .service-content p {
        color: var(--text-body);
        font-size: 0.9rem;
        line-height: 1.6;
        margin: 0;
    }
    
    @media (max-width: 992px) {
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        .services-grid {
            grid-template-columns: 1fr;
        }
        .service-card-new {
            flex-direction: column;
            text-align: center;
        }
        .service-icon-col {
            width: 100%;
        }
        .service-btn {
            width: fit-content;
        }
    }
</style>

@endsection
