<nav class="navbar navbar-expand-lg site-navbar">
    <div class="container">
        @php($headerDisplay = $siteSetting->header_display ?? 'text')
        @php($headerPages = \App\Models\CustomPage::getHeaderPages())
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
                @forelse($menuItems ?? [] as $menuItem)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs($menuItem->route) ? 'active' : '' }}" 
                           href="{{ $menuItem->link }}" 
                           target="{{ $menuItem->target }}">
                            @if($menuItem->icon)<i class="{{ $menuItem->icon }} me-1"></i>@endif
                            {{ $menuItem->title }}
                        </a>
                    </li>
                @empty
                    {{-- Fallback static menu if no menu items exist --}}
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a></li>
                @endforelse
                
                @foreach($headerPages as $headerPage)
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('page.show') && request()->slug === $headerPage->slug ? 'active' : '' }}" href="{{ route('page.show', $headerPage->slug) }}">{{ $headerPage->title }}</a></li>
                @endforeach

                @guest
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('user.login') ? 'active' : '' }}" href="{{ route('user.login') }}">Login</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('user.dashboard') }}"><i class="fa-solid fa-tachometer-alt me-2"></i>Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fa-solid fa-user me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('user.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fa-solid fa-sign-out-alt me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest

                <li class="nav-item d-flex align-items-center gap-2">
                    <div class="search-wrapper" id="searchWrapper">
                        <div class="search-icon-wrap">
                            <a href="#" class="search-btn" id="searchBtn" aria-label="Search">
                                <i class="fa-solid fa-search"></i>
                            </a>
                            <div class="search-box" id="searchBox">
                                <form action="{{ route('search') }}" method="GET" id="searchForm">
                                    <i class="fa-solid fa-search search-icon"></i>
                                    <input type="text" name="q" class="search-input" id="searchInput" placeholder="Search..." autocomplete="off">
                                    <button type="submit" class="search-submit" id="searchSubmit">
                                        <i class="fa-solid fa-search"></i>
                                    </button>
                                </form>
                                <div class="search-results" id="searchResults"></div>
                            </div>
                        </div>
                    </div>
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
