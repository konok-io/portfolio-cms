<?php

declare(strict_types=1);

namespace Mrh\License\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * LicenseActivation
 * -----------------
 * The client's record of an activation attempt and the signed grant returned
 * by the license server. Normally one active row; history is retained across
 * resets and domain moves.
 *
 * @property int         $id
 * @property int|null    $license_setting_id
 * @property string|null $license_uuid
 * @property string|null $activation_uuid
 * @property string      $installation_id
 * @property string|null $normalized_domain
 * @property bool        $is_wildcard
 * @property string|null $server_type
 * @property string|null $fingerprint_hash
 * @property string|null $ip_address
 * @property string|null $os_info
 * @property string      $status
 * @property array|null  $grant_payload
 * @property string|null $grant_signature
 * @property \Illuminate\Support\Carbon|null $activated_at
 * @property \Illuminate\Support\Carbon|null $revoked_at
 * @property array|null  $meta
 */
class LicenseActivation extends Model
{
    protected $table = 'mrh_license_activations';

    protected $fillable = [
        'license_setting_id',
        'license_uuid',
        'activation_uuid',
        'installation_id',
        'normalized_domain',
        'is_wildcard',
        'server_type',
        'fingerprint_hash',
        'ip_address',
        'os_info',
        'status',
        'grant_payload',
        'grant_signature',
        'activated_at',
        'revoked_at',
        'meta',
    ];

    protected $hidden = [
        'grant_signature',
    ];

    protected function casts(): array
    {
        return [
            'is_wildcard'   => 'boolean',
            'grant_payload' => 'array',
            'meta'          => 'array',
            'activated_at'  => 'datetime',
            'revoked_at'    => 'datetime',
        ];
    }

    /** @return BelongsTo<LicenseSetting, LicenseActivation> */
    public function setting(): BelongsTo
    {
        return $this->belongsTo(LicenseSetting::class, 'license_setting_id');
    }

    /** @return HasMany<LicenseVerification> */
    public function verifications(): HasMany
    {
        return $this->hasMany(LicenseVerification::class);
    }
}
