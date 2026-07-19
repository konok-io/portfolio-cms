<?php

declare(strict_types=1);

namespace Mrh\License\Enums;

/** Runtime environment classification sent on activation. */
enum ServerType: string
{
    case Localhost = 'localhost';
    case Shared    = 'shared';
    case Vps       = 'vps';
}
