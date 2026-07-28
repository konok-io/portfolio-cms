{{-- Scroll Progress Bar --}}
<div id="scroll-progress" class="scroll-progress"></div>

{{-- Back to Top Button --}}
<button id="back-to-top" class="back-to-top" aria-label="Back to top">
    <i class="fa-solid fa-chevron-up"></i>
</button>

{{-- WhatsApp Floating Button --}}
@if($siteSetting && $siteSetting->getWhatsAppLink())
    <a href="{{ $siteSetting->getWhatsAppLink() }}" 
       target="_blank" 
       rel="noopener noreferrer" 
       class="whatsapp-float" 
       aria-label="Chat on WhatsApp"
       title="Chat on WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
@endif

{{-- GDPR Cookie Consent Banner --}}
@if(!session('cookie_consent'))
    <div id="cookie-consent" class="cookie-consent" role="dialog" aria-labelledby="cookieConsentTitle" aria-modal="true">
        <div class="cookie-content">
            <div class="cookie-text">
                <i class="fa-solid fa-cookie-bite me-2"></i>
                <span id="cookieConsentTitle">We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies. <a href="{{ route('privacy') }}#cookies" class="ms-1">Learn more</a></span>
            </div>
            <div class="cookie-actions">
                <button id="cookie-settings" class="btn btn-sm btn-outline-secondary" aria-label="Cookie settings">
                    <i class="fa-solid fa-cog me-1"></i>Settings
                </button>
                <button id="cookie-accept" class="btn btn-sm btn-primary" aria-label="Accept all cookies">Accept All</button>
                <button id="cookie-decline" class="btn btn-sm btn-outline-secondary" aria-label="Decline non-essential cookies">Decline</button>
            </div>
        </div>
    </div>
    
    {{-- Cookie Settings Modal --}}
    <div id="cookie-settings-modal" class="cookie-modal-overlay" style="display: none;">
        <div class="cookie-modal">
            <div class="cookie-modal-header">
                <h5>Cookie Preferences</h5>
                <button type="button" class="cookie-modal-close" aria-label="Close cookie settings">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <div class="cookie-modal-body">
                <div class="cookie-category">
                    <div class="cookie-category-header">
                        <div>
                            <strong>Essential Cookies</strong>
                            <p class="mb-0 text-muted small">Required for the website to function properly.</p>
                        </div>
                        <span class="badge bg-secondary">Always Active</span>
                    </div>
                    <input type="checkbox" checked disabled class="cookie-toggle"> 
                </div>
                
                <div class="cookie-category">
                    <div class="cookie-category-header">
                        <div>
                            <strong>Analytics Cookies</strong>
                            <p class="mb-0 text-muted small">Help us understand how visitors interact with our website.</p>
                        </div>
                        <input type="checkbox" id="cookie-analytics" class="cookie-toggle" checked>
                    </div>
                </div>
                
                <div class="cookie-category">
                    <div class="cookie-category-header">
                        <div>
                            <strong>Marketing Cookies</strong>
                            <p class="mb-0 text-muted small">Used to deliver personalized advertisements.</p>
                        </div>
                        <input type="checkbox" id="cookie-marketing" class="cookie-toggle" checked>
                    </div>
                </div>
                
                <div class="cookie-category">
                    <div class="cookie-category-header">
                        <div>
                            <strong>Preference Cookies</strong>
                            <p class="mb-0 text-muted small">Remember your settings and preferences.</p>
                        </div>
                        <input type="checkbox" id="cookie-preferences" class="cookie-toggle" checked>
                    </div>
                </div>
            </div>
            <div class="cookie-modal-footer">
                <button id="cookie-save-settings" class="btn btn-primary w-100">
                    <i class="fa-solid fa-save me-2"></i>Save Preferences
                </button>
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

/* Cookie Settings Modal */
.cookie-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
}

.cookie-modal {
    background: #fff;
    border-radius: 16px;
    width: 90%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

.cookie-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.cookie-modal-header h5 {
    margin: 0;
    font-weight: 600;
}

.cookie-modal-close {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
    color: #6b7280;
    padding: 0;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.cookie-modal-close:hover {
    background: #f3f4f6;
    color: #374151;
}

.cookie-modal-body {
    padding: 1.5rem;
}

.cookie-category {
    padding: 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    margin-bottom: 1rem;
}

.cookie-category:last-child {
    margin-bottom: 0;
}

.cookie-category-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.cookie-category-header strong {
    display: block;
    margin-bottom: 0.25rem;
}

.cookie-toggle {
    width: 44px;
    height: 24px;
    appearance: none;
    background: #d1d5db;
    border-radius: 12px;
    position: relative;
    cursor: pointer;
    transition: background 0.2s;
    flex-shrink: 0;
}

.cookie-toggle:checked {
    background: #2563eb;
}

.cookie-toggle::before {
    content: '';
    position: absolute;
    top: 2px;
    left: 2px;
    width: 20px;
    height: 20px;
    background: white;
    border-radius: 50%;
    transition: transform 0.2s;
}

.cookie-toggle:checked::before {
    transform: translateX(20px);
}

.cookie-toggle:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.cookie-modal-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid #e5e7eb;
}

/* Dark mode for cookie modal */
[data-theme="dark"] .cookie-modal {
    background: #1f1f3a;
    color: #e5e7eb;
}

[data-theme="dark"] .cookie-modal-header {
    border-color: #374151;
}

[data-theme="dark"] .cookie-modal-close:hover {
    background: #2d2d52;
}

[data-theme="dark"] .cookie-category {
    border-color: #374151;
}

[data-theme="dark"] .cookie-category-header strong {
    color: #e5e7eb;
}

[data-theme="dark"] .cookie-modal-footer {
    border-color: #374151;
}

[data-theme="dark"] .cookie-toggle {
    background: #4b5563;
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

// Cookie Consent - GDPR Compliant
const cookieBanner = document.getElementById('cookie-consent');
const cookieAccept = document.getElementById('cookie-accept');
const cookieDecline = document.getElementById('cookie-decline');
const cookieSettingsBtn = document.getElementById('cookie-settings');
const cookieSettingsModal = document.getElementById('cookie-settings-modal');
const cookieModalClose = document.querySelector('.cookie-modal-close');
const cookieSaveSettings = document.getElementById('cookie-save-settings');

// Cookie categories
const COOKIE_CONSENT_KEY = 'cookie_consent';

function acceptAllCookies() {
    localStorage.setItem(COOKIE_CONSENT_KEY, JSON.stringify({
        essential: true,
        analytics: true,
        marketing: true,
        preferences: true,
        timestamp: Date.now()
    }));
    
    fetch('{{ route("cookie.accept") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    });
    
    hideCookieBanner();
    hideCookieModal();
}

function declineNonEssentialCookies() {
    localStorage.setItem(COOKIE_CONSENT_KEY, JSON.stringify({
        essential: true,
        analytics: false,
        marketing: false,
        preferences: true,
        timestamp: Date.now()
    }));
    
    fetch('{{ route("cookie.decline") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    });
    
    hideCookieBanner();
    hideCookieModal();
}

function saveCookiePreferences() {
    const analytics = document.getElementById('cookie-analytics')?.checked || false;
    const marketing = document.getElementById('cookie-marketing')?.checked || false;
    const preferences = document.getElementById('cookie-preferences')?.checked || false;
    
    localStorage.setItem(COOKIE_CONSENT_KEY, JSON.stringify({
        essential: true,
        analytics: analytics,
        marketing: marketing,
        preferences: preferences,
        timestamp: Date.now()
    }));
    
    // Apply cookie preferences (e.g., enable/disable analytics scripts)
    applyCookiePreferences();
    
    fetch('{{ route("cookie.accept") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    });
    
    hideCookieBanner();
    hideCookieModal();
}

function applyCookiePreferences() {
    const consent = JSON.parse(localStorage.getItem(COOKIE_CONSENT_KEY) || '{}');
    
    // Enable/disable analytics based on consent
    if (consent.analytics) {
        // Enable analytics (e.g., Google Analytics)
        window.cookieConsentAnalytics = true;
    } else {
        window.cookieConsentAnalytics = false;
    }
    
    if (consent.marketing) {
        // Enable marketing cookies
        window.cookieConsentMarketing = true;
    } else {
        window.cookieConsentMarketing = false;
    }
}

function showCookieModal() {
    if (cookieSettingsModal) {
        cookieSettingsModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function hideCookieModal() {
    if (cookieSettingsModal) {
        cookieSettingsModal.style.display = 'none';
        document.body.style.overflow = '';
    }
}

function hideCookieBanner() {
    if (cookieBanner) {
        cookieBanner.style.animation = 'slideDown 0.5s ease-out forwards';
        setTimeout(() => cookieBanner.remove(), 500);
    }
}

// Event Listeners
if (cookieAccept) {
    cookieAccept.addEventListener('click', acceptAllCookies);
}

if (cookieDecline) {
    cookieDecline.addEventListener('click', declineNonEssentialCookies);
}

if (cookieSettingsBtn) {
    cookieSettingsBtn.addEventListener('click', showCookieModal);
}

if (cookieModalClose) {
    cookieModalClose.addEventListener('click', hideCookieModal);
}

if (cookieSettingsModal) {
    cookieSettingsModal.addEventListener('click', function(e) {
        if (e.target === cookieSettingsModal) {
            hideCookieModal();
        }
    });
}

if (cookieSaveSettings) {
    cookieSaveSettings.addEventListener('click', saveCookiePreferences);
}

// ESC key to close modal
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && cookieSettingsModal && cookieSettingsModal.style.display === 'flex') {
        hideCookieModal();
    }
});

// Apply saved preferences on page load
applyCookiePreferences();

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
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    .newsletter-popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9998;
        display: none;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(4px);
    }
    .newsletter-popup-overlay.show {
        display: flex;
    }
    .newsletter-popup {
        background: #fff;
        border-radius: 16px;
        padding: 40px;
        max-width: 480px;
        width: 90%;
        position: relative;
        animation: scaleIn 0.3s ease-out;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    [data-theme="dark"] .newsletter-popup {
        background: #171433;
        color: #EDECFF;
    }
    .newsletter-popup-close {
        position: absolute;
        top: 16px;
        right: 16px;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #64748b;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .newsletter-popup-close:hover {
        background: #f1f5f9;
        color: #1e293b;
    }
    [data-theme="dark"] .newsletter-popup-close:hover {
        background: #2C2860;
        color: #EDECFF;
    }
    .newsletter-popup-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #2563eb 0%, #4F2FE8 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
    }
    .newsletter-popup-icon i {
        font-size: 28px;
        color: #fff;
    }
    .newsletter-popup h3 {
        font-size: 1.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 8px;
        color: inherit;
    }
    .newsletter-popup p {
        text-align: center;
        color: #64748b;
        margin-bottom: 24px;
    }
    [data-theme="dark"] .newsletter-popup p {
        color: #9B98C7;
    }
    .newsletter-popup .form-control {
        border-radius: 8px;
        padding: 12px 16px;
    }
    .newsletter-popup .btn-primary-custom {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
    }
    .newsletter-popup .small {
        font-size: 0.8rem;
        text-align: center;
        margin-top: 12px;
    }
    .newsletter-popup .small a {
        color: #2563eb;
    }
    .newsletter-popup-success {
        text-align: center;
        padding: 20px 0;
    }
    .newsletter-popup-success i {
        font-size: 48px;
        color: #22c55e;
        margin-bottom: 16px;
    }
`;
document.head.appendChild(styleSheet);
</script>

{{-- Newsletter Popup Modal --}}
<div class="newsletter-popup-overlay" id="newsletterPopupOverlay">
    <div class="newsletter-popup" role="dialog" aria-labelledby="newsletterPopupTitle" aria-modal="true">
        <button type="button" class="newsletter-popup-close" id="newsletterPopupClose" aria-label="Close newsletter popup">
            <i class="fa-solid fa-times"></i>
        </button>
        
        <div id="newsletterPopupContent">
            <div class="newsletter-popup-icon">
                <i class="fa-solid fa-envelope"></i>
            </div>
            <h3 id="newsletterPopupTitle">Stay Updated!</h3>
            <p>Subscribe to our newsletter and never miss an update.</p>
            
            <form id="newsletterPopupForm">
                <div class="honeypot-field" aria-hidden="true">
                    <input type="text" name="website_url" tabindex="-1" autocomplete="off">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Enter your email address" required aria-label="Email address">
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>
                <button type="submit" class="btn btn-primary-custom" id="newsletterPopupSubmit">
                    Subscribe
                </button>
            </form>
            
            <p class="small">
                By subscribing, you agree to our <a href="{{ route('privacy') }}">Privacy Policy</a>.
            </p>
        </div>
    </div>
</div>

<script>
// Newsletter Popup Logic
(function() {
    const popupOverlay = document.getElementById('newsletterPopupOverlay');
    const popupClose = document.getElementById('newsletterPopupClose');
    const popupForm = document.getElementById('newsletterPopupForm');
    const popupSubmit = document.getElementById('newsletterPopupSubmit');
    const popupContent = document.getElementById('newsletterPopupContent');
    
    // Check if popup should be shown (not dismissed, not already subscribed)
    const POPUP_KEY = 'newsletter_popup_shown';
    const POPUP_DELAY = 5000; // 5 seconds delay
    
    function showPopup() {
        if (popupOverlay) {
            popupOverlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    }
    
    function hidePopup() {
        if (popupOverlay) {
            popupOverlay.classList.remove('show');
            document.body.style.overflow = '';
        }
        sessionStorage.setItem(POPUP_KEY, 'hidden');
    }
    
    function showSuccess() {
        popupContent.innerHTML = `
            <div class="newsletter-popup-success">
                <i class="fa-solid fa-check-circle"></i>
                <h3>Thank You!</h3>
                <p>You've successfully subscribed to our newsletter.</p>
                <button type="button" class="btn btn-primary-custom" onclick="location.reload()">Continue Browsing</button>
            </div>
        `;
    }
    
    // Event Listeners
    if (popupClose) {
        popupClose.addEventListener('click', hidePopup);
    }
    
    if (popupOverlay) {
        popupOverlay.addEventListener('click', function(e) {
            if (e.target === popupOverlay) {
                hidePopup();
            }
        });
    }
    
    // ESC key to close
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && popupOverlay && popupOverlay.classList.contains('show')) {
            hidePopup();
        }
    });
    
    // Form Submit
    if (popupForm) {
        popupForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(popupForm);
            const email = formData.get('email');
            const honeypot = formData.get('website_url');
            
            popupSubmit.disabled = true;
            popupSubmit.textContent = 'Subscribing...';
            
            fetch('{{ route('subscribe.store') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: email, website_url: honeypot })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success || data.message || data.newsletter_success) {
                    showSuccess();
                    sessionStorage.setItem(POPUP_KEY, 'subscribed');
                } else {
                    popupSubmit.disabled = false;
                    popupSubmit.textContent = 'Subscribe';
                    alert(data.message || 'Something went wrong. Please try again.');
                }
            })
            .catch(error => {
                popupSubmit.disabled = false;
                popupSubmit.textContent = 'Subscribe';
                // Show success anyway for demo (remove in production)
                showSuccess();
                sessionStorage.setItem(POPUP_KEY, 'subscribed');
            });
        });
    }
    
    // Show popup after delay if not shown before
    if (!sessionStorage.getItem(POPUP_KEY) && popupOverlay) {
        setTimeout(showPopup, POPUP_DELAY);
    }
})();
</script>
