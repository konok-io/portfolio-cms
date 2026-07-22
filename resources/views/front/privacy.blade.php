@extends('front.layouts.app')

@section('seo_title', 'Privacy Policy')
@section('meta_description', 'Read our privacy policy to understand how we collect, use, and protect your personal information.')

@section('content')
<section class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Privacy Policy</h1>
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
                    <p class="lead">Your privacy is important to us. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website.</p>
                    
                    <h2 class="h4 mt-4 mb-3">1. Information We Collect</h2>
                    <p>We may collect the following types of information:</p>
                    <ul>
                        <li><strong>Personal Data:</strong> Name, email address, phone number, and other contact details you provide when filling out forms or contacting us.</li>
                        <li><strong>Usage Data:</strong> Information about how you access and use our website, including your IP address, browser type, pages visited, and time spent on pages.</li>
                        <li><strong>Cookies:</strong> We use cookies to enhance your browsing experience. You can manage your cookie preferences through our cookie consent banner.</li>
                    </ul>
                    
                    <h2 class="h4 mt-4 mb-3">2. How We Use Your Information</h2>
                    <p>We use the collected information for the following purposes:</p>
                    <ul>
                        <li>To provide and maintain our services</li>
                        <li>To respond to your inquiries and support requests</li>
                        <li>To send you newsletters and marketing communications (with your consent)</li>
                        <li>To analyze website usage and improve user experience</li>
                        <li>To detect and prevent technical issues and security threats</li>
                    </ul>
                    
                    <h2 class="h4 mt-4 mb-3">3. Data Sharing and Disclosure</h2>
                    <p>We do not sell your personal information. We may share your data with:</p>
                    <ul>
                        <li><strong>Service Providers:</strong> Third-party companies that help us operate our website (hosting, analytics, email services)</li>
                        <li><strong>Legal Requirements:</strong> When required by law or to protect our rights</li>
                        <li><strong>Business Transfers:</strong> In case of a merger or acquisition, your data may be transferred</li>
                    </ul>
                    
                    <h2 class="h4 mt-4 mb-3">4. Data Security</h2>
                    <p>We implement appropriate technical and organizational measures to protect your personal data against unauthorized access, alteration, disclosure, or destruction.</p>
                    
                    <h2 class="h4 mt-4 mb-3">5. Your Rights (GDPR Compliance)</h2>
                    <p>If you are a resident of the European Economic Area (EEA), you have the following rights:</p>
                    <ul>
                        <li><strong>Right to Access:</strong> Request a copy of your personal data</li>
                        <li><strong>Right to Rectification:</strong> Request correction of inaccurate data</li>
                        <li><strong>Right to Erasure:</strong> Request deletion of your personal data</li>
                        <li><strong>Right to Restrict Processing:</strong> Request limitation of data processing</li>
                        <li><strong>Right to Data Portability:</strong> Receive your data in a structured format</li>
                        <li><strong>Right to Object:</strong> Object to processing of your personal data</li>
                    </ul>
                    <p>To exercise these rights, please contact us at <a href="mailto:{{ $siteSetting->email ?? 'privacy@example.com' }}">{{ $siteSetting->email ?? 'privacy@example.com' }}</a>.</p>
                    
                    <h2 class="h4 mt-4 mb-3">6. Cookies</h2>
                    <p>We use the following types of cookies:</p>
                    <ul>
                        <li><strong>Essential Cookies:</strong> Required for the website to function properly</li>
                        <li><strong>Analytics Cookies:</strong> Help us understand how visitors use our site</li>
                        <li><strong>Marketing Cookies:</strong> Used to deliver relevant advertisements (with consent)</li>
                    </ul>
                    <p>You can manage your cookie preferences at any time by clicking "Cookie Settings" in our footer or by clearing your browser cookies.</p>
                    
                    <h2 class="h4 mt-4 mb-3">7. Third-Party Links</h2>
                    <p>Our website may contain links to third-party websites. We are not responsible for the privacy practices of these external sites. We encourage you to read their privacy policies.</p>
                    
                    <h2 class="h4 mt-4 mb-3">8. Children's Privacy</h2>
                    <p>Our services are not intended for individuals under the age of 16. We do not knowingly collect personal information from children.</p>
                    
                    <h2 class="h4 mt-4 mb-3">9. Changes to This Policy</h2>
                    <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last updated" date.</p>
                    <p>We encourage you to review this policy periodically for any changes.</p>
                    
                    <h2 class="h4 mt-4 mb-3">10. Contact Us</h2>
                    <p>If you have any questions about this Privacy Policy, please contact us:</p>
                    <ul>
                        <li>Email: <a href="mailto:{{ $siteSetting->email ?? 'privacy@example.com' }}">{{ $siteSetting->email ?? 'privacy@example.com' }}</a></li>
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
