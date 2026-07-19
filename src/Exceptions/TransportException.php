<?php

declare(strict_types=1);

namespace Mrh\License\Exceptions;

use Throwable;

/**
 * The license server could not be reached (connection refused, DNS failure,
 * timeout, or 5xx). Distinct from a signed denial: the caller catches this to
 * hand off to the grace lifecycle rather than blocking outright.
 */
class TransportException extends LicenseException
{
    public function __construct(string $message = '', ?Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
