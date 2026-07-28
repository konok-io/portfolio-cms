@props(['statistics' => collect()])

@if($statistics->count() > 0)
<section class="section bg-gradient-primary text-white py-5 stats-section">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach($statistics as $index => $stat)
                <div class="col-lg-2-5 col-md-4 col-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="stat-card text-center">
                        <div class="stat-icon mb-3">
                            <i class="{{ $stat->icon }}"></i>
                        </div>
                        <div class="stat-value" data-target="{{ $stat->value }}">
                            {{ $stat->prefix ?? '' }}{{ $stat->value }}{{ $stat->suffix ?? '' }}
                        </div>
                        <div class="stat-title">{{ $stat->title }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
.stats-section {
    background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
    position: relative;
    overflow: hidden;
}

.stats-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.col-lg-2-5 {
    flex: 0 0 20%;
    max-width: 20%;
}

@media (max-width: 991px) {
    .col-lg-2-5 {
        flex: 0 0 25%;
        max-width: 25%;
    }
}

@media (max-width: 575px) {
    .col-lg-2-5 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

.stat-card {
    padding: 1.5rem 1rem;
    position: relative;
    z-index: 1;
}

.stat-icon i {
    font-size: 2.5rem;
    opacity: 0.9;
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 0.5rem;
}

.stat-title {
    font-size: 0.95rem;
    font-weight: 500;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

@media (max-width: 767px) {
    .stat-value {
        font-size: 2rem;
    }
    
    .stat-icon i {
        font-size: 2rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate counter when section is in view
    const observerOptions = {
        threshold: 0.3,
        rootMargin: '0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                animateCounters(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        observer.observe(statsSection);
    }
    
    function animateCounters(section) {
        const counters = section.querySelectorAll('.stat-value[data-target]');
        
        counters.forEach(function(counter) {
            const target = parseInt(counter.dataset.target);
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;
            
            const updateCounter = function() {
                current += increment;
                if (current < target) {
                    counter.textContent = counter.textContent.replace(/[\d,]/g, '') + formatNumber(Math.floor(current));
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = counter.textContent.replace(/[\d,]/g, '') + formatNumber(target);
                }
            };
            
            updateCounter();
        });
    }
    
    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
});
</script>
@endif
