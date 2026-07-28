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
        </div>
    </div>
</section>

{{-- Content Section --}}
<section class="section-padding section-2 py-5">
    <div class="container">
        <div class="policy-intro mb-5">
            <p class="lead">Your privacy is important to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website.</p>
            <p class="text-muted"><small><i class="fa-regular fa-calendar me-1"></i>Last updated: {{ now()->format('F d, Y') }}</small></p>
        </div>

        <div class="policy-sections">
            {{-- Section 1 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">01</div>
                <div class="policy-content">
                    <h2 class="policy-title">Information We Collect</h2>
                    <p>We may collect the following types of information:</p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon"><i class="fa-solid fa-user"></i></div>
                                <div>
                                    <strong>Personal Data</strong>
                                    <p class="mb-0">Name, email address, phone number, and other contact details you provide when filling out forms or contacting us.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon"><i class="fa-solid fa-chart-line"></i></div>
                                <div>
                                    <strong>Usage Data</strong>
                                    <p class="mb-0">Information about how you access and use our website, including your IP address, browser type, and pages visited.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-item">
                                <div class="info-icon"><i class="fa-solid fa-cookie-bite"></i></div>
                                <div>
                                    <strong>Cookies</strong>
                                    <p class="mb-0">We use cookies to enhance your browsing experience. Manage preferences through our cookie consent banner.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 2 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">02</div>
                <div class="policy-content">
                    <h2 class="policy-title">How We Use Your Information</h2>
                    <p>We use the collected information for the following purposes:</p>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="feature-item">
                                <i class="fa-solid fa-gear"></i>
                                <span>Provide and maintain our services</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-item">
                                <i class="fa-solid fa-headset"></i>
                                <span>Respond to inquiries and support</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-item">
                                <i class="fa-solid fa-envelope"></i>
                                <span>Send newsletters and updates</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-item">
                                <i class="fa-solid fa-magnifying-glass-chart"></i>
                                <span>Analyze and improve user experience</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-item">
                                <i class="fa-solid fa-shield-halved"></i>
                                <span>Detect and prevent security threats</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 3 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">03</div>
                <div class="policy-content">
                    <h2 class="policy-title">Data Sharing and Disclosure</h2>
                    <p class="mb-4">We do not sell your personal information. We may share your data with:</p>
                    <div class="sharing-grid">
                        <div class="sharing-card">
                            <div class="sharing-icon"><i class="fa-solid fa-server"></i></div>
                            <h4>Service Providers</h4>
                            <p>Third-party companies that help us operate our website (hosting, analytics, email services)</p>
                        </div>
                        <div class="sharing-card">
                            <div class="sharing-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                            <h4>Legal Requirements</h4>
                            <p>When required by law or to protect our rights</p>
                        </div>
                        <div class="sharing-card">
                            <div class="sharing-icon"><i class="fa-solid fa-building"></i></div>
                            <h4>Business Transfers</h4>
                            <p>In case of a merger or acquisition, your data may be transferred</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 4 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">04</div>
                <div class="policy-content">
                    <h2 class="policy-title">Data Security</h2>
                    <p>We implement appropriate technical and organizational measures to protect your personal data against unauthorized access, alteration, disclosure, or destruction.</p>
                    <div class="security-badges">
                        <span class="security-badge"><i class="fa-solid fa-lock me-1"></i>SSL Encrypted</span>
                        <span class="security-badge"><i class="fa-solid fa-shield me-1"></i>Secure Servers</span>
                        <span class="security-badge"><i class="fa-solid fa-user-shield me-1"></i>Access Control</span>
                    </div>
                </div>
            </div>

            {{-- Section 5 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">05</div>
                <div class="policy-content">
                    <h2 class="policy-title">Your Rights <span class="badge bg-primary ms-2">GDPR</span></h2>
                    <p>If you are a resident of the European Economic Area (EEA), you have the following rights:</p>
                    <div class="rights-grid">
                        <div class="right-item">
                            <i class="fa-solid fa-file-contract"></i>
                            <div>
                                <strong>Right to Access</strong>
                                <span>Request a copy of your personal data</span>
                            </div>
                        </div>
                        <div class="right-item">
                            <i class="fa-solid fa-pen"></i>
                            <div>
                                <strong>Right to Rectification</strong>
                                <span>Request correction of inaccurate data</span>
                            </div>
                        </div>
                        <div class="right-item">
                            <i class="fa-solid fa-trash"></i>
                            <div>
                                <strong>Right to Erasure</strong>
                                <span>Request deletion of your personal data</span>
                            </div>
                        </div>
                        <div class="right-item">
                            <i class="fa-solid fa-pause-circle"></i>
                            <div>
                                <strong>Right to Restrict</strong>
                                <span>Request limitation of data processing</span>
                            </div>
                        </div>
                        <div class="right-item">
                            <i class="fa-solid fa-download"></i>
                            <div>
                                <strong>Right to Portability</strong>
                                <span>Receive your data in a structured format</span>
                            </div>
                        </div>
                        <div class="right-item">
                            <i class="fa-solid fa-ban"></i>
                            <div>
                                <strong>Right to Object</strong>
                                <span>Object to processing of your personal data</span>
                            </div>
                        </div>
                    </div>
                    <p class="mt-4"><i class="fa-solid fa-envelope me-2 text-primary"></i>To exercise these rights, please contact us at <a href="mailto:{{ $siteSetting->email ?? 'privacy@example.com' }}" class="text-primary">{{ $siteSetting->email ?? 'privacy@example.com' }}</a></p>
                </div>
            </div>

            {{-- Section 6 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">06</div>
                <div class="policy-content">
                    <h2 class="policy-title">Cookies</h2>
                    <p class="mb-4">We use the following types of cookies:</p>
                    <div class="cookies-grid">
                        <div class="cookie-card essential">
                            <div class="cookie-icon"><i class="fa-solid fa-asterisk"></i></div>
                            <h5>Essential Cookies</h5>
                            <p>Required for the website to function properly</p>
                        </div>
                        <div class="cookie-card analytics">
                            <div class="cookie-icon"><i class="fa-solid fa-chart-pie"></i></div>
                            <h5>Analytics Cookies</h5>
                            <p>Help us understand how visitors use our site</p>
                        </div>
                        <div class="cookie-card marketing">
                            <div class="cookie-icon"><i class="fa-solid fa-bullhorn"></i></div>
                            <h5>Marketing Cookies</h5>
                            <p>Used to deliver relevant advertisements (with consent)</p>
                        </div>
                    </div>
                    <p class="text-muted mt-4"><i class="fa-solid fa-info-circle me-1"></i>You can manage your cookie preferences at any time by clicking "Cookie Settings" in our footer.</p>
                </div>
            </div>

            {{-- Section 7 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">07</div>
                <div class="policy-content">
                    <h2 class="policy-title">Third-Party Links</h2>
                    <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices of these external sites. We encourage you to read their privacy policies before providing any personal information.</p>
                </div>
            </div>

            {{-- Section 8 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">08</div>
                <div class="policy-content">
                    <h2 class="policy-title">Children's Privacy</h2>
                    <p>Our services are not intended for individuals under the age of 16. We do not knowingly collect personal information from children. If you believe we have inadvertently collected such information, please contact us immediately.</p>
                </div>
            </div>

            {{-- Section 9 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">09</div>
                <div class="policy-content">
                    <h2 class="policy-title">Changes to This Policy</h2>
                    <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last updated" date.</p>
                    <div class="alert alert-info">
                        <i class="fa-solid fa-lightbulb me-2"></i><strong>Tip:</strong> We encourage you to review this policy periodically for any changes.
                    </div>
                </div>
            </div>

            {{-- Section 10 - Contact --}}
            <div class="policy-card policy-contact" data-aos="fade-up">
                <div class="policy-number">10</div>
                <div class="policy-content">
                    <h2 class="policy-title">Contact Us</h2>
                    <p>If you have any questions about this Privacy Policy, please don't hesitate to reach out to us:</p>
                    <div class="contact-grid">
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fa-solid fa-envelope"></i></div>
                            <div>
                                <strong>Email</strong>
                                <a href="mailto:{{ $siteSetting->email ?? 'privacy@example.com' }}">{{ $siteSetting->email ?? 'privacy@example.com' }}</a>
                            </div>
                        </div>
                        @if($siteSetting->phone ?? false)
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fa-solid fa-phone"></i></div>
                            <div>
                                <strong>Phone</strong>
                                <a href="tel:{{ $siteSetting->phone }}">{{ $siteSetting->phone }}</a>
                            </div>
                        </div>
                        @endif
                        @if($siteSetting->address ?? false)
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fa-solid fa-location-dot"></i></div>
                            <div>
                                <strong>Address</strong>
                                <span>{{ $siteSetting->address }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .policy-intro {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 3rem;
    }
    
    .policy-intro .lead {
        font-size: 1.15rem;
        color: #475569;
    }
    
    [data-theme="dark"] .policy-intro .lead {
        color: #CBD5E1;
    }
    
    .policy-card {
        display: flex;
        gap: 2rem;
        background: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.04);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .policy-card:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }
    
    [data-theme="dark"] .policy-card {
        background: #171433;
        border-color: #2C2860;
    }
    
    [data-theme="dark"] .policy-card:hover {
        border-color: #3D3970;
    }
    
    .policy-number {
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.1rem;
    }
    
    .policy-content {
        flex: 1;
    }
    
    .policy-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1rem;
    }
    
    [data-theme="dark"] .policy-title {
        color: #fff;
    }
    
    .policy-title .badge {
        font-size: 0.65rem;
        font-weight: 600;
        vertical-align: middle;
    }
    
    .policy-content p {
        color: #64748b;
        line-height: 1.7;
    }
    
    [data-theme="dark"] .policy-content p {
        color: #A8A4C8;
    }
    
    /* Info Items */
    .info-item {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 10px;
        height: 100%;
    }
    
    [data-theme="dark"] .info-item {
        background: #0f0f2d;
    }
    
    .info-icon {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }
    
    .info-item strong {
        display: block;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }
    
    [data-theme="dark"] .info-item strong {
        color: #fff;
    }
    
    .info-item p {
        font-size: 0.85rem;
        margin-bottom: 0;
    }
    
    /* Feature Items */
    .feature-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 10px;
        height: 100%;
    }
    
    [data-theme="dark"] .feature-item {
        background: #0f0f2d;
    }
    
    .feature-item i {
        color: #2563eb;
        font-size: 1rem;
    }
    
    .feature-item span {
        color: #475569;
        font-size: 0.9rem;
    }
    
    [data-theme="dark"] .feature-item span {
        color: #CBD5E1;
    }
    
    /* Sharing Grid */
    .sharing-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 768px) {
        .sharing-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .sharing-card {
        text-align: center;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }
    
    [data-theme="dark"] .sharing-card {
        background: #0f0f2d;
        border-color: #2C2860;
    }
    
    .sharing-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.2rem;
    }
    
    .sharing-card h4 {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    [data-theme="dark"] .sharing-card h4 {
        color: #fff;
    }
    
    .sharing-card p {
        font-size: 0.85rem;
        margin-bottom: 0;
    }
    
    /* Security Badges */
    .security-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1rem;
    }
    
    .security-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: #f0fdf4;
        color: #166534;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid #bbf7d0;
    }
    
    [data-theme="dark"] .security-badge {
        background: rgba(34, 197, 94, 0.1);
        color: #4ade80;
        border-color: rgba(34, 197, 94, 0.3);
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
    
    .right-item {
        display: flex;
        gap: 0.75rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 10px;
    }
    
    [data-theme="dark"] .right-item {
        background: #0f0f2d;
    }
    
    .right-item i {
        color: #2563eb;
        font-size: 1.1rem;
        margin-top: 0.15rem;
    }
    
    .right-item strong {
        display: block;
        color: #1e293b;
        font-size: 0.9rem;
        margin-bottom: 0.15rem;
    }
    
    [data-theme="dark"] .right-item strong {
        color: #fff;
    }
    
    .right-item span {
        font-size: 0.8rem;
        color: #64748b;
    }
    
    /* Cookies Grid */
    .cookies-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 768px) {
        .cookies-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .cookie-card {
        padding: 1.5rem;
        border-radius: 12px;
        text-align: center;
    }
    
    .cookie-card.essential {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
    }
    
    .cookie-card.analytics {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
    }
    
    .cookie-card.marketing {
        background: #fef3c7;
        border: 1px solid #fde68a;
    }
    
    [data-theme="dark"] .cookie-card {
        background: #0f0f2d !important;
        border-color: #2C2860 !important;
    }
    
    .cookie-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem;
        font-size: 1rem;
    }
    
    .cookie-card.essential .cookie-icon {
        background: #2563eb;
        color: white;
    }
    
    .cookie-card.analytics .cookie-icon {
        background: #16a34a;
        color: white;
    }
    
    .cookie-card.marketing .cookie-icon {
        background: #d97706;
        color: white;
    }
    
    .cookie-card h5 {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    [data-theme="dark"] .cookie-card h5 {
        color: #fff;
    }
    
    .cookie-card p {
        font-size: 0.8rem;
        margin-bottom: 0;
    }
    
    /* Contact Grid */
    .policy-contact {
        background: linear-gradient(135deg, #2563eb08, #3b82f608);
        border-color: #bfdbfe;
    }
    
    [data-theme="dark"] .policy-contact {
        background: linear-gradient(135deg, #2563eb15, #3b82f615);
        border-color: #3D3970;
    }
    
    .contact-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-top: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .contact-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .contact-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    
    .contact-item strong {
        display: block;
        color: #1e293b;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }
    
    [data-theme="dark"] .contact-item strong {
        color: #fff;
    }
    
    .contact-item a,
    .contact-item span {
        color: #2563eb;
        font-weight: 600;
        font-size: 0.95rem;
    }
    
    .contact-item a:hover {
        text-decoration: underline;
    }
    
    /* Alert */
    .alert-info {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: #1e40af;
        border-radius: 10px;
        padding: 1rem;
    }
    
    [data-theme="dark"] .alert-info {
        background: rgba(37, 99, 235, 0.1);
        border-color: rgba(37, 99, 235, 0.3);
        color: #93c5fd;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .policy-card {
            flex-direction: column;
            gap: 1rem;
        }
        
        .policy-number {
            width: 40px;
            height: 40px;
            font-size: 0.95rem;
        }
        
        .policy-title {
            font-size: 1.2rem;
        }
    }
</style>
@endpush
