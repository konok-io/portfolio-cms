{{-- =========================================================
     X. WHAT I DO - Services Section (Design 8)
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
        gap: 25px;
    }
    
    .what-i-do-card {
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
    
    .what-i-do-card:hover {
        border-color: var(--primary);
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.1);
        transform: translateY(-5px);
    }
    
    .what-i-do-number {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 3rem;
        font-weight: 900;
        color: var(--primary-glow);
        line-height: 1;
        transition: all 0.3s ease;
    }
    
    .what-i-do-card:hover .what-i-do-number {
        color: rgba(37, 99, 235, 0.15);
    }
    
    .what-i-do-icon-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        flex-shrink: 0;
    }
    
    .what-i-do-icon {
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
    
    .what-i-do-card:hover .what-i-do-icon {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: #fff;
    }
    
    .what-i-do-btn {
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
    
    .what-i-do-btn:hover {
        background: var(--primary);
        color: #fff;
    }
    
    .what-i-do-content {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .what-i-do-content h3 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: var(--text-dark);
    }
    
    .what-i-do-content p {
        color: var(--text-body);
        font-size: 0.9rem;
        line-height: 1.6;
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
            text-align: center;
        }
        .what-i-do-icon-col {
            width: 100%;
        }
        .what-i-do-btn {
            width: fit-content;
        }
    }
</style>
@endif
