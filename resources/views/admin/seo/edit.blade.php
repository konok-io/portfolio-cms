@extends('admin.layouts.app')

@section('title', 'SEO Settings')

@section('content')

<div class="admin-page-header d-flex justify-content-between align-items-start">
    <div>
        <h1><i class="fa-solid fa-magnifying-glass me-2"></i>SEO Settings</h1>
        <p class="admin-breadcrumb mb-0">Optimize your website for search engines and social media.</p>
    </div>
    <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('seoForm').submit()">
        <i class="fa-solid fa-floppy-disk me-1"></i> Save All Changes
    </button>
</div>

<x-validation-errors />

{{-- SEO Health Check Summary --}}
<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <span><i class="fa-solid fa-heart-pulse me-2"></i>SEO Health Score</span>
                <button class="btn btn-sm btn-link text-decoration-none" type="button" data-bs-toggle="collapse" data-bs-target="#healthDetails">
                    <i class="fa-solid fa-chevron-down"></i> View Details
                </button>
            </div>
            <div class="card-body-custom">
                @php
                    $successCount = collect($seoHealth)->where('status', 'success')->count();
                    $warningCount = collect($seoHealth)->where('status', 'warning')->count();
                    $errorCount = collect($seoHealth)->where('status', 'error')->count();
                    $totalCount = count($seoHealth);
                    $healthPercent = round(($successCount / $totalCount) * 100);
                @endphp
                <div class="d-flex align-items-center gap-3">
                    <div class="progress flex-grow-1" style="height: 8px;">
                        <div class="progress-bar bg-{{ $healthPercent >= 80 ? 'success' : ($healthPercent >= 50 ? 'warning' : 'danger') }}" 
                             role="progressbar" style="width: {{ $healthPercent }}%"></div>
                    </div>
                    <span class="badge bg-{{ $healthPercent >= 80 ? 'success' : ($healthPercent >= 50 ? 'warning' : 'danger') }}">
                        {{ $healthPercent }}%
                    </span>
                </div>
                <div class="d-flex gap-3 mt-2 small">
                    <span class="text-success"><i class="fa-solid fa-check-circle me-1"></i>{{ $successCount }} Good</span>
                    <span class="text-warning"><i class="fa-solid fa-exclamation-circle me-1"></i>{{ $warningCount }} Warnings</span>
                    <span class="text-danger"><i class="fa-solid fa-times-circle me-1"></i>{{ $errorCount }} Issues</span>
                </div>
                
                {{-- Health Details --}}
                <div class="collapse mt-3" id="healthDetails">
                    <div class="row g-2">
                        @foreach($seoHealth as $key => $check)
                            <div class="col-md-4">
                                <div class="p-2 rounded bg-light d-flex align-items-center gap-2">
                                    @if($check['status'] === 'success')
                                        <i class="fa-solid fa-check-circle text-success"></i>
                                    @elseif($check['status'] === 'warning')
                                        <i class="fa-solid fa-exclamation-circle text-warning"></i>
                                    @else
                                        <i class="fa-solid fa-times-circle text-danger"></i>
                                    @endif
                                    <div>
                                        <div class="small fw-semibold">{{ $check['label'] }}</div>
                                        <div class="text-muted" style="font-size: 11px;">{{ $check['message'] }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Live Preview --}}
<div class="row g-3 mb-3">
    <div class="col-12">
        <div class="admin-card">
            <div class="card-header-custom">
                <i class="fa-solid fa-eye me-2"></i>Live Preview
            </div>
            <div class="card-body-custom">
                <ul class="nav nav-tabs mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#googlePreview" type="button">
                            <i class="fa-brands fa-google me-1"></i> Google
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#facebookPreview" type="button">
                            <i class="fa-brands fa-facebook me-1"></i> Facebook
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#twitterPreview" type="button">
                            <i class="fa-brands fa-twitter me-1"></i> Twitter
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    {{-- Google Preview --}}
                    <div class="tab-pane fade show active" id="googlePreview">
                        <div class="seo-preview google-preview p-3 border rounded">
                            <div class="preview-url text-muted small mb-1">{{ url('/') }}</div>
                            <div class="preview-title text-primary" style="font-size: 18px; line-height: 1.3;">
                                <span id="googleTitlePreview">{{ $seo->meta_title ?: 'Your Page Title' }}</span>
                            </div>
                            <div class="preview-desc text-success" style="font-size: 14px; line-height: 1.4;">
                                <span id="googleDescPreview">{{ $seo->meta_description ?: 'Your meta description will appear here. Make it compelling to encourage clicks from search results.' }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- Facebook Preview --}}
                    <div class="tab-pane fade" id="facebookPreview">
                        <div class="seo-preview facebook-preview border rounded overflow-hidden" style="max-width: 500px;">
                            <div class="bg-light p-2">
                                <div class="text-muted small fw-semibold">example.com</div>
                            </div>
                            <div class="p-2">
                                <div class="preview-title fw-semibold mb-1" style="font-size: 16px; color: #1a1a1a;">
                                    <span id="fbTitlePreview">{{ $seo->og_title ?: ($seo->meta_title ?: 'Your Page Title') }}</span>
                                </div>
                                <div class="preview-desc text-muted small mb-2">
                                    <span id="fbDescPreview">{{ $seo->og_description ?: ($seo->meta_description ?: 'Your meta description will appear here.') }}</span>
                                </div>
                                @if($seo->og_image)
                                    <img src="{{ $seo->og_image_url }}" class="img-fluid rounded" alt="OG Image">
                                @else
                                    <div class="bg-secondary text-white p-4 text-center rounded">
                                        <i class="fa-solid fa-image me-2"></i> No Image
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- Twitter Preview --}}
                    <div class="tab-pane fade" id="twitterPreview">
                        <div class="seo-preview twitter-preview border rounded overflow-hidden" style="max-width: 500px;">
                            <div class="bg-light p-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fa-brands fa-twitter text-primary"></i>
                                    <span class="text-muted small">Twitter</span>
                                </div>
                            </div>
                            <div class="p-2 border-top">
                                <div class="preview-title fw-semibold mb-1" style="font-size: 15px;">
                                    <span id="twTitlePreview">{{ $seo->twitter_title ?: ($seo->og_title ?: ($seo->meta_title ?: 'Your Page Title')) }}</span>
                                </div>
                                <div class="preview-desc text-muted small mb-2">
                                    <span id="twDescPreview">{{ $seo->twitter_description ?: ($seo->og_description ?: ($seo->meta_description ?: 'Your meta description')) }}</span>
                                </div>
                                @if($seo->twitter_image || $seo->og_image)
                                    <img src="{{ $seo->twitter_image_url ?: $seo->og_image_url }}" class="img-fluid rounded" alt="Twitter Image">
                                @else
                                    <div class="bg-secondary text-white p-4 text-center rounded">
                                        <i class="fa-solid fa-image me-2"></i> No Image
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('admin.seo.update') }}" method="POST" enctype="multipart/form-data" id="seoForm">
    @csrf
    @method('PUT')

    {{-- Main Tabs --}}
    <ul class="nav nav-tabs mb-3" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#generalSeo" type="button">
                <i class="fa-solid fa-globe me-1"></i> General
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#homepageSeo" type="button">
                <i class="fa-solid fa-home me-1"></i> Homepage
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#openGraph" type="button">
                <i class="fa-brands fa-facebook me-1"></i> Open Graph
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#twitterCards" type="button">
                <i class="fa-brands fa-twitter me-1"></i> Twitter
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#verification" type="button">
                <i class="fa-solid fa-check-double me-1"></i> Verification
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#analytics" type="button">
                <i class="fa-solid fa-chart-line me-1"></i> Analytics
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#schemaMarkup" type="button">
                <i class="fa-solid fa-code me-1"></i> Schema
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#socialProfiles" type="button">
                <i class="fa-solid fa-share-nodes me-1"></i> Social
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#technicalSeo" type="button">
                <i class="fa-solid fa-gear me-1"></i> Technical
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#sitemap" type="button">
                <i class="fa-solid fa-sitemap me-1"></i> Sitemap
            </button>
        </li>
    </ul>

    <div class="tab-content">
        {{-- Tab 1: General SEO --}}
        <div class="tab-pane fade show active" id="generalSeo">
            <div class="admin-card mb-3">
                <div class="card-header-custom">
                    <i class="fa-solid fa-globe me-2"></i>General SEO Settings
                    <small class="text-muted ms-2">(Applied across all pages)</small>
                </div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-admin">Meta Title <span class="text-danger">*</span></label>
                            <input type="text" name="meta_title" class="form-control" 
                                   value="{{ old('meta_title', $seo->meta_title) }}" 
                                   maxlength="255" id="metaTitleInput"
                                   placeholder="Best Portfolio Website | Your Name"
                                   oninput="updatePreviews()">
                            <small class="text-muted">Ideal: 50-60 characters</small>
                            <div class="progress mt-1" style="height: 3px;">
                                <div class="progress-bar bg-primary" id="titleProgress" style="width: 0%"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Meta Author</label>
                            <input type="text" name="meta_author" class="form-control" 
                                   value="{{ old('meta_author', $seo->meta_author) }}"
                                   placeholder="Your Name or Company">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Meta Description <span class="text-danger">*</span></label>
                            <textarea name="meta_description" class="form-control" rows="3" 
                                      maxlength="500" id="metaDescInput"
                                      placeholder="Describe your website in 150-160 characters..."
                                      oninput="updatePreviews()">{{ old('meta_description', $seo->meta_description) }}</textarea>
                            <small class="text-muted">Ideal: 150-160 characters</small>
                            <div class="progress mt-1" style="height: 3px;">
                                <div class="progress-bar bg-success" id="descProgress" style="width: 0%"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Meta Keywords</label>
                            <input type="text" name="meta_keywords" class="form-control" 
                                   value="{{ old('meta_keywords', $seo->meta_keywords) }}"
                                   placeholder="portfolio, developer, designer, web development"
                                   data-role="tagsinput">
                            <small class="text-muted">Separate keywords with commas</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Meta Language</label>
                            <select name="meta_language" class="form-select">
                                <option value="en" {{ ($seo->meta_language ?? 'en') === 'en' ? 'selected' : '' }}>English</option>
                                <option value="ar" {{ $seo->meta_language === 'ar' ? 'selected' : '' }}>Arabic (العربية)</option>
                                <option value="bn" {{ $seo->meta_language === 'bn' ? 'selected' : '' }}>Bengali (বাংলা)</option>
                                <option value="ur" {{ $seo->meta_language === 'ur' ? 'selected' : '' }}>Urdu (اردو)</option>
                                <option value="hi" {{ $seo->meta_language === 'hi' ? 'selected' : '' }}>Hindi (हिन्दी)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Canonical URL</label>
                            <input type="url" name="canonical_url" class="form-control" 
                                   value="{{ old('canonical_url', $seo->canonical_url) }}"
                                   placeholder="https://yourdomain.com">
                            <small class="text-muted">Preferred URL for search engines</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab 2: Homepage SEO --}}
        <div class="tab-pane fade" id="homepageSeo">
            <div class="admin-card mb-3">
                <div class="card-header-custom">
                    <i class="fa-solid fa-home me-2"></i>Homepage SEO
                    <small class="text-muted ms-2">(Specific settings for your homepage)</small>
                </div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label-admin">Homepage Meta Title</label>
                            <input type="text" name="home_meta_title" class="form-control" 
                                   value="{{ old('home_meta_title', $seo->home_meta_title) }}"
                                   placeholder="Overwrite default title for homepage only">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Homepage Meta Description</label>
                            <textarea name="home_meta_description" class="form-control" rows="3" 
                                      placeholder="Overwrite default description for homepage only">{{ old('home_meta_description', $seo->home_meta_description) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Homepage Keywords</label>
                            <input type="text" name="home_meta_keywords" class="form-control" 
                                   value="{{ old('home_meta_keywords', $seo->home_meta_keywords) }}"
                                   placeholder="Separate with commas">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab 3: Open Graph --}}
        <div class="tab-pane fade" id="openGraph">
            <div class="admin-card mb-3">
                <div class="card-header-custom">
                    <i class="fa-brands fa-facebook me-2"></i>Open Graph Settings (Facebook)
                    <small class="text-muted ms-2">How your site appears when shared on Facebook</small>
                </div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-admin">OG Title</label>
                            <input type="text" name="og_title" class="form-control" 
                                   value="{{ old('og_title', $seo->og_title) }}"
                                   placeholder="Leave empty to use meta title"
                                   oninput="updatePreviews()">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">OG Site Name</label>
                            <input type="text" name="og_site_name" class="form-control" 
                                   value="{{ old('og_site_name', $seo->og_site_name) }}"
                                   placeholder="Your Website Name">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">OG Description</label>
                            <textarea name="og_description" class="form-control" rows="2" 
                                      oninput="updatePreviews()">{{ old('og_description', $seo->og_description) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">OG Type</label>
                            <select name="og_type" class="form-select">
                                <option value="website" {{ ($seo->og_type ?? 'website') === 'website' ? 'selected' : '' }}>Website</option>
                                <option value="article" {{ $seo->og_type === 'article' ? 'selected' : '' }}>Article</option>
                                <option value="profile" {{ $seo->og_type === 'profile' ? 'selected' : '' }}>Profile</option>
                                <option value="book" {{ $seo->og_type === 'book' ? 'selected' : '' }}>Book</option>
                                <option value="music.song" {{ $seo->og_type === 'music.song' ? 'selected' : '' }}>Music - Song</option>
                                <option value="music.album" {{ $seo->og_type === 'music.album' ? 'selected' : '' }}>Music - Album</option>
                                <option value="video.movie" {{ $seo->og_type === 'video.movie' ? 'selected' : '' }}>Video - Movie</option>
                                <option value="video.episode" {{ $seo->og_type === 'video.episode' ? 'selected' : '' }}>Video - Episode</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">OG Locale</label>
                            <select name="og_locale" class="form-select">
                                <option value="en_US" {{ ($seo->og_locale ?? 'en_US') === 'en_US' ? 'selected' : '' }}>English (US)</option>
                                <option value="en_GB" {{ $seo->og_locale === 'en_GB' ? 'selected' : '' }}>English (UK)</option>
                                <option value="ar_AR" {{ $seo->og_locale === 'ar_AR' ? 'selected' : '' }}>Arabic</option>
                                <option value="bn_BD" {{ $seo->og_locale === 'bn_BD' ? 'selected' : '' }}>Bengali (Bangladesh)</option>
                                <option value="hi_IN" {{ $seo->og_locale === 'hi_IN' ? 'selected' : '' }}>Hindi (India)</option>
                                <option value="ur_PK" {{ $seo->og_locale === 'ur_PK' ? 'selected' : '' }}>Urdu (Pakistan)</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">OG Image</label>
                            <div class="row">
                                <div class="col-md-3">
                                    @if($seo->og_image_url)
                                        <img src="{{ $seo->og_image_url }}" class="img-thumbnail mb-2" style="max-height: 100px;">
                                    @else
                                        <div class="bg-light p-4 text-center rounded mb-2">
                                            <i class="fa-solid fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <input type="file" name="og_image" class="form-control" accept="image/*">
                                    <small class="text-muted">Recommended: 1200x630px, Max 2MB (JPG, PNG, WEBP)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab 4: Twitter Cards --}}
        <div class="tab-pane fade" id="twitterCards">
            <div class="admin-card mb-3">
                <div class="card-header-custom">
                    <i class="fa-brands fa-twitter me-2"></i>Twitter Card Settings
                    <small class="text-muted ms-2">How your site appears when shared on Twitter</small>
                </div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-admin">Twitter Card Type</label>
                            <select name="twitter_card_type" class="form-select">
                                <option value="summary_large_image" {{ ($seo->twitter_card_type ?? 'summary_large_image') === 'summary_large_image' ? 'selected' : '' }}>
                                    Summary Large Image
                                </option>
                                <option value="summary" {{ $seo->twitter_card_type === 'summary' ? 'selected' : '' }}>Summary</option>
                                <option value="app" {{ $seo->twitter_card_type === 'app' ? 'selected' : '' }}>App</option>
                                <option value="player" {{ $seo->twitter_card_type === 'player' ? 'selected' : '' }}>Player</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Twitter Site (@username)</label>
                            <input type="text" name="twitter_site" class="form-control" 
                                   value="{{ old('twitter_site', $seo->twitter_site) }}"
                                   placeholder="@yoursite">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Twitter Creator (@username)</label>
                            <input type="text" name="twitter_creator" class="form-control" 
                                   value="{{ old('twitter_creator', $seo->twitter_creator) }}"
                                   placeholder="@yourusername">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Twitter Title</label>
                            <input type="text" name="twitter_title" class="form-control" 
                                   value="{{ old('twitter_title', $seo->twitter_title) }}"
                                   placeholder="Leave empty to use OG title"
                                   oninput="updatePreviews()">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Twitter Description</label>
                            <textarea name="twitter_description" class="form-control" rows="2" 
                                      placeholder="Leave empty to use OG description"
                                      oninput="updatePreviews()">{{ old('twitter_description', $seo->twitter_description) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Twitter Image</label>
                            <div class="row">
                                <div class="col-md-3">
                                    @if($seo->twitter_image_url)
                                        <img src="{{ $seo->twitter_image_url }}" class="img-thumbnail mb-2" style="max-height: 100px;">
                                    @elseif($seo->og_image_url)
                                        <img src="{{ $seo->og_image_url }}" class="img-thumbnail mb-2" style="max-height: 100px; opacity: 0.5;">
                                        <small class="text-muted d-block">Will use OG Image</small>
                                    @else
                                        <div class="bg-light p-4 text-center rounded mb-2">
                                            <i class="fa-solid fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <input type="file" name="twitter_image" class="form-control" accept="image/*">
                                    <small class="text-muted">Recommended: 1200x600px, Max 2MB. Leave empty to use OG Image.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab 5: Verification --}}
        <div class="tab-pane fade" id="verification">
            <div class="admin-card mb-3">
                <div class="card-header-custom">
                    <i class="fa-solid fa-check-double me-2"></i>Search Engine Verification
                    <small class="text-muted ms-2">Verify ownership with search engines</small>
                </div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-admin">
                                <i class="fa-brands fa-google text-danger me-1"></i> Google Site Verification
                            </label>
                            <input type="text" name="google_site_verification" class="form-control" 
                                   value="{{ old('google_site_verification', $seo->google_site_verification) }}"
                                   placeholder="google-site-verification=xxxxx">
                            <small class="text-muted">Found in Google Search Console</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">
                                <i class="fa-brands fa-microsoft text-info me-1"></i> Bing Site Verification
                            </label>
                            <input type="text" name="bing_site_verification" class="form-control" 
                                   value="{{ old('bing_site_verification', $seo->bing_site_verification) }}"
                                   placeholder="msvalidate.01=xxxxx">
                            <small class="text-muted">Found in Bing Webmaster Tools</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">
                                <i class="fa-brands fa-yandex text-success me-1"></i> Yandex Verification
                            </label>
                            <input type="text" name="yandex_verification" class="form-control" 
                                   value="{{ old('yandex_verification', $seo->yandex_verification) }}"
                                   placeholder="yandex_verification=xxxxx">
                            <small class="text-muted">Found in Yandex Webmaster</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">
                                <i class="fa-brands fa-pinterest text-danger me-1"></i> Pinterest Verification
                            </label>
                            <input type="text" name="pinterest_verification" class="form-control" 
                                   value="{{ old('pinterest_verification', $seo->pinterest_verification) }}"
                                   placeholder="p:domain_verify=xxxxx">
                            <small class="text-muted">Found in Pinterest Settings</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab 6: Analytics --}}
        <div class="tab-pane fade" id="analytics">
            <div class="admin-card mb-3">
                <div class="card-header-custom">
                    <i class="fa-solid fa-chart-line me-2"></i>Analytics & Tracking
                    <small class="text-muted ms-2">Connect your analytics tools</small>
                </div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-admin">
                                <i class="fa-brands fa-google me-1"></i> Google Analytics ID
                            </label>
                            <input type="text" name="google_analytics_id" class="form-control" 
                                   value="{{ old('google_analytics_id', $seo->google_analytics_id) }}"
                                   placeholder="G-XXXXXXXXXX">
                            <small class="text-muted">Found in GA4 Admin > Data Streams</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">
                                <i class="fa-solid fa-layer-group me-1"></i> Google Tag Manager ID
                            </label>
                            <input type="text" name="google_tag_manager_id" class="form-control" 
                                   value="{{ old('google_tag_manager_id', $seo->google_tag_manager_id) }}"
                                   placeholder="GTM-XXXXXX">
                            <small class="text-muted">Found in GTM Dashboard</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">
                                <i class="fa-brands fa-facebook me-1"></i> Facebook Pixel ID
                            </label>
                            <input type="text" name="facebook_pixel_id" class="form-control" 
                                   value="{{ old('facebook_pixel_id', $seo->facebook_pixel_id) }}"
                                   placeholder="123456789012345">
                            <small class="text-muted">Found in Meta Events Manager</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">
                                <i class="fa-solid fa-chart-simple me-1"></i> Microsoft Clarity ID
                            </label>
                            <input type="text" name="microsoft_clarity_id" class="form-control" 
                                   value="{{ old('microsoft_clarity_id', $seo->microsoft_clarity_id) }}"
                                   placeholder="xxxxxxxxxx">
                            <small class="text-muted">Found in Clarity Dashboard</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab 7: Schema Markup --}}
        <div class="tab-pane fade" id="schemaMarkup">
            <div class="admin-card mb-3">
                <div class="card-header-custom">
                    <i class="fa-solid fa-code me-2"></i>Schema Markup (JSON-LD)
                    <small class="text-muted ms-2">Structured data for rich search results</small>
                </div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="alert alert-info small mb-3">
                                <i class="fa-solid fa-info-circle me-1"></i>
                                Schema markup helps search engines understand your content better and may improve your search appearance.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Organization Name</label>
                            <input type="text" name="organization_name" class="form-control" 
                                   value="{{ old('organization_name', $seo->organization_name) }}"
                                   placeholder="Your Company or Personal Brand Name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Organization Logo</label>
                            <div class="row">
                                <div class="col-md-4">
                                    @if($seo->organization_logo_url)
                                        <img src="{{ $seo->organization_logo_url }}" class="img-thumbnail mb-2" style="max-height: 60px;">
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="organization_logo" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Organization Phone</label>
                            <input type="text" name="organization_phone" class="form-control" 
                                   value="{{ old('organization_phone', $seo->organization_phone) }}"
                                   placeholder="+1 234 567 8900">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">Organization Email</label>
                            <input type="email" name="organization_email" class="form-control" 
                                   value="{{ old('organization_email', $seo->organization_email) }}"
                                   placeholder="contact@example.com">
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Organization Address</label>
                            <textarea name="organization_address" class="form-control" rows="2"
                                      placeholder="123 Main St, City, State, ZIP">{{ old('organization_address', $seo->organization_address) }}</textarea>
                        </div>
                        
                        {{-- Schema Preview --}}
                        <div class="col-12">
                            <label class="form-label-admin">Generated Schema Preview</label>
                            <div class="bg-dark text-light p-3 rounded" style="font-family: monospace; font-size: 12px; max-height: 300px; overflow: auto;">
                                <pre id="schemaPreview" class="mb-0 text-white">{!! json_encode($seo->getAllSchemas(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab 8: Social Profiles --}}
        <div class="tab-pane fade" id="socialProfiles">
            <div class="admin-card mb-3">
                <div class="card-header-custom">
                    <i class="fa-solid fa-share-nodes me-2"></i>Social Media Profiles
                    <small class="text-muted ms-2">Links to your social profiles (used in schema markup)</small>
                </div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-admin">
                                <i class="fa-brands fa-facebook text-primary me-1"></i> Facebook
                            </label>
                            <input type="url" name="facebook_url" class="form-control" 
                                   value="{{ old('facebook_url', $seo->facebook_url) }}"
                                   placeholder="https://facebook.com/yourpage">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">
                                <i class="fa-brands fa-x-twitter text-info me-1"></i> Twitter / X
                            </label>
                            <input type="url" name="twitter_url" class="form-control" 
                                   value="{{ old('twitter_url', $seo->twitter_url) }}"
                                   placeholder="https://twitter.com/yourusername">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">
                                <i class="fa-brands fa-linkedin text-primary me-1"></i> LinkedIn
                            </label>
                            <input type="url" name="linkedin_url" class="form-control" 
                                   value="{{ old('linkedin_url', $seo->linkedin_url) }}"
                                   placeholder="https://linkedin.com/in/yourprofile">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">
                                <i class="fa-brands fa-instagram text-danger me-1"></i> Instagram
                            </label>
                            <input type="url" name="instagram_url" class="form-control" 
                                   value="{{ old('instagram_url', $seo->instagram_url) }}"
                                   placeholder="https://instagram.com/yourusername">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-admin">
                                <i class="fa-brands fa-youtube text-danger me-1"></i> YouTube
                            </label>
                            <input type="url" name="youtube_url" class="form-control" 
                                   value="{{ old('youtube_url', $seo->youtube_url) }}"
                                   placeholder="https://youtube.com/@yourchannel">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab 9: Technical SEO --}}
        <div class="tab-pane fade" id="technicalSeo">
            <div class="admin-card mb-3">
                <div class="card-header-custom">
                    <i class="fa-solid fa-gear me-2"></i>Technical SEO Settings
                </div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        {{-- Search Engine Access --}}
                        <div class="col-12">
                            <h6 class="border-bottom pb-2 mb-3">
                                <i class="fa-solid fa-robot me-1"></i> Search Engine Access
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="allow_indexing" value="1" 
                                       class="form-check-input" id="allowIndexing"
                                       {{ ($seo->allow_indexing ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="allowIndexing">
                                    <strong>Allow Search Engine Indexing</strong>
                                    <small class="text-muted d-block">Enable to let Google, Bing, etc. index your site</small>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="allow_following" value="1" 
                                       class="form-check-input" id="allowFollowing"
                                       {{ ($seo->allow_following ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="allowFollowing">
                                    <strong>Allow Search Engine Following</strong>
                                    <small class="text-muted d-block">Allow bots to follow links on your site</small>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="allow_archiving" value="1" 
                                       class="form-check-input" id="allowArchiving"
                                       {{ ($seo->allow_archiving ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="allowArchiving">
                                    <strong>Allow Archiving</strong>
                                    <small class="text-muted d-block">Allow Wayback Machine to archive your site</small>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="allow_snippet" value="1" 
                                       class="form-check-input" id="allowSnippet"
                                       {{ ($seo->allow_snippet ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="allowSnippet">
                                    <strong>Allow Search Snippets</strong>
                                    <small class="text-muted d-block">Show page descriptions in search results</small>
                                </label>
                            </div>
                        </div>

                        {{-- Robots.txt --}}
                        <div class="col-12 mt-4">
                            <h6 class="border-bottom pb-2 mb-3">
                                <i class="fa-solid fa-file-alt me-1"></i> Robots.txt Editor
                            </h6>
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Custom Robots.txt Content</label>
                            <textarea name="robots_txt_content" class="form-control" rows="8"
                                      placeholder="Leave empty to use default robots.txt"
                                      style="font-family: monospace;">{{ old('robots_txt_content', $seo->robots_txt_content) }}</textarea>
                            <small class="text-muted">
                                Default: Allow all bots. Customize to block specific paths.
                                <a href="{{ url('/robots.txt') }}" target="_blank" class="text-decoration-none">
                                    <i class="fa-solid fa-external-link-alt ms-1"></i> View current
                                </a>
                            </small>
                        </div>

                        {{-- Custom Code --}}
                        <div class="col-12 mt-4">
                            <h6 class="border-bottom pb-2 mb-3">
                                <i class="fa-solid fa-code me-1"></i> Custom Code Injection
                            </h6>
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Custom &lt;head&gt; Code</label>
                            <textarea name="custom_head_code" class="form-control" rows="4"
                                      placeholder="<!-- Custom scripts, styles, or meta tags -->"
                                      style="font-family: monospace;">{{ old('custom_head_code', $seo->custom_head_code) }}</textarea>
                            <small class="text-muted">This code will be injected before &lt;/head&gt;</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Custom &lt;body&gt; Code</label>
                            <textarea name="custom_body_code" class="form-control" rows="4"
                                      placeholder="<!-- Custom scripts before </body> -->"
                                      style="font-family: monospace;">{{ old('custom_body_code', $seo->custom_body_code) }}</textarea>
                            <small class="text-muted">This code will be injected before &lt;/body&gt;</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tab 10: Sitemap --}}
        <div class="tab-pane fade" id="sitemap">
            <div class="admin-card mb-3">
                <div class="card-header-custom">
                    <i class="fa-solid fa-sitemap me-2"></i>XML Sitemap Settings
                </div>
                <div class="card-body-custom">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="form-check form-switch mb-3">
                                <input type="checkbox" name="sitemap_enabled" value="1" 
                                       class="form-check-input" id="sitemapEnabled"
                                       {{ ($seo->sitemap_enabled ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="sitemapEnabled">
                                    <strong>Enable XML Sitemap</strong>
                                    <small class="text-muted d-block">Automatically generate sitemap.xml for search engines</small>
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="alert alert-info">
                                <i class="fa-solid fa-info-circle me-1"></i>
                                <strong>Sitemap URL:</strong> 
                                <a href="{{ url('/sitemap.xml') }}" target="_blank" class="alert-link">
                                    {{ url('/sitemap.xml') }}
                                </a>
                                <br>
                                <small>This sitemap includes: Home page, About, Services, Projects, Blog posts, and Contact.</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label-admin">Custom Sitemap URL (Optional)</label>
                            <input type="url" name="sitemap_url" class="form-control" 
                                   value="{{ old('sitemap_url', $seo->sitemap_url) }}"
                                   placeholder="Leave empty to use default sitemap URL">
                            <small class="text-muted">If you're using an external sitemap service</small>
                        </div>
                        
                        {{-- Sitemap Contents --}}
                        <div class="col-12 mt-3">
                            <label class="form-label-admin">Sitemap Contents</label>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Section</th>
                                            <th>Included</th>
                                            <th>Last Updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><i class="fa-solid fa-home me-1"></i> Home Page</td>
                                            <td><span class="badge bg-success">Yes</span></td>
                                            <td>Auto</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa-solid fa-user me-1"></i> About</td>
                                            <td><span class="badge bg-success">Yes</span></td>
                                            <td>Auto</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa-solid fa-briefcase me-1"></i> Services</td>
                                            <td><span class="badge bg-success">Yes</span></td>
                                            <td>Auto</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa-solid fa-folder-open me-1"></i> Projects</td>
                                            <td><span class="badge bg-success">Yes</span></td>
                                            <td>Auto</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa-solid fa-blog me-1"></i> Blog Posts</td>
                                            <td><span class="badge bg-success">Yes</span></td>
                                            <td>Auto</td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa-solid fa-envelope me-1"></i> Contact</td>
                                            <td><span class="badge bg-success">Yes</span></td>
                                            <td>Auto</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
        <button type="submit" class="btn btn-admin-primary px-5">
            <i class="fa-solid fa-floppy-disk me-2"></i>Save All SEO Settings
        </button>
    </div>
</form>

@endsection

@push('scripts')
<script>
// Update preview on input
function updatePreviews() {
    const title = document.getElementById('metaTitleInput')?.value || '';
    const desc = document.getElementById('metaDescInput')?.value || '';
    
    // Google Preview
    document.getElementById('googleTitlePreview').textContent = title || 'Your Page Title';
    document.getElementById('googleDescPreview').textContent = desc || 'Your meta description will appear here...';
    
    // Facebook Preview
    document.getElementById('fbTitlePreview').textContent = title || 'Your Page Title';
    document.getElementById('fbDescPreview').textContent = desc || 'Your meta description will appear here...';
    
    // Twitter Preview
    document.getElementById('twTitlePreview').textContent = title || 'Your Page Title';
    document.getElementById('twDescPreview').textContent = desc || 'Your meta description will appear here...';
    
    // Progress bars
    updateProgress('titleProgress', title.length, 60);
    updateProgress('descProgress', desc.length, 160);
}

function updateProgress(elementId, current, ideal) {
    const el = document.getElementById(elementId);
    if (!el) return;
    
    const percent = Math.min(100, (current / ideal) * 100);
    el.style.width = percent + '%';
    
    if (current > ideal) {
        el.className = 'progress-bar bg-danger';
    } else if (percent >= 80) {
        el.className = 'progress-bar bg-success';
    } else if (percent >= 50) {
        el.className = 'progress-bar bg-warning';
    } else {
        el.className = 'progress-bar bg-primary';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    updatePreviews();
    
    // Auto-save indicator for tabs
    const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');
    tabs.forEach(tab => {
        tab.addEventListener('shown.bs.tab', function() {
            updatePreviews();
        });
    });
});
</script>
@endpush

<style>
.seo-preview {
    background: #fff;
    max-width: 600px;
}
.seo-preview.google-preview {
    border: 1px solid #dfe3ea !important;
}
.seo-preview .preview-title {
    cursor: pointer;
}
.seo-preview .preview-title:hover {
    text-decoration: underline;
}
.nav-tabs .nav-link {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}
@media (max-width: 768px) {
    .nav-tabs {
        flex-wrap: wrap;
    }
    .nav-tabs .nav-link {
        flex: 1 1 auto;
        text-align: center;
        min-width: 100px;
    }
}
</style>
