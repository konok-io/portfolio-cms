{{-- Scroll Progress Bar --}}
<div id="scroll-progress" class="scroll-progress"></div>

{{-- Back to Top Button --}}
<button id="back-to-top" class="back-to-top" aria-label="Back to top">
    <i class="fa-solid fa-chevron-up"></i>
</button>

{{-- Cookie Consent Banner --}}
@if(!session('cookie_consent'))
    <div id="cookie-consent" class="cookie-consent">
        <div class="cookie-content">
            <div class="cookie-text">
                <i class="fa-solid fa-cookie-bite me-2"></i>
                <span>We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.</span>
                <a href="{{ route('privacy') }}" class="ms-1">Learn more</a>
            </div>
            <div class="cookie-actions">
                <button id="cookie-accept" class="btn btn-sm btn-primary">Accept</button>
                <button id="cookie-decline" class="btn btn-sm btn-outline-secondary">Decline</button>
            </div>
        </div>
    </div>
@endif

<style>
/* Scroll Progress Bar */
.scroll-progress {
    position: fixed;
    top: 0;
    left: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--color-primary, #4F2FE8), var(--color-secondary, #7B61FF));
    width: 0%;
    z-index: 9999;
    transition: width 0.1s ease-out;
}

/* Back to Top Button */
.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--color-primary, #4F2FE8);
    color: white;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.3s ease;
    z-index: 1000;
    box-shadow: 0 4px 15px rgba(79, 47, 232, 0.3);
}

.back-to-top.visible {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.back-to-top:hover {
    background: var(--color-secondary, #7B61FF);
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(79, 47, 232, 0.4);
}

.back-to-top i {
    font-size: 18px;
}

/* Cookie Consent Banner */
.cookie-consent {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
    color: white;
    padding: 1rem;
    z-index: 9998;
    box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.2);
    animation: slideUp 0.5s ease-out;
}

@keyframes slideUp {
    from {
        transform: translateY(100%);
    }
    to {
        transform: translateY(0);
    }
}

.cookie-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
}

.cookie-text {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    font-size: 14px;
}

.cookie-text i {
    color: #fbbf24;
}

.cookie-text a {
    color: #93c5fd;
    text-decoration: underline;
}

.cookie-text a:hover {
    color: #60a5fa;
}

.cookie-actions {
    display: flex;
    gap: 0.5rem;
}

.cookie-actions .btn {
    padding: 0.5rem 1rem;
    font-size: 13px;
}

@media (max-width: 768px) {
    .cookie-content {
        flex-direction: column;
        text-align: center;
    }
    
    .cookie-text {
        justify-content: center;
    }
    
    .cookie-actions {
        width: 100%;
        justify-content: center;
    }
    
    .back-to-top {
        bottom: 100px;
        right: 20px;
        width: 44px;
        height: 44px;
    }
}
</style>

<script>
// Scroll Progress Bar
window.addEventListener('scroll', function() {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    const scrollPercent = (scrollTop / docHeight) * 100;
    document.getElementById('scroll-progress').style.width = scrollPercent + '%';
});

// Back to Top Button
const backToTopBtn = document.getElementById('back-to-top');
window.addEventListener('scroll', function() {
    if (window.scrollY > 500) {
        backToTopBtn.classList.add('visible');
    } else {
        backToTopBtn.classList.remove('visible');
    }
});

backToTopBtn.addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

// Cookie Consent
const cookieBanner = document.getElementById('cookie-consent');
const cookieAccept = document.getElementById('cookie-accept');
const cookieDecline = document.getElementById('cookie-decline');

if (cookieAccept) {
    cookieAccept.addEventListener('click', function() {
        fetch('{{ route("cookie.accept") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(() => {
            cookieBanner.style.animation = 'slideDown 0.5s ease-out forwards';
            setTimeout(() => cookieBanner.remove(), 500);
        });
    });
}

if (cookieDecline) {
    cookieDecline.addEventListener('click', function() {
        fetch('{{ route("cookie.decline") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(() => {
            cookieBanner.style.animation = 'slideDown 0.5s ease-out forwards';
            setTimeout(() => cookieBanner.remove(), 500);
        });
    });
}

// Add slideDown animation
const styleSheet = document.createElement('style');
styleSheet.textContent = `
    @keyframes slideDown {
        from {
            transform: translateY(0);
        }
        to {
            transform: translateY(100%);
        }
    }
`;
document.head.appendChild(styleSheet);
</script>
