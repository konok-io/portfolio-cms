{{-- =========================================================
     X. WHAT I DO - Services Section (Design 8 - New)
     ========================================================= --}}
@if($services->isNotEmpty())
<section id="services" class="section-padding section-1">
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
@endif
