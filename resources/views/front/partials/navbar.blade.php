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
                @forelse($menuItems as $menuItem)
                    @if($menuItem->children && $menuItem->children->count() > 0)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs($menuItem->route) ? 'active' : '' }}" 
                               href="{{ $menuItem->link }}" 
                               target="{{ $menuItem->target }}"
                               role="button" 
                               data-bs-toggle="dropdown" 
                               aria-expanded="false"
                               aria-haspopup="true">
                                @if($menuItem->icon)<i class="{{ $menuItem->icon }} me-1"></i>@endif
                                {{ $menuItem->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown-{{ $menuItem->id }}">
                                <li>
                                    <a class="dropdown-item" href="{{ $menuItem->link }}" target="{{ $menuItem->target }}">
                                        @if($menuItem->icon)<i class="{{ $menuItem->icon }} me-2"></i>@endif
                                        {{ $menuItem->name }}
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                @foreach($menuItem->children as $child)
                                    <li>
                                        <a class="dropdown-item" href="{{ $child->link }}" target="{{ $child->target }}">
                                            @if($child->icon)<i class="{{ $child->icon }} me-2"></i>@endif
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs($menuItem->route) ? 'active' : '' }}" 
                               href="{{ $menuItem->link }}" 
                               target="{{ $menuItem->target }}">
                                @if($menuItem->icon)<i class="{{ $menuItem->icon }} me-1"></i>@endif
                                {{ $menuItem->name }}
                            </a>
                        </li>
                    @endif
                @empty
                    {{-- Fallback if no menu items --}}
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">Portfolio</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">Blog</a></li>
                @endforelse

                <li class="nav-item d-flex align-items-center gap-2">
                    <div class="search-wrapper" id="searchWrapper">
                        <div class="search-icon-wrap">
                            <a href="#" class="search-btn" id="searchBtn" aria-label="Search">
                                <i class="fa-solid fa-search"></i>
                            </a>
                            <div class="search-box" id="searchBox">
                                <form action="{{ route('search') }}" method="GET">
                                    <i class="fa-solid fa-search search-icon"></i>
                                    <input type="text" name="q" class="search-input" placeholder="Search..." autocomplete="off" aria-label="Search query">
                                    <button type="submit" class="search-submit" id="searchSubmit" aria-label="Submit search">
                                        <i class="fa-solid fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="gtranslate-wrap">
                        <button type="button" class="gt-btn" onclick="document.body.classList.toggle('gt-open')" aria-label="Select language" aria-expanded="false" aria-haspopup="listbox">
                            <i class="fa-solid fa-language"></i><i class="fa-solid fa-chevron-down" style="font-size:.7em"></i>
                        </button>
                        <div id="google_translate_element" style="display:none"></div>
                    <div class="lang-menu" role="listbox" aria-label="Language selection">
                        <button type="button" onclick="pickLang('en')" role="option" aria-label="English">English</button>
                        <button type="button" onclick="pickLang('ar')" role="option" aria-label="Arabic">العربية</button>
                        <button type="button" onclick="pickLang('bn')" role="option" aria-label="Bengali">বাংলা</button>
                        <button type="button" onclick="pickLang('ur')" role="option" aria-label="Urdu">اردو</button>
                        <button type="button" onclick="pickLang('hi')" role="option" aria-label="Hindi">हिन्दी</button>
                        <button type="button" onclick="pickLang('tl')" role="option" aria-label="Filipino">Filipino</button>
                    </div>
                    </div>
                    <button type="button" class="theme-toggle-btn" onclick="pcToggleTheme()" aria-label="Toggle theme">
                        <i class="fa-solid fa-sun" id="pcSun"></i>
                        <i class="fa-solid fa-moon" id="pcMoon" style="display:none"></i>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</nav>
