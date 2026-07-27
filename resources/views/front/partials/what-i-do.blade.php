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

        <div class="what-i-do-grid">
            @foreach($services as $index => $service)
            <div class="what-i-do-card reveal-on-scroll">
                <span class="what-i-do-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                
                <div class="what-i-do-icon-col">
                    <div class="what-i-do-icon">
                        <i class="{{ $service->icon ?? 'fa-solid fa-gear' }}"></i>
                    </div>
                    <a href="{{ route('services.show', $service->slug ?? '#') }}" class="what-i-do-btn">
                        {{ __('View') }} <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="what-i-do-content">
                    <h3>{{ $service->name }}</h3>
                    <p>{{ Str::limit($service->short_description ?? $service->description, 120) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .what-i-do-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    
    .what-i-do-card {
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
    
    .what-i-do-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.08);
        border-color: var(--primary);
    }
    
    .what-i-do-number {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 2.5rem;
        font-weight: 900;
        color: rgba(0,0,0,0.03);
        line-height: 1;
        transition: all 0.3s ease;
    }
    
    .what-i-do-card:hover .what-i-do-number {
        color: rgba(37, 99, 235, 0.1);
    }
    
    .what-i-do-icon-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
        flex-shrink: 0;
    }
    
    .what-i-do-icon {
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
    
    .what-i-do-card:hover .what-i-do-icon {
        background: var(--primary);
        color: #fff;
    }
    
    .what-i-do-btn {
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
    
    .what-i-do-btn:hover {
        background: var(--primary);
        color: #fff;
    }
    
    .what-i-do-btn i {
        transition: transform 0.3s ease;
    }
    
    .what-i-do-btn:hover i {
        transform: translateX(3px);
    }
    
    .what-i-do-content {
        flex: 1;
    }
    
    .what-i-do-content h3 {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 10px;
    }
    
    .what-i-do-content p {
        color: var(--text-body);
        font-size: 0.95rem;
        line-height: 1.7;
        margin: 0;
    }
    
    @media (max-width: 992px) {
        .what-i-do-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        .what-i-do-grid {
            grid-template-columns: 1fr;
        }
        .what-i-do-card {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
    }
</style>
@endif
