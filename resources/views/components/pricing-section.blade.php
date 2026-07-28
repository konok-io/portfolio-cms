@props(['plans' => collect()])

@if($plans->count() > 0)
<section class="pricing-split-section" id="pricing">
    <div class="container">
        <div class="pricing-split-row">
            {{-- Left Side: Text Content --}}
            <div class="pricing-split-left reveal-on-scroll">
                <h2 class="pricing-split-title">Simple, Fair Pricing</h2>
                <p class="pricing-split-desc">Choose the plan that fits your needs. 14-day free trial included.</p>
                
                {{-- Monthly/Yearly Toggle --}}
                <div class="pricing-split-toggle">
                    <label class="pricing-toggle-option active" onclick="togglePricingPeriod('monthly')">
                        <input type="radio" name="pricing_period" value="monthly" checked>
                        <span>Monthly</span>
                    </label>
                    <label class="pricing-toggle-option" onclick="togglePricingPeriod('yearly')">
                        <input type="radio" name="pricing_period" value="yearly">
                        <span>Yearly</span>
                        <span class="pricing-save-badge">-20%</span>
                    </label>
                </div>
            </div>
            
            {{-- Right Side: Pricing Cards --}}
            <div class="pricing-split-right">
                <div class="pricing-split-grid">
                    @foreach($plans as $plan)
                    <div class="pricing-split-card {{ $plan->is_highlighted ? 'featured' : '' }} reveal-on-scroll">
                        @if($plan->badge)
                        <span class="pricing-split-badge">{{ $plan->badge }}</span>
                        @endif
                        
                        <h3 class="pricing-split-plan-name">{{ $plan->name }}</h3>
                        <p class="pricing-split-plan-desc">{{ $plan->description }}</p>
                        
                        <div class="pricing-split-price">
                            <span class="pricing-split-currency">{!! $plan->currency === 'BDT' ? '৳' : ($plan->currency === 'USD' ? '$' : $plan->currency) !!}</span>
                            <span class="pricing-split-amount" 
                                  data-monthly="{{ (int)$plan->monthly_price }}" 
                                  data-yearly="{{ (int)($plan->yearly_price ?: $plan->monthly_price * 0.8) }}">
                                {{ (int)$plan->monthly_price }}
                            </span>
                            <span class="pricing-split-period">/mo</span>
                        </div>
                        
                        <ul class="pricing-split-features">
                            @foreach($plan->getFeaturesArray() as $feature)
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <span>{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>
                        
                        @if($plan->button_url)
                        <a href="{{ $plan->button_url }}" class="pricing-split-btn {{ $plan->is_highlighted ? 'btn-primary-split' : 'btn-outline-split' }}">
                            {{ $plan->button_text ?: 'Get Started' }}
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .pricing-split-section {
        padding: 80px 0;
        background: #eff6ff;
    }
    
    [data-theme="dark"] .pricing-split-section {
        background: #1f1f3a;
    }
    
    .pricing-split-row {
        display: flex;
        align-items: center;
        gap: 60px;
    }
    
    .pricing-split-left {
        flex: 0 0 35%;
        max-width: 380px;
    }
    
    .pricing-split-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-color, #0f172a);
        margin-bottom: 12px;
        line-height: 1.2;
    }
    
    [data-theme="dark"] .pricing-split-title {
        color: #fff;
    }
    
    .pricing-split-desc {
        font-size: 0.95rem;
        color: #64748b;
        margin-bottom: 25px;
        line-height: 1.6;
    }
    
    [data-theme="dark"] .pricing-split-desc {
        color: #A8A4C8;
    }
    
    .pricing-split-toggle {
        display: inline-flex;
        background: #ffffff;
        border-radius: 50px;
        padding: 6px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }
    
    [data-theme="dark"] .pricing-split-toggle {
        background: #171433;
    }
    
    .pricing-toggle-option {
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        padding: 10px 18px;
        border-radius: 50px;
        transition: all 0.3s;
    }
    
    .pricing-toggle-option input {
        display: none;
    }
    
    .pricing-toggle-option span:first-of-type {
        font-weight: 600;
        font-size: 0.85rem;
        color: #64748b;
        transition: color 0.3s;
    }
    
    .pricing-toggle-option.active {
        background: var(--color-primary, #2563EB);
    }
    
    .pricing-toggle-option.active span:first-of-type {
        color: white;
    }
    
    .pricing-save-badge {
        background: #d1fae5;
        color: #059669;
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 700;
    }
    
    .pricing-toggle-option.active .pricing-save-badge {
        background: rgba(255,255,255,0.3);
        color: white;
    }
    
    .pricing-split-right {
        flex: 1;
    }
    
    .pricing-split-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
    }
    
    .pricing-split-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px;
        padding-bottom: 16px;
        position: relative;
        transition: all 0.3s;
        border: 1px solid #d1d5db;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    [data-theme="dark"] .pricing-split-card {
        background: #171433;
        border-color: #2C2860;
    }
    
    .pricing-split-card:hover {
        border-color: var(--color-primary, #2563EB);
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }
    
    .pricing-split-card.featured {
        background: var(--color-primary, #2563EB);
        color: white;
        border: none;
        box-shadow: 0 20px 40px rgba(37, 99, 235, 0.25);
        transform: scale(1.02);
    }
    
    .pricing-split-card.featured:hover {
        transform: scale(1.02);
        box-shadow: 0 25px 50px rgba(37, 99, 235, 0.35);
    }
    
    .pricing-split-badge {
        position: absolute;
        top: -10px;
        right: 20px;
        background: #fbbf24;
        color: #92400e;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
    }
    
    .pricing-split-plan-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-color, #0f172a);
        margin-bottom: 4px;
    }
    
    .pricing-split-card.featured .pricing-split-plan-name {
        color: white;
    }
    
    .pricing-split-plan-desc {
        font-size: 0.75rem;
        color: #64748b;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    
    [data-theme="dark"] .pricing-split-plan-desc {
        color: #A8A4C8;
    }
    
    .pricing-split-card.featured .pricing-split-plan-desc {
        color: rgba(255,255,255,0.8);
    }
    
    .pricing-split-price {
        display: flex;
        align-items: baseline;
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border-color, #e5e7eb);
    }
    
    [data-theme="dark"] .pricing-split-price {
        border-color: #2C2860;
    }
    
    .pricing-split-card.featured .pricing-split-price {
        border-color: rgba(255,255,255,0.2);
    }
    
    .pricing-split-currency {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--color-primary, #4f46e5);
        align-self: flex-start;
        margin-top: 4px;
    }
    
    .pricing-split-card.featured .pricing-split-currency {
        color: white;
    }
    
    .pricing-split-amount {
        font-size: 1.75rem;
        font-weight: 900;
        color: var(--text-color, #0f172a);
        line-height: 1;
    }
    
    [data-theme="dark"] .pricing-split-amount {
        color: #fff;
    }
    
    .pricing-split-card.featured .pricing-split-amount {
        color: white;
    }
    
    .pricing-split-period {
        font-size: 0.75rem;
        color: #64748b;
        margin-left: 2px;
    }
    
    .pricing-split-card.featured .pricing-split-period {
        color: rgba(255,255,255,0.7);
    }
    
    .pricing-split-features {
        list-style: none;
        padding: 0;
        margin: 0 0 16px 0;
    }
    
    .pricing-split-features li {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 4px 0;
        font-size: 0.8rem;
        color: #374151;
    }
    
    [data-theme="dark"] .pricing-split-features li {
        color: #E8E6F2;
    }
    
    .pricing-split-features li i {
        color: #059669;
        font-size: 0.7rem;
    }
    
    .pricing-split-card.featured .pricing-split-features li i {
        color: #34d399;
    }
    
    .pricing-split-btn {
        display: inline-block;
        width: 100%;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        text-align: center;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .btn-outline-split {
        background: transparent;
        border: 2px solid #e2e8f0;
        color: #374151;
    }
    
    .btn-outline-split:hover {
        border-color: var(--color-primary, #2563EB);
        color: var(--color-primary, #2563EB);
    }
    
    [data-theme="dark"] .btn-outline-split {
        border-color: #2C2860;
        color: #E8E6F2;
    }
    
    .btn-primary-split {
        background: var(--color-primary, #2563EB);
        border: 2px solid var(--color-primary, #2563EB);
        color: white;
    }
    
    .btn-primary-split:hover {
        background: var(--color-primary-dark, #1d4ed8);
        border-color: var(--color-primary-dark, #1d4ed8);
        color: white;
    }
    
    @media (max-width: 991px) {
        .pricing-split-row {
            flex-direction: column;
            gap: 30px;
        }
        
        .pricing-split-left {
            flex: none;
            max-width: 100%;
            text-align: center;
        }
        
        .pricing-split-toggle {
            justify-content: center;
        }
        
        .pricing-split-card.featured {
            transform: none;
        }
    }
</style>

<script>
function togglePricingPeriod(period) {
    const isYearly = period === 'yearly';
    
    // Update toggle UI
    document.querySelectorAll('.pricing-toggle-option').forEach(function(el) {
        el.classList.remove('active');
    });
    document.querySelector('.pricing-toggle-option[onclick*="' + period + '"]').classList.add('active');
    
    // Update prices
    document.querySelectorAll('.pricing-split-amount').forEach(function(el) {
        el.textContent = isYearly ? el.dataset.yearly : el.dataset.monthly;
    });
}

// Initialize toggle state
document.addEventListener('DOMContentLoaded', function() {
    togglePricingPeriod('monthly');
});
</script>
@endif
