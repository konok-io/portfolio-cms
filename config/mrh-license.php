<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| MRH License — Client Configuration
|--------------------------------------------------------------------------
| Consumed by the client package installed in each Laravel project. The
| source of truth is the Saudi License Server; these values control how the
| client talks to it and how it behaves offline.
|
| NOTE: No business logic here yet — values are placeholders/defaults only.
*/

return [

    // The license key issued to this installation (store in .env).
    'key' => env('MRH_LICENSE_KEY'),

    // Base URL of the Saudi License Server, e.g. https://license.example.com
    'server_url' => env('MRH_LICENSE_SERVER_URL'),

    /*
    |--------------------------------------------------------------------------
    | Server type override
    |--------------------------------------------------------------------------
    | Leave null to auto-detect (localhost / domain / vps). Set explicitly to
    | one of: localhost, domain, vps — to force it. Handy for local *.test
    | domains where the machine is local but the site is served as a domain.
    */
    'server_type' => env('MRH_LICENSE_SERVER_TYPE'),

    /*
    | Bundled RSA-4096 public key used to verify signed server responses
    | offline. Published to the host app on install.
    */
    'public_key_path' => env('MRH_LICENSE_PUBLIC_KEY', null),

    /*
    | Verification cadence & offline tolerance.
    | - cache_ttl_hours : how long a signed verdict is trusted before re-verify
    | - grace_days      : how long to keep running when the server is
    |                     unreachable or the license has expired
    */
    'cache_ttl_hours' => (int) env('MRH_LICENSE_CACHE_TTL', 24),
    'grace_days'      => (int) env('MRH_LICENSE_GRACE_DAYS', 7),

    /*
    | Scheduler.
    | The package auto-schedules `license:verify`. The command respects the
    | 24-hour window, so a frequent cadence is safe (fresh runs are skipped).
    | - enabled : master switch for auto-scheduling
    | - cron    : optional custom cron expression; blank = hourly default
    */
    'schedule' => [
        'enabled' => (bool) env('MRH_LICENSE_SCHEDULE', true),
        'cron'    => env('MRH_LICENSE_SCHEDULE_CRON', ''),
    ],

    /*
    | Transport options for outbound calls to the license server.
    */
    'http' => [
        'timeout'         => (int) env('MRH_LICENSE_HTTP_TIMEOUT', 10),
        'connect_timeout' => (int) env('MRH_LICENSE_HTTP_CONNECT_TIMEOUT', 5),
        'retries'         => (int) env('MRH_LICENSE_HTTP_RETRIES', 2),
    ],

    /*
    | Policy when the server is unreachable AND the grace window has elapsed.
    | 'block'      → hard-fail (403 blocked view)
    | 'read_only'  → degrade (reserved for host-app handling)
    */
    'expired_policy' => env('MRH_LICENSE_EXPIRED_POLICY', 'block'),

    /*
    | Global middleware guard.
    | - enabled  : master switch for the route-independent guard
    | - redirect : where to send unlicensed (not-yet-activated) traffic
    | - except   : URI patterns always allowed (activation, auth, assets, health)
    */
    'guard' => [
        'enabled' => (bool) env('MRH_LICENSE_GUARD_ENABLED', env('MRH_LICENSE_GUARD', true)),

        // Route name (preferred) or URI the middleware redirects to when the
        // installation has no license yet. Falls back to the URI if the named
        // route does not exist in the host app.
        'redirect_to' => env('MRH_LICENSE_REDIRECT', 'mrh-license/activate'),

        // Always-allowed URI patterns (Str::is glob syntax). Covers the
        // package's own endpoints, host auth flows, and static assets so the
        // app never locks the user out of activating or logging in.
        'except' => [
            // Package license endpoints
            'mrh-license',
            'mrh-license/*',

            // Authentication
            'login',
            'logout',
            'register',

            // Password reset
            'password',
            'password/*',
            'forgot-password',
            'reset-password',
            'reset-password/*',

            // Email verification (Laravel default)
            'email/verify',
            'email/verify/*',

            // Health checks
            'up',

            // Static assets
            'assets/*',
            'css/*',
            'js/*',
            'images/*',
            'img/*',
            'fonts/*',
            'build/*',
            'storage/*',
            'favicon.ico',
            'robots.txt',
        ],
    ],

    /*
    | Local persistence.
    | - cache_store : cache store name for the hot-path verdict
    | - file_mirror : encrypted fallback file (survives migrate:fresh)
    */
    'storage' => [
        'cache_store' => env('MRH_LICENSE_CACHE_STORE', null),
        'file_mirror' => storage_path('app/mrh-license.dat'),
    ],

    /*
    | Optional activation wizard (blade UI + guarded routes).
    | When false, activation is CLI-only via `php artisan license:activate`.
    */
    'install_wizard' => (bool) env('MRH_LICENSE_INSTALL_WIZARD', env('MRH_LICENSE_WIZARD', false)),
];
