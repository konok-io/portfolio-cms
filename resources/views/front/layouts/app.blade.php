<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" @if(in_array(app()->getLocale(), ['ar', 'ur', 'he'])) dir="rtl" @endif>
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
    
    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ $seoMeta->canonical_url ?? url()->current() }}">
    
    {{-- Open Graph Tags --}}
    <meta property="og:title" content="@yield('og_title', ($seoMeta->og_title ?? $siteSetting->site_name ?? 'Portfolio CMS'))">
    <meta property="og:description" content="@yield('meta_description', ($seoMeta->og_description ?? $seoMeta->meta_description ?? ''))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="{{ $seoMeta->og_type ?? 'website' }}">
    <meta property="og:site_name" content="{{ $seoMeta->og_site_name ?? $siteSetting->site_name ?? 'Portfolio CMS' }}">
    <meta property="og:locale" content="{{ $seoMeta->og_locale ?? 'en_US' }}">
    @if($seoMeta && $seoMeta->og_image)
        <meta property="og:image" content="{{ asset('storage/' . $seoMeta->og_image) }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:image:alt" content="{{ $seoMeta->og_title ?? $siteSetting->site_name ?? 'Portfolio CMS' }}">
    @endif
    
    {{-- Twitter Card Tags --}}
    <meta name="twitter:card" content="{{ $seoMeta->twitter_card_type ?? 'summary_large_image' }}">
    @if($seoMeta && $seoMeta->twitter_site)
        <meta name="twitter:site" content="{{ $seoMeta->twitter_site }}">
    @endif
    @if($seoMeta && $seoMeta->twitter_creator)
        <meta name="twitter:creator" content="{{ $seoMeta->twitter_creator }}">
    @endif
    <meta name="twitter:title" content="@yield('twitter_title', ($seoMeta->twitter_title ?? $seoMeta->og_title ?? $siteSetting->site_name ?? 'Portfolio CMS'))">
    <meta name="twitter:description" content="@yield('meta_description', ($seoMeta->twitter_description ?? $seoMeta->meta_description ?? ''))">
    @if($seoMeta && $seoMeta->twitter_image)
        <meta name="twitter:image" content="{{ asset('storage/' . $seoMeta->twitter_image) }}">
    @elseif($seoMeta && $seoMeta->og_image)
        <meta name="twitter:image" content="{{ asset('storage/' . $seoMeta->og_image) }}">
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

    {{-- Dark Mode: FOUC Prevention with localStorage + Cookie fallback --}}
    <script>
    (function(){
      try {
        // Try localStorage first
        var theme = localStorage.getItem('pc-theme');
        
        // Fallback to cookie if localStorage not available
        if (!theme) {
          var cookieMatch = document.cookie.match(/pc-theme=([^;]+)/);
          theme = cookieMatch ? cookieMatch[1] : null;
        }
        
        // Fallback to system preference
        if (!theme) {
          theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }
        
        if (theme === 'dark') {
          document.documentElement.setAttribute('data-theme', 'dark');
        }
      } catch(e) {}
    })();
    </script>
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
      [data-theme="dark"] body{background:#0A0A1F!important;color:#E8E6F2}
      [data-theme="dark"] .site-navbar{background:#12102E!important}
      [data-theme="dark"] section,[data-theme="dark"] .section,[data-theme="dark"] .bg-white,[data-theme="dark"] .bg-body{background:#0A0A1F!important}
      [data-theme="dark"] .bg-light-custom,[data-theme="dark"] .bg-light,[data-theme="dark"] .bg-body-tertiary{background:#171433!important}
      [data-theme="dark"] .section-alt{background:#1a1a40!important}
      [data-theme="dark"] .section-tint{background:#1e1b38!important}
      [data-theme="dark"] .section-accent-tint{background:#1c1a00!important}
      [data-theme="dark"] .section-dark-tint{background:#222055!important}
      [data-theme="dark"] .card,[data-theme="dark"] .experience-card,[data-theme="dark"] .skill-card,[data-theme="dark"] .service-card,[data-theme="dark"] .project-card,[data-theme="dark"] .blog-card,[data-theme="dark"] .testimonial-card{background:#171433!important;color:#E8E6F2!important;border-color:#3D3A70!important}
      [data-theme="dark"] h1,[data-theme="dark"] h2,[data-theme="dark"] h3,[data-theme="dark"] h4,[data-theme="dark"] h5,[data-theme="dark"] h6,[data-theme="dark"] p,[data-theme="dark"] li,[data-theme="dark"] span,[data-theme="dark"] .nav-link,[data-theme="dark"] .navbar-brand{color:#E8E6F2!important}
      [data-theme="dark"] .text-muted,[data-theme="dark"] .text-secondary,[data-theme="dark"] small{color:#A8A4C8!important}
      [data-theme="dark"] .text-dark{color:#E8E6F2!important}
      [data-theme="dark"] .border,[data-theme="dark"] .border-top,[data-theme="dark"] .border-bottom,[data-theme="dark"] hr{border-color:#3D3A70!important}
      [data-theme="dark"] a:not(.btn){color:#67E8F9}
      [data-theme="dark"] a:not(.btn):hover{color:#A5F3FC}
      [data-theme="dark"] .form-control,[data-theme="dark"] .form-select,[data-theme="dark"] textarea{background:#171433;color:#E8E6F2;border-color:#3D3A70}
      [data-theme="dark"] .form-control:focus{background:#1E1B44;border-color:#4F2FE8;box-shadow:0 0 0 3px rgba(79,47,232,0.3)}
      [data-theme="dark"] .form-control::placeholder{color:#7B7890}
      [data-theme="dark"] footer{background:#12102E!important}
      [data-theme="dark"] .footer-social a{background:#4F2FE8!important;color:#fff!important;border-color:#4F2FE8!important}
      [data-theme="dark"] .footer-social a i{color:#fff!important}
      [data-theme="dark"] .footer-social a:hover{background:#fff!important;border-color:#fff!important}
      [data-theme="dark"] .footer-social a:hover i{color:#4F2FE8!important}
      [data-theme="dark"] footer .form-control{background:#0A0A1F!important;color:#E8E6F2!important;border-color:#3D3A70!important}
      [data-theme="dark"] footer .form-control::placeholder{color:#7B7890!important}
      [data-theme="dark"] .btn-primary-custom{background:#4F2FE8!important;color:#fff!important;border-color:#4F2FE8}
      [data-theme="dark"] .btn-primary-custom:hover{background:#6D5AE8!important;color:#fff!important}
      [data-theme="dark"] .btn-outline-primary,[data-theme="dark"] .btn-outline-secondary,[data-theme="dark"] .btn-outline-light{color:#E8E6F2!important;border-color:#4F2FE8!important}
      [data-theme="dark"] .btn-outline-primary:hover,[data-theme="dark"] .btn-outline-secondary:hover{background:#4F2FE8!important;color:#fff!important}
      [data-theme="dark"] .btn-light{background:#2A2755!important;color:#E8E6F2!important;border-color:#3D3A70!important}
      [data-theme="dark"] .btn-primary,[data-theme="dark"] .btn-primary-custom{background:#4F2FE8!important;color:#fff!important;border-color:#4F2FE8!important}
      [data-theme="dark"] .btn-primary:hover,[data-theme="dark"] .btn-primary-custom:hover{background:#6D5AE8!important;color:#fff!important;border-color:#6D5AE8!important}
      [data-theme="dark"] .btn-secondary{background:#3A356E!important;color:#fff!important;border-color:#3A356E!important}
      [data-theme="dark"] .btn-success{background:#16a34a!important;color:#fff!important;border-color:#16a34a!important}
      [data-theme="dark"] .btn-danger{background:#dc2626!important;color:#fff!important;border-color:#dc2626!important}
      [data-theme="dark"] .btn-warning{background:#d97706!important;color:#fff!important;border-color:#d97706!important}
      [data-theme="dark"] .btn-info{background:#0891B2!important;color:#fff!important;border-color:#0891B2!important}
      [data-theme="dark"] .btn-dark{background:#2A2755!important;color:#fff!important;border-color:#3D3A70!important}
      [data-theme="dark"] .btn-outline-primary,[data-theme="dark"] .btn-outline-light,[data-theme="dark"] .btn-outline-secondary,[data-theme="dark"] .btn-outline-dark{color:#E8E6F2!important;border-color:#4F2FE8!important;background:transparent!important}
      [data-theme="dark"] .btn-outline-primary:hover,[data-theme="dark"] .btn-outline-light:hover,[data-theme="dark"] .btn-outline-secondary:hover,[data-theme="dark"] .btn-outline-dark:hover{background:#4F2FE8!important;color:#fff!important}
      [data-theme="dark"] .btn-link{color:#67E8F9!important}
      [data-theme="dark"] .btn-link:hover{color:#A5F3FC}
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
      [data-theme="dark"] .text-primary,[data-theme="dark"] .eyebrow{color:#A5B4FC!important}
      [data-theme="dark"] .hero-section{background:linear-gradient(180deg, #0A0A1F 0%, #12102E 60%, #0f0d24 100%);border-color:#3D3A70!important}
      [data-theme="dark"] .hero-section::before{background:radial-gradient(circle, rgba(165,180,252,0.25) 0%, rgba(165,180,252,0) 70%)}
      [data-theme="dark"] .hero-section::after{background:radial-gradient(circle, rgba(34,211,238,0.15) 0%, rgba(34,211,238,0) 70%)}
      [data-theme="dark"] .hero-eyebrow{background:rgba(165,180,252,0.15);color:#A5B4FC}
      [data-theme="dark"] .hero-title{color:#E8E6F2!important}
      [data-theme="dark"] .hero-section .lead{color:#A8A4C8!important}
      [data-theme="dark"] .hero-section .badge-floating{background:#171433!important;border-color:#3D3A70!important;color:#E8E6F2!important}
      [data-theme="dark"] .hero-section .badge-floating .small{color:#A8A4C8!important}
      
      /* Accessibility: High contrast focus outlines */
      :focus-visible {
        outline: 3px solid #2563EB;
        outline-offset: 2px;
      }
      [data-theme="dark"] :focus-visible {
        outline-color: #67E8F9;
      }
    </style>
    @stack('styles')
    
    {{-- JSON-LD Structured Data --}}
    @php
        $schemas = [];
        
        // Organization Schema
        if ($seoMeta && $seoMeta->organization_name) {
            $schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'Organization',
                'name' => $seoMeta->organization_name,
                'url' => url('/'),
                'logo' => $siteSetting->logo_url ? asset('storage/' . $siteSetting->logo_url) : null,
                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'telephone' => $seoMeta->organization_phone ?? $siteSetting->phone ?? null,
                    'email' => $seoMeta->organization_email ?? $siteSetting->email ?? null,
                    'address' => $seoMeta->organization_address ?? $siteSetting->address ?? null,
                ],
                'sameAs' => array_filter([
                    $siteSetting->facebook ?? null,
                    $siteSetting->twitter ?? null,
                    $siteSetting->linkedin ?? null,
                    $siteSetting->instagram ?? null,
                    $siteSetting->github ?? null,
                    $siteSetting->youtube ?? null,
                ]),
            ];
        }
        
        // WebSite Schema
        $schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $siteSetting->site_name ?? 'Portfolio',
            'url' => url('/'),
            'description' => $seoMeta->meta_description ?? null,
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => url('/search?q={search_term_string}'),
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];
        
        // Person Schema (if about section exists)
        if (isset($about) && $about) {
            $schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'Person',
                'name' => $about->name ?? null,
                'url' => url('/'),
                'image' => $about->photo_url ?? null,
                'jobTitle' => $about->title ?? null,
                'description' => $about->short_intro ?? $about->description ?? null,
                'email' => $siteSetting->email ?? null,
                'telephone' => $siteSetting->phone ?? null,
                'address' => $siteSetting->address ?? null,
                'sameAs' => array_filter([
                    $siteSetting->facebook ?? null,
                    $siteSetting->twitter ?? null,
                    $siteSetting->linkedin ?? null,
                    $siteSetting->github ?? null,
                    $siteSetting->instagram ?? null,
                ]),
            ];
        }
    @endphp
    
    @foreach($schemas as $schema)
        <script type="application/ld+json">
            {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>
    @endforeach
</head>
<body>
    <!-- Skip to main content link for keyboard users -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    @include('front.partials.navbar')

    <!-- Scroll Progress Bar -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <div class="main-content">
    <main id="main-content">
        @yield('content')
    </main>
    </div>

    @include('front.partials.footer')

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
           title="Chat on WhatsApp"
           aria-label="Chat on WhatsApp">
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
    var newTheme = dark ? 'light' : 'dark';
    
    if(dark){el.removeAttribute('data-theme');}
    else{el.setAttribute('data-theme','dark');}
    
    // Save to localStorage
    try{localStorage.setItem('pc-theme', newTheme);}catch(e){}
    
    // Also set cookie for cross-page persistence (expires in 1 year)
    try{
      var d = new Date();
      d.setTime(d.getTime() + (365*24*60*60*1000));
      document.cookie = 'pc-theme=' + newTheme + ';expires=' + d.toUTCString() + ';path=/;SameSite=Lax';
    }catch(e){}
    
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
<script type="text/javascript">
  function googleTranslateElementInit(){
    new google.translate.TranslateElement({pageLanguage:'{{ \App\Models\Setting::getDefaultLanguage() }}',includedLanguages:'en,ar,bn,ur,hi,tl,af,sq,am,hy,az,eu,be,bs,ca,ceb,ny,zh-CN,zh-TW,co,hr,cs,da,nl,eo,et,fil,fi,fr,fy,gl,ka,de,el,gu,ht,ha,haw,iw,hmn,hu,is,ig,id,ga,it,ja,jw,kn,kk,km,rw,ko,ku,ky,lo,la,lv,lt,lb,mk,mg,ms,ml,mt,mi,mr,mn,my,ne,no,ps,fa,pl,pt,pa,ro,ru,sm,gd,sr,st,sn,sd,si,sk,sl,so,es,su,sw,sv,tg,ta,tt,te,th,tr,tk,uk,ug,uz,vi,cy,xh,yi,yo,zu',layout:google.translate.TranslateElement.InlineLayout.SIMPLE,autoDisplay:false},'google_translate_element');
  }
  function pickLang(lang){
    document.body.classList.remove('gt-open');
    // Store in localStorage for persistence
    localStorage.setItem('portfolio_locale', lang);
    // Also set cookie for server-side
    document.cookie = 'locale=' + lang + ';path=/;max-age=' + (60*60*24*365);
    // Reload to apply new language
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

</body>
</html>
