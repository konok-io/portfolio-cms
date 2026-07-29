@extends('front.layouts.app')

@section('seo_title', 'Privacy Policy')
@section('meta_description', 'Read our privacy policy to understand how we collect, use, and protect your personal information.')

@section('content')
{{-- Page Header --}}
<section class="page-title-section section-padding">
    <div class="shape-container">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
        <div class="shape shape-6"></div>
        <div class="shape shape-7"></div>
        <div class="shape shape-8"></div>
    </div>

    <div class="container">
        <div class="text-center mb-0">
            <span class="section-eyebrow text-white">Legal</span>
            <h1 class="section-title text-white">Privacy Policy</h1>
            <p class="section-subtitle mx-auto">Your privacy matters to us. Learn how we protect your data.</p>
        </div>
    </div>
</section>

{{-- Content Section --}}
<section class="section-padding section-2">
    <div class="container">
        {{-- Last Updated Banner --}}
        <div class="last-updated-banner mb-5">
            <i class="fa-solid fa-calendar-check me-2"></i>
            <span>Last updated: {{ now()->format('F d, Y') }}</span>
        </div>

        {{-- Quick Navigation --}}
        <div class="quick-nav mb-5">
            <div class="quick-nav-scroll">
                <a href="#information" class="quick-nav-item">
                    <i class="fa-solid fa-database"></i>
                    <span>Information</span>
                </a>
                <a href="#usage" class="quick-nav-item">
                    <i class="fa-solid fa-gears"></i>
                    <span>How We Use</span>
                </a>
                <a href="#sharing" class="quick-nav-item">
                    <i class="fa-solid fa-share-nodes"></i>
                    <span>Data Sharing</span>
                </a>
                <a href="#security" class="quick-nav-item">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Security</span>
                </a>
                <a href="#rights" class="quick-nav-item">
                    <i class="fa-solid fa-scale-balanced"></i>
                    <span>Your Rights</span>
                </a>
                <a href="#cookies" class="quick-nav-item">
                    <i class="fa-solid fa-cookie-bite"></i>
                    <span>Cookies</span>
                </a>
                <a href="#contact" class="quick-nav-item">
                    <i class="fa-solid fa-headset"></i>
                    <span>Contact</span>
                </a>
            </div>
        </div>

        {{-- Section 1: Information We Collect --}}
        <div class="privacy-section mb-5" id="information" data-aos="fade-up">
            <div class="privacy-section-header">
                <div class="privacy-section-icon">
                    <i class="fa-solid fa-database"></i>
                </div>
                <div>
                    <h2 class="privacy-section-title">Information We Collect</h2>
                    <p class="privacy-section-desc">We collect various types of information to provide and improve our services.</p>
                </div>
            </div>
            <div class="privacy-cards-grid">
                <div class="privacy-card">
                    <div class="privacy-card-icon">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <h4>Personal Data</h4>
                    <p>Name, email, phone, and contact details you provide when filling forms or contacting us.</p>
                </div>
                <div class="privacy-card">
                    <div class="privacy-card-icon">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h4>Usage Data</h4>
                    <p>IP address, browser type, pages visited, and how you interact with our website.</p>
                </div>
                <div class="privacy-card">
                    <div class="privacy-card-icon">
                        <i class="fa-solid fa-cookie-bite"></i>
                    </div>
                    <h4>Cookies</h4>
                    <p>Small data files stored on your device to enhance your browsing experience.</p>
                </div>
            </div>
        </div>

        {{-- Section 2: How We Use --}}
        <div class="privacy-section mb-5" id="usage" data-aos="fade-up">
            <div class="privacy-section-header">
                <div class="privacy-section-icon">
                    <i class="fa-solid fa-gears"></i>
                </div>
                <div>
                    <h2 class="privacy-section-title">How We Use Your Information</h2>
                    <p class="privacy-section-desc">We use collected data to power our services and continuously improve your experience.</p>
                </div>
            </div>
            <div class="usage-list">
                <div class="usage-item">
                    <div class="usage-icon"><i class="fa-solid fa-wrench"></i></div>
                    <div class="usage-text">
                        <h5>Service Provision</h5>
                        <p>Provide, maintain, and personalize our website services.</p>
                    </div>
                </div>
                <div class="usage-item">
                    <div class="usage-icon"><i class="fa-solid fa-headset"></i></div>
                    <div class="usage-text">
                        <h5>Customer Support</h5>
                        <p>Respond to inquiries and provide technical assistance.</p>
                    </div>
                </div>
                <div class="usage-item">
                    <div class="usage-icon"><i class="fa-solid fa-envelope-open-text"></i></div>
                    <div class="usage-text">
                        <h5>Communications</h5>
                        <p>Send newsletters, updates, and marketing communications.</p>
                    </div>
                </div>
                <div class="usage-item">
                    <div class="usage-icon"><i class="fa-solid fa-magnifying-glass-chart"></i></div>
                    <div class="usage-text">
                        <h5>Analytics</h5>
                        <p>Analyze usage patterns to improve user experience.</p>
                    </div>
                </div>
                <div class="usage-item">
                    <div class="usage-icon"><i class="fa-solid fa-shield"></i></div>
                    <div class="usage-text">
                        <h5>Security</h5>
                        <p>Detect and prevent fraud, spam, and security threats.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 3: Data Sharing --}}
        <div class="privacy-section mb-5" id="sharing" data-aos="fade-up">
            <div class="privacy-section-header">
                <div class="privacy-section-icon">
                    <i class="fa-solid fa-share-nodes"></i>
                </div>
                <div>
                    <h2 class="privacy-section-title">Data Sharing and Disclosure</h2>
                    <p class="privacy-section-desc">We do not sell your personal information. Data may only be shared in specific circumstances.</p>
                </div>
            </div>
            <div class="sharing-cards">
                <div class="sharing-card">
                    <div class="sharing-card-icon">
                        <i class="fa-solid fa-server"></i>
                    </div>
                    <h4>Service Providers</h4>
                    <p>Trusted third-party services for hosting, analytics, email delivery, and payment processing.</p>
                </div>
                <div class="sharing-card">
                    <div class="sharing-card-icon">
                        <i class="fa-solid fa-gavel"></i>
                    </div>
                    <h4>Legal Requirements</h4>
                    <p>When required by law, court order, or to protect our legal rights.</p>
                </div>
                <div class="sharing-card">
                    <div class="sharing-card-icon">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <h4>Business Transfers</h4>
                    <p>In case of merger, acquisition, or sale of assets, your data may be transferred.</p>
                </div>
            </div>
        </div>

        {{-- Section 4: Data Security --}}
        <div class="privacy-section mb-5" id="security" data-aos="fade-up">
            <div class="privacy-section-header">
                <div class="privacy-section-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h2 class="privacy-section-title">Data Security</h2>
                    <p class="privacy-section-desc">We implement robust security measures to protect your personal information.</p>
                </div>
            </div>
            <div class="security-features">
                <div class="security-feature">
                    <div class="security-feature-icon"><i class="fa-solid fa-lock"></i></div>
                    <div class="security-feature-text">
                        <h5>SSL Encryption</h5>
                        <p>All data transmitted between your browser and our servers is encrypted.</p>
                    </div>
                </div>
                <div class="security-feature">
                    <div class="security-feature-icon"><i class="fa-solid fa-database"></i></div>
                    <div class="security-feature-text">
                        <h5>Secure Storage</h5>
                        <p>Data is stored on secure servers with access controls and regular backups.</p>
                    </div>
                </div>
                <div class="security-feature">
                    <div class="security-feature-icon"><i class="fa-solid fa-user-check"></i></div>
                    <div class="security-feature-text">
                        <h5>Access Control</h5>
                        <p>Strict access controls limit who can access your personal information.</p>
                    </div>
                </div>
                <div class="security-feature">
                    <div class="security-feature-icon"><i class="fa-solid fa-clipboard-check"></i></div>
                    <div class="security-feature-text">
                        <h5>Regular Audits</h5>
                        <p>We conduct regular security audits and vulnerability assessments.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section 5: Your Rights --}}
        <div class="privacy-section mb-5" id="rights" data-aos="fade-up">
            <div class="privacy-section-header">
                <div class="privacy-section-icon">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
                <div>
                    <h2 class="privacy-section-title">Your Privacy Rights</h2>
                    <p class="privacy-section-desc">You have full control over your personal data. Exercise your rights anytime.</p>
                </div>
            </div>
            <div class="rights-grid">
                <div class="right-card">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <h5>Access</h5>
                    <p>Request copies of your personal data</p>
                </div>
                <div class="right-card">
                    <i class="fa-solid fa-pen"></i>
                    <h5>Correction</h5>
                    <p>Update or correct inaccurate data</p>
                </div>
                <div class="right-card">
                    <i class="fa-solid fa-trash-can"></i>
                    <h5>Deletion</h5>
                    <p>Request deletion of your data</p>
                </div>
                <div class="right-card">
                    <i class="fa-solid fa-pause-circle"></i>
                    <h5>Restriction</h5>
                    <p>Limit how we process your data</p>
                </div>
                <div class="right-card">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <h5>Portability</h5>
                    <p>Get your data in portable format</p>
                </div>
                <div class="right-card">
                    <i class="fa-solid fa-hand"></i>
                    <h5>Objection</h5>
                    <p>Object to specific processing</p>
                </div>
            </div>
        </div>

        {{-- Section 6: Cookies --}}
        <div class="privacy-section mb-5" id="cookies" data-aos="fade-up">
            <div class="privacy-section-header">
                <div class="privacy-section-icon">
                    <i class="fa-solid fa-cookie-bite"></i>
                </div>
                <div>
                    <h2 class="privacy-section-title">Cookies Policy</h2>
                    <p class="privacy-section-desc">We use cookies to enhance your browsing experience. Manage your preferences anytime.</p>
                </div>
            </div>
            <div class="cookie-types">
                <div class="cookie-type essential">
                    <div class="cookie-type-header">
                        <div class="cookie-type-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        <div>
                            <h5>Essential Cookies</h5>
                            <span class="badge-required">Required</span>
                        </div>
                    </div>
                    <p>Necessary for the website to function. Cannot be disabled as they are required for core functionality.</p>
                </div>
                <div class="cookie-type analytics">
                    <div class="cookie-type-header">
                        <div class="cookie-type-icon"><i class="fa-solid fa-chart-simple"></i></div>
                        <div>
                            <h5>Analytics Cookies</h5>
                            <span class="badge-optional">Optional</span>
                        </div>
                    </div>
                    <p>Help us understand how visitors interact with our website by collecting anonymous data.</p>
                </div>
                <div class="cookie-type marketing">
                    <div class="cookie-type-header">
                        <div class="cookie-type-icon"><i class="fa-solid fa-bullhorn"></i></div>
                        <div>
                            <h5>Marketing Cookies</h5>
                            <span class="badge-optional">Optional</span>
                        </div>
                    </div>
                    <p>Used to deliver relevant advertisements and track campaign performance across websites.</p>
                </div>
            </div>
        </div>

        {{-- Section 7: Children's Privacy --}}
        <div class="privacy-section mb-5" id="children" data-aos="fade-up">
            <div class="privacy-section-header">
                <div class="privacy-section-icon">
                    <i class="fa-solid fa-children"></i>
                </div>
                <div>
                    <h2 class="privacy-section-title">Children's Privacy</h2>
                    <p class="privacy-section-desc">Protecting the privacy of young users is our priority.</p>
                </div>
            </div>
            <div class="children-notice">
                <i class="fa-solid fa-info-circle"></i>
                <p>Our services are not intended for individuals under the age of 16. We do not knowingly collect personal information from children. If we become aware of any such collection, we will immediately delete the information.</p>
            </div>
        </div>

        {{-- Section 8: Changes --}}
        <div class="privacy-section mb-5" id="changes" data-aos="fade-up">
            <div class="privacy-section-header">
                <div class="privacy-section-icon">
                    <i class="fa-solid fa-rotate"></i>
                </div>
                <div>
                    <h2 class="privacy-section-title">Policy Updates</h2>
                    <p class="privacy-section-desc">We may update this policy to reflect changes in our practices.</p>
                </div>
            </div>
            <p class="update-text">We will notify you of any material changes by posting the new Privacy Policy on this page and updating the "Last updated" date. We encourage you to review this Privacy Policy periodically for any changes.</p>
        </div>

        {{-- Section 9: Contact --}}
        <div class="privacy-contact-section" id="contact" data-aos="fade-up">
            <div class="privacy-contact-header">
                <h2><i class="fa-solid fa-headset me-2"></i>Get in Touch</h2>
                <p>Have questions about our privacy practices? We're here to help.</p>
            </div>
            <div class="contact-methods">
                @if($siteSetting->email)
                <a href="mailto:{{ $siteSetting->email }}" class="contact-method">
                    <div class="contact-method-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <span>Email Us</span>
                        <strong>{{ $siteSetting->email }}</strong>
                    </div>
                </a>
                @endif
                @if($siteSetting->phone)
                <a href="tel:{{ $siteSetting->phone }}" class="contact-method">
                    <div class="contact-method-icon"><i class="fa-solid fa-phone"></i></div>
                    <div>
                        <span>Call Us</span>
                        <strong>{{ $siteSetting->phone }}</strong>
                    </div>
                </a>
                @endif
                <a href="{{ route('contact') }}" class="contact-method">
                    <div class="contact-method-icon"><i class="fa-solid fa-comment-dots"></i></div>
                    <div>
                        <span>Contact Form</span>
                        <strong>Send a Message</strong>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="section-padding section-1">
    <div class="container">
        <div class="text-center">
            <h3 class="mb-3">Have More Questions?</h3>
            <p class="text-muted mb-4">Our team is ready to assist you with any privacy-related concerns.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary-custom">
                <i class="fa-solid fa-envelope me-2"></i>Contact Us
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Last Updated Banner */
    .last-updated-banner {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.1), rgba(59, 130, 246, 0.1));
        border: 1px solid rgba(37, 99, 235, 0.2);
        border-radius: 50px;
        color: var(--color-primary);
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    [data-theme="dark"] .last-updated-banner {
        background: rgba(59, 130, 246, 0.15);
        border-color: rgba(59, 130, 246, 0.3);
        color: #93c5fd;
    }
    
    /* Quick Navigation */
    .quick-nav {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 10px;
    }
    
    .quick-nav-scroll {
        display: flex;
        gap: 12px;
        min-width: max-content;
    }
    
    .quick-nav-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        color: #475569;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    .quick-nav-item:hover {
        background: var(--color-primary);
        border-color: var(--color-primary);
        color: #ffffff;
        transform: translateY(-2px);
    }
    
    .quick-nav-item i {
        font-size: 0.9rem;
    }
    
    [data-theme="dark"] .quick-nav-item {
        background: #1e293b;
        border-color: #334155;
        color: #94a3b8;
    }
    
    [data-theme="dark"] .quick-nav-item:hover {
        background: var(--color-primary);
        border-color: var(--color-primary);
        color: #ffffff;
    }
    
    /* Privacy Section */
    .privacy-section {
        background: #ffffff;
        border-radius: 20px;
        padding: 2rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .privacy-section:hover {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        transform: translateY(-3px);
    }
    
    [data-theme="dark"] .privacy-section {
        background: #1e293b;
        border-color: #334155;
    }
    
    .privacy-section-header {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }
    
    [data-theme="dark"] .privacy-section-header {
        border-color: #334155;
    }
    
    .privacy-section-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    
    .privacy-section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    [data-theme="dark"] .privacy-section-title {
        color: #f1f5f9;
    }
    
    .privacy-section-desc {
        color: #64748b;
        font-size: 1rem;
        margin: 0;
    }
    
    [data-theme="dark"] .privacy-section-desc {
        color: #94a3b8;
    }
    
    /* Privacy Cards Grid */
    .privacy-cards-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 992px) {
        .privacy-cards-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        .privacy-cards-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .privacy-card {
        background: #f8fafc;
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    
    .privacy-card:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        transform: translateY(-5px);
    }
    
    [data-theme="dark"] .privacy-card {
        background: #0f0f2d;
    }
    
    [data-theme="dark"] .privacy-card:hover {
        background: rgba(37, 99, 235, 0.1);
        border-color: rgba(37, 99, 235, 0.3);
    }
    
    .privacy-card-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.2rem;
        margin: 0 auto 1rem;
    }
    
    .privacy-card h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    [data-theme="dark"] .privacy-card h4 {
        color: #f1f5f9;
    }
    
    .privacy-card p {
        font-size: 0.9rem;
        color: #64748b;
        margin: 0;
        line-height: 1.6;
    }
    
    [data-theme="dark"] .privacy-card p {
        color: #94a3b8;
    }
    
    /* Usage List */
    .usage-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .usage-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1.25rem;
        background: #f8fafc;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    
    .usage-item:hover {
        background: #eff6ff;
        transform: translateX(5px);
    }
    
    [data-theme="dark"] .usage-item {
        background: #0f0f2d;
    }
    
    [data-theme="dark"] .usage-item:hover {
        background: rgba(37, 99, 235, 0.1);
    }
    
    .usage-icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    .usage-text h5 {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }
    
    [data-theme="dark"] .usage-text h5 {
        color: #f1f5f9;
    }
    
    .usage-text p {
        font-size: 0.9rem;
        color: #64748b;
        margin: 0;
    }
    
    [data-theme="dark"] .usage-text p {
        color: #94a3b8;
    }
    
    /* Sharing Cards */
    .sharing-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .sharing-cards {
            grid-template-columns: 1fr;
        }
    }
    
    .sharing-card {
        background: #f8fafc;
        border-radius: 16px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #e2e8f0;
    }
    
    .sharing-card:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.15);
    }
    
    [data-theme="dark"] .sharing-card {
        background: #0f0f2d;
        border-color: #334155;
    }
    
    [data-theme="dark"] .sharing-card:hover {
        background: rgba(37, 99, 235, 0.1);
        border-color: rgba(37, 99, 235, 0.3);
    }
    
    .sharing-card-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.5rem;
        margin: 0 auto 1rem;
    }
    
    .sharing-card h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    [data-theme="dark"] .sharing-card h4 {
        color: #f1f5f9;
    }
    
    .sharing-card p {
        font-size: 0.9rem;
        color: #64748b;
        margin: 0;
        line-height: 1.6;
    }
    
    [data-theme="dark"] .sharing-card p {
        color: #94a3b8;
    }
    
    /* Security Features */
    .security-features {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 768px) {
        .security-features {
            grid-template-columns: 1fr;
        }
    }
    
    .security-feature {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1.5rem;
        background: #f0fdf4;
        border-radius: 16px;
        border: 1px solid #bbf7d0;
    }
    
    .security-feature:nth-child(2),
    .security-feature:nth-child(4) {
        background: #eff6ff;
        border-color: #bfdbfe;
    }
    
    [data-theme="dark"] .security-feature {
        background: rgba(34, 197, 94, 0.1);
        border-color: rgba(34, 197, 94, 0.2);
    }
    
    [data-theme="dark"] .security-feature:nth-child(2),
    [data-theme="dark"] .security-feature:nth-child(4) {
        background: rgba(37, 99, 235, 0.1);
        border-color: rgba(37, 99, 235, 0.2);
    }
    
    .security-feature-icon {
        width: 50px;
        height: 50px;
        background: #16a34a;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    
    .security-feature:nth-child(2) .security-feature-icon,
    .security-feature:nth-child(4) .security-feature-icon {
        background: #2563eb;
    }
    
    .security-feature-text h5 {
        font-size: 1rem;
        font-weight: 700;
        color: #166534;
        margin-bottom: 0.25rem;
    }
    
    .security-feature:nth-child(2) .security-feature-text h5,
    .security-feature:nth-child(4) .security-feature-text h5 {
        color: #1d4ed8;
    }
    
    [data-theme="dark"] .security-feature-text h5 {
        color: #4ade80;
    }
    
    .security-feature-text p {
        font-size: 0.85rem;
        color: #15803d;
        margin: 0;
    }
    
    .security-feature:nth-child(2) .security-feature-text p,
    .security-feature:nth-child(4) .security-feature-text p {
        color: #1e40af;
    }
    
    [data-theme="dark"] .security-feature-text p {
        color: #86efac;
    }
    
    /* Rights Grid */
    .rights-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 768px) {
        .rights-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        .rights-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .right-card {
        background: #f8fafc;
        border-radius: 16px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    
    .right-card:hover {
        background: #eff6ff;
        border-color: #bfdbfe;
        transform: translateY(-5px);
    }
    
    [data-theme="dark"] .right-card {
        background: #0f0f2d;
    }
    
    [data-theme="dark"] .right-card:hover {
        background: rgba(37, 99, 235, 0.1);
        border-color: rgba(37, 99, 235, 0.3);
    }
    
    .right-card i {
        font-size: 1.5rem;
        color: var(--color-primary);
        margin-bottom: 0.75rem;
    }
    
    .right-card h5 {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }
    
    [data-theme="dark"] .right-card h5 {
        color: #f1f5f9;
    }
    
    .right-card p {
        font-size: 0.85rem;
        color: #64748b;
        margin: 0;
    }
    
    [data-theme="dark"] .right-card p {
        color: #94a3b8;
    }
    
    /* Cookie Types */
    .cookie-types {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .cookie-type {
        padding: 1.5rem;
        border-radius: 16px;
        border: 1px solid;
    }
    
    .cookie-type.essential {
        background: #eff6ff;
        border-color: #bfdbfe;
    }
    
    .cookie-type.analytics {
        background: #f0fdf4;
        border-color: #bbf7d0;
    }
    
    .cookie-type.marketing {
        background: #fef3c7;
        border-color: #fde68a;
    }
    
    [data-theme="dark"] .cookie-type {
        background: #0f0f2d !important;
        border-color: #334155 !important;
    }
    
    .cookie-type-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 0.75rem;
    }
    
    .cookie-type-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    
    .cookie-type.essential .cookie-type-icon {
        background: #2563eb;
    }
    
    .cookie-type.analytics .cookie-type-icon {
        background: #16a34a;
    }
    
    .cookie-type.marketing .cookie-type-icon {
        background: #d97706;
    }
    
    .cookie-type-header h5 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }
    
    [data-theme="dark"] .cookie-type-header h5 {
        color: #f1f5f9;
    }
    
    .badge-required {
        display: inline-block;
        padding: 2px 10px;
        background: #2563eb;
        color: #ffffff;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .badge-optional {
        display: inline-block;
        padding: 2px 10px;
        background: #16a34a;
        color: #ffffff;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .cookie-type p {
        font-size: 0.9rem;
        color: #475569;
        margin: 0;
        padding-left: 61px;
        line-height: 1.6;
    }
    
    [data-theme="dark"] .cookie-type p {
        color: #94a3b8;
    }
    
    /* Children Notice */
    .children-notice {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1.5rem;
        background: #fef3c7;
        border-radius: 16px;
        border: 1px solid #fde68a;
    }
    
    .children-notice i {
        font-size: 1.5rem;
        color: #d97706;
        flex-shrink: 0;
    }
    
    .children-notice p {
        font-size: 0.95rem;
        color: #92400e;
        margin: 0;
        line-height: 1.6;
    }
    
    [data-theme="dark"] .children-notice {
        background: rgba(217, 119, 6, 0.1);
        border-color: rgba(217, 119, 6, 0.3);
    }
    
    [data-theme="dark"] .children-notice i {
        color: #fbbf24;
    }
    
    [data-theme="dark"] .children-notice p {
        color: #fcd34d;
    }
    
    /* Update Text */
    .update-text {
        font-size: 0.95rem;
        color: #475569;
        line-height: 1.8;
    }
    
    [data-theme="dark"] .update-text {
        color: #94a3b8;
    }
    
    /* Contact Section */
    .privacy-contact-section {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 24px;
        padding: 3rem;
        text-align: center;
        color: #ffffff;
    }
    
    .privacy-contact-header h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .privacy-contact-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 2rem;
    }
    
    .contact-methods {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .contact-method {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 16px;
        text-decoration: none;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .contact-method:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-3px);
    }
    
    .contact-method-icon {
        width: 45px;
        height: 45px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }
    
    .contact-method span {
        display: block;
        font-size: 0.8rem;
        opacity: 0.8;
    }
    
    .contact-method strong {
        display: block;
        font-size: 0.95rem;
        color: #ffffff;
    }
    
    @media (max-width: 768px) {
        .privacy-contact-section {
            padding: 2rem 1.5rem;
        }
        
        .contact-methods {
            flex-direction: column;
        }
        
        .contact-method {
            justify-content: flex-start;
        }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .privacy-section-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .privacy-section-icon {
            width: 50px;
            height: 50px;
            font-size: 1.1rem;
        }
        
        .privacy-section-title {
            font-size: 1.3rem;
        }
    }
</style>
@endpush
