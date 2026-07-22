@extends('front.layouts.app')

@section('title', 'Terms of Service')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="mb-4">Terms of Service</h1>
                <div class="content">
                    <p>Last updated: {{ date('F j, Y') }}</p>
                    
                    <p>Please read these Terms of Service carefully before using our website.</p>
                    
                    <h4>Agreement to Terms</h4>
                    <p>By accessing or using our website, you agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use our website.</p>
                    
                    <h4>Services</h4>
                    <p>We provide web development, design, and related services. The specific details of our services are described on our website.</p>
                    
                    <h4>Intellectual Property</h4>
                    <p>All content, designs, and materials on this website are the property of {{ $siteSetting->site_name ?? 'Portfolio CMS' }} and are protected by intellectual property laws.</p>
                    
                    <h4>Project Work</h4>
                    <p>When you engage us for projects:</p>
                    <ul>
                        <li>Project scope and pricing will be agreed upon in writing</li>
                        <li>Payment terms will be specified in project agreements</li>
                        <li>Deliverables will meet agreed-upon specifications</li>
                    </ul>
                    
                    <h4>Client Responsibilities</h4>
                    <p>Clients are responsible for:</p>
                    <ul>
                        <li>Providing accurate information</li>
                        <li>Timely feedback and approvals</li>
                        <li>Payment according to agreed terms</li>
                    </ul>
                    
                    <h4>Limitation of Liability</h4>
                    <p>We are not liable for any indirect, incidental, or consequential damages arising from the use of our services or website.</p>
                    
                    <h4>Changes to Terms</h4>
                    <p>We reserve the right to modify these terms at any time. Changes will be effective upon posting on the website.</p>
                    
                    <h4>Contact</h4>
                    <p>For questions about these Terms of Service, please contact us.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
