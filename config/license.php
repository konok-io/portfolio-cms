<?php

return [
    'product' => env('LICENSE_PRODUCT', 'Portfolio CMS'),
    'edition' => env('LICENSE_EDITION', 'Standard'),
    'version' => env('LICENSE_VERSION', '1.0.0'),
    'licensed_to' => env('LICENSE_LICENSED_TO', env('APP_NAME', 'Portfolio CMS')),
    'owner_email' => env('LICENSE_OWNER_EMAIL', env('MAIL_FROM_ADDRESS')),
    'key' => env('LICENSE_KEY', 'PCMS-XXXX-XXXX-XXXX-XXXX'),
    'status' => env('LICENSE_STATUS', 'active'),
    'issued_at' => env('LICENSE_ISSUED_AT', '2026-01-01'),
    'expires_at' => env('LICENSE_EXPIRES_AT', 'Lifetime'),
    'support_until' => env('LICENSE_SUPPORT_UNTIL', 'Lifetime'),
    'domain' => env('LICENSE_DOMAIN', null),
    'seats' => env('LICENSE_SEATS', 'Unlimited'),
];
