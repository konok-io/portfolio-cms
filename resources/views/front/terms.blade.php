@extends('front.layouts.app')

@section('seo_title', 'Terms of Service')
@section('meta_description', 'Read our terms of service to understand the rules and guidelines for using our website and services.')

@section('content')
<section class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Terms of Service</h1>
                <p class="text-muted">Last updated: {{ now()->format('F d, Y') }}</p>
            </div>
        </div>
    </div>
</section>

<section class="section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="page-content">
                    <p class="lead">Please read these Terms of Service ("Terms") carefully before using our website and services.</p>
                    
                    <h2 class="h4 mt-4 mb-3">1. Acceptance of Terms</h2>
                    <p>By accessing or using our website, you agree to be bound by these Terms. If you do not agree to these Terms, please do not use our services. These Terms constitute a legally binding agreement between you and {{ $siteSetting->site_name ?? 'us' }}.</p>
                    
                    <h2 class="h4 mt-4 mb-3">2. Description of Services</h2>
                    <p>We provide web development, design, and related technology services. The specific services offered may vary and are described in detail on our website. We reserve the right to modify, suspend, or discontinue any service at any time.</p>
                    
                    <h2 class="h4 mt-4 mb-3">3. User Responsibilities</h2>
                    <p>By using our services, you agree to:</p>
                    <ul>
                        <li>Provide accurate, current, and complete information</li>
                        <li>Maintain the security of your account credentials</li>
                        <li>Notify us immediately of any unauthorized use</li>
                        <li>Not use our services for any illegal or prohibited purposes</li>
                        <li>Not interfere with or disrupt our services or servers</li>
                        <li>Not attempt to gain unauthorized access to any systems</li>
                    </ul>
                    
                    <h2 class="h4 mt-4 mb-3">4. Intellectual Property</h2>
                    <p>All content, designs, logos, and materials on this website are the property of {{ $siteSetting->site_name ?? 'us' }} or our licensors and are protected by copyright and other intellectual property laws. You may not reproduce, distribute, or create derivative works without our express written permission.</p>
                    <p>For client projects, ownership rights will be defined in individual project agreements.</p>
                    
                    <h2 class="h4 mt-4 mb-3">5. Payment Terms</h2>
                    <p>Payment terms for our services are as follows:</p>
                    <ul>
                        <li>A deposit may be required before work begins</li>
                        <li>Payment is due within the timeframe specified in your invoice</li>
                        <li>We accept payment via the methods indicated on our website</li>
                        <li>Late payments may incur additional fees</li>
                    </ul>
                    
                    <h2 class="h4 mt-4 mb-3">6. Project Scope and Changes</h2>
                    <p>Project scope is defined in the initial agreement. Additional features or changes outside the original scope may require additional time and cost. We will communicate any such requirements before implementation.</p>
                    
                    <h2 class="h4 mt-4 mb-3">7. Confidentiality</h2>
                    <p>We respect the confidentiality of your business information and project details. We will not disclose confidential information to third parties without your consent, except as required by law.</p>
                    
                    <h2 class="h4 mt-4 mb-3">8. Warranty and Disclaimer</h2>
                    <p>Our services are provided "as is" and "as available." We do not warrant that our services will be uninterrupted, error-free, or completely secure. We disclaim all warranties, express or implied, including merchantability and fitness for a particular purpose.</p>
                    
                    <h2 class="h4 mt-4 mb-3">9. Limitation of Liability</h2>
                    <p>To the fullest extent permitted by law, we shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of our services. Our total liability shall not exceed the amount you paid for the specific service giving rise to the claim.</p>
                    
                    <h2 class="h4 mt-4 mb-3">10. Indemnification</h2>
                    <p>You agree to indemnify, defend, and hold harmless {{ $siteSetting->site_name ?? 'us' }}, our affiliates, and our personnel from any claims, damages, or expenses arising from your violation of these Terms or your use of our services.</p>
                    
                    <h2 class="h4 mt-4 mb-3">11. Termination</h2>
                    <p>Either party may terminate services with written notice. Upon termination:</p>
                    <ul>
                        <li>You will pay for all services rendered up to the termination date</li>
                        <li>We will deliver completed work as per the agreement</li>
                        <li>Confidentiality obligations will survive termination</li>
                    </ul>
                    
                    <h2 class="h4 mt-4 mb-3">12. Governing Law</h2>
                    <p>These Terms shall be governed by and construed in accordance with applicable laws. Any disputes shall be resolved through binding arbitration or in the courts of the applicable jurisdiction.</p>
                    
                    <h2 class="h4 mt-4 mb-3">13. Changes to Terms</h2>
                    <p>We reserve the right to modify these Terms at any time. We will notify you of significant changes by posting the updated Terms on this page with a new "Last updated" date. Your continued use of our services after such changes constitutes acceptance of the new Terms.</p>
                    
                    <h2 class="h4 mt-4 mb-3">14. Contact Information</h2>
                    <p>If you have any questions about these Terms of Service, please contact us:</p>
                    <ul>
                        <li>Email: <a href="mailto:{{ $siteSetting->email ?? 'legal@example.com' }}">{{ $siteSetting->email ?? 'legal@example.com' }}</a></li>
                        @if($siteSetting->phone ?? false)
                        <li>Phone: {{ $siteSetting->phone }}</li>
                        @endif
                        @if($siteSetting->address ?? false)
                        <li>Address: {{ $siteSetting->address }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
