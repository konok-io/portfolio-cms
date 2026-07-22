<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $seoMeta = null;
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('seo_settings')) {
                $seoMeta = \App\Models\SeoSetting::first();
            }
        } catch (\Throwable $e) {}
    @endphp

    <title>@yield('seo_title', $seoMeta->meta_title ?? $siteSetting->site_name ?? 'Portfolio CMS')</title>
    <meta name="description" content="@yield('meta_description', ($seoMeta->meta_description ?? ''))">
    <meta name="keywords" content="@yield('meta_keywords', ($seoMeta->meta_keywords ?? ''))">

    <meta property="og:title" content="@yield('title', ($siteSetting->site_name ?? 'Portfolio CMS'))">
    <meta property="og:description" content="@yield('meta_description', ($seoMeta->meta_description ?? ''))">
    @if($seoMeta && $seoMeta->og_image)
        <meta property="og:image" content="{{ asset('storage/' . $seoMeta->og_image) }}">
    @endif

    @if($siteSetting && $siteSetting->favicon)
        <link rel="icon" href="{{ asset('storage/' . $siteSetting->favicon) }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" id="bs-ltr">
    <script>
      (function(){try{
        var m=document.cookie.match(/googtrans=\/[^\/]+\/([a-z-]+)/);var l=m?m[1]:'';
        var rtl=['ar','ur','fa','he','ps','sd'];
        if(rtl.indexOf(l)>=0){
          var ltr=document.getElementById('bs-ltr');
          if(ltr) ltr.href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.rtl.min.css';
        }
      }catch(e){}})();
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/front.css') }}">

    <script>(function(){try{var t=localStorage.getItem('pc-theme')||'light';if(t==='dark')document.documentElement.setAttribute('data-theme','dark');}catch(e){}})();</script>
    <script>(function(){try{var m=document.cookie.match(/googtrans=\/[^\/]+\/([a-z-]+)/);var l=m?m[1]:'en';var rtl=['ar','ur','fa','he','ps','sd'];if(rtl.indexOf(l)>=0){document.documentElement.setAttribute('dir','rtl');}else{document.documentElement.setAttribute('dir','ltr');}}catch(e){}})();</script>
    <style>
      .gtranslate-wrap{position:relative}
      .gt-btn,.theme-toggle-btn{display:inline-flex;align-items:center;gap:7px;font-size:.9rem;font-weight:500;color:inherit;background:transparent;border:1px solid rgba(125,125,150,.3);border-radius:20px;padding:6px 13px;cursor:pointer}
      .theme-toggle-btn{width:38px;height:38px;justify-content:center;border-radius:50%;padding:0}
      .gt-btn:hover,.theme-toggle-btn:hover{border-color:#4F2FE8}
      .lang-menu{position:absolute;top:60px;right:0;z-index:1050;background:#fff;border:1px solid #e2e2e8;border-radius:12px;padding:6px;display:none;box-shadow:0 24px 60px -30px rgba(0,0,0,.3);max-height:360px;overflow:auto;min-width:170px}
      body.gt-open .lang-menu{display:block}
      .lang-menu button{display:block;width:100%;text-align:left;background:none;border:0;color:#333;font-size:14.5px;padding:9px 14px;border-radius:8px;cursor:pointer}
      .lang-menu button:hover{background:#f4f4f9}
      [data-theme="dark"] .lang-menu{background:#171433;border-color:#2C2860}
      [data-theme="dark"] .lang-menu button{color:#EDECFF}
      [data-theme="dark"] .lang-menu button:hover{background:#1E1A44}
      .goog-te-banner-frame,.skiptranslate iframe{display:none!important}
      body{top:0!important}
      font font{background:transparent!important;box-shadow:none!important}
      [data-theme="dark"] body{background:#0A0A1F!important;color:#EDECFF}
      [data-theme="dark"] .site-navbar{background:#12102E!important}
      [data-theme="dark"] section,[data-theme="dark"] .section,[data-theme="dark"] .bg-white,[data-theme="dark"] .bg-body{background:#0A0A1F!important}
      [data-theme="dark"] .bg-light-custom,[data-theme="dark"] .bg-light,[data-theme="dark"] .bg-body-tertiary{background:#12102E!important}
      [data-theme="dark"] .section-alt{background:#1a1a40!important}
      [data-theme="dark"] .section-tint{background:#1e1b38!important}
      [data-theme="dark"] .section-accent-tint{background:#1c1a00!important}
      [data-theme="dark"] .section-dark-tint{background:#222055!important}
      [data-theme="dark"] .card,[data-theme="dark"] .experience-card,[data-theme="dark"] .skill-card,[data-theme="dark"] .service-card,[data-theme="dark"] .project-card,[data-theme="dark"] .blog-card,[data-theme="dark"] .testimonial-card{background:#171433!important;color:#EDECFF!important;border-color:#2C2860!important}
      [data-theme="dark"] h1,[data-theme="dark"] h2,[data-theme="dark"] h3,[data-theme="dark"] h4,[data-theme="dark"] h5,[data-theme="dark"] h6,[data-theme="dark"] p,[data-theme="dark"] li,[data-theme="dark"] span,[data-theme="dark"] .nav-link,[data-theme="dark"] .navbar-brand{color:#EDECFF!important}
      [data-theme="dark"] .text-muted,[data-theme="dark"] .text-secondary,[data-theme="dark"] small{color:#9B98C7!important}
      [data-theme="dark"] .text-dark{color:#EDECFF!important}
      [data-theme="dark"] .border,[data-theme="dark"] .border-top,[data-theme="dark"] .border-bottom,[data-theme="dark"] hr{border-color:#2C2860!important}
      [data-theme="dark"] a:not(.btn){color:#22D3EE}
      [data-theme="dark"] .form-control,[data-theme="dark"] .form-select,[data-theme="dark"] textarea{background:#171433;color:#EDECFF;border-color:#2C2860}
      [data-theme="dark"] .form-control::placeholder{color:#6B6790}
      [data-theme="dark"] footer{background:#12102E!important}
      [data-theme="dark"] .footer-social a{background:#4F2FE8!important;color:#fff!important;border-color:#4F2FE8!important}
      [data-theme="dark"] .footer-social a i{color:#fff!important}
      [data-theme="dark"] .footer-social a:hover{background:#fff!important;border-color:#fff!important}
      [data-theme="dark"] .footer-social a:hover i{color:#4F2FE8!important}
      [data-theme="dark"] footer .form-control{background:#0A0A1F!important;color:#EDECFF!important;border-color:#2C2860!important}
      [data-theme="dark"] footer .form-control::placeholder{color:#6B6790!important}
      [data-theme="dark"] .btn-primary-custom{background:#4F2FE8!important;color:#fff!important;border-color:#4F2FE8}
      [data-theme="dark"] .btn-primary-custom:hover{background:#7C3AED!important;color:#fff!important}
      [data-theme="dark"] .btn-outline-primary,[data-theme="dark"] .btn-outline-secondary,[data-theme="dark"] .btn-outline-light{color:#EDECFF!important;border-color:#4F2FE8!important}
      [data-theme="dark"] .btn-outline-primary:hover,[data-theme="dark"] .btn-outline-secondary:hover{background:#4F2FE8!important;color:#fff!important}
      [data-theme="dark"] .btn-light{background:#1E1A44!important;color:#EDECFF!important;border-color:#2C2860!important}
      [data-theme="dark"] .btn-primary,[data-theme="dark"] .btn-primary-custom{background:#4F2FE8!important;color:#fff!important;border-color:#4F2FE8!important}
      [data-theme="dark"] .btn-primary:hover,[data-theme="dark"] .btn-primary-custom:hover{background:#7C3AED!important;color:#fff!important;border-color:#7C3AED!important}
      [data-theme="dark"] .btn-secondary{background:#3A356E!important;color:#fff!important;border-color:#3A356E!important}
      [data-theme="dark"] .btn-success{background:#16a34a!important;color:#fff!important;border-color:#16a34a!important}
      [data-theme="dark"] .btn-danger{background:#dc2626!important;color:#fff!important;border-color:#dc2626!important}
      [data-theme="dark"] .btn-warning{background:#d97706!important;color:#fff!important;border-color:#d97706!important}
      [data-theme="dark"] .btn-info{background:#0891B2!important;color:#fff!important;border-color:#0891B2!important}
      [data-theme="dark"] .btn-dark{background:#1E1A44!important;color:#fff!important;border-color:#2C2860!important}
      [data-theme="dark"] .btn-outline-primary,[data-theme="dark"] .btn-outline-light,[data-theme="dark"] .btn-outline-secondary,[data-theme="dark"] .btn-outline-dark{color:#EDECFF!important;border-color:#4F2FE8!important;background:transparent!important}
      [data-theme="dark"] .btn-outline-primary:hover,[data-theme="dark"] .btn-outline-light:hover,[data-theme="dark"] .btn-outline-secondary:hover,[data-theme="dark"] .btn-outline-dark:hover{background:#4F2FE8!important;color:#fff!important}
      [data-theme="dark"] .btn-link{color:#22D3EE!important}
      [data-theme="dark"] .btn-close{filter:invert(1) grayscale(100%) brightness(200%)}
      [data-theme="dark"] .btn-outline-custom{color:#EDECFF!important;border-color:#7C3AED!important;background:transparent!important}
      [data-theme="dark"] .btn-outline-custom:hover{background:#4F2FE8!important;color:#fff!important;border-color:#4F2FE8!important}
      [data-theme="dark"] .project-card a,[data-theme="dark"] .blog-card a,[data-theme="dark"] .view-project,[data-theme="dark"] a.text-primary{color:#22D3EE!important}
      [data-theme="dark"] .social-links a,[data-theme="dark"] .social-icon,[data-theme="dark"] .hero-social a{color:#EDECFF!important}
      [data-theme="dark"] .footer-social a i,[data-theme="dark"] .social-links a i{color:#fff!important}
      [dir="rtl"] .navbar-nav.ms-auto{margin-left:0!important;margin-right:auto!important}
      [dir="rtl"] .navbar-nav .ms-lg-2{margin-left:0!important;margin-right:.5rem!important}
      [dir="rtl"] .footer-social a{margin-right:0;margin-left:.5rem}
      [dir="rtl"] .text-md-end{text-align:left!important}
      [data-theme="dark"] .text-primary,[data-theme="dark"] .eyebrow{color:#8B7BF0!important}
      [data-theme="dark"] .hero-section{background:linear-gradient(180deg, #0A0A1F 0%, #12102E 60%, #0f0d24 100%);border-color:#2C2860!important}
      [data-theme="dark"] .hero-section::before{background:radial-gradient(circle, rgba(139,123,240,0.25) 0%, rgba(139,123,240,0) 70%)}
      [data-theme="dark"] .hero-section::after{background:radial-gradient(circle, rgba(34,211,238,0.15) 0%, rgba(34,211,238,0) 70%)}
      [data-theme="dark"] .hero-eyebrow{background:rgba(139,123,240,0.15);color:#8B7BF0}
      [data-theme="dark"] .hero-title{color:#EDECFF!important}
      [data-theme="dark"] .hero-section .lead{color:#9B98C7!important}
      [data-theme="dark"] .hero-section .badge-floating{background:#171433!important;border-color:#2C2860!important;color:#EDECFF!important}
      [data-theme="dark"] .hero-section .badge-floating .small{color:#9B98C7!important}
      /* Additional dark mode styles */
      [data-theme="dark"] .filter-pill{background:#171433!important;color:#9B98C7!important;border-color:#2C2860!important}
      [data-theme="dark"] .filter-pill:hover,[data-theme="dark"] .filter-pill.active{background:#4F2FE8!important;color:#fff!important;border-color:#4F2FE8!important}
      [data-theme="dark"] .share-btn{background:#2C2860!important;color:#EDECFF!important}
      [data-theme="dark"] .share-btn:hover{transform:translateY(-2px)}
      [data-theme="dark"] .contact-form-card,[data-theme="dark"] .contact-info-card{background:#171433!important;border-color:#2C2860!important}
      [data-theme="dark"] .contact-info-card h3,[data-theme="dark"] .contact-form-card h3{color:#EDECFF!important}
      [data-theme="dark"] .contact-info-card .contact-icon{background:#2C2860!important}
      [data-theme="dark"] .breadcrumb{background:#171433!important}
      [data-theme="dark"] .breadcrumb-item a{color:#9B98C7!important}
      [data-theme="dark"] .breadcrumb-item.active{color:#EDECFF!important}
      [data-theme="dark"] .pagination{--bs-pagination-bg:#171433;--bs-pagination-border-color:#2C2860;--bs-pagination-color:#EDECFF;--bs-pagination-hover-bg:#2C2860;--bs-pagination-hover-color:#EDECFF;--bs-pagination-disabled-bg:#171433;--bs-pagination-disabled-color:#6B6790}
      [data-theme="dark"] .modal-content{background:#171433!important;border-color:#2C2860!important}
      [data-theme="dark"] .modal-header,[data-theme="dark"] .modal-footer{border-color:#2C2860!important}
      [data-theme="dark"] .modal-title{color:#EDECFF!important}
      [data-theme="dark"] .testimonial-card{background:#171433!important}
      [data-theme="dark"] .testimonial-card .quote-icon{color:#4F2FE8!important}
      [data-theme="dark"] .pricing-card{background:#171433!important;border-color:#2C2860!important}
      [data-theme="dark"] .pricing-card.popular{background:#1a1a40!important;border-color:#4F2FE8!important}
      [data-theme="dark"] .faq-item{background:#171433!important;border-color:#2C2860!important}
      [data-theme="dark"] .faq-question{color:#EDECFF!important}
      [data-theme="dark"] .experience-timeline::before{background:#2C2860!important}
      [data-theme="dark"] .experience-card{background:#171433!important;border-color:#2C2860!important}
      [data-theme="dark"] .skill-bar{background:#2C2860!important}
      [data-theme="dark"] .section-eyebrow{color:#8B7BF0!important}
      [data-theme="dark"] .scroll-progress{background:#4F2FE8!important}
      [data-theme="dark"] .whatsapp-float{background:#25D366!important}
      [data-theme="dark"] .back-to-top{background:#4F2FE8!important;color:#fff!important}
      [data-theme="dark"] .google-map-placeholder{background:#12102E!important;border-color:#2C2860!important;color:#6B6790!important}
      [data-theme="dark"] .newsletter-popup,[data-theme="dark"] .cookie-consent{background:#171433!important;color:#EDECFF!important}
      [data-theme="dark"] .newsletter-popup .btn-outline-light,[data-theme="dark"] .cookie-consent .btn-outline-light{color:#EDECFF!important;border-color:#4F2FE8!important}
    </style>
    @stack('styles')
    
    {{-- JSON-LD Structured Data --}}
    @php
    $jsonLdScripts = [];
    
    // WebSite Schema
    $jsonLdScripts['website'] = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => $siteSetting->site_name ?? 'Portfolio CMS',
        'url' => url('/'),
    ];
    
    // Person Schema (if $about exists)
    if (isset($about)) {
        $personSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $about->name ?? 'Portfolio Owner',
            'url' => url('/'),
        ];
        if (!empty($about->designation)) {
            $personSchema['jobTitle'] = $about->designation;
        }
        if (!empty($about->short_bio)) {
            $personSchema['description'] = $about->short_bio;
        }
        if (!empty($about->photo_url)) {
            $personSchema['image'] = $about->photo_url;
        }
        $sameAs = [];
        if (!empty($about->facebook)) $sameAs[] = $about->facebook;
        if (!empty($about->twitter)) $sameAs[] = $about->twitter;
        if (!empty($about->linkedin)) $sameAs[] = $about->linkedin;
        if (!empty($about->github)) $sameAs[] = $about->github;
        if (!empty($sameAs)) {
            $personSchema['sameAs'] = $sameAs;
        }
        $jsonLdScripts['person'] = $personSchema;
    }
    @endphp
    
    @foreach($jsonLdScripts as $schema)
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endforeach

    {{-- Analytics Integration --}}
    @include('front.partials.analytics')
</head>
<body class="{{ (isset($page) && $page && $page->show_site_header === false) ? 'no-header' : 'has-header' }}">

    @if(!isset($page) || ($page && $page->show_site_header !== false))
        @include('front.partials.navbar')
    @endif

    <!-- Scroll Progress Bar -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <div class="main-content">
    <main>
        @yield('content')
    </main>
    </div>

    {{-- UI Components: Progress Bar, Back to Top, Cookie Consent --}}
    @include('front.partials.ui-components')

    @if(!isset($page) || ($page && $page->show_site_footer !== false))
        @include('front.partials.footer')
    @endif

{{-- Newsletter Popup Modal --}}
@if(!session('newsletter_popup_shown') && !session('newsletter_success'))
<div class="modal fade" id="newsletterModal" tabindex="-1" aria-labelledby="newsletterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="newsletterModalLabel">
                    <i class="fa-solid fa-envelope me-2 text-primary"></i>Subscribe to Newsletter
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="text-muted">Get notified about new projects and blog posts.</p>
                <form action="{{ route('subscribe.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter your email" required>
                    </div>
                    <button type="submit" class="btn btn-primary-custom w-100">Subscribe</button>
                </form>
                <p class="small text-muted mt-3 mb-0">No spam, unsubscribe anytime.</p>
            </div>
        </div>
    </div>
</div>
@endif

    {{-- Cookie Consent Banner --}}
    <div class="cookie-consent" id="cookieConsent">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <p class="mb-2 mb-md-0">We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies. <a href="{{ route('page.show', 'privacy-policy') }}">Learn more</a></p>
                </div>
                <div class="col-md-4 text-md-end">
                    <button class="btn btn-light btn-sm me-2" onclick="acceptCookies()">Accept All</button>
                    <button class="btn btn-outline-light btn-sm" onclick="declineCookies()">Decline</button>
                </div>
            </div>
        </div>
    </div>

    <!-- WhatsApp Floating Button -->
    @if($about->whatsapp ?? false)
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $about->whatsapp) }}" 
           target="_blank" 
           class="whatsapp-float" 
           title="Chat on WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    @endif

    <a href="#" class="back-to-top" aria-label="Back to top">
        <i class="fa-solid fa-arrow-up"></i>
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/js/front.js') }}"></script>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: @json(session('success')),
                    confirmButtonColor: '#2563EB',
                });
            });
        </script>
    @endif

    @stack('scripts')

{{-- Copy Link Function for Social Share --}}
<script>
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        if (window.Swal) {
            Swal.fire({
                icon: 'success',
                title: 'Link Copied!',
                text: 'The link has been copied to your clipboard.',
                confirmButtonColor: '#2563EB',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            alert('Link copied to clipboard!');
        }
    });
}

// Cookie Consent
function showCookieConsent() {
    if (!getCookie('cookie_consent')) {
        document.getElementById('cookieConsent').classList.add('show');
    }
}

function acceptCookies() {
    setCookie('cookie_consent', 'accepted', 365);
    document.getElementById('cookieConsent').classList.remove('show');
}

function declineCookies() {
    setCookie('cookie_consent', 'declined', 365);
    document.getElementById('cookieConsent').classList.remove('show');
}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Show cookie consent on page load
document.addEventListener('DOMContentLoaded', showCookieConsent);
</script>

<script>
  function pcToggleTheme(){
    var el=document.documentElement, dark=el.getAttribute('data-theme')==='dark';
    if(dark){el.removeAttribute('data-theme');try{localStorage.setItem('pc-theme','light')}catch(e){}}
    else{el.setAttribute('data-theme','dark');try{localStorage.setItem('pc-theme','dark')}catch(e){}}
    pcSyncThemeIcon();
  }
  function pcSyncThemeIcon(){
    var dark=document.documentElement.getAttribute('data-theme')==='dark';
    var s=document.getElementById('pcSun'), m=document.getElementById('pcMoon');
    if(s&&m){s.style.display=dark?'none':'inline';m.style.display=dark?'inline':'none';}
  }
  pcSyncThemeIcon();
  
  // Search
  document.addEventListener('DOMContentLoaded', function() {
    var searchBtn = document.getElementById('searchBtn');
    var searchBox = document.getElementById('searchBox');
    var searchIconWrap = document.querySelector('.search-icon-wrap');
    var searchInput = searchBox ? searchBox.querySelector('.search-input') : null;
    
    if (searchBtn && searchBox && searchIconWrap) {
      searchBtn.addEventListener('click', function(e) {
        e.preventDefault();
        searchIconWrap.classList.add('active');
        searchBox.classList.add('active');
        if (searchInput) {
          setTimeout(function() {
            searchInput.focus();
          }, 100);
        }
      });
    }
    
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && searchIconWrap && searchIconWrap.classList.contains('active')) {
        searchIconWrap.classList.remove('active');
        searchBox.classList.remove('active');
        if (searchInput) searchInput.value = '';
      }
    });
    
    // Close when clicking outside
    document.addEventListener('click', function(e) {
      if (searchIconWrap && searchIconWrap.classList.contains('active')) {
        if (!searchIconWrap.contains(e.target)) {
          searchIconWrap.classList.remove('active');
          searchBox.classList.remove('active');
          if (searchInput) searchInput.value = '';
        }
      }
    });
  });
</script>
<script>
// Live Search Enhancement
document.addEventListener('DOMContentLoaded', function() {
  var searchInput = document.getElementById('searchInput');
  var searchResults = document.getElementById('searchResults');
  var searchTimeout;

  if (searchInput && searchResults) {
    searchInput.addEventListener('input', function() {
      var query = this.value.trim();
      clearTimeout(searchTimeout);
      
      if (query.length < 2) {
        searchResults.innerHTML = '';
        searchResults.style.display = 'none';
        return;
      }
      
      searchTimeout = setTimeout(function() {
        searchResults.innerHTML = '<div class="search-loading"><i class="fa-solid fa-spinner fa-spin"></i> Searching...</div>';
        searchResults.style.display = 'block';
        
        fetch('/search?q=' + encodeURIComponent(query) + '&live=1', {
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
          if (data.total > 0) {
            var html = '<div class="search-results-list">';
            
            if (data.projects && data.projects.length > 0) {
              html += '<div class="search-section-title"><i class="fa-solid fa-folder-open me-2"></i>Projects</div>';
              data.projects.forEach(function(p) {
                html += '<a href="' + p.url + '" class="search-result-item"><span>' + p.title + '</span><small>' + (p.category || '') + '</small></a>';
              });
            }
            
            if (data.blogs && data.blogs.length > 0) {
              html += '<div class="search-section-title"><i class="fa-solid fa-newspaper me-2"></i>Blog Posts</div>';
              data.blogs.forEach(function(b) {
                html += '<a href="' + b.url + '" class="search-result-item"><span>' + b.title + '</span><small>' + (b.category || '') + '</small></a>';
              });
            }
            
            if (data.services && data.services.length > 0) {
              html += '<div class="search-section-title"><i class="fa-solid fa-briefcase me-2"></i>Services</div>';
              data.services.forEach(function(s) {
                html += '<a href="' + s.url + '" class="search-result-item"><span>' + s.title + '</span></a>';
              });
            }
            
            html += '<a href="/search?q=' + encodeURIComponent(query) + '" class="search-view-all">View all ' + data.total + ' results <i class="fa-solid fa-arrow-right ms-1"></i></a>';
            html += '</div>';
            searchResults.innerHTML = html;
          } else {
            searchResults.innerHTML = '<div class="search-no-results"><i class="fa-solid fa-search me-2"></i>No results found</div>';
          }
        })
        .catch(function() {
          searchResults.innerHTML = '';
          searchResults.style.display = 'none';
        });
      }, 300);
    });
    
    searchInput.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        searchResults.innerHTML = '';
        searchResults.style.display = 'none';
      }
    });
  }
});
</script>
<style>
.search-results { position: absolute; top: 100%; right: 0; width: 350px; max-height: 400px; overflow-y: auto; background: #fff; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); margin-top: 10px; z-index: 1000; display: none; }
.search-results-list { padding: 0.5rem; }
.search-section-title { font-size: 11px; font-weight: 600; text-transform: uppercase; color: #666; padding: 0.5rem; border-bottom: 1px solid #eee; }
.search-result-item { display: flex; justify-content: space-between; align-items: center; padding: 0.6rem 0.75rem; color: #333; text-decoration: none; border-radius: 8px; transition: background 0.2s; }
.search-result-item:hover { background: #f5f5f5; }
.search-result-item span { font-size: 13px; }
.search-result-item small { font-size: 11px; color: #999; }
.search-view-all { display: block; padding: 0.75rem; text-align: center; color: #4F2FE8; font-weight: 600; font-size: 13px; border-top: 1px solid #eee; text-decoration: none; }
.search-view-all:hover { background: #f8f5ff; }
.search-loading, .search-no-results { padding: 1.5rem; text-align: center; color: #666; font-size: 13px; }
[data-theme="dark"] .search-results { background: #1a1a2e; }
[data-theme="dark"] .search-result-item { color: #e0e0e0; }
[data-theme="dark"] .search-result-item:hover { background: #2a2a4e; }
[data-theme="dark"] .search-section-title { color: #aaa; border-bottom-color: #333; }
[data-theme="dark"] .search-view-all { border-top-color: #333; }
[data-theme="dark"] .search-view-all:hover { background: #2a2a4e; }
</style>
<script type="text/javascript">
  function googleTranslateElementInit(){
    new google.translate.TranslateElement({pageLanguage:'{{ \App\Models\Setting::getDefaultLanguage() }}',includedLanguages:'en,ar,bn,ur,hi,tl,af,sq,am,hy,az,eu,be,bs,ca,ceb,ny,zh-CN,zh-TW,co,hr,cs,da,nl,eo,et,fil,fi,fr,fy,gl,ka,de,el,gu,ht,ha,haw,iw,hmn,hu,is,ig,id,ga,it,ja,jw,kn,kk,km,rw,ko,ku,ky,lo,la,lv,lt,lb,mk,mg,ms,ml,mt,mi,mr,mn,my,ne,no,ps,fa,pl,pt,pa,ro,ru,sm,gd,sr,st,sn,sd,si,sk,sl,so,es,su,sw,sv,tg,ta,tt,te,th,tr,tk,uk,ug,uz,vi,cy,xh,yi,yo,zu',layout:google.translate.TranslateElement.InlineLayout.SIMPLE,autoDisplay:false},'google_translate_element');
  }
  function pickLang(lang){
    document.body.classList.remove('gt-open');
    var host = location.hostname;
    var val = '/en/' + lang;
    document.cookie = 'googtrans=' + val + ';path=/';
    document.cookie = 'googtrans=' + val + ';path=/;domain=' + host;
    document.cookie = 'googtrans=' + val + ';path=/;domain=.' + host;
    if(lang === 'en'){
      document.cookie = 'googtrans=;path=/;expires=Thu, 01 Jan 1970 00:00:00 GMT';
      document.cookie = 'googtrans=;path=/;domain=' + host + ';expires=Thu, 01 Jan 1970 00:00:00 GMT';
      document.cookie = 'googtrans=;path=/;domain=.' + host + ';expires=Thu, 01 Jan 1970 00:00:00 GMT';
    }
    location.reload();
  }
  // Close dropdown when clicking outside
  document.addEventListener('click', function(e) {
    var gtranslateWrap = document.querySelector('.gtranslate-wrap');
    if(gtranslateWrap && !gtranslateWrap.contains(e.target)) {
      document.body.classList.remove('gt-open');
    }
  });
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script>
// Apply language-specific fonts
(function() {
  function applyFonts() {
    var m = document.cookie.match(/googtrans=\/[^\/]+\/([a-z-]+)/);
    var lang = m ? m[1] : '';
    
    // Bengali
    if (lang === 'bn' || lang === 'bengali') {
      document.body.classList.add('TEWGTB-BANGLA');
      document.body.classList.remove('TEWGTB-ARABIC');
    }
    // Arabic and other RTL languages
    else if (lang === 'ar' || lang === 'ur' || lang === 'fa' || lang === 'he' || lang === 'ps' || lang === 'sd') {
      document.body.classList.add('TEWGTB-ARABIC');
      document.body.classList.remove('TEWGTB-BANGLA');
    }
    // English / others
    else {
      document.body.classList.remove('TEWGTB-BANGLA');
      document.body.classList.remove('TEWGTB-ARABIC');
    }
  }
  
  // Apply on page load
  applyFonts();
  
  // Watch for language changes
  setInterval(applyFonts, 500);
  
  // Also apply when translation happens
  var observer = new MutationObserver(applyFonts);
  observer.observe(document.body, { childList: true, subtree: true });

})();
</script>

{{-- Newsletter Popup Script --}}
@if(!session('newsletter_popup_shown') && !session('newsletter_success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check localStorage for newsletter popup state
        const getTodayString = function() {
            return new Date().toISOString().split('T')[0];
        };
        
        const today = getTodayString();
        const lastClosedDate = localStorage.getItem('newsletter_popup_closed_date');
        const isSubscribed = localStorage.getItem('newsletter_subscribed') === 'true';
        
        // Check if we should show the popup
        const shouldShow = !isSubscribed && lastClosedDate !== today;
        
        if (shouldShow) {
            setTimeout(function() {
                var popupElement = document.getElementById('newsletterModal');
                var popup = new bootstrap.Modal(popupElement);
                popup.show();
                
                // Track popup shown
                localStorage.setItem('newsletter_popup_shown_date', today);
                
                // Handle popup close (X button or backdrop click)
                popupElement.addEventListener('hidden.bs.modal', function() {
                    localStorage.setItem('newsletter_popup_closed_date', getTodayString());
                });
                
                // Handle form submission (subscribe)
                var form = popupElement.querySelector('form');
                if (form) {
                    form.addEventListener('submit', function() {
                        localStorage.setItem('newsletter_subscribed', 'true');
                    });
                }
            }, 5000);
        }
    });
</script>
@endif

@yield('scripts')

</body>
</html>
