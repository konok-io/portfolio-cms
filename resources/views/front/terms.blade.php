@extends('front.layouts.app')

@section('seo_title', 'Terms of Service')
@section('meta_description', 'Read our terms of service to understand the rules and guidelines for using our website and services.')

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
            <h1 class="section-title text-white">Terms of Service</h1>
        </div>
    </div>
</section>

{{-- Content Section --}}
<section class="section-padding section-2 py-5">
    <div class="container">
        <div class="policy-intro mb-5">
            <p class="lead">Please read these Terms of Service ("Terms") carefully before using our website and services.</p>
            <p class="text-muted"><small><i class="fa-regular fa-calendar me-1"></i>Last updated: {{ now()->format('F d, Y') }}</small></p>
        </div>

        <div class="policy-sections">
            {{-- Section 1 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">01</div>
                <div class="policy-content">
                    <h2 class="policy-title">Acceptance of Terms</h2>
                    <p>By accessing or using our website, you agree to be bound by these Terms. If you do not agree to these Terms, please do not use our services. These Terms constitute a legally binding agreement between you and {{ $siteSetting->site_name ?? 'us' }}.</p>
                </div>
            </div>

            {{-- Section 2 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">02</div>
                <div class="policy-content">
                    <h2 class="policy-title">Description of Services</h2>
                    <p>We provide web development, design, and related technology services. The specific services offered may vary and are described in detail on our website. We reserve the right to modify, suspend, or discontinue any service at any time.</p>
                    <div class="services-grid mt-3">
                        <div class="service-item">
                            <i class="fa-solid fa-code"></i>
                            <span>Web Development</span>
                        </div>
                        <div class="service-item">
                            <i class="fa-solid fa-palette"></i>
                            <span>UI/UX Design</span>
                        </div>
                        <div class="service-item">
                            <i class="fa-solid fa-mobile-screen"></i>
                            <span>Responsive Design</span>
                        </div>
                        <div class="service-item">
                            <i class="fa-solid fa-server"></i>
                            <span>Backend Solutions</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 3 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">03</div>
                <div class="policy-content">
                    <h2 class="policy-title">User Responsibilities</h2>
                    <p>By using our services, you agree to:</p>
                    <div class="responsibilities-grid">
                        <div class="responsibility-item">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Provide accurate, current, and complete information</span>
                        </div>
                        <div class="responsibility-item">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Maintain the security of your account credentials</span>
                        </div>
                        <div class="responsibility-item">
                            <i class="fa-solid fa-check-circle"></i>
                            <span>Notify us immediately of any unauthorized use</span>
                        </div>
                        <div class="responsibility-item">
                            <i class="fa-solid fa-xmark-circle"></i>
                            <span>Not use our services for illegal purposes</span>
                        </div>
                        <div class="responsibility-item">
                            <i class="fa-solid fa-xmark-circle"></i>
                            <span>Not interfere with or disrupt our services</span>
                        </div>
                        <div class="responsibility-item">
                            <i class="fa-solid fa-xmark-circle"></i>
                            <span>Not attempt unauthorized system access</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 4 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">04</div>
                <div class="policy-content">
                    <h2 class="policy-title">Intellectual Property</h2>
                    <p>All content, designs, logos, and materials on this website are the property of {{ $siteSetting->site_name ?? 'us' }} or our licensors and are protected by copyright and other intellectual property laws.</p>
                    <div class="alert alert-warning mt-3">
                        <i class="fa-solid fa-exclamation-triangle me-2"></i><strong>Notice:</strong> You may not reproduce, distribute, or create derivative works without our express written permission.
                    </div>
                    <p class="mt-3">For client projects, ownership rights will be defined in individual project agreements.</p>
                </div>
            </div>

            {{-- Section 5 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">05</div>
                <div class="policy-content">
                    <h2 class="policy-title">Payment Terms</h2>
                    <p>Payment terms for our services are as follows:</p>
                    <div class="payment-steps">
                        <div class="payment-step">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <strong>Deposit Required</strong>
                                <span>A deposit may be required before work begins</span>
                            </div>
                        </div>
                        <div class="payment-step">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <strong>Invoice Payment</strong>
                                <span>Payment is due within the timeframe specified</span>
                            </div>
                        </div>
                        <div class="payment-step">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <strong>Payment Methods</strong>
                                <span>We accept various payment methods</span>
                            </div>
                        </div>
                        <div class="payment-step">
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <strong>Late Fees</strong>
                                <span>Late payments may incur additional fees</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 6 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">06</div>
                <div class="policy-content">
                    <h2 class="policy-title">Project Scope and Changes</h2>
                    <p>Project scope is defined in the initial agreement. Additional features or changes outside the original scope may require additional time and cost. We will communicate any such requirements before implementation.</p>
                </div>
            </div>

            {{-- Section 7 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">07</div>
                <div class="policy-content">
                    <h2 class="policy-title">Confidentiality</h2>
                    <p>We respect the confidentiality of your business information and project details. We will not disclose confidential information to third parties without your consent, except as required by law.</p>
                    <div class="security-badges mt-3">
                        <span class="security-badge"><i class="fa-solid fa-user-secret me-1"></i>Client Privacy</span>
                        <span class="security-badge"><i class="fa-solid fa-file-contract me-1"></i>NDA Protection</span>
                        <span class="security-badge"><i class="fa-solid fa-shield-halved me-1"></i>Secure Handling</span>
                    </div>
                </div>
            </div>

            {{-- Section 8 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">08</div>
                <div class="policy-content">
                    <h2 class="policy-title">Warranty and Disclaimer</h2>
                    <p>Our services are provided <strong>"as is"</strong> and <strong>"as available."</strong></p>
                    <div class="disclaimer-box">
                        <p class="mb-0"><i class="fa-solid fa-info-circle me-2"></i>We do not warrant that our services will be uninterrupted, error-free, or completely secure. We disclaim all warranties, express or implied, including merchantability and fitness for a particular purpose.</p>
                    </div>
                </div>
            </div>

            {{-- Section 9 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">09</div>
                <div class="policy-content">
                    <h2 class="policy-title">Limitation of Liability</h2>
                    <p>To the fullest extent permitted by law, we shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of our services.</p>
                    <div class="liability-highlight mt-3">
                        <i class="fa-solid fa-scale-balanced me-2"></i>
                        <span>Our total liability shall not exceed the amount you paid for the specific service giving rise to the claim.</span>
                    </div>
                </div>
            </div>

            {{-- Section 10 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">10</div>
                <div class="policy-content">
                    <h2 class="policy-title">Indemnification</h2>
                    <p>You agree to indemnify, defend, and hold harmless {{ $siteSetting->site_name ?? 'us' }}, our affiliates, and our personnel from any claims, damages, or expenses arising from:</p>
                    <ul class="indemnification-list">
                        <li>Your violation of these Terms</li>
                        <li>Your use of our services</li>
                        <li>Any unauthorized access to your account</li>
                    </ul>
                </div>
            </div>

            {{-- Section 11 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">11</div>
                <div class="policy-content">
                    <h2 class="policy-title">Termination</h2>
                    <p>Either party may terminate services with written notice. Upon termination:</p>
                    <div class="termination-points">
                        <div class="termination-item">
                            <i class="fa-solid fa-credit-card"></i>
                            <span>You will pay for all services rendered up to the termination date</span>
                        </div>
                        <div class="termination-item">
                            <i class="fa-solid fa-box"></i>
                            <span>We will deliver completed work as per the agreement</span>
                        </div>
                        <div class="termination-item">
                            <i class="fa-solid fa-lock"></i>
                            <span>Confidentiality obligations will survive termination</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section 12 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">12</div>
                <div class="policy-content">
                    <h2 class="policy-title">Governing Law</h2>
                    <p>These Terms shall be governed by and construed in accordance with applicable laws. Any disputes shall be resolved through binding arbitration or in the courts of the applicable jurisdiction.</p>
                </div>
            </div>

            {{-- Section 13 --}}
            <div class="policy-card mb-4" data-aos="fade-up">
                <div class="policy-number">13</div>
                <div class="policy-content">
                    <h2 class="policy-title">Changes to Terms</h2>
                    <p>We reserve the right to modify these Terms at any time. We will notify you of significant changes by posting the updated Terms on this page with a new "Last updated" date.</p>
                    <div class="alert alert-info mt-3">
                        <i class="fa-solid fa-lightbulb me-2"></i><strong>Note:</strong> Your continued use of our services after such changes constitutes acceptance of the new Terms.
                    </div>
                </div>
            </div>

            {{-- Section 14 - Contact --}}
            <div class="policy-card policy-contact" data-aos="fade-up">
                <div class="policy-number">14</div>
                <div class="policy-content">
                    <h2 class="policy-title">Contact Information</h2>
                    <p>If you have any questions about these Terms of Service, please don't hesitate to reach out to us:</p>
                    <div class="contact-grid">
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fa-solid fa-envelope"></i></div>
                            <div>
                                <strong>Email</strong>
                                <a href="mailto:{{ $siteSetting->email ?? 'legal@example.com' }}">{{ $siteSetting->email ?? 'legal@example.com' }}</a>
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
    
    .policy-content p {
        color: #64748b;
        line-height: 1.7;
    }
    
    [data-theme="dark"] .policy-content p {
        color: #A8A4C8;
    }
    
    /* Services Grid */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }
    
    @media (max-width: 768px) {
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    .service-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 10px;
        text-align: center;
    }
    
    [data-theme="dark"] .service-item {
        background: #0f0f2d;
    }
    
    .service-item i {
        font-size: 1.5rem;
        color: #2563eb;
    }
    
    .service-item span {
        font-size: 0.85rem;
        color: #475569;
        font-weight: 500;
    }
    
    [data-theme="dark"] .service-item span {
        color: #CBD5E1;
    }
    
    /* Responsibilities Grid */
    .responsibilities-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
        margin-top: 1rem;
    }
    
    @media (max-width: 768px) {
        .responsibilities-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .responsibility-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        background: #f8fafc;
        border-radius: 8px;
    }
    
    [data-theme="dark"] .responsibility-item {
        background: #0f0f2d;
    }
    
    .responsibility-item i {
        font-size: 1rem;
    }
    
    .responsibility-item .fa-check-circle {
        color: #16a34a;
    }
    
    .responsibility-item .fa-xmark-circle {
        color: #dc2626;
    }
    
    .responsibility-item span {
        font-size: 0.9rem;
        color: #475569;
    }
    
    [data-theme="dark"] .responsibility-item span {
        color: #CBD5E1;
    }
    
    /* Payment Steps */
    .payment-steps {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .payment-steps {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    .payment-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 1.25rem;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }
    
    [data-theme="dark"] .payment-step {
        background: #0f0f2d;
        border-color: #2C2860;
    }
    
    .step-number {
        width: 35px;
        height: 35px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 0.75rem;
    }
    
    .step-content strong {
        display: block;
        color: #1e293b;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }
    
    [data-theme="dark"] .step-content strong {
        color: #fff;
    }
    
    .step-content span {
        font-size: 0.8rem;
        color: #64748b;
    }
    
    [data-theme="dark"] .step-content span {
        color: #A8A4C8;
    }
    
    /* Security Badges */
    .security-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    
    .security-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        border: 1px solid #bfdbfe;
    }
    
    [data-theme="dark"] .security-badge {
        background: rgba(37, 99, 235, 0.1);
        color: #93c5fd;
        border-color: rgba(37, 99, 235, 0.3);
    }
    
    /* Disclaimer Box */
    .disclaimer-box {
        background: #fef3c7;
        border: 1px solid #fde68a;
        border-radius: 10px;
        padding: 1rem;
        color: #92400e;
    }
    
    [data-theme="dark"] .disclaimer-box {
        background: rgba(217, 119, 6, 0.1);
        border-color: rgba(217, 119, 6, 0.3);
        color: #fbbf24;
    }
    
    /* Liability Highlight */
    .liability-highlight {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #eff6ff;
        border-left: 4px solid #2563eb;
        border-radius: 0 10px 10px 0;
        color: #1e40af;
        font-size: 0.95rem;
    }
    
    [data-theme="dark"] .liability-highlight {
        background: rgba(37, 99, 235, 0.1);
        border-color: #8B7BF0;
        color: #93c5fd;
    }
    
    /* Indemnification List */
    .indemnification-list {
        list-style: none;
        padding: 0;
        margin: 1rem 0 0 0;
    }
    
    .indemnification-list li {
        position: relative;
        padding-left: 1.5rem;
        margin-bottom: 0.5rem;
        color: #64748b;
    }
    
    [data-theme="dark"] .indemnification-list li {
        color: #A8A4C8;
    }
    
    .indemnification-list li::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0.6rem;
        width: 8px;
        height: 8px;
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        border-radius: 50%;
    }
    
    /* Termination Points */
    .termination-points {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1rem;
    }
    
    .termination-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 10px;
    }
    
    [data-theme="dark"] .termination-item {
        background: #0f0f2d;
    }
    
    .termination-item i {
        font-size: 1.25rem;
        color: #2563eb;
    }
    
    .termination-item span {
        color: #475569;
        font-size: 0.95rem;
    }
    
    [data-theme="dark"] .termination-item span {
        color: #CBD5E1;
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
    
    /* Alerts */
    .alert {
        border-radius: 10px;
        padding: 1rem;
    }
    
    .alert-warning {
        background: #fef3c7;
        border: 1px solid #fde68a;
        color: #92400e;
    }
    
    [data-theme="dark"] .alert-warning {
        background: rgba(217, 119, 6, 0.1);
        border-color: rgba(217, 119, 6, 0.3);
        color: #fbbf24;
    }
    
    .alert-info {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: #1e40af;
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
