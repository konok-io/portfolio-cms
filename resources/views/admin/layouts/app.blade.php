<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Admin — {{ $siteSetting->site_name ?? 'Portfolio CMS' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" id="bs-ltr">
    <script>
      (function(){try{
        var m=document.cookie.match(/googtrans=\/[^\/]+\/([a-z-]+)/);var l=m?m[1]:'';
        var rtl=['ar','ur','fa','he','ps','sd'];
        if(rtl.indexOf(l)>=0){var ltr=document.getElementById('bs-ltr');if(ltr) ltr.href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.rtl.min.css';}
      }catch(e){}})();
    </script>
    {{-- Font Awesome 6 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    {{-- DataTables with Bootstrap 5 styling --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    <script>
      // Apply saved theme before render (default: light).
      (function(){try{var t=localStorage.getItem('pc-theme')||'light';if(t==='dark')document.documentElement.setAttribute('data-theme','dark');}catch(e){}})();
      (function(){try{var m=document.cookie.match(/googtrans=\/[^\/]+\/([a-z-]+)/);var l=m?m[1]:'en';var rtl=['ar','ur','fa','he','ps','sd'];document.documentElement.setAttribute('dir',rtl.indexOf(l)>=0?'rtl':'ltr');}catch(e){}})();
    </script>
    <style>
      /* language switch + theme toggle */
      .gtranslate-wrap{position:relative}
      .gt-btn,.theme-toggle-btn{display:inline-flex;align-items:center;gap:7px;font-size:.9rem;font-weight:500;color:#333;background:#fff;border:1px solid #e2e2e8;border-radius:20px;padding:7px 14px;cursor:pointer;transition:border-color .18s,background .18s}
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
      /* dark theme */
      [data-theme="dark"] body,[data-theme="dark"] .admin-body,[data-theme="dark"] .admin-wrapper,[data-theme="dark"] .admin-main,[data-theme="dark"] .admin-content{background:#0A0A1F!important;color:#EDECFF}
      [data-theme="dark"] .admin-topbar,[data-theme="dark"] .admin-sidebar,[data-theme="dark"] .card,[data-theme="dark"] .admin-card,[data-theme="dark"] .stat-card,[data-theme="dark"] .dropdown-menu,[data-theme="dark"] .admin-page-header{background:#171433!important;color:#EDECFF!important;border-color:#2C2860!important}
      [data-theme="dark"] .gt-btn,[data-theme="dark"] .theme-toggle-btn{background:#171433;color:#EDECFF;border-color:#2C2860}
      [data-theme="dark"] .text-dark,[data-theme="dark"] .text-body,[data-theme="dark"] .stat-value,[data-theme="dark"] h1,[data-theme="dark"] h2,[data-theme="dark"] h3,[data-theme="dark"] h4,[data-theme="dark"] h5{color:#EDECFF!important}
      [data-theme="dark"] .text-muted,[data-theme="dark"] .stat-label,[data-theme="dark"] .admin-breadcrumb,[data-theme="dark"] .admin-breadcrumb a,[data-theme="dark"] small{color:#9B98C7!important}
      [data-theme="dark"] .table{color:#EDECFF!important;border-color:#2C2860;--bs-table-bg:#171433;--bs-table-color:#EDECFF;--bs-table-striped-bg:#1B1740;--bs-table-striped-color:#EDECFF;--bs-table-hover-bg:#1E1A44;--bs-table-hover-color:#EDECFF;--bs-table-border-color:#2C2860}
      [data-theme="dark"] .table thead th{background:#12102E!important;color:#EDECFF!important;border-color:#2C2860}
      [data-theme="dark"] .table tbody td,[data-theme="dark"] .table tbody th,[data-theme="dark"] .table tbody tr{background:#171433!important;color:#EDECFF!important;border-color:#2C2860}
      [data-theme="dark"] .table td,[data-theme="dark"] .table th{border-color:#2C2860}
      [data-theme="dark"] .table-hover tbody tr:hover td{background:#1E1A44!important;color:#EDECFF}
      [data-theme="dark"] .table-admin thead th{background:#12102E!important;color:#9B98C7!important;border-color:#2C2860!important}
      [data-theme="dark"] .table-admin td,[data-theme="dark"] .table-admin tr{background:#171433!important;color:#EDECFF!important;border-color:#2C2860!important}
      [data-theme="dark"] .card-header-custom,[data-theme="dark"] .card-body-custom{background:#171433!important;color:#EDECFF!important;border-color:#2C2860!important}
      [data-theme="dark"] .rounded-3.bg-light,[data-theme="dark"] .border.bg-light{background:#1E1A44!important;color:#EDECFF!important;border-color:#2C2860!important}
      [data-theme="dark"] .form-control,[data-theme="dark"] .form-select,[data-theme="dark"] textarea{background:#0A0A1F;color:#EDECFF;border-color:#2C2860}
      [data-theme="dark"] .form-control::placeholder{color:#6B6790}
      [data-theme="dark"] .dropdown-item{color:#EDECFF}
      [data-theme="dark"] .dropdown-item:hover{background:#1E1A44}
      [data-theme="dark"] .border,[data-theme="dark"] .border-top,[data-theme="dark"] .border-bottom,[data-theme="dark"] hr{border-color:#2C2860!important}
      [data-theme="dark"] .bg-light,[data-theme="dark"] .bg-white{background:#171433!important}
      [data-theme="dark"] .btn-light,[data-theme="dark"] .btn-outline-secondary{background:#1E1A44;color:#EDECFF;border-color:#2C2860}
      [data-theme="dark"] a:not(.btn):not(.nav-link){color:#22D3EE}
      [data-theme="dark"] .dataTables_wrapper{color:#EDECFF}
      [data-theme="dark"] table.dataTable,[data-theme="dark"] .dataTable tbody td,[data-theme="dark"] .dataTable thead th{background:#171433!important;color:#EDECFF!important;border-color:#2C2860!important}
      [data-theme="dark"] .dataTable tbody tr{background:#171433!important}
      [data-theme="dark"] .dataTables_wrapper .dataTables_length select,[data-theme="dark"] .dataTables_wrapper .dataTables_filter input{background:#0A0A1F;color:#EDECFF;border-color:#2C2860}
      [data-theme="dark"] .page-link{background:#171433;color:#EDECFF;border-color:#2C2860}
      [data-theme="dark"] .page-item.disabled .page-link{background:#12102E;color:#6B6790}
      [data-theme="dark"] .ProseMirror,[data-theme="dark"] .ql-editor,[data-theme="dark"] .editor-content,[data-theme="dark"] [contenteditable]{background:#0A0A1F!important;color:#EDECFF!important}
      [data-theme="dark"] .ql-toolbar,[data-theme="dark"] .editor-toolbar,[data-theme="dark"] .tox-toolbar{background:#171433!important;border-color:#2C2860!important}
      [data-theme="dark"] .editor-toolbar button,[data-theme="dark"] .ql-toolbar button,[data-theme="dark"] .ql-toolbar .ql-stroke{color:#EDECFF!important;stroke:#EDECFF!important}
      [data-theme="dark"] .modal-content,[data-theme="dark"] .offcanvas,[data-theme="dark"] .list-group-item,[data-theme="dark"] .input-group-text,[data-theme="dark"] .accordion-button,[data-theme="dark"] .accordion-body{background:#171433!important;color:#EDECFF!important;border-color:#2C2860!important}
      [data-theme="dark"] .nav-tabs .nav-link{color:#9B98C7}
      [data-theme="dark"] .nav-tabs .nav-link.active{background:#171433;color:#EDECFF;border-color:#2C2860}
      [data-theme="dark"] .badge.bg-light{background:#1E1A44!important;color:#EDECFF!important}
      [data-theme="dark"] .btn-primary{background:#4F2FE8!important;color:#fff!important;border-color:#4F2FE8!important}
      [data-theme="dark"] .btn-primary:hover{background:#7C3AED!important;color:#fff!important}
      [data-theme="dark"] .btn-secondary{background:#3A356E!important;color:#fff!important;border-color:#3A356E!important}
      [data-theme="dark"] .btn-success{background:#16a34a!important;color:#fff!important;border-color:#16a34a!important}
      [data-theme="dark"] .btn-danger{background:#dc2626!important;color:#fff!important;border-color:#dc2626!important}
      [data-theme="dark"] .btn-warning{background:#d97706!important;color:#fff!important;border-color:#d97706!important}
      [data-theme="dark"] .btn-info{background:#0891B2!important;color:#fff!important;border-color:#0891B2!important}
      [data-theme="dark"] .btn-light{background:#1E1A44!important;color:#EDECFF!important;border-color:#2C2860!important}
      [data-theme="dark"] .btn-dark{background:#1E1A44!important;color:#fff!important;border-color:#2C2860!important}
      [data-theme="dark"] .btn-outline-primary,[data-theme="dark"] .btn-outline-secondary,[data-theme="dark"] .btn-outline-light,[data-theme="dark"] .btn-outline-dark{color:#EDECFF!important;border-color:#4F2FE8!important;background:transparent!important}
      [data-theme="dark"] .btn-outline-primary:hover,[data-theme="dark"] .btn-outline-secondary:hover,[data-theme="dark"] .btn-outline-light:hover,[data-theme="dark"] .btn-outline-dark:hover{background:#4F2FE8!important;color:#fff!important}
      [data-theme="dark"] .btn-outline-danger{color:#f87171!important;border-color:#dc2626!important}
      [data-theme="dark"] .btn-outline-danger:hover{background:#dc2626!important;color:#fff!important}
      [data-theme="dark"] .btn-link{color:#22D3EE!important}
      [data-theme="dark"] .btn-close{filter:invert(1) grayscale(100%) brightness(200%)}
      [data-theme="dark"] .admin-sidebar .nav-link{color:#9B98C7}
      [data-theme="dark"] .admin-sidebar .nav-link:hover,[data-theme="dark"] .admin-sidebar .nav-link.active{color:#fff;background:linear-gradient(135deg,#4F2FE8,#7C3AED)}
    </style>
    @stack('styles')
</head>
<body class="admin-body"
      data-flash-success="{{ session('success') }}"
      data-flash-error="{{ session('error') }}">

<div class="admin-wrapper">

    {{-- ============ SIDEBAR ============ --}}
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <i class="fa-solid fa-circle-nodes"></i>
            <span>{{ $siteSetting->site_name ?? 'Portfolio CMS' }}</span>
        </div>

        <nav class="nav flex-column pb-4">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>

            <div class="nav-section-title">Content</div>
            <a href="{{ route('admin.about.edit') }}" class="nav-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i> About Me
            </a>
            <a href="{{ route('admin.skills.index') }}" class="nav-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-simple"></i> Skills
            </a>
            <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="fa-solid fa-briefcase"></i> Services
            </a>
            <a href="{{ route('admin.experience.index') }}" class="nav-link {{ request()->routeIs('admin.experience.*') ? 'active' : '' }}">
                <i class="fa-solid fa-building"></i> Experience
            </a>
            <a href="{{ route('admin.education.index') }}" class="nav-link {{ request()->routeIs('admin.education.*') ? 'active' : '' }}">
                <i class="fa-solid fa-graduation-cap"></i> Education
            </a>
            <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <i class="fa-solid fa-diagram-project"></i> Projects
            </a>
            <a href="{{ route('admin.blog.index') }}" class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                <i class="fa-solid fa-newspaper"></i> Blog Posts
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <i class="fa-solid fa-quote-left"></i> Testimonials
            </a>

            <div class="nav-section-title">Communication</div>
            @php($unread = \Illuminate\Support\Facades\Schema::hasTable('contact_messages') ? \App\Models\ContactMessage::unread()->count() : 0)
            <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                <i class="fa-solid fa-envelope"></i> Messages
                @if($unread > 0)
                    <span class="badge bg-danger ms-auto">{{ $unread }}</span>
                @endif
            </a>

            <div class="nav-section-title">Administration</div>
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Users
            </a>
            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-shield"></i> Roles &amp; Permissions
            </a>
            <a href="{{ route('admin.settings.edit') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="fa-solid fa-gear"></i> Site Settings
            </a>
            <a href="{{ route('admin.seo.edit') }}" class="nav-link {{ request()->routeIs('admin.seo.*') ? 'active' : '' }}">
                <i class="fa-solid fa-magnifying-glass-chart"></i> SEO Settings
            </a>
            <a href="{{ route('admin.license.index') }}" class="nav-link {{ request()->routeIs('admin.license.*') ? 'active' : '' }}">
                <i class="fa-solid fa-certificate"></i> License
            </a>

            <div class="nav-section-title">Account</div>
            <a href="{{ route('admin.profile.edit') }}" class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <i class="fa-solid fa-id-badge"></i> My Profile
            </a>
            <a href="{{ route('home') }}" target="_blank" class="nav-link">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> View Website
            </a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    {{-- ============ MAIN CONTENT ============ --}}
    <div class="admin-content">
        <header class="admin-topbar">
            <button class="sidebar-toggle-btn" aria-label="Toggle sidebar">
                <i class="fa-solid fa-bars"></i>
            </button>

            <div class="ms-auto d-flex align-items-center gap-3">
                {{-- Language: Google Translate --}}
                <div class="gtranslate-wrap">
                    <button type="button" class="gt-btn" onclick="document.body.classList.toggle('gt-open')">
                        <i class="fa-solid fa-language"></i>
                        <span class="d-none d-md-inline">Language</span>
                        <i class="fa-solid fa-chevron-down" style="font-size:.7em"></i>
                    </button>
                    <div id="google_translate_element" style="display:none"></div>
                    <div class="lang-menu">
                        <button type="button" onclick="pickLang('en')">English</button>
                        <button type="button" onclick="pickLang('ar')">العربية</button>
                        <button type="button" onclick="pickLang('bn')">বাংলা</button>
                        <button type="button" onclick="pickLang('ur')">اردو</button>
                        <button type="button" onclick="pickLang('hi')">हिन्दी</button>
                        <button type="button" onclick="pickLang('tl')">Filipino</button>
                    </div>
                </div>

                {{-- Light / dark toggle --}}
                <button type="button" class="theme-toggle-btn" onclick="pcToggleTheme()" aria-label="Toggle theme" title="Toggle light/dark">
                    <i class="fa-solid fa-sun" id="pcSun"></i>
                    <i class="fa-solid fa-moon" id="pcMoon" style="display:none"></i>
                </button>

                <a href="{{ route('admin.messages.index') }}" class="text-dark position-relative">
                    <i class="fa-solid fa-bell fs-5"></i>
                    @if($unread > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.6rem;">{{ $unread }}</span>
                    @endif
                </a>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center gap-2 text-decoration-none text-dark dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="{{ auth()->user()->avatar_url }}" width="36" height="36" class="rounded-circle object-fit-cover" alt="Avatar">
                        <span class="d-none d-md-inline small fw-semibold">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i class="fa-solid fa-id-badge me-2"></i>My Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <main class="admin-main">
            @yield('content')
        </main>
    </div>
</div>

{{-- Scripts --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script src="{{ asset('assets/js/admin.js') }}"></script>
<script>
    // Laravel File Manager popup helper
    function openFileManager(inputId, previewId) {
        window.addEventListener('message', function handler(e) {
            if (typeof e.data === 'string' && e.data.startsWith('http')) {
                var input = document.getElementById(inputId);
                if (input) input.value = e.data;
                var preview = previewId ? document.getElementById(previewId) : null;
                if (preview) preview.src = e.data;
                window.removeEventListener('message', handler);
            }
        });
        window.open('{{ url('laravel-filemanager') }}?type=Images', 'FileManager', 'width=900,height=600');
    }
</script>

@stack('scripts')

{{-- Light / dark toggle --}}
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

{{-- Google Translate --}}
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
