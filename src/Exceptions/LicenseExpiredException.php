<?php

declare(strict_types=1);

namespace Mrh\License\Exceptions;

/** License has expired and the grace window has elapsed. */
class LicenseExpiredException extends LicenseException
{
}
