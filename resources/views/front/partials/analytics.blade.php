{{-- Google Analytics / Tag Manager Integration --}}
@if($siteSetting->isAnalyticsEnabled())
    {{-- Google Tag Manager (noscript fallback) --}}
    @if($siteSetting->getGoogleTagManagerId())
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id={{ $siteSetting->getGoogleTagManagerId() }}"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
    @endif

    {{-- Google Analytics Script --}}
    @if($siteSetting->getGoogleAnalyticsId())
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $siteSetting->getGoogleAnalyticsId() }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $siteSetting->getGoogleAnalyticsId() }}', {
                'anonymize_ip': true,
                'allow_google_ads': true
            });
        </script>
    @endif

    {{-- Google Tag Manager Script --}}
    @if($siteSetting->getGoogleTagManagerId())
        <!-- Google Tag Manager -->
        <script>
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{ $siteSetting->getGoogleTagManagerId() }}');
        </script>
    @endif
@endif
