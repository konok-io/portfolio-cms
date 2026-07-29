@extends('front.layouts.app')

@section('seo_title', 'Terms of Service')
@section('meta_description', 'Read our terms of service to understand the rules and guidelines for using our website and services.')

@section('content')
{{-- Page Header --}}
<section class="terms-hero">
    <div class="hero-shapes">
        <div class="hero-shape hero-shape-1"></div>
        <div class="hero-shape hero-shape-2"></div>
        <div class="hero-shape hero-shape-3"></div>
        <div class="hero-shape hero-shape-4"></div>
    </div>
    <div class="container">
        <div class="text-center">
            <div class="hero-badge">
                <i class="fa-solid fa-file-contract me-2"></i>
                <span>Legal</span>
            </div>
            <h1 class="hero-title">Terms of Service</h1>
            <p class="hero-subtitle">Please read these terms carefully before using our services. By accessing our website, you agree to be bound by these terms.</p>
            <div class="hero-meta">
                <span class="meta-item">
                    <i class="fa-solid fa-calendar-check me-1"></i>
                    Updated: {{ now()->format('F d, Y') }}
                </span>
                <span class="meta-divider">•</span>
                <span class="meta-item">
                    <i class="fa-solid fa-clock me-1"></i>
                    8 min read
                </span>
            </div>
        </div>
    </div>
</section>

{{-- Content Section --}}
<section class="section-padding section-2">
    <div class="container">
        {{-- Table of Contents --}}
        <div class="terms-toc">
            <div class="toc-header">
                <i class="fa-solid fa-list-ol me-2"></i>
                <span>Table of Contents</span>
            </div>
            <div class="toc-grid">
                <a href="#acceptance" class="toc-item">
                    <span class="toc-number">01</span>
                    <span class="toc-text">Acceptance of Terms</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#services" class="toc-item">
                    <span class="toc-number">02</span>
                    <span class="toc-text">Services</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#responsibilities" class="toc-item">
                    <span class="toc-number">03</span>
                    <span class="toc-text">User Responsibilities</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#intellectual" class="toc-item">
                    <span class="toc-number">04</span>
                    <span class="toc-text">Intellectual Property</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#payment" class="toc-item">
                    <span class="toc-number">05</span>
                    <span class="toc-text">Payment Terms</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#confidentiality" class="toc-item">
                    <span class="toc-number">06</span>
                    <span class="toc-text">Confidentiality</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#warranty" class="toc-item">
                    <span class="toc-number">07</span>
                    <span class="toc-text">Warranty</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#liability" class="toc-item">
                    <span class="toc-number">08</span>
                    <span class="toc-text">Limitation</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#termination" class="toc-item">
                    <span class="toc-number">09</span>
                    <span class="toc-text">Termination</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#contact" class="toc-item">
                    <span class="toc-number">10</span>
                    <span class="toc-text">Contact</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
            </div>
        </div>

        {{-- Section 1: Acceptance --}}
        <div class="terms-block" id="acceptance">
            <div class="block-header">
                <div class="block-number">01</div>
                <div class="block-content">
                    <h2 class="block-title">Acceptance of Terms</h2>
                    <p class="block-desc">By accessing or using our website and services, you agree to be bound by these Terms.</p>
                </div>
            </div>
            <div class="acceptance-content">
                <div class="acceptance-box">
                    <div class="acceptance-icon">
                        <i class="fa-solid fa-handshake"></i>
                    </div>
                    <div class="acceptance-text">
                        <h4>Agreement to Terms</h4>
                        <p>These Terms constitute a legally binding agreement between you and <strong>{{ $siteSetting->site_name ?? 'us' }}</strong>. If you do not agree to these Terms, please do not use our services.</p>
                    </div>
                </div>
                <div class="acceptance-box">
                    <div class="acceptance-icon warning">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div class="acceptance-text">
                        <h4>Important Notice</h4>
                        <p>Your continued use of our services after any changes to these Terms constitutes your acceptance of the updated terms.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: Services --}}
        <div class="terms-block" id="services">
            <div class="block-header">
                <div class="block-number">02</div>
                <div class="block-content">
                    <h2 class="block-title">Description of Services</h2>
                    <p class="block-desc">We provide professional web development, design, and technology services tailored to your needs.</p>
                </div>
            </div>
            <div class="services-cards">
                <div class="service-card">
                    <div class="service-card-icon">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <h4>Web Development</h4>
                    <p>Custom web applications and websites built with modern technologies.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon">
                        <i class="fa-solid fa-palette"></i>
                    </div>
                    <h4>UI/UX Design</h4>
                    <p>Beautiful and intuitive user interface designs that enhance user experience.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon">
                        <i class="fa-solid fa-mobile-screen"></i>
                    </div>
                    <h4>Responsive Design</h4>
                    <p>Mobile-first designs that work perfectly on all devices.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon">
                        <i class="fa-solid fa-server"></i>
                    </div>
                    <h4>Backend Solutions</h4>
                    <p>Robust server-side development and database management.</p>
                </div>
            </div>
        </div>

        {{-- Section 3: Responsibilities --}}
        <div class="terms-block" id="responsibilities">
            <div class="block-header">
                <div class="block-number">03</div>
                <div class="block-content">
                    <h2 class="block-title">User Responsibilities</h2>
                    <p class="block-desc">By using our services, you agree to the following responsibilities.</p>
                </div>
            </div>
            <div class="responsibilities-grid">
                <div class="responsibility-section">
                    <h5 class="resp-title"><i class="fa-solid fa-check-circle me-2"></i>You Must:</h5>
                    <ul class="resp-list">
                        <li>Provide accurate, current, and complete information</li>
                        <li>Maintain the security of your account credentials</li>
                        <li>Notify us immediately of any unauthorized use</li>
                        <li>Use our services in compliance with all laws</li>
                    </ul>
                </div>
                <div class="responsibility-section">
                    <h5 class="resp-title prohibited"><i class="fa-solid fa-xmark-circle me-2"></i>You Must Not:</h5>
                    <ul class="resp-list prohibited">
                        <li>Use our services for illegal purposes</li>
                        <li>Interfere with or disrupt our services</li>
                        <li>Attempt unauthorized system access</li>
                        <li>Share your account without permission</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Section 4: Intellectual Property --}}
        <div class="terms-block" id="intellectual">
            <div class="block-header">
                <div class="block-number">04</div>
                <div class="block-content">
                    <h2 class="block-title">Intellectual Property</h2>
                    <p class="block-desc">Understanding ownership and rights to content and work produced.</p>
                </div>
            </div>
            <div class="ip-content">
                <div class="ip-card">
                    <div class="ip-header">
                        <div class="ip-icon">
                            <i class="fa-solid fa-copyright"></i>
                        </div>
                        <div>
                            <h4>Our Intellectual Property</h4>
                            <span class="ip-badge">Owned</span>
                        </div>
                    </div>
                    <p>All content, designs, logos, and materials on this website are the property of {{ $siteSetting->site_name ?? 'us' }} or our licensors and are protected by copyright laws.</p>
                    <div class="ip-warning">
                        <i class="fa-solid fa-exclamation-triangle"></i>
                        <p class="mb-0">You may not reproduce, distribute, or create derivative works without our express written permission.</p>
                    </div>
                </div>
                <div class="ip-card">
                    <div class="ip-header">
                        <div class="ip-icon client">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div>
                            <h4>Client Projects</h4>
                            <span class="ip-badge client">Custom</span>
                        </div>
                    </div>
                    <p>For client projects, ownership rights will be clearly defined in individual project agreements and contracts.</p>
                </div>
            </div>
        </div>

        {{-- Section 5: Payment --}}
        <div class="terms-block" id="payment">
            <div class="block-header">
                <div class="block-number">05</div>
                <div class="block-content">
                    <h2 class="block-title">Payment Terms</h2>
                    <p class="block-desc">Clear and transparent payment policies for our services.</p>
                </div>
            </div>
            <div class="payment-steps">
                <div class="payment-step">
                    <div class="step-icon">
                        <i class="fa-solid fa-1"></i>
                    </div>
                    <div class="step-content">
                        <h5>Deposit Required</h5>
                        <p>A deposit may be required before work begins on your project.</p>
                    </div>
                </div>
                <div class="payment-step">
                    <div class="step-icon">
                        <i class="fa-solid fa-2"></i>
                    </div>
                    <div class="step-content">
                        <h5>Invoice Payment</h5>
                        <p>Payment is due within the timeframe specified on your invoice.</p>
                    </div>
                </div>
                <div class="payment-step">
                    <div class="step-icon">
                        <i class="fa-solid fa-3"></i>
                    </div>
                    <div class="step-content">
                        <h5>Payment Methods</h5>
                        <p>We accept various secure payment methods for your convenience.</p>
                    </div>
                </div>
                <div class="payment-step warning">
                    <div class="step-icon">
                        <i class="fa-solid fa-4"></i>
                    </div>
                    <div class="step-content">
                        <h5>Late Fees</h5>
                        <p>Late payments may incur additional fees as specified in your agreement.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 6: Confidentiality --}}
        <div class="terms-block" id="confidentiality">
            <div class="block-header">
                <div class="block-number">06</div>
                <div class="block-content">
                    <h2 class="block-title">Confidentiality</h2>
                    <p class="block-desc">We respect the confidentiality of your business information.</p>
                </div>
            </div>
            <div class="confidentiality-content">
                <p class="conf-intro">We respect the confidentiality of your business information and project details. We will not disclose confidential information to third parties without your consent, except as required by law.</p>
                <div class="conf-badges">
                    <div class="conf-badge">
                        <i class="fa-solid fa-user-secret"></i>
                        <span>Client Privacy</span>
                    </div>
                    <div class="conf-badge">
                        <i class="fa-solid fa-file-contract"></i>
                        <span>NDA Protection</span>
                    </div>
                    <div class="conf-badge">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Secure Handling</span>
                    </div>
                    <div class="conf-badge">
                        <i class="fa-solid fa-lock"></i>
                        <span>Data Protection</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 7: Warranty --}}
        <div class="terms-block" id="warranty">
            <div class="block-header">
                <div class="block-number">07</div>
                <div class="block-content">
                    <h2 class="block-title">Warranty and Disclaimer</h2>
                    <p class="block-desc">Understanding our service guarantees and limitations.</p>
                </div>
            </div>
            <div class="warranty-content">
                <div class="warranty-box">
                    <div class="warranty-icon">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                    <div class="warranty-text">
                        <h4>"As Is" Services</h4>
                        <p>Our services are provided <strong>"as is"</strong> and <strong>"as available."</strong> We strive to deliver high-quality work but cannot guarantee uninterrupted or error-free services at all times.</p>
                    </div>
                </div>
                <div class="disclaimer-box">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <h5>Disclaimer</h5>
                        <p class="mb-0">We do not warrant that our services will be uninterrupted, error-free, or completely secure. We disclaim all warranties, express or implied, including merchantability and fitness for a particular purpose.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 8: Liability --}}
        <div class="terms-block" id="liability">
            <div class="block-header">
                <div class="block-number">08</div>
                <div class="block-content">
                    <h2 class="block-title">Limitation of Liability</h2>
                    <p class="block-desc">Understanding the extent of our responsibility.</p>
                </div>
            </div>
            <div class="liability-content">
                <div class="liability-box">
                    <p>To the fullest extent permitted by law, we shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of our services.</p>
                </div>
                <div class="liability-highlight">
                    <div class="liability-icon">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <div class="liability-text">
                        <h5>Maximum Liability</h5>
                        <p class="mb-0">Our total liability shall not exceed the amount you paid for the specific service giving rise to the claim.</p>
                    </div>
                </div>
                <div class="indemnification-box">
                    <h5><i class="fa-solid fa-shield me-2"></i>Indemnification</h5>
                    <p>You agree to indemnify, defend, and hold harmless {{ $siteSetting->site_name ?? 'us' }}, our affiliates, and personnel from any claims, damages, or expenses arising from:</p>
                    <ul>
                        <li>Your violation of these Terms</li>
                        <li>Your use of our services</li>
                        <li>Any unauthorized access to your account</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Section 9: Termination --}}
        <div class="terms-block" id="termination">
            <div class="block-header">
                <div class="block-number">09</div>
                <div class="block-content">
                    <h2 class="block-title">Termination</h2>
                    <p class="block-desc">Terms for ending our service relationship.</p>
                </div>
            </div>
            <div class="termination-content">
                <p class="term-intro">Either party may terminate services with written notice. Upon termination:</p>
                <div class="termination-items">
                    <div class="term-item">
                        <div class="term-icon">
                            <i class="fa-solid fa-credit-card"></i>
                        </div>
                        <div class="term-text">
                            <h5>Payment Due</h5>
                            <p>You will pay for all services rendered up to the termination date.</p>
                        </div>
                    </div>
                    <div class="term-item">
                        <div class="term-icon">
                            <i class="fa-solid fa-box"></i>
                        </div>
                        <div class="term-text">
                            <h5>Deliverables</h5>
                            <p>We will deliver completed work as per the agreement.</p>
                        </div>
                    </div>
                    <div class="term-item">
                        <div class="term-icon">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="term-text">
                            <h5>Confidentiality</h5>
                            <p>All confidentiality obligations will survive termination.</p>
                        </div>
                    </div>
                </div>
                <div class="governing-box">
                    <i class="fa-solid fa-landmark me-2"></i>
                    <div>
                        <h5>Governing Law</h5>
                        <p class="mb-0">These Terms shall be governed by applicable laws. Any disputes shall be resolved through binding arbitration or in the courts of the applicable jurisdiction.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 10: Contact --}}
        <div class="terms-contact-block" id="contact">
            <div class="contact-bg-pattern"></div>
            <div class="contact-content">
                <div class="contact-header">
                    <span class="contact-label">Get in Touch</span>
                    <h2>Questions About Terms?</h2>
                    <p>If you have any questions about these Terms of Service, please reach out to our legal team.</p>
                </div>
                <div class="contact-options">
                    @if($siteSetting->email)
                    <a href="mailto:{{ $siteSetting->email }}" class="contact-option">
                        <div class="contact-option-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="contact-option-text">
                            <span>Email Us</span>
                            <strong>{{ $siteSetting->email }}</strong>
                        </div>
                        <i class="fa-solid fa-arrow-right contact-arrow"></i>
                    </a>
                    @endif
                    @if($siteSetting->phone)
                    <a href="tel:{{ $siteSetting->phone }}" class="contact-option">
                        <div class="contact-option-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="contact-option-text">
                            <span>Call Us</span>
                            <strong>{{ $siteSetting->phone }}</strong>
                        </div>
                        <i class="fa-solid fa-arrow-right contact-arrow"></i>
                    </a>
                    @endif
                    <a href="{{ route('contact') }}" class="contact-option">
                        <div class="contact-option-icon">
                            <i class="fa-solid fa-comment-dots"></i>
                        </div>
                        <div class="contact-option-text">
                            <span>Send Message</span>
                            <strong>Contact Form</strong>
                        </div>
                        <i class="fa-solid fa-arrow-right contact-arrow"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="terms-footer">
            <div class="footer-icon">
                <i class="fa-solid fa-file-contract"></i>
            </div>
            <p>These Terms of Service were last updated on {{ now()->format('F d, Y') }}. We reserve the right to modify these terms at any time.</p>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Hero Section */
    .terms-hero {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #1e40af 100%);
        padding: 80px 0 100px;
        position: relative;
        overflow: hidden;
    }
    
    .hero-shapes {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        overflow: hidden;
    }
    
    .hero-shape {
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.02));
    }
    
    .hero-shape-1 { width: 400px; height: 400px; top: -150px; right: -100px; }
    .hero-shape-2 { width: 300px; height: 300px; bottom: -100px; left: -50px; }
    .hero-shape-3 { width: 200px; height: 200px; top: 50%; left: 20%; }
    .hero-shape-4 { width: 150px; height: 150px; bottom: 20%; right: 30%; }
    
    .hero-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 20px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 50px;
        color: #ffffff;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(10px);
    }
    
    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
    }
    
    .hero-subtitle {
        font-size: 1.25rem;
        color: rgba(255,255,255,0.8);
        max-width: 600px;
        margin: 0 auto 2rem;
        line-height: 1.7;
    }
    
    .hero-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .meta-item {
        display: inline-flex;
        align-items: center;
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
    }
    
    .meta-divider {
        color: rgba(255,255,255,0.3);
    }
    
    /* Table of Contents */
    .terms-toc {
        background: #ffffff;
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    
    [data-theme="dark"] .terms-toc {
        background: #1e293b;
        border-color: #334155;
    }
    
    .toc-header {
        display: flex;
        align-items: center;
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e2e8f0;
    }
    
    [data-theme="dark"] .toc-header {
        color: #f1f5f9;
        border-color: #334155;
    }
    
    .toc-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 12px;
    }
    
    .toc-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        background: #f8fafc;
        border-radius: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    
    .toc-item:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        transform: translateX(5px);
    }
    
    [data-theme="dark"] .toc-item {
        background: #0f0f2d;
    }
    
    [data-theme="dark"] .toc-item:hover {
        background: rgba(37, 99, 235, 0.15);
        border-color: rgba(37, 99, 235, 0.3);
    }
    
    .toc-number {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--color-primary);
        background: rgba(37, 99, 235, 0.1);
        padding: 4px 10px;
        border-radius: 8px;
    }
    
    .toc-text {
        flex: 1;
        font-size: 0.9rem;
        font-weight: 600;
        color: #475569;
    }
    
    [data-theme="dark"] .toc-text {
        color: #94a3b8;
    }
    
    .toc-arrow {
        color: #94a3b8;
        transition: transform 0.3s ease;
    }
    
    .toc-item:hover .toc-arrow {
        transform: translateX(3px);
        color: var(--color-primary);
    }
    
    /* Terms Block */
    .terms-block {
        background: #ffffff;
        border-radius: 24px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .terms-block:hover {
        box-shadow: 0 20px 50px rgba(0,0,0,0.08);
    }
    
    [data-theme="dark"] .terms-block {
        background: #1e293b;
        border-color: #334155;
    }
    
    .block-header {
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #f1f5f9;
    }
    
    [data-theme="dark"] .block-header {
        border-color: #334155;
    }
    
    .block-number {
        font-size: 2rem;
        font-weight: 900;
        color: rgba(37, 99, 235, 0.15);
        line-height: 1;
    }
    
    .block-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    [data-theme="dark"] .block-title {
        color: #f1f5f9;
    }
    
    .block-desc {
        color: #64748b;
        font-size: 1.05rem;
        margin: 0;
    }
    
    [data-theme="dark"] .block-desc {
        color: #94a3b8;
    }
    
    /* Acceptance Content */
    .acceptance-content {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .acceptance-content { grid-template-columns: 1fr; }
    }
    
    .acceptance-box {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 16px;
        border: 1px solid transparent;
        transition: all 0.3s ease;
    }
    
    .acceptance-box:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
    }
    
    [data-theme="dark"] .acceptance-box {
        background: #0f0f2d;
    }
    
    [data-theme="dark"] .acceptance-box:hover {
        background: rgba(37, 99, 235, 0.1);
        border-color: rgba(37, 99, 235, 0.2);
    }
    
    .acceptance-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    
    .acceptance-icon.warning {
        background: linear-gradient(135deg, #d97706, #f59e0b);
    }
    
    .acceptance-text h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    [data-theme="dark"] .acceptance-text h4 {
        color: #f1f5f9;
    }
    
    .acceptance-text p {
        font-size: 0.9rem;
        color: #64748b;
        margin: 0;
        line-height: 1.6;
    }
    
    [data-theme="dark"] .acceptance-text p {
        color: #94a3b8;
    }
    
    /* Services Cards */
    .services-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 992px) {
        .services-cards { grid-template-columns: repeat(2, 1fr); }
    }
    
    @media (max-width: 576px) {
        .services-cards { grid-template-columns: 1fr; }
    }
    
    .service-card {
        background: #f8fafc;
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    
    .service-card:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        transform: translateY(-5px);
    }
    
    [data-theme="dark"] .service-card {
        background: #0f0f2d;
    }
    
    [data-theme="dark"] .service-card:hover {
        background: rgba(37, 99, 235, 0.1);
        border-color: rgba(37, 99, 235, 0.2);
    }
    
    .service-card-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.4rem;
        margin: 0 auto 1rem;
    }
    
    .service-card h4 {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    [data-theme="dark"] .service-card h4 {
        color: #f1f5f9;
    }
    
    .service-card p {
        font-size: 0.85rem;
        color: #64748b;
        margin: 0;
        line-height: 1.5;
    }
    
    [data-theme="dark"] .service-card p {
        color: #94a3b8;
    }
    
    /* Responsibilities */
    .responsibilities-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .responsibilities-grid { grid-template-columns: 1fr; }
    }
    
    .responsibility-section {
        background: #f0fdf4;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid #bbf7d0;
    }
    
    .responsibility-section:nth-child(2) {
        background: #fef2f2;
        border-color: #fecaca;
    }
    
    [data-theme="dark"] .responsibility-section {
        background: rgba(34, 197, 94, 0.1);
        border-color: rgba(34, 197, 94, 0.2);
    }
    
    [data-theme="dark"] .responsibility-section:nth-child(2) {
        background: rgba(220, 38, 38, 0.1);
        border-color: rgba(220, 38, 38, 0.2);
    }
    
    .resp-title {
        font-size: 1rem;
        font-weight: 700;
        color: #166534;
        margin-bottom: 1rem;
    }
    
    .resp-title.prohibited {
        color: #dc2626;
    }
    
    [data-theme="dark"] .resp-title {
        color: #4ade80;
    }
    
    [data-theme="dark"] .resp-title.prohibited {
        color: #f87171;
    }
    
    .resp-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .resp-list li {
        position: relative;
        padding-left: 1.5rem;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        color: #166534;
    }
    
    .resp-list li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #16a34a;
        font-weight: 700;
    }
    
    .resp-list.prohibited li {
        color: #dc2626;
    }
    
    .resp-list.prohibited li::before {
        content: '✗';
        color: #dc2626;
    }
    
    [data-theme="dark"] .resp-list li {
        color: #86efac;
    }
    
    [data-theme="dark"] .resp-list.prohibited li {
        color: #fca5a5;
    }
    
    /* IP Content */
    .ip-content {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .ip-content { grid-template-columns: 1fr; }
    }
    
    .ip-card {
        background: #f8fafc;
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid #e2e8f0;
    }
    
    [data-theme="dark"] .ip-card {
        background: #0f0f2d;
        border-color: #334155;
    }
    
    .ip-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .ip-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.3rem;
    }
    
    .ip-icon.client {
        background: linear-gradient(135deg, #7c3aed, #8b5cf6);
    }
    
    .ip-header h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }
    
    [data-theme="dark"] .ip-header h4 {
        color: #f1f5f9;
    }
    
    .ip-badge {
        display: inline-block;
        padding: 2px 10px;
        background: rgba(37, 99, 235, 0.1);
        color: var(--color-primary);
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    
    .ip-badge.client {
        background: rgba(124, 58, 237, 0.1);
        color: #7c3aed;
    }
    
    .ip-card p {
        font-size: 0.9rem;
        color: #64748b;
        margin-bottom: 1rem;
        line-height: 1.6;
    }
    
    [data-theme="dark"] .ip-card p {
        color: #94a3b8;
    }
    
    .ip-warning {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 1rem;
        background: #fef3c7;
        border-radius: 12px;
        border: 1px solid #fde68a;
    }
    
    .ip-warning i {
        font-size: 1.2rem;
        color: #d97706;
        flex-shrink: 0;
    }
    
    .ip-warning p {
        font-size: 0.85rem;
        color: #92400e;
        margin: 0;
    }
    
    [data-theme="dark"] .ip-warning {
        background: rgba(217, 119, 6, 0.1);
        border-color: rgba(217, 119, 6, 0.3);
    }
    
    [data-theme="dark"] .ip-warning i,
    [data-theme="dark"] .ip-warning p {
        color: #fbbf24;
    }
    
    /* Payment Steps */
    .payment-steps {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 992px) {
        .payment-steps { grid-template-columns: repeat(2, 1fr); }
    }
    
    @media (max-width: 576px) {
        .payment-steps { grid-template-columns: 1fr; }
    }
    
    .payment-step {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
    }
    
    .payment-step.warning {
        background: #fef3c7;
        border-color: #fde68a;
    }
    
    [data-theme="dark"] .payment-step {
        background: #0f0f2d;
        border-color: #334155;
    }
    
    [data-theme="dark"] .payment-step.warning {
        background: rgba(217, 119, 6, 0.1);
        border-color: rgba(217, 119, 6, 0.3);
    }
    
    .step-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    
    .step-content h5 {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.35rem;
    }
    
    [data-theme="dark"] .step-content h5 {
        color: #f1f5f9;
    }
    
    .step-content p {
        font-size: 0.82rem;
        color: #64748b;
        margin: 0;
        line-height: 1.5;
    }
    
    [data-theme="dark"] .step-content p {
        color: #94a3b8;
    }
    
    /* Confidentiality */
    .confidentiality-content {
        text-align: center;
    }
    
    .conf-intro {
        font-size: 1rem;
        color: #475569;
        max-width: 700px;
        margin: 0 auto 2rem;
        line-height: 1.7;
    }
    
    [data-theme="dark"] .conf-intro {
        color: #94a3b8;
    }
    
    .conf-badges {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .conf-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--color-primary);
    }
    
    .conf-badge i {
        font-size: 1rem;
    }
    
    [data-theme="dark"] .conf-badge {
        background: rgba(37, 99, 235, 0.1);
        border-color: rgba(37, 99, 235, 0.2);
        color: #93c5fd;
    }
    
    /* Warranty */
    .warranty-content {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .warranty-box {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
    }
    
    [data-theme="dark"] .warranty-box {
        background: #0f0f2d;
        border-color: #334155;
    }
    
    .warranty-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    
    .warranty-text h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    [data-theme="dark"] .warranty-text h4 {
        color: #f1f5f9;
    }
    
    .warranty-text p {
        font-size: 0.9rem;
        color: #64748b;
        margin: 0;
        line-height: 1.6;
    }
    
    [data-theme="dark"] .warranty-text p {
        color: #94a3b8;
    }
    
    .disclaimer-box {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        background: #fef3c7;
        border-radius: 16px;
        border: 1px solid #fde68a;
    }
    
    .disclaimer-box i {
        font-size: 1.5rem;
        color: #d97706;
        flex-shrink: 0;
    }
    
    .disclaimer-box h5 {
        font-size: 1rem;
        font-weight: 700;
        color: #92400e;
        margin-bottom: 0.35rem;
    }
    
    .disclaimer-box p {
        font-size: 0.9rem;
        color: #92400e;
        margin: 0;
        line-height: 1.6;
    }
    
    [data-theme="dark"] .disclaimer-box {
        background: rgba(217, 119, 6, 0.1);
        border-color: rgba(217, 119, 6, 0.3);
    }
    
    [data-theme="dark"] .disclaimer-box i,
    [data-theme="dark"] .disclaimer-box h5,
    [data-theme="dark"] .disclaimer-box p {
        color: #fbbf24;
    }
    
    /* Liability */
    .liability-content {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .liability-box {
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
    }
    
    .liability-box p {
        font-size: 0.95rem;
        color: #475569;
        margin: 0;
        line-height: 1.7;
    }
    
    [data-theme="dark"] .liability-box {
        background: #0f0f2d;
        border-color: #334155;
    }
    
    [data-theme="dark"] .liability-box p {
        color: #94a3b8;
    }
    
    .liability-highlight {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-radius: 16px;
    }
    
    .liability-icon {
        width: 50px;
        height: 50px;
        background: rgba(255,255,255,0.2);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    
    .liability-text h5 {
        font-size: 1rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.35rem;
    }
    
    .liability-text p {
        font-size: 0.9rem;
        color: rgba(255,255,255,0.9);
        margin: 0;
        line-height: 1.6;
    }
    
    .indemnification-box {
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
    }
    
    .indemnification-box h5 {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.75rem;
    }
    
    [data-theme="dark"] .indemnification-box {
        background: #0f0f2d;
        border-color: #334155;
    }
    
    [data-theme="dark"] .indemnification-box h5 {
        color: #f1f5f9;
    }
    
    .indemnification-box p {
        font-size: 0.9rem;
        color: #475569;
        margin-bottom: 1rem;
    }
    
    [data-theme="dark"] .indemnification-box p {
        color: #94a3b8;
    }
    
    .indemnification-box ul {
        margin: 0;
        padding-left: 1.5rem;
    }
    
    .indemnification-box li {
        font-size: 0.9rem;
        color: #475569;
        margin-bottom: 0.5rem;
    }
    
    [data-theme="dark"] .indemnification-box li {
        color: #94a3b8;
    }
    
    /* Termination */
    .termination-content {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .term-intro {
        font-size: 1rem;
        color: #475569;
    }
    
    [data-theme="dark"] .term-intro {
        color: #94a3b8;
    }
    
    .termination-items {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 768px) {
        .termination-items { grid-template-columns: 1fr; }
    }
    
    .term-item {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
    }
    
    [data-theme="dark"] .term-item {
        background: #0f0f2d;
        border-color: #334155;
    }
    
    .term-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    
    .term-text h5 {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.35rem;
    }
    
    [data-theme="dark"] .term-text h5 {
        color: #f1f5f9;
    }
    
    .term-text p {
        font-size: 0.85rem;
        color: #64748b;
        margin: 0;
        line-height: 1.5;
    }
    
    [data-theme="dark"] .term-text p {
        color: #94a3b8;
    }
    
    .governing-box {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        background: #eff6ff;
        border-radius: 16px;
        border: 1px solid #bfdbfe;
    }
    
    .governing-box i {
        font-size: 1.5rem;
        color: var(--color-primary);
        flex-shrink: 0;
    }
    
    .governing-box h5 {
        font-size: 1rem;
        font-weight: 700;
        color: #1e40af;
        margin-bottom: 0.35rem;
    }
    
    .governing-box p {
        font-size: 0.9rem;
        color: #1e40af;
        margin: 0;
    }
    
    [data-theme="dark"] .governing-box {
        background: rgba(37, 99, 235, 0.1);
        border-color: rgba(37, 99, 235, 0.2);
    }
    
    [data-theme="dark"] .governing-box i,
    [data-theme="dark"] .governing-box h5,
    [data-theme="dark"] .governing-box p {
        color: #93c5fd;
    }
    
    /* Contact Block */
    .terms-contact-block {
        background: linear-gradient(135deg, #1e40af, #3b82f6, #2563eb);
        border-radius: 32px;
        padding: 4rem 3rem;
        position: relative;
        overflow: hidden;
        text-align: center;
        color: #ffffff;
        margin-bottom: 2rem;
    }
    
    .contact-bg-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.5;
    }
    
    .contact-content {
        position: relative;
        z-index: 1;
    }
    
    .contact-label {
        display: inline-block;
        padding: 6px 16px;
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .contact-header h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
    }
    
    .contact-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        max-width: 500px;
        margin: 0 auto 2.5rem;
    }
    
    .contact-options {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .contact-option {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        background: rgba(255,255,255,0.95);
        border-radius: 16px;
        text-decoration: none;
        transition: all 0.3s ease;
        min-width: 200px;
    }
    
    .contact-option:hover {
        background: #ffffff;
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }
    
    .contact-option-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #ffffff;
        flex-shrink: 0;
    }
    
    .contact-option-text {
        text-align: left;
    }
    
    .contact-option-text span {
        display: block;
        font-size: 0.8rem;
        color: rgba(30, 64, 175, 0.7);
    }
    
    .contact-option-text strong {
        display: block;
        font-size: 0.95rem;
        color: #1e40af;
        font-weight: 700;
    }
    
    .contact-arrow {
        margin-left: auto;
        color: #1e40af;
        opacity: 0.5;
        transition: all 0.3s ease;
    }
    
    .contact-option:hover .contact-arrow {
        opacity: 1;
        transform: translateX(3px);
    }
    
    /* Footer */
    .terms-footer {
        text-align: center;
        padding: 2rem;
    }
    
    .footer-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.3rem;
        margin: 0 auto 1rem;
    }
    
    .terms-footer p {
        font-size: 0.9rem;
        color: #64748b;
        max-width: 600px;
        margin: 0 auto;
    }
    
    [data-theme="dark"] .terms-footer p {
        color: #94a3b8;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .hero-title { font-size: 2.5rem; }
        .hero-subtitle { font-size: 1.1rem; }
        .block-header { flex-direction: column; }
        .block-number { font-size: 1.5rem; }
        .block-title { font-size: 1.4rem; }
        .terms-contact-block { padding: 3rem 1.5rem; }
        .contact-header h2 { font-size: 1.75rem; }
        .contact-options { flex-direction: column; }
        .contact-option { width: 100%; }
    }
</style>
@endpush
