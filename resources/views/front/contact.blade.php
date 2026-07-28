@extends('front.layouts.app')
@section('title', page_content('contact', 'page_title', app()->getLocale()) . ' | ' . ($siteSetting->site_name ?? 'Portfolio CMS'))
@section('meta_description', page_content('contact', 'page_subtitle', app()->getLocale()))

@section('content')

{{-- Page header --}}
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
            <span class="section-eyebrow">{{ page_content('contact', 'page_eyebrow', app()->getLocale()) }}</span>
            <h1 class="section-title">{{ page_content('contact', 'page_title', app()->getLocale()) }}</h1>
            <p class="section-subtitle mx-auto">{{ page_content('contact', 'page_subtitle', app()->getLocale()) }}</p>
        </div>
    </div>
</section>

{{-- Contact Section - Same as Home Page --}}
<section class="section-padding section-1">
    <div class="container">
        
        <style>
            .contact-vertical-section {
                background: #ffffff;
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 4px 20px rgba(0,0,0,0.06);
                border: 1px solid #d1d5db;
            }
            
            .contact-vertical-top {
                background: linear-gradient(135deg, var(--color-primary, #2563EB), var(--color-primary-dark, #1d4ed8));
                padding: 24px 32px;
                color: #fff;
            }
            
            .contact-vertical-title {
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 8px;
                color: #ffffff;
            }
            
            .contact-vertical-subtitle {
                font-size: 0.9rem;
                opacity: 0.9;
                margin-bottom: 0;
                color: rgba(255, 255, 255, 0.9);
            }
            
            .contact-vertical-info {
                display: flex;
                justify-content: flex-end;
                gap: 16px;
                flex-wrap: wrap;
            }
            
            .contact-vertical-info-item {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 0.85rem;
            }
            
            .contact-vertical-info-icon {
                width: 28px;
                height: 28px;
                background: rgba(255,255,255,0.2);
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.75rem;
                flex-shrink: 0;
            }
            
            .contact-vertical-bottom {
                padding: 28px 32px;
            }
            
            .contact-vertical-form-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
                margin-bottom: 12px;
            }
            
            .contact-vertical-input {
                width: 100%;
                padding: 10px 14px;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                font-size: 0.9rem;
                transition: all 0.3s;
            }
            
            .contact-vertical-input:focus {
                outline: none;
                border-color: var(--color-primary, #2563EB);
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            }
            
            .contact-vertical-textarea {
                width: 100%;
                padding: 10px 14px;
                border: 1px solid #d1d5db;
                border-radius: 8px;
                font-size: 0.9rem;
                resize: none;
                height: 80px;
                transition: all 0.3s;
            }
            
            .contact-vertical-textarea:focus {
                outline: none;
                border-color: var(--color-primary, #2563EB);
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            }
            
            .contact-vertical-btn {
                background: var(--color-primary, #2563EB);
                color: #fff;
                padding: 10px 24px;
                border-radius: 8px;
                border: none;
                font-weight: 600;
                font-size: 0.9rem;
                cursor: pointer;
                transition: all 0.3s;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                width: 100%;
            }
            
            .contact-vertical-btn:hover {
                background: var(--color-primary-dark, #1d4ed8);
            }
            
            .contact-vertical-map-container {
                width: 100%;
                height: 100%;
                min-height: 250px;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                border: 1px solid #d1d5db;
            }
            
            .contact-vertical-map-container iframe,
            .contact-vertical-map-container #contactPageMap {
                width: 100%;
                height: 100%;
                min-height: 250px;
                border: none;
            }
            
            .contact-vertical-map-placeholder {
                min-height: 250px;
            }
            
            @media (max-width: 576px) {
                .contact-vertical-form-grid {
                    grid-template-columns: 1fr;
                }
                .contact-vertical-info {
                    flex-direction: column;
                    gap: 12px;
                }
                .contact-vertical-map-container,
                .contact-vertical-map-container iframe {
                    min-height: 200px;
                }
            }
            
            @media (max-width: 991px) {
                .contact-vertical-map-container,
                .contact-vertical-map-container iframe {
                    min-height: 200px;
                    margin-top: 20px;
                }
            }
            
            [data-theme="dark"] .contact-vertical-section {
                background: #1e293b;
            }
            [data-theme="dark"] .contact-vertical-input,
            [data-theme="dark"] .contact-vertical-textarea {
                background: #0f172a;
                border-color: #334155;
                color: #f1f5f9;
            }
            [data-theme="dark"] .contact-vertical-input::placeholder,
            [data-theme="dark"] .contact-vertical-textarea::placeholder {
                color: #64748b;
            }
        </style>
        
        <div class="contact-vertical-section reveal-on-scroll">
            <div class="contact-vertical-top">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3 class="contact-vertical-title">{{ page_content('contact', 'contact_title', app()->getLocale()) }}</h3>
                        <p class="contact-vertical-subtitle">{{ page_content('contact', 'contact_text', app()->getLocale()) }}</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-vertical-info text-end">
                            @if($siteSetting->email)
                                <div class="contact-vertical-info-item">
                                    <div class="contact-vertical-info-icon">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <span>{{ Str::limit($siteSetting->email, 30) }}</span>
                                </div>
                            @endif
                            @if($siteSetting->phone)
                                <div class="contact-vertical-info-item">
                                    <div class="contact-vertical-info-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <span>{{ $siteSetting->phone }}</span>
                                </div>
                            @endif
                            @if($siteSetting->address)
                                <div class="contact-vertical-info-item">
                                    <div class="contact-vertical-info-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <span>{{ Str::limit($siteSetting->address, 25) }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-vertical-bottom">
                @if(session('success'))
                    <div class="alert alert-success mb-4">{{ session('success') }}</div>
                @endif
                <div class="row g-4 align-items-stretch">
                    <div class="col-lg-7 d-flex">
                        @if($siteSetting->google_map)
                            <div class="contact-vertical-map-container">
                                <div id="contactPageMap"></div>
                            </div>
                        @else
                            <div class="contact-vertical-map-placeholder d-flex align-items-center justify-content-center w-100" style="background: #f8f9fa; border-radius: 12px; border: 1px solid #d1d5db;">
                                <div class="text-center text-muted">
                                    <i class="fas fa-map-marker-alt fa-2x mb-2"></i>
                                    <p class="mb-0 small">Map location will appear here</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-5 d-flex">
                        <form action="{{ route('contact.store') }}" method="POST" class="w-100 d-flex flex-column justify-content-center">
                            @csrf
                            {{-- Honeypot spam protection - hidden from users --}}
                            <div class="honeypot-field" aria-hidden="true">
                                <input type="text" name="website_url" tabindex="-1" autocomplete="off">
                            </div>
                            <div class="contact-vertical-form-grid">
                                <input type="text" name="name" class="contact-vertical-input" placeholder="Your Name *" value="{{ old('name') }}" required>
                                <input type="email" name="email" class="contact-vertical-input" placeholder="Email Address *" value="{{ old('email') }}" required>
                                <input type="tel" name="phone" class="contact-vertical-input" placeholder="{{ page_content('contact', 'form_phone', app()->getLocale()) }}" value="{{ old('phone') }}">
                                <input type="text" name="subject" class="contact-vertical-input" placeholder="{{ page_content('contact', 'form_subject', app()->getLocale()) }}" value="{{ old('subject') }}">
                            </div>
                            <textarea name="message" class="contact-vertical-textarea" placeholder="{{ page_content('contact', 'form_message', app()->getLocale()) }} *" required>{{ old('message') }}</textarea>
                            @if($siteSetting->isRecaptchaEnabled())
                                <div class="mb-3 mt-2">
                                    <div class="g-recaptcha" data-sitekey="{{ $siteSetting->recaptcha_site_key }}"></div>
                                    @error('recaptcha')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            <button type="submit" class="contact-vertical-btn mt-3">
                                <i class="fas fa-paper-plane"></i>
                                {{ page_content('contact', 'form_button', app()->getLocale()) }}
                            </button>
                        </form>
                    </div>
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
    const map = L.map('contactPageMap').setView([0, 0], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);
    
    const mapUrl = "{{ addslashes($siteSetting->google_map) }}";
    const address = "{{ addslashes($siteSetting->address ?? '') }}";
    
    const coordMatch = mapUrl.match(/@(-?\d+\.?\d*),(-?\d+\.?\d*)/);
    
    if (coordMatch) {
        const lat = parseFloat(coordMatch[1]);
        const lon = parseFloat(coordMatch[2]);
        map.setView([lat, lon], 15);
        L.marker([lat, lon]).addTo(map)
            .bindPopup(address || 'Location').openPopup();
    } else {
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
