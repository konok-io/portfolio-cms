@extends('front.layouts.app')

@section('seo_title', 'Privacy Policy')
@section('meta_description', 'Read our privacy policy to understand how we collect, use, and protect your personal information.')

@section('content')
{{-- Page Header --}}
<section class="privacy-hero">
    <div class="hero-shapes">
        <div class="hero-shape hero-shape-1"></div>
        <div class="hero-shape hero-shape-2"></div>
        <div class="hero-shape hero-shape-3"></div>
        <div class="hero-shape hero-shape-4"></div>
    </div>
    <div class="container">
        <div class="text-center">
            <div class="hero-badge">
                <i class="fa-solid fa-shield-halved me-2"></i>
                <span>Legal</span>
            </div>
            <h1 class="hero-title">Privacy Policy</h1>
            <p class="hero-subtitle">Your privacy matters to us. Learn how we protect your personal data with enterprise-grade security measures.</p>
            <div class="hero-meta">
                <span class="meta-item">
                    <i class="fa-solid fa-calendar-check me-1"></i>
                    Updated: {{ now()->format('F d, Y') }}
                </span>
                <span class="meta-divider">•</span>
                <span class="meta-item">
                    <i class="fa-solid fa-clock me-1"></i>
                    5 min read
                </span>
            </div>
        </div>
    </div>
</section>

{{-- Content Section --}}
<section class="section-padding section-2">
    <div class="container">
        {{-- Quick Navigation --}}
        <div class="privacy-toc">
            <div class="toc-header">
                <i class="fa-solid fa-list-ol me-2"></i>
                <span>Table of Contents</span>
            </div>
            <div class="toc-grid">
                <a href="#information" class="toc-item">
                    <span class="toc-number">01</span>
                    <span class="toc-text">Information We Collect</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#usage" class="toc-item">
                    <span class="toc-number">02</span>
                    <span class="toc-text">How We Use Data</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#sharing" class="toc-item">
                    <span class="toc-number">03</span>
                    <span class="toc-text">Data Sharing</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#security" class="toc-item">
                    <span class="toc-number">04</span>
                    <span class="toc-text">Security Measures</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#rights" class="toc-item">
                    <span class="toc-number">05</span>
                    <span class="toc-text">Your Rights</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#cookies" class="toc-item">
                    <span class="toc-number">06</span>
                    <span class="toc-text">Cookies Policy</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
                <a href="#contact" class="toc-item">
                    <span class="toc-number">07</span>
                    <span class="toc-text">Contact Us</span>
                    <i class="fa-solid fa-arrow-right toc-arrow"></i>
                </a>
            </div>
        </div>

        {{-- Section 1: Information We Collect --}}
        <div class="privacy-block" id="information">
            <div class="block-header">
                <div class="block-number">01</div>
                <div class="block-content">
                    <h2 class="block-title">Information We Collect</h2>
                    <p class="block-desc">We collect various types of information to provide and improve our services for you.</p>
                </div>
            </div>
            <div class="info-cards">
                <div class="info-card">
                    <div class="info-card-inner">
                        <div class="info-card-icon">
                            <i class="fa-solid fa-user-shield"></i>
                        </div>
                        <div class="info-card-badge">Personal</div>
                    </div>
                    <h4>Personal Data</h4>
                    <p>Name, email address, phone number, and contact details you provide when filling out forms or contacting us directly.</p>
                    <div class="info-card-footer">
                        <span class="info-tag"><i class="fa-solid fa-check me-1"></i>Encrypted</span>
                        <span class="info-tag"><i class="fa-solid fa-lock me-1"></i>Secured</span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-card-inner">
                        <div class="info-card-icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div class="info-card-badge">Analytics</div>
                    </div>
                    <h4>Usage Data</h4>
                    <p>IP address, browser type, operating system, pages visited, time spent, and interaction patterns on our website.</p>
                    <div class="info-card-footer">
                        <span class="info-tag"><i class="fa-solid fa-chart-bar me-1"></i>Anonymous</span>
                        <span class="info-tag"><i class="fa-solid fa-clock me-1"></i>Real-time</span>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-card-inner">
                        <div class="info-card-icon">
                            <i class="fa-solid fa-cookie-bite"></i>
                        </div>
                        <div class="info-card-badge">Cookies</div>
                    </div>
                    <h4>Cookies Data</h4>
                    <p>Small data files stored on your device to remember preferences, enhance security, and improve your browsing experience.</p>
                    <div class="info-card-footer">
                        <span class="info-tag"><i class="fa-solid fa-toggle-on me-1"></i>Manageable</span>
                        <span class="info-tag"><i class="fa-solid fa-shield-halved me-1"></i>GDPR Ready</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 2: How We Use --}}
        <div class="privacy-block" id="usage">
            <div class="block-header">
                <div class="block-number">02</div>
                <div class="block-content">
                    <h2 class="block-title">How We Use Your Information</h2>
                    <p class="block-desc">We use collected data to power our services and continuously improve your experience with us.</p>
                </div>
            </div>
            <div class="usage-grid">
                <div class="usage-item">
                    <div class="usage-icon">
                        <i class="fa-solid fa-wrench"></i>
                    </div>
                    <div class="usage-content">
                        <h5>Service Provision</h5>
                        <p>Provide, maintain, and personalize our website services to meet your needs.</p>
                    </div>
                </div>
                <div class="usage-item">
                    <div class="usage-icon">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div class="usage-content">
                        <h5>Customer Support</h5>
                        <p>Respond to inquiries, resolve issues, and provide technical assistance 24/7.</p>
                    </div>
                </div>
                <div class="usage-item">
                    <div class="usage-icon">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <div class="usage-content">
                        <h5>Communications</h5>
                        <p>Send newsletters, updates, and important notifications about your account.</p>
                    </div>
                </div>
                <div class="usage-item">
                    <div class="usage-icon">
                        <i class="fa-solid fa-magnifying-glass-chart"></i>
                    </div>
                    <div class="usage-content">
                        <h5>Analytics & Insights</h5>
                        <p>Analyze usage patterns to improve user experience and website performance.</p>
                    </div>
                </div>
                <div class="usage-item">
                    <div class="usage-icon">
                        <i class="fa-solid fa-shield-virus"></i>
                    </div>
                    <div class="usage-content">
                        <h5>Security & Fraud</h5>
                        <p>Detect and prevent fraud, spam, and security threats in real-time.</p>
                    </div>
                </div>
                <div class="usage-item">
                    <div class="usage-icon">
                        <i class="fa-solid fa-gavel"></i>
                    </div>
                    <div class="usage-content">
                        <h5>Legal Compliance</h5>
                        <p>Comply with legal obligations and protect our legal rights when necessary.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 3: Data Sharing --}}
        <div class="privacy-block" id="sharing">
            <div class="block-header">
                <div class="block-number">03</div>
                <div class="block-content">
                    <h2 class="block-title">Data Sharing and Disclosure</h2>
                    <p class="block-desc">We never sell your personal information. Data may only be shared in these specific circumstances.</p>
                </div>
            </div>
            <div class="sharing-grid">
                <div class="sharing-card">
                    <div class="sharing-icon-wrap">
                        <div class="sharing-icon">
                            <i class="fa-solid fa-server"></i>
                        </div>
                        <div class="sharing-line"></div>
                    </div>
                    <div class="sharing-content">
                        <span class="sharing-label">Third-Party</span>
                        <h4>Service Providers</h4>
                        <p>Trusted partners for hosting, analytics, email delivery, payment processing, and customer support.</p>
                        <ul class="sharing-features">
                            <li><i class="fa-solid fa-check"></i> NDA Protected</li>
                            <li><i class="fa-solid fa-check"></i> Limited Access</li>
                            <li><i class="fa-solid fa-check"></i> Audited</li>
                        </ul>
                    </div>
                </div>
                <div class="sharing-card">
                    <div class="sharing-icon-wrap">
                        <div class="sharing-icon warning">
                            <i class="fa-solid fa-gavel"></i>
                        </div>
                        <div class="sharing-line"></div>
                    </div>
                    <div class="sharing-content">
                        <span class="sharing-label">Legal</span>
                        <h4>Legal Requirements</h4>
                        <p>When required by law, court order, or to protect our rights and the safety of others.</p>
                        <ul class="sharing-features">
                            <li><i class="fa-solid fa-check"></i> Lawful Basis</li>
                            <li><i class="fa-solid fa-check"></i> Documented</li>
                            <li><i class="fa-solid fa-check"></i> Minimal Data</li>
                        </ul>
                    </div>
                </div>
                <div class="sharing-card">
                    <div class="sharing-icon-wrap">
                        <div class="sharing-icon accent">
                            <i class="fa-solid fa-building-columns"></i>
                        </div>
                        <div class="sharing-line"></div>
                    </div>
                    <div class="sharing-content">
                        <span class="sharing-label">Business</span>
                        <h4>Business Transfers</h4>
                        <p>In case of merger, acquisition, or sale of assets, your data may be transferred to the new entity.</p>
                        <ul class="sharing-features">
                            <li><i class="fa-solid fa-check"></i> Notice Given</li>
                            <li><i class="fa-solid fa-check"></i> Protected</li>
                            <li><i class="fa-solid fa-check"></i> Your Choice</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="sharing-notice">
                <i class="fa-solid fa-info-circle"></i>
                <p><strong>Your data is safe with us.</strong> We never sell, rent, or trade your personal information to third parties for marketing purposes.</p>
            </div>
        </div>

        {{-- Section 4: Data Security --}}
        <div class="privacy-block" id="security">
            <div class="block-header">
                <div class="block-number">04</div>
                <div class="block-content">
                    <h2 class="block-title">Data Security Measures</h2>
                    <p class="block-desc">We implement enterprise-grade security measures to protect your personal information.</p>
                </div>
            </div>
            <div class="security-grid">
                <div class="security-card primary">
                    <div class="security-icon">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <div class="security-content">
                        <h5>SSL/TLS Encryption</h5>
                        <p>All data transmitted between your browser and our servers is encrypted using 256-bit encryption.</p>
                        <div class="security-status">
                            <span class="status-dot active"></span>
                            <span>Active Protection</span>
                        </div>
                    </div>
                </div>
                <div class="security-card">
                    <div class="security-icon">
                        <i class="fa-solid fa-database"></i>
                    </div>
                    <div class="security-content">
                        <h5>Secure Storage</h5>
                        <p>Data stored on encrypted servers with regular backups and redundancy systems.</p>
                        <div class="security-status">
                            <span class="status-dot active"></span>
                            <span>24/7 Monitoring</span>
                        </div>
                    </div>
                </div>
                <div class="security-card">
                    <div class="security-icon">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <div class="security-content">
                        <h5>Access Control</h5>
                        <p>Strict role-based access controls with multi-factor authentication.</p>
                        <div class="security-status">
                            <span class="status-dot active"></span>
                            <span>Verified Personnel</span>
                        </div>
                    </div>
                </div>
                <div class="security-card">
                    <div class="security-icon">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                    <div class="security-content">
                        <h5>Regular Audits</h5>
                        <p>Third-party security audits and vulnerability assessments conducted quarterly.</p>
                        <div class="security-status">
                            <span class="status-dot active"></span>
                            <span>Certified</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 5: Your Rights --}}
        <div class="privacy-block" id="rights">
            <div class="block-header">
                <div class="block-number">05</div>
                <div class="block-content">
                    <h2 class="block-title">Your Privacy Rights</h2>
                    <p class="block-desc">You have full control over your personal data. Exercise your rights anytime, no questions asked.</p>
                </div>
            </div>
            <div class="rights-grid">
                <div class="right-item">
                    <div class="right-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div class="right-content">
                        <h5>Access</h5>
                        <p>Request and receive copies of your personal data</p>
                    </div>
                    <span class="right-action">Request →</span>
                </div>
                <div class="right-item">
                    <div class="right-icon">
                        <i class="fa-solid fa-pen"></i>
                    </div>
                    <div class="right-content">
                        <h5>Correction</h5>
                        <p>Update or correct inaccurate personal data</p>
                    </div>
                    <span class="right-action">Update →</span>
                </div>
                <div class="right-item">
                    <div class="right-icon">
                        <i class="fa-solid fa-trash-can"></i>
                    </div>
                    <div class="right-content">
                        <h5>Deletion</h5>
                        <p>Request complete deletion of your data</p>
                    </div>
                    <span class="right-action">Delete →</span>
                </div>
                <div class="right-item">
                    <div class="right-icon">
                        <i class="fa-solid fa-pause-circle"></i>
                    </div>
                    <div class="right-content">
                        <h5>Restriction</h5>
                        <p>Limit how we process your personal data</p>
                    </div>
                    <span class="right-action">Limit →</span>
                </div>
                <div class="right-item">
                    <div class="right-icon">
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </div>
                    <div class="right-content">
                        <h5>Portability</h5>
                        <p>Receive your data in portable format</p>
                    </div>
                    <span class="right-action">Export →</span>
                </div>
                <div class="right-item">
                    <div class="right-icon">
                        <i class="fa-solid fa-hand"></i>
                    </div>
                    <div class="right-content">
                        <h5>Objection</h5>
                        <p>Object to specific data processing</p>
                    </div>
                    <span class="right-action">Object →</span>
                </div>
            </div>
        </div>

        {{-- Section 6: Cookies --}}
        <div class="privacy-block" id="cookies">
            <div class="block-header">
                <div class="block-number">06</div>
                <div class="block-content">
                    <h2 class="block-title">Cookies Policy</h2>
                    <p class="block-desc">We use cookies to enhance your browsing experience. Manage your preferences anytime.</p>
                </div>
            </div>
            <div class="cookie-grid">
                <div class="cookie-card essential">
                    <div class="cookie-header">
                        <div class="cookie-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div class="cookie-title-wrap">
                            <h5>Essential Cookies</h5>
                            <span class="cookie-badge required">Required</span>
                        </div>
                    </div>
                    <p>Necessary for the website to function properly. Cannot be disabled as they are required for core functionality, security, and accessibility.</p>
                    <div class="cookie-features">
                        <span><i class="fa-solid fa-check-circle"></i> Session Management</span>
                        <span><i class="fa-solid fa-check-circle"></i> Security</span>
                        <span><i class="fa-solid fa-check-circle"></i> Accessibility</span>
                    </div>
                </div>
                <div class="cookie-card analytics">
                    <div class="cookie-header">
                        <div class="cookie-icon">
                            <i class="fa-solid fa-chart-simple"></i>
                        </div>
                        <div class="cookie-title-wrap">
                            <h5>Analytics Cookies</h5>
                            <span class="cookie-badge optional">Optional</span>
                        </div>
                    </div>
                    <p>Help us understand how visitors interact with our website by collecting anonymous data about pages visited and time spent.</p>
                    <div class="cookie-features">
                        <span><i class="fa-solid fa-check-circle"></i> Page Analytics</span>
                        <span><i class="fa-solid fa-check-circle"></i> User Behavior</span>
                        <span><i class="fa-solid fa-check-circle"></i> Performance</span>
                    </div>
                </div>
                <div class="cookie-card marketing">
                    <div class="cookie-header">
                        <div class="cookie-icon">
                            <i class="fa-solid fa-bullhorn"></i>
                        </div>
                        <div class="cookie-title-wrap">
                            <h5>Marketing Cookies</h5>
                            <span class="cookie-badge optional">Optional</span>
                        </div>
                    </div>
                    <p>Used to deliver relevant advertisements and track campaign performance across websites and social media platforms.</p>
                    <div class="cookie-features">
                        <span><i class="fa-solid fa-check-circle"></i> Ad Targeting</span>
                        <span><i class="fa-solid fa-check-circle"></i> Retargeting</span>
                        <span><i class="fa-solid fa-check-circle"></i> Campaign Track</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 7: Contact --}}
        <div class="privacy-contact-block" id="contact">
            <div class="contact-bg-pattern"></div>
            <div class="contact-content">
                <div class="contact-header">
                    <span class="contact-label">Get in Touch</span>
                    <h2>Have Questions About Privacy?</h2>
                    <p>Our dedicated privacy team is here to help. Reach out anytime and we'll respond within 24 hours.</p>
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
                    <a href="{{ route('contact') }}" class="contact-option primary">
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

        {{-- Footer Notice --}}
        <div class="privacy-footer">
            <div class="footer-icon">
                <i class="fa-solid fa-scale-balanced"></i>
            </div>
            <p>We are committed to protecting your privacy and complying with all applicable data protection laws including GDPR, CCPA, and other regional regulations.</p>
            <div class="footer-badges">
                <span class="footer-badge"><i class="fa-brands fa-google me-1"></i>GDPR Compliant</span>
                <span class="footer-badge"><i class="fa-solid fa-shield-halved me-1"></i>CCPA Ready</span>
                <span class="footer-badge"><i class="fa-solid fa-lock me-1"></i>256-bit SSL</span>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Hero Section */
    .privacy-hero {
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
    .privacy-toc {
        background: #ffffff;
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    
    [data-theme="dark"] .privacy-toc {
        background: #1a1a3e;
        border-color: #3d3a70;
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
        color: #e8e6f2;
        border-color: #3d3a70;
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
        background: #0f0f23;
    }
    
    [data-theme="dark"] .toc-item:hover {
        background: rgba(59, 130, 246, 0.15);
        border-color: rgba(59, 130, 246, 0.3);
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
        color: #a8a4c8;
    }
    
    .toc-arrow {
        color: #94a3b8;
        transition: transform 0.3s ease;
    }
    
    .toc-item:hover .toc-arrow {
        transform: translateX(3px);
        color: var(--color-primary);
    }
    
    /* Privacy Block */
    .privacy-block {
        background: #ffffff;
        border-radius: 24px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .privacy-block:hover {
        box-shadow: 0 20px 50px rgba(0,0,0,0.08);
    }
    
    [data-theme="dark"] .privacy-block {
        background: #1a1a3e;
        border-color: #3d3a70;
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
        border-color: #3d3a70;
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
        color: #e8e6f2;
    }
    
    .block-desc {
        color: #64748b;
        font-size: 1.05rem;
        margin: 0;
    }
    
    [data-theme="dark"] .block-desc {
        color: #a8a4c8;
    }
    
    /* Info Cards */
    .info-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }
    
    @media (max-width: 992px) {
        .info-cards { grid-template-columns: repeat(2, 1fr); }
    }
    
    @media (max-width: 576px) {
        .info-cards { grid-template-columns: 1fr; }
    }
    
    .info-card {
        background: linear-gradient(145deg, #f8fafc, #ffffff);
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid #e2e8f0;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }
    
    .info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #2563eb, #3b82f6);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .info-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(37, 99, 235, 0.15);
        border-color: transparent;
    }
    
    .info-card:hover::before {
        opacity: 1;
    }
    
    [data-theme="dark"] .info-card {
        background: #0f0f23;
        border-color: #3d3a70;
    }
    
    [data-theme="dark"] .info-card:hover {
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.25);
    }
    
    .info-card-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
    }
    
    .info-card-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.4rem;
    }
    
    .info-card-badge {
        padding: 4px 12px;
        background: rgba(37, 99, 235, 0.1);
        color: var(--color-primary);
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    
    .info-card h4 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.75rem;
    }
    
    [data-theme="dark"] .info-card h4 {
        color: #e8e6f2;
    }
    
    .info-card p {
        font-size: 0.9rem;
        color: #64748b;
        line-height: 1.7;
        margin-bottom: 1.25rem;
    }
    
    [data-theme="dark"] .info-card p {
        color: #94a3b8;
    }
    
    .info-card-footer {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .info-tag {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        background: #f0fdf4;
        color: #16a34a;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    /* Usage Grid */
    .usage-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 768px) {
        .usage-grid { grid-template-columns: 1fr; }
    }
    
    .usage-item {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 16px;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    
    .usage-item:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        transform: translateX(8px);
    }
    
    [data-theme="dark"] .usage-item {
        background: #0f0f2d;
    }
    
    [data-theme="dark"] .usage-item:hover {
        background: rgba(37, 99, 235, 0.1);
        border-color: rgba(37, 99, 235, 0.2);
    }
    
    .usage-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    
    .usage-content h5 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.35rem;
    }
    
    [data-theme="dark"] .usage-content h5 {
        color: #f1f5f9;
    }
    
    .usage-content p {
        font-size: 0.88rem;
        color: #64748b;
        margin: 0;
        line-height: 1.6;
    }
    
    [data-theme="dark"] .usage-content p {
        color: #94a3b8;
    }
    
    /* Sharing Grid */
    .sharing-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    @media (max-width: 992px) {
        .sharing-grid { grid-template-columns: 1fr; }
    }
    
    .sharing-card {
        background: #f8fafc;
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid #e2e8f0;
        transition: all 0.4s ease;
        position: relative;
    }
    
    .sharing-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(37, 99, 235, 0.12);
        border-color: transparent;
    }
    
    [data-theme="dark"] .sharing-card {
        background: #0f0f23;
        border-color: #3d3a70;
    }
    
    .sharing-icon-wrap {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }
    
    .sharing-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.5rem;
    }
    
    .sharing-icon.warning {
        background: linear-gradient(135deg, #d97706, #f59e0b);
    }
    
    .sharing-icon.accent {
        background: linear-gradient(135deg, #7c3aed, #8b5cf6);
    }
    
    .sharing-line {
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, #2563eb, transparent);
    }
    
    .sharing-label {
        display: inline-block;
        padding: 3px 10px;
        background: rgba(37, 99, 235, 0.1);
        color: var(--color-primary);
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }
    
    .sharing-content h4 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    [data-theme="dark"] .sharing-content h4 {
        color: #e8e6f2;
    }
    
    .sharing-content p {
        font-size: 0.9rem;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 1rem;
    }
    
    [data-theme="dark"] .sharing-content p {
        color: #94a3b8;
    }
    
    .sharing-features {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .sharing-features li {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.8rem;
        color: #16a34a;
        font-weight: 600;
    }
    
    .sharing-notice {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.25rem 1.5rem;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.08), rgba(59, 130, 246, 0.08));
        border: 1px solid rgba(37, 99, 235, 0.2);
        border-radius: 16px;
    }
    
    .sharing-notice i {
        font-size: 1.5rem;
        color: var(--color-primary);
        flex-shrink: 0;
    }
    
    .sharing-notice p {
        font-size: 0.95rem;
        color: #1e293b;
        margin: 0;
    }
    
    [data-theme="dark"] .sharing-notice p {
        color: #f1f5f9;
    }
    
    /* Security Grid */
    .security-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 768px) {
        .security-grid { grid-template-columns: 1fr; }
    }
    
    .security-card {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        background: #f0fdf4;
        border-radius: 20px;
        border: 1px solid #bbf7d0;
        transition: all 0.3s ease;
    }
    
    .security-card:nth-child(2),
    .security-card:nth-child(4) {
        background: #eff6ff;
        border-color: #bfdbfe;
    }
    
    .security-card.primary {
        background: linear-gradient(135deg, #1e40af, #2563eb);
        border-color: transparent;
        grid-column: span 2;
    }
    
    .security-card.primary .security-icon {
        background: rgba(255,255,255,0.2);
    }
    
    .security-card.primary .security-content h5,
    .security-card.primary .security-content p {
        color: #ffffff;
    }
    
    .security-card.primary .security-status {
        color: rgba(255,255,255,0.9);
    }
    
    .security-card.primary .status-dot {
        background: #4ade80;
    }
    
    @media (max-width: 768px) {
        .security-card.primary { grid-column: span 1; }
    }
    
    [data-theme="dark"] .security-card {
        background: rgba(34, 197, 94, 0.1);
        border-color: rgba(34, 197, 94, 0.2);
    }
    
    [data-theme="dark"] .security-card:nth-child(2),
    [data-theme="dark"] .security-card:nth-child(4) {
        background: rgba(37, 99, 235, 0.1);
        border-color: rgba(37, 99, 235, 0.2);
    }
    
    [data-theme="dark"] .security-card.primary {
        background: linear-gradient(135deg, #1e3a8a, #2563eb);
    }
    
    .security-icon {
        width: 54px;
        height: 54px;
        background: #16a34a;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    
    .security-card:nth-child(2) .security-icon,
    .security-card:nth-child(4) .security-icon {
        background: #2563eb;
    }
    
    .security-content h5 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #166534;
        margin-bottom: 0.35rem;
    }
    
    .security-card:nth-child(2) .security-content h5,
    .security-card:nth-child(4) .security-content h5 {
        color: #1d4ed8;
    }
    
    [data-theme="dark"] .security-content h5 {
        color: #4ade80;
    }
    
    [data-theme="dark"] .security-card:nth-child(2) .security-content h5,
    [data-theme="dark"] .security-card:nth-child(4) .security-content h5 {
        color: #93c5fd;
    }
    
    .security-content p {
        font-size: 0.88rem;
        color: #15803d;
        line-height: 1.6;
        margin-bottom: 0.75rem;
    }
    
    .security-card:nth-child(2) .security-content p,
    .security-card:nth-child(4) .security-content p {
        color: #1e40af;
    }
    
    [data-theme="dark"] .security-content p {
        color: #86efac;
    }
    
    [data-theme="dark"] .security-card:nth-child(2) .security-content p,
    [data-theme="dark"] .security-card:nth-child(4) .security-content p {
        color: #93c5fd;
    }
    
    .security-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
        color: #16a34a;
        font-weight: 600;
    }
    
    .status-dot {
        width: 8px;
        height: 8px;
        background: #16a34a;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    
    /* Rights Grid */
    .rights-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 992px) {
        .rights-grid { grid-template-columns: repeat(2, 1fr); }
    }
    
    @media (max-width: 576px) {
        .rights-grid { grid-template-columns: 1fr; }
    }
    
    .right-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 16px;
        border: 1px solid transparent;
        transition: all 0.3s ease;
    }
    
    .right-item:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        transform: translateX(5px);
    }
    
    .right-item:hover .right-action {
        opacity: 1;
        transform: translateX(0);
    }
    
    [data-theme="dark"] .right-item {
        background: #0f0f2d;
    }
    
    [data-theme="dark"] .right-item:hover {
        background: rgba(37, 99, 235, 0.1);
        border-color: rgba(37, 99, 235, 0.2);
    }
    
    .right-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    
    .right-content {
        flex: 1;
        min-width: 0;
    }
    
    .right-content h5 {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.2rem;
    }
    
    [data-theme="dark"] .right-content h5 {
        color: #f1f5f9;
    }
    
    .right-content p {
        font-size: 0.82rem;
        color: #64748b;
        margin: 0;
    }
    
    [data-theme="dark"] .right-content p {
        color: #94a3b8;
    }
    
    .right-action {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--color-primary);
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    /* Cookie Grid */
    .cookie-grid {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .cookie-card {
        padding: 1.75rem;
        border-radius: 20px;
        border: 2px solid;
    }
    
    .cookie-card.essential {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), rgba(59, 130, 246, 0.05));
        border-color: #bfdbfe;
    }
    
    .cookie-card.analytics {
        background: linear-gradient(135deg, rgba(22, 163, 74, 0.05), rgba(34, 197, 94, 0.05));
        border-color: #bbf7d0;
    }
    
    .cookie-card.marketing {
        background: linear-gradient(135deg, rgba(217, 119, 6, 0.05), rgba(245, 158, 11, 0.05));
        border-color: #fde68a;
    }
    
    [data-theme="dark"] .cookie-card {
        background: #0f0f2d !important;
        border-color: #334155 !important;
    }
    
    .cookie-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .cookie-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    
    .cookie-card.essential .cookie-icon { background: #2563eb; }
    .cookie-card.analytics .cookie-icon { background: #16a34a; }
    .cookie-card.marketing .cookie-icon { background: #d97706; }
    
    .cookie-title-wrap {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    
    .cookie-title-wrap h5 {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }
    
    [data-theme="dark"] .cookie-title-wrap h5 {
        color: #f1f5f9;
    }
    
    .cookie-badge {
        padding: 3px 10px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    
    .cookie-badge.required {
        background: #2563eb;
        color: #ffffff;
    }
    
    .cookie-badge.optional {
        background: #16a34a;
        color: #ffffff;
    }
    
    .cookie-card p {
        font-size: 0.95rem;
        color: #475569;
        line-height: 1.7;
        margin-bottom: 1rem;
    }
    
    [data-theme="dark"] .cookie-card p {
        color: #94a3b8;
    }
    
    .cookie-features {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    
    .cookie-features span {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.8rem;
        color: #16a34a;
        font-weight: 600;
    }
    
    /* Contact Block */
    .privacy-contact-block {
        background: linear-gradient(135deg, #1e40af, #3b82f6, #2563eb);
        border-radius: 32px;
        padding: 4rem 3rem;
        position: relative;
        overflow: hidden;
        text-align: center;
        color: #ffffff;
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
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 16px;
        text-decoration: none;
        transition: all 0.3s ease;
        min-width: 200px;
        backdrop-filter: blur(10px);
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
    .privacy-footer {
        text-align: center;
        padding: 3rem 2rem;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 24px;
        margin-top: 2rem;
    }
    
    [data-theme="dark"] .privacy-footer {
        background: linear-gradient(135deg, #1e293b, #0f172a);
    }
    
    .footer-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.5rem;
        margin: 0 auto 1.5rem;
    }
    
    .privacy-footer p {
        font-size: 1rem;
        color: #475569;
        max-width: 600px;
        margin: 0 auto 1.5rem;
        line-height: 1.7;
    }
    
    [data-theme="dark"] .privacy-footer p {
        color: #94a3b8;
    }
    
    .footer-badges {
        display: flex;
        justify-content: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    
    .footer-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #475569;
    }
    
    [data-theme="dark"] .footer-badge {
        background: #1e293b;
        border-color: #334155;
        color: #94a3b8;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .hero-title { font-size: 2.5rem; }
        .hero-subtitle { font-size: 1.1rem; }
        .block-header { flex-direction: column; }
        .block-number { font-size: 1.5rem; }
        .block-title { font-size: 1.4rem; }
        .privacy-contact-block { padding: 3rem 1.5rem; }
        .contact-header h2 { font-size: 1.75rem; }
        .contact-options { flex-direction: column; }
        .contact-option { width: 100%; }
    }
</style>
@endpush
