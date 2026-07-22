<nav class="navbar navbar-expand-lg sticky-top site-navbar" id="mainNavbar">
    <div class="container position-relative">
        @php($headerDisplay = $siteSetting->header_display ?? 'text')
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            @if(($headerDisplay === 'logo' || $headerDisplay === 'both') && ($siteSetting->logo_url ?? false))
                <img src="{{ $siteSetting->logo_url }}" alt="{{ $siteSetting->site_name }}" height="36">
            @endif
            @if($headerDisplay === 'text' || $headerDisplay === 'both' || !($siteSetting->logo_url ?? false))
                <span>{{ $siteSetting->site_name ?? 'Portfolio' }}</span>
            @endif
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}#home">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('resume') ? 'active' : '' }}" href="{{ route('resume') }}">Resume</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('pricing') ? 'active' : '' }}" href="{{ route('pricing') }}">Pricing</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}" href="{{ route('faq') }}">FAQ</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a></li>
                <li class="nav-item">
                    <a class="nav-link search-toggle-btn" href="#" onclick="toggleSearch(); return false;">
                        <i class="fa-solid fa-search search-icon"></i>
                        <i class="fa-solid fa-times close-icon" style="display:none;"></i>
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center gap-2 ms-lg-2">
                    <div class="gtranslate-wrap">
                        <button type="button" class="gt-btn" onclick="document.body.classList.toggle('gt-open')">
                            <i class="fa-solid fa-language"></i><i class="fa-solid fa-chevron-down" style="font-size:.7em"></i>
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
                    <button type="button" class="theme-toggle-btn" onclick="pcToggleTheme()" aria-label="Toggle theme">
                        <i class="fa-solid fa-sun" id="pcSun"></i>
                        <i class="fa-solid fa-moon" id="pcMoon" style="display:none"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary-custom ms-lg-2 mt-2 mt-lg-0" href="{{ route('contact') }}">Get in Touch</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{-- Expandable Search Bar (Jago News Style) --}}
<div class="search-expand-wrapper" id="searchExpandWrapper">
    <div class="search-expand-overlay" id="searchExpandOverlay" onclick="toggleSearch()"></div>
    <div class="search-expand-container" id="searchExpandContainer">
        <div class="search-expand-header">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="search-brand">
                        <i class="fa-solid fa-search me-2"></i>Search
                    </div>
                    <button type="button" class="search-expand-close" onclick="toggleSearch()">
                        <i class="fa-solid fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="search-expand-body">
            <div class="container">
                <form action="{{ route('search') }}" method="GET" class="search-expand-form">
                    <div class="search-expand-input-wrap">
                        <input type="text" name="q" class="search-expand-input" placeholder="Search projects, blogs, services..." autocomplete="off">
                        <button type="submit" class="search-expand-submit">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                    <div class="search-expand-suggestions">
                        <span class="search-suggestion-label">Quick:</span>
                        <a href="{{ route('projects.index') }}" class="search-suggestion-link">Projects</a>
                        <a href="{{ route('blog.index') }}" class="search-suggestion-link">Blog</a>
                        <a href="{{ route('services') }}" class="search-suggestion-link">Services</a>
                        <a href="{{ route('resume') }}" class="search-suggestion-link">Resume</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
