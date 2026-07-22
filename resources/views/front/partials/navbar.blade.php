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
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('resume') ? 'active' : '' }}" href="{{ route('resume') }}">Resume</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('pricing') ? 'active' : '' }}" href="{{ route('pricing') }}">Pricing</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}" href="{{ route('faq') }}">FAQ</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a></li>
                
                {{-- Search Dropdown --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-search me-1"></i> Search
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end search-dropdown p-3" aria-labelledby="searchDropdown">
                        <li>
                            <form action="{{ route('search') }}" method="GET" class="search-form-inline">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" placeholder="Search..." required>
                                    <button type="submit" class="btn btn-primary-custom">
                                        <i class="fa-solid fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </li>
                        <li class="mt-2"><hr class="dropdown-divider"></li>
                        <li class="quick-links-label">Quick Links</li>
                        <li><a class="dropdown-item" href="{{ route('projects.index') }}"><i class="fa-solid fa-folder-open me-2"></i>Projects</a></li>
                        <li><a class="dropdown-item" href="{{ route('blog.index') }}"><i class="fa-solid fa-newspaper me-2"></i>Blog</a></li>
                        <li><a class="dropdown-item" href="{{ route('services') }}"><i class="fa-solid fa-briefcase me-2"></i>Services</a></li>
                        <li><a class="dropdown-item" href="{{ route('resume') }}"><i class="fa-solid fa-file-alt me-2"></i>Resume</a></li>
                    </ul>
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
