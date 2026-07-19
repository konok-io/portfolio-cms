<?php

declare(strict_types=1);

namespace Mrh\License\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * LicenseSetting
 * --------------
 * Single-row (per installation) durable mirror of this client's licensing
 * state. Root of the client-side model graph. The license key is encrypted
 * at rest and never exposed via array/JSON output.
 *
 * @property int         $id
 * @property string      $installation_id
 * @property string|null $license_key_encrypted
 * @property string|null $license_uuid
 * @property string|null $server_type
 * @property string|null $normalized_domain
 * @property string|null $fingerprint_hash
 * @property string      $status
 * @property string|null $last_action
 * @property array|null  $last_verdict
 * @property string|null $last_signature
 * @property string|null $key_version
 * @property \Illuminate\Support\Carbon|null $activated_at
 * @property \Illuminate\Support\Carbon|null $last_verified_at
 * @property \Illuminate\Support\Carbon|null $next_verify_by
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $grace_ends_at
 * @property array|null  $meta
 */
class LicenseSetting extends Model
{
    protected $table = 'mrh_license_settings';

    protected $fillable = [
        'installation_id',
        'license_key_encrypted',
        'license_uuid',
        'server_type',
        'normalized_domain',
        'fingerprint_hash',
        'status',
        'last_action',
        'last_verdict',
        'last_signature',
        'key_version',
        'activated_at',
        'last_verified_at',
        'next_verify_by',
        'expires_at',
        'grace_ends_at',
        'meta',
    ];

    /**
     * Encrypted key and raw signature are never serialized.
     */
    protected $hidden = [
        'license_key_encrypted',
        'last_signature',
    ];

    protected function casts(): array
    {
        return [
            'last_verdict'     => 'array',
            'meta'             => 'array',
            'activated_at'     => 'datetime',
            'last_verified_at' => 'datetime',
            'next_verify_by'   => 'datetime',
            'expires_at'       => 'datetime',
            'grace_ends_at'    => 'datetime',
        ];
    }

    /** @return HasMany<LicenseActivation> */
    public function activations(): HasMany
    {
        return $this->hasMany(LicenseActivation::class);
    }

    /** @return HasMany<LicenseVerification> */
    public function verifications(): HasMany
    {
        return $this->hasMany(LicenseVerification::class);
    }

    /** @return HasMany<LicenseLog> */
    public function logs(): HasMany
    {
        return $this->hasMany(LicenseLog::class);
    }

    /**
     * The current active activation binding, if any.
     *
     * @return HasOne<LicenseActivation>
     */
    public function activeActivation(): HasOne
    {
        return $this->hasOne(LicenseActivation::class)
            ->where('status', 'active')
            ->latestOfMany();
    }
}
