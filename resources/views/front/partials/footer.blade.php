<footer class="site-footer pt-5 pb-4 mt-auto">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4">
                <h5 class="font-heading mb-3">{{ $siteSetting->site_name ?? 'Portfolio' }}</h5>
                <p class="small mb-3">Building thoughtful, modern web experiences — from idea to launch.</p>
                <div class="footer-social">
                    @if($siteSetting->facebook ?? false)
                        <a href="{{ $siteSetting->facebook }}" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a>
                    @endif
                    @if($siteSetting->twitter ?? false)
                        <a href="{{ $siteSetting->twitter }}" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter"></i></a>
                    @endif
                    @if($siteSetting->linkedin ?? false)
                        <a href="{{ $siteSetting->linkedin }}" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a>
                    @endif
                    @if($siteSetting->github ?? false)
                        <a href="{{ $siteSetting->github }}" target="_blank" rel="noopener"><i class="fa-brands fa-github"></i></a>
                    @endif
                    @if($siteSetting->instagram ?? false)
                        <a href="{{ $siteSetting->instagram }}" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a>
                    @endif
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <h5 class="mb-3">Quick Links</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ route('home') }}#about">About</a></li>
                    <li class="mb-2"><a href="{{ route('home') }}#services">Services</a></li>
                    <li class="mb-2"><a href="{{ route('projects.index') }}">Portfolio</a></li>
                    <li class="mb-2"><a href="{{ route('blog.index') }}">Blog</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 col-6">
                <h5 class="mb-3">Contact</h5>
                <ul class="list-unstyled small">
                    @if($siteSetting->email ?? false)
                        <li class="mb-2"><i class="fa-solid fa-envelope me-2"></i>{{ $siteSetting->email }}</li>
                    @endif
                    @if($siteSetting->phone ?? false)
                        <li class="mb-2"><i class="fa-solid fa-phone me-2"></i>{{ $siteSetting->phone }}</li>
                    @endif
                    @if($siteSetting->address ?? false)
                        <li class="mb-2"><i class="fa-solid fa-location-dot me-2"></i>{{ $siteSetting->address }}</li>
                    @endif
                </ul>
            </div>

            <div class="col-lg-3 col-md-4">
                <h5 class="mb-3">Newsletter</h5>
                <p class="small mb-3">Get notified about new projects and blog posts.</p>
                @if(session('newsletter_success'))
                    <div class="alert alert-success py-2 px-3 small mb-2">{{ session('newsletter_success') }}</div>
                @endif
                <form class="d-flex gap-2" action="{{ route('subscribe.store') }}" method="POST">
                    @csrf
                    <input type="email" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="Your email" aria-label="Email" required>
                    <button class="btn btn-sm btn-primary-custom" type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
                @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
        </div>

        <hr class="border-secondary mt-4 mb-3" style="opacity: 0.15;">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small">
            <p class="mb-0">&copy; {{ date('Y') }} {{ $siteSetting->site_name ?? 'Portfolio CMS' }}. All rights reserved.</p>
            <p class="mb-0">Built with Laravel</p>
        </div>
    </div>
</footer>
