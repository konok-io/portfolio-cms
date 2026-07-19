<?php

declare(strict_types=1);

namespace Mrh\License\Enums;

/** Denormalized local license state stored on LicenseSetting. */
enum LicenseStatus: string
{
    case Pending            = 'pending';
    case Active             = 'active';
    case Grace              = 'grace';
    case Expired            = 'expired';
    case Blocked            = 'blocked';
    case VerificationFailed = 'verification_failed';

    /** Whether the application is permitted to run in this state. */
    public function isOperational(): bool
    {
        return in_array($this, [self::Active, self::Grace], true);
    }

    /** Terminal, non-operational states the guard must block on. */
    public function isBlocking(): bool
    {
        return in_array($this, [self::Expired, self::Blocked, self::VerificationFailed], true);
    }
}
