{{-- =========================================================
     X. WHAT I DO - Services Section (Design 8 - New)
     ========================================================= --}}
@if($services->isNotEmpty())
<section id="services" class="section-padding section-alt">
    <div class="container">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-5 gap-3">
            <div class="text-center text-lg-start reveal-on-scroll">
                <span class="section-eyebrow">
                    <i class="fas fa-briefcase"></i>
                    {{ __('What I Do') }}
                </span>
                <h2 class="section-title mb-2">{{ __('Professional services tailored to your needs') }}</h2>
                <p class="section-subtitle mx-auto mx-lg-0">{{ __('I offer a wide range of services to help you achieve your goals.') }}</p>
            </div>
            <a href="{{ route('services') }}" class="btn btn-outline-custom flex-shrink-0 reveal-on-scroll">
                {{ __('View All') }} <i class="fa-solid fa-arrow-right ms-2"></i>
            </a>
        </div>

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
                    <a href="{{ route('services.show', $service->slug ?? '#') }}" class="btn-view">
                        {{ __('View') }} <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="card-right">
                    <h3>{{ $service->name }}</h3>
                    <p>{{ Str::limit($service->description, 120) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    
    .service-card {
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 28px;
        display: flex;
        align-items: flex-start;
        gap: 20px;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
    }
    
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.08);
        border-color: var(--primary);
    }
    
    .service-number {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 2.5rem;
        font-weight: 900;
        color: rgba(0,0,0,0.03);
        line-height: 1;
        transition: all 0.3s ease;
    }
    
    .service-card:hover .service-number {
        color: rgba(37, 99, 235, 0.1);
    }
    
    .card-left {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }
    
    .icon-box {
        width: 64px;
        height: 64px;
        background: rgba(37, 99, 235, 0.08);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 1.5rem;
        transition: all 0.35s ease;
    }
    
    .service-card:hover .icon-box {
        background: var(--primary);
        color: #fff;
    }
    
    .btn-view {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: rgba(37, 99, 235, 0.08);
        color: var(--primary);
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .service-card:hover .btn-view {
        background: var(--primary);
        color: #fff;
    }
    
    .btn-view i {
        transition: transform 0.3s ease;
    }
    
    .btn-view:hover i {
        transform: translateX(3px);
    }
    
    .card-right {
        flex: 1;
    }
    
    .card-right h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 10px;
    }
    
    .card-right p {
        color: var(--text-body);
        font-size: 0.95rem;
        line-height: 1.7;
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
        .service-card {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
    }
</style>
@endif
