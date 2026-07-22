<nav class="navbar navbar-expand-lg sticky-top site-navbar">
    <div class="container">
        <?php ($headerDisplay = $siteSetting->header_display ?? 'text'); ?>
        <a class="navbar-brand d-flex align-items-center gap-2" href="<?php echo e(route('home')); ?>">
            <?php if(($headerDisplay === 'logo' || $headerDisplay === 'both') && ($siteSetting->logo_url ?? false)): ?>
                <img src="<?php echo e($siteSetting->logo_url); ?>" alt="<?php echo e($siteSetting->site_name); ?>" height="36">
            <?php endif; ?>
            <?php if($headerDisplay === 'text' || $headerDisplay === 'both' || !($siteSetting->logo_url ?? false)): ?>
                <span><?php echo e($siteSetting->site_name ?? 'Portfolio'); ?></span>
            <?php endif; ?>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>#home">Home</a></li>
                <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('about') ? 'active' : ''); ?>" href="<?php echo e(route('about')); ?>">About</a></li>
                <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('services') ? 'active' : ''); ?>" href="<?php echo e(route('services')); ?>">Services</a></li>
                <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('projects.*') ? 'active' : ''); ?>" href="<?php echo e(route('projects.index')); ?>">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('resume') ? 'active' : ''); ?>" href="<?php echo e(route('resume')); ?>">Resume</a></li>
                <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('pricing') ? 'active' : ''); ?>" href="<?php echo e(route('pricing')); ?>">Pricing</a></li>
                <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('faq') ? 'active' : ''); ?>" href="<?php echo e(route('faq')); ?>">FAQ</a></li>
                <li class="nav-item"><a class="nav-link <?php echo e(request()->routeIs('blog.*') ? 'active' : ''); ?>" href="<?php echo e(route('blog.index')); ?>">Blog</a></li>

                <li class="nav-item d-flex align-items-center gap-2">
                    <div class="search-wrapper" id="searchWrapper">
                        <a href="#" class="search-btn" id="searchBtn" aria-label="Search">
                            <i class="fa-solid fa-search"></i>
                        </a>
                        <div class="search-box" id="searchBox">
                            <form action="<?php echo e(route('search')); ?>" method="GET">
                                <i class="fa-solid fa-search search-icon"></i>
                                <input type="text" name="q" class="search-input" placeholder="Search..." autocomplete="off">
                                <button type="submit" class="search-submit" id="searchSubmit">
                                    <i class="fa-solid fa-search"></i>
                                </button>
                            </form>
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
                    <a class="btn btn-primary-custom ms-lg-2 mt-2 mt-lg-0" href="<?php echo e(route('contact')); ?>">Get in Touch</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH C:\laragon\www\portfolio-cms\resources\views/front/partials/navbar.blade.php ENDPATH**/ ?>