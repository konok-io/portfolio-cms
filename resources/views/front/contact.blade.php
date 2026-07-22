@extends('front.layouts.app')
@section('title', 'Contact | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', 'Get in touch with us. We would love to hear from you. Feel free to send me a message about your project or inquiry.')

@section('content')
<section class="contact-page-section">
    <div class="container py-5">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa-solid fa-home"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
        </nav>

        <div class="text-center mb-5">
            <span class="section-eyebrow">Get In Touch</span>
            <h1 class="section-title">Let's Work Together</h1>
            <p class="section-subtitle mx-auto">Have a project in mind? Fill out the form below and I'll get back to you within 24 hours.</p>
        </div>

        <div class="row g-5">
            <div class="col-lg-7">
                <div class="contact-form-card">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Your Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                       id="subject" name="subject" value="{{ old('subject') }}">
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="message" class="form-label">Your Message <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror" 
                                          id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                @if($siteSetting->isRecaptchaEnabled())
                                    <div class="mb-3">
                                        <div class="g-recaptcha" data-sitekey="{{ $siteSetting->recaptcha_site_key }}"></div>
                                        @error('recaptcha')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                @endif
                                <button type="submit" class="btn btn-primary-custom btn-lg">
                                    <i class="fa-solid fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="contact-info-card">
                    <h3 class="mb-4">Contact Information</h3>
                    
                    @if($siteSetting->email)
                    <div class="contact-info-item mb-4">
                        <div class="contact-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <h5>Email</h5>
                            <a href="mailto:{{ $siteSetting->email }}">{{ $siteSetting->email }}</a>
                        </div>
                    </div>
                    @endif

                    @if($siteSetting->phone)
                    <div class="contact-info-item mb-4">
                        <div class="contact-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h5>Phone</h5>
                            <a href="tel:{{ $siteSetting->phone }}">{{ $siteSetting->phone }}</a>
                        </div>
                    </div>
                    @endif

                    @if($siteSetting->address)
                    <div class="contact-info-item mb-4">
                        <div class="contact-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h5>Address</h5>
                            <p class="mb-0">{{ $siteSetting->address }}</p>
                        </div>
                    </div>
                    @endif

                    @if($siteSetting->google_map)
                    <div class="google-map mt-4" id="contactMap"></div>
                    @else
                    <div class="google-map-placeholder mt-4">
                        <i class="fa-solid fa-map-location-dot"></i>
                        <p>Map location will appear here</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
@if($siteSetting->isRecaptchaEnabled())
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif
@if($siteSetting->google_map)
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const map = L.map('contactMap').setView([0, 0], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    const mapUrl = "{{ addslashes($siteSetting->google_map) }}";
    const address = "{{ addslashes($siteSetting->address ?? '') }}";
    
    // Extract coordinates from Google Maps URL if present
    const coordMatch = mapUrl.match(/@(-?\d+\.?\d*),(-?\d+\.?\d*)/);
    
    if (coordMatch) {
        const lat = parseFloat(coordMatch[1]);
        const lon = parseFloat(coordMatch[2]);
        map.setView([lat, lon], 15);
        L.marker([lat, lon]).addTo(map)
            .bindPopup(address || 'Location').openPopup();
    } else {
        // Fallback: search by address
        const searchQuery = address || mapUrl;
        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(searchQuery)}`)
            .then(r => r.json())
            .then(data => {
                if (data && data.length > 0) {
                    const lat = parseFloat(data[0].lat);
                    const lon = parseFloat(data[0].lon);
                    map.setView([lat, lon], 15);
                    L.marker([lat, lon]).addTo(map)
                        .bindPopup(address || 'Location').openPopup();
                }
            });
    }
});
</script>
@endif
@endpush

@push('styles')
<style>
.contact-page-section {
    background: linear-gradient(180deg, #ffffff 0%, #f0f7ff 100%);
    min-height: 100vh;
}
[data-theme="dark"] .contact-page-section {
    background: linear-gradient(180deg, #0A0A1F 0%, #12102E 100%);
}
.contact-form-card,
.contact-info-card {
    background: #fff;
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    height: 100%;
}
[data-theme="dark"] .contact-form-card,
[data-theme="dark"] .contact-info-card {
    background: #171433;
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
}
.contact-info-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}
.contact-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.contact-info-item h5 {
    font-size: 0.9rem;
    color: var(--color-muted);
    margin-bottom: 0.25rem;
}
.contact-info-item p,
.contact-info-item a {
    color: var(--color-secondary);
    text-decoration: none;
    transition: color 0.3s;
}
[data-theme="dark"] .contact-info-item p,
[data-theme="dark"] .contact-info-item a {
    color: #EDECFF;
}
.contact-info-item a:hover {
    color: var(--color-primary);
}
.google-map {
    border-radius: 12px;
    overflow: hidden;
}
.google-map, #contactMap {
    height: 250px;
    border-radius: 12px;
    z-index: 1;
}
.google-map iframe {
    width: 100%;
    height: 200px;
    border: 0;
}
.google-map-placeholder {
    background: #f8fafc;
    border: 2px dashed #e2e8f0;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    color: #94a3b8;
}
[data-theme="dark"] .google-map-placeholder {
    background: #12102E;
    border-color: #2C2860;
    color: #6B6790;
}
.google-map-placeholder i {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}
.google-map-placeholder p {
    margin: 0;
    font-size: 0.9rem;
}
</style>
@endpush
