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

    <title>@yield('title', ($siteSetting->site_name ?? 'Portfolio CMS'))</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
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
      .lang-menu{position:absolute;top:44px;right:0;z-index:1050;background:#fff;border:1px solid #e2e2e8;border-radius:12px;padding:6px;display:none;box-shadow:0 24px 60px -30px rgba(0,0,0,.3);max-height:360px;overflow:auto;min-width:170px}
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
      [data-theme="dark"] .bg-light-custom,[data-theme="dark"] .section-alt,[data-theme="dark"] .bg-light,[data-theme="dark"] .bg-body-tertiary{background:#12102E!important}
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
    </style>
    @stack('styles')
</head>
<body>

    @include('front.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('front.partials.footer')

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
</script>
<script type="text/javascript">
  function googleTranslateElementInit(){
    new google.translate.TranslateElement({pageLanguage:'en',includedLanguages:'en,ar,bn,ur,hi,tl',layout:google.translate.TranslateElement.InlineLayout.SIMPLE,autoDisplay:false},'google_translate_element');
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
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>
