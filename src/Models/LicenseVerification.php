<?php

declare(strict_types=1);

namespace Mrh\License\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * LicenseVerification
 * -------------------
 * A single signed verdict received from the server's /verify heartbeat (or a
 * resolved offline fallback). Immutable history — rows are inserted, never
 * updated. Prune on a schedule.
 *
 * @property int         $id
 * @property int|null    $license_setting_id
 * @property int|null    $license_activation_id
 * @property string      $action
 * @property string|null $result
 * @property bool        $operational
 * @property bool|null   $signature_valid
 * @property string|null $installation_id
 * @property string|null $normalized_domain
 * @property string|null $nonce
 * @property string|null $payload_hash
 * @property string|null $key_version
 * @property string      $source
 * @property int|null    $latency_ms
 * @property \Illuminate\Support\Carbon|null $verified_at
 * @property \Illuminate\Support\Carbon|null $next_verify_by
 * @property array|null  $payload
 */
class LicenseVerification extends Model
{
    protected $table = 'mrh_license_verifications';

    protected $fillable = [
        'license_setting_id',
        'license_activation_id',
        'action',
        'result',
        'operational',
        'signature_valid',
        'installation_id',
        'normalized_domain',
        'nonce',
        'payload_hash',
        'key_version',
        'source',
        'latency_ms',
        'verified_at',
        'next_verify_by',
        'payload',
    ];

    protected function casts(): array
    {
        return [
            'operational'     => 'boolean',
            'signature_valid' => 'boolean',
            'latency_ms'      => 'integer',
            'payload'         => 'array',
            'verified_at'     => 'datetime',
            'next_verify_by'  => 'datetime',
        ];
    }

    /** @return BelongsTo<LicenseSetting, LicenseVerification> */
    public function setting(): BelongsTo
    {
        return $this->belongsTo(LicenseSetting::class, 'license_setting_id');
    }

    /** @return BelongsTo<LicenseActivation, LicenseVerification> */
    public function activation(): BelongsTo
    {
        return $this->belongsTo(LicenseActivation::class, 'license_activation_id');
    }
}
