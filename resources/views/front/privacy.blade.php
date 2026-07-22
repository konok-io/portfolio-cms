@extends('front.layouts.app')

@section('title', 'Privacy Policy')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">Privacy Policy</h1>
                <div class="content">
                    <p>Last updated: {{ date('F j, Y') }}</p>
                    
                    <p>Your privacy is important to us. This Privacy Policy explains how we collect, use, and protect your information when you use our website.</p>
                    
                    <h4>Information We Collect</h4>
                    <p>We may collect the following information:</p>
                    <ul>
                        <li>Name and contact information (email address)</li>
                        <li>Demographic information</li>
                        <li>Project and portfolio preferences</li>
                        <li>Newsletter subscription data</li>
                    </ul>
                    
                    <h4>How We Use Your Information</h4>
                    <p>We use the information we collect for the following purposes:</p>
                    <ul>
                        <li>To provide you with our services</li>
                        <li>To send newsletters and updates (with your consent)</li>
                        <li>To respond to your inquiries</li>
                        <li>To improve our website and services</li>
                    </ul>
                    
                    <h4>Data Security</h4>
                    <p>We are committed to ensuring that your information is secure. We use appropriate technical and organizational measures to protect your personal data.</p>
                    
                    <h4>Cookies</h4>
                    <p>Our website may use cookies to enhance your browsing experience. You can choose to accept or decline cookies.</p>
                    
                    <h4>Third-Party Links</h4>
                    <p>Our website may contain links to other websites. We are not responsible for the privacy practices of these external sites.</p>
                    
                    <h4>Your Rights</h4>
                    <p>You have the right to access, correct, or delete your personal information. Contact us if you have any questions about your data.</p>
                    
                    <h4>Contact Us</h4>
                    <p>If you have any questions about this Privacy Policy, please contact us.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
