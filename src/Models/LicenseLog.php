<?php

declare(strict_types=1);

namespace Mrh\License\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * LicenseLog
 * ----------
 * Unified transport/event diagnostic trail for the client. One row per
 * meaningful event (activation, verification, reset, guard block, transport
 * error). Denormalized on purpose; survives a reset via nullOnDelete.
 *
 * @property int         $id
 * @property int|null    $license_setting_id
 * @property string      $channel
 * @property string      $event
 * @property string      $level
 * @property string|null $action
 * @property string|null $result
 * @property bool|null   $signature_valid
 * @property string|null $installation_id
 * @property string|null $normalized_domain
 * @property string|null $server_type
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $endpoint
 * @property int|null    $http_status
 * @property int|null    $latency_ms
 * @property string|null $message
 * @property array|null  $context
 * @property \Illuminate\Support\Carbon|null $logged_at
 */
class LicenseLog extends Model
{
    protected $table = 'mrh_license_logs';

    protected $fillable = [
        'license_setting_id',
        'channel',
        'event',
        'level',
        'action',
        'result',
        'signature_valid',
        'installation_id',
        'normalized_domain',
        'server_type',
        'ip_address',
        'user_agent',
        'endpoint',
        'http_status',
        'latency_ms',
        'message',
        'context',
        'logged_at',
    ];

    protected function casts(): array
    {
        return [
            'signature_valid' => 'boolean',
            'http_status'     => 'integer',
            'latency_ms'      => 'integer',
            'context'         => 'array',
            'logged_at'       => 'datetime',
        ];
    }

    /** @return BelongsTo<LicenseSetting, LicenseLog> */
    public function setting(): BelongsTo
    {
        return $this->belongsTo(LicenseSetting::class, 'license_setting_id');
    }
}
