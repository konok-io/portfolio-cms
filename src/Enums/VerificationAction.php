<?php

declare(strict_types=1);

namespace Mrh\License\Enums;

/**
 * Directive returned inside the server's signed verify verdict.
 * Mirrors the server's App\Enums\VerificationAction exactly.
 */
enum VerificationAction: string
{
    case Continue   = 'continue';
    case Kill       = 'kill';
    case Grace      = 'grace';
    case Expire     = 'expire';
    case Reactivate = 'reactivate';
    case Deny       = 'deny';

    /** Whether the ERP should remain operational under this action. */
    public function isOperational(): bool
    {
        return in_array($this, [self::Continue, self::Grace], true);
    }

    /** Map a verdict action to the local license status it implies. */
    public function toStatus(): LicenseStatus
    {
        return match ($this) {
            self::Continue   => LicenseStatus::Active,
            self::Grace      => LicenseStatus::Grace,
            self::Expire     => LicenseStatus::Expired,
            self::Kill,
            self::Deny       => LicenseStatus::Blocked,
            self::Reactivate => LicenseStatus::Pending,
        };
    }
}
