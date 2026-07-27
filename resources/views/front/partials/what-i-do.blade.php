{{-- =========================================================
     X. WHAT I DO - Services Section
     ========================================================= --}}
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
                <i class="fa-solid fa-arrow-right me-2"></i>{{ __('View All') }}
            </a>
        </div>

        <div class="row g-4">
            @foreach($services as $service)
            <div class="col-lg-4 col-md-6">
                <div class="service-card reveal-on-scroll">
                    <div class="service-icon">
                        <i class="{{ $service->icon ?? 'fa-solid fa-gear' }}"></i>
                    </div>
                    <h3>{{ $service->name }}</h3>
                    <p>{{ Str::limit($service->short_description ?? $service->description, 120) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
    .service-card {
        background: var(--bg-white);
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        border: 1px solid var(--border);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .service-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 0;
    }

    .service-card::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 60px rgba(37, 99, 235, 0.15);
        border-color: transparent;
    }

    .service-card:hover::before {
        opacity: 1;
    }

    .service-card:hover::after {
        transform: scaleX(1);
    }

    .service-icon {
        width: 80px;
        height: 80px;
        background: var(--primary-glow);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        color: var(--primary);
        font-size: 1.8rem;
        transition: all 0.3s;
        position: relative;
        z-index: 1;
    }

    .service-card:hover .service-icon {
        background: rgba(255,255,255,0.2);
        color: #fff;
        transform: scale(1.1);
    }

    .service-card h3 {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 15px;
        position: relative;
        z-index: 1;
        transition: color 0.3s;
    }

    .service-card:hover h3 {
        color: #fff;
    }

    .service-card p {
        color: var(--text-body);
        font-size: 0.95rem;
        line-height: 1.7;
        position: relative;
        z-index: 1;
        transition: color 0.3s;
        margin: 0;
    }

    .service-card:hover p {
        color: rgba(255,255,255,0.9);
    }
</style>
