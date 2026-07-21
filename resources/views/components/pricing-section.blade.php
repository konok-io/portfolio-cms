@props(['plans' => collect()])

@if($plans->count() > 0)
<section class="section bg-light-custom pricing-section" id="pricing">
    <div class="container">
        <div class="row justify-content-center text-center mb-5" data-aos="fade-up">
            <div class="col-lg-8">
                <span class="eyebrow text-primary mb-3 d-inline-block">{{ __('pricing_plans') }}</span>
                <h2 class="section-title">{{ __('pricing') }}</h2>
                <p class="lead text-muted">{{ __('Choose the perfect plan for your needs') }}</p>
            </div>
        </div>

        <!-- Pricing Toggle -->
        <div class="row justify-content-center mb-5" data-aos="fade-up">
            <div class="col-auto">
                <div class="pricing-toggle">
                    <span class="toggle-label monthly active" data-billing="monthly">{{ __('monthly') }}</span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="billingToggle">
                        <label class="form-check-label" for="billingToggle"></label>
                    </div>
                    <span class="toggle-label yearly" data-billing="yearly">{{ __('yearly') }}</span>
                    <span class="badge bg-success ms-2 yearly-discount">{{ __('Save 20%') }}</span>
                </div>
            </div>
        </div>

        <!-- Pricing Cards -->
        <div class="row g-4 justify-content-center">
            @foreach($plans as $index => $plan)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="pricing-card {{ $plan->is_highlighted ? 'highlighted' : '' }}">
                        @if($plan->badge)
                            <div class="pricing-badge">{{ $plan->badge }}</div>
                        @endif
                        
                        <div class="pricing-header">
                            <h3 class="pricing-name">{{ $plan->name }}</h3>
                            @if($plan->description)
                                <p class="pricing-description">{{ $plan->description }}</p>
                            @endif
                        </div>

                        <div class="pricing-price">
                            <div class="price-wrapper">
                                <span class="currency">{{ $plan->currency === 'USD' ? '$' : ($plan->currency === 'EUR' ? '€' : ($plan->currency === 'GBP' ? '£' : $plan->currency)) }}</span>
                                <span class="amount monthly-price" data-monthly="{{ $plan->monthly_price }}" data-yearly="{{ $plan->yearly_price }}">
                                    {{ number_format($plan->monthly_price, 0) }}
                                </span>
                            </div>
                            <span class="period monthly-period">/ {{ __('monthly') }}</span>
                            <span class="period yearly-period" style="display: none;">/ {{ __('yearly') }}</span>
                        </div>

                        <ul class="pricing-features">
                            @foreach($plan->getFeaturesArray() as $feature)
                                <li>
                                    <i class="fa-solid fa-check"></i>
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>

                        <div class="pricing-footer">
                            <a href="{{ $plan->button_url ?? route('contact') }}" 
                               class="btn {{ $plan->is_highlighted ? 'btn-primary-custom' : 'btn-outline-primary' }} w-100">
                                {{ $plan->button_text }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
.pricing-section {
    position: relative;
}

.pricing-toggle {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: white;
    padding: 0.5rem 1.5rem;
    border-radius: 50px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
}

[data-theme="dark"] .pricing-toggle {
    background: #171433;
}

.toggle-label {
    font-weight: 600;
    color: #64748b;
    transition: color 0.3s ease;
    cursor: pointer;
}

.toggle-label.active {
    color: #2563eb;
}

.yearly-discount {
    font-size: 0.75rem;
}

.pricing-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    position: relative;
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
    height: 100%;
}

[data-theme="dark"] .pricing-card {
    background: #171433;
    border-color: #2C2860;
}

.pricing-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.pricing-card.highlighted {
    border-color: #2563eb;
    border-width: 2px;
    background: linear-gradient(180deg, #2563eb08 0%, transparent 100%);
}

[data-theme="dark"] .pricing-card.highlighted {
    border-color: #8B7BF0;
    background: linear-gradient(180deg, #8B7BF020 0%, transparent 100%);
}

.pricing-badge {
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    color: white;
    padding: 0.35rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.pricing-header {
    text-align: center;
    margin-bottom: 1.5rem;
}

.pricing-name {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.pricing-description {
    color: #64748b;
    font-size: 0.9rem;
    margin-bottom: 0;
}

[data-theme="dark"] .pricing-description {
    color: #9B98C7;
}

.pricing-price {
    text-align: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #e2e8f0;
}

[data-theme="dark"] .pricing-price {
    border-color: #2C2860;
}

.price-wrapper {
    display: flex;
    align-items: flex-start;
    justify-content: center;
}

.currency {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 0.5rem;
}

.amount {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1;
}

.period {
    color: #64748b;
    font-size: 0.9rem;
}

[data-theme="dark"] .period {
    color: #9B98C7;
}

.pricing-features {
    list-style: none;
    padding: 0;
    margin: 0 0 1.5rem 0;
}

.pricing-features li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 0;
    font-size: 0.95rem;
}

.pricing-features li i {
    color: #16a34a;
    font-size: 0.9rem;
}

.pricing-footer {
    margin-top: auto;
}

.pricing-footer .btn {
    padding: 0.875rem 1.5rem;
    font-weight: 600;
    border-radius: 12px;
}

.btn-primary-custom {
    background: linear-gradient(135deg, #2563eb, #7c3aed);
    border: none;
    color: white;
}

.btn-primary-custom:hover {
    background: linear-gradient(135deg, #1d4ed8, #6d28d9);
    color: white;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('billingToggle');
    const monthlyLabel = document.querySelector('.toggle-label.monthly');
    const yearlyLabel = document.querySelector('.toggle-label.yearly');
    const yearlyDiscount = document.querySelector('.yearly-discount');
    
    // Toggle click handlers
    monthlyLabel.addEventListener('click', function() {
        if (toggle.checked) {
            toggle.checked = false;
            updatePricing();
        }
    });
    
    yearlyLabel.addEventListener('click', function() {
        if (!toggle.checked) {
            toggle.checked = true;
            updatePricing();
        }
    });
    
    toggle.addEventListener('change', updatePricing);
    
    function updatePricing() {
        const isYearly = toggle.checked;
        
        // Update labels
        monthlyLabel.classList.toggle('active', !isYearly);
        yearlyLabel.classList.toggle('active', isYearly);
        yearlyDiscount.style.display = isYearly ? 'inline' : 'none';
        
        // Update prices
        document.querySelectorAll('.monthly-price').forEach(function(el) {
            const monthly = parseFloat(el.dataset.monthly);
            const yearly = parseFloat(el.dataset.yearly);
            el.textContent = isYearly ? Math.round(yearly) : Math.round(monthly);
        });
        
        // Update periods
        document.querySelectorAll('.monthly-period').forEach(function(el) {
            el.style.display = isYearly ? 'none' : 'inline';
        });
        document.querySelectorAll('.yearly-period').forEach(function(el) {
            el.style.display = isYearly ? 'inline' : 'none';
        });
    }
});
</script>
@endif
