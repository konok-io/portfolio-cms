<nav class="navbar navbar-expand-lg sticky-top site-navbar">
    <div class="container">
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
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a></li>
                <li class="nav-item d-flex align-items-center gap-2 ms-lg-2">
                    <div class="gtranslate-wrap">
                        <button type="button" class="gt-btn" onclick="document.body.classList.toggle('gt-open')">
                            <i class="fa-solid fa-language"></i><span>Language</span>
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
                    <a class="btn btn-primary-custom ms-lg-2 mt-2 mt-lg-0" href="{{ route('home') }}#contact">Get in Touch</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
