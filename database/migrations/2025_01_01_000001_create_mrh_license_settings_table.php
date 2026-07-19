<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * license_settings
 * ----------------
 * Single-row (per installation) durable mirror of this client's licensing
 * state. The cache is the hot path; this table is the fallback that survives
 * cache flushes, and the encrypted file mirror backs THIS up for shared
 * hosting where the DB can be reset by migrate:fresh.
 *
 * Source of truth remains the license server. This row only records the last
 * signed verdict and the identity material sent on every request.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mrh_license_settings', function (Blueprint $table): void {
            $table->id();

            // Stable identity sent to the server on every call.
            $table->string('installation_id', 191)->unique();

            // Encrypted at rest (Laravel Crypt). Never stored in plaintext.
            $table->text('license_key_encrypted')->nullable();

            // Returned by the server on activation.
            $table->uuid('license_uuid')->nullable()->index();

            // Binding context.
            $table->string('server_type', 20)->nullable();      // localhost | shared | vps
            $table->string('normalized_domain', 191)->nullable();
            $table->string('fingerprint_hash', 64)->nullable();

            // Denormalized state for fast gate reads.
            $table->string('status', 20)->default('pending');   // pending|active|grace|expired|blocked
            $table->string('last_action', 20)->nullable();      // continue|grace|expire|kill|reactivate|deny

            // Last signed verdict + its signature (re-checkable offline).
            $table->json('last_verdict')->nullable();
            $table->text('last_signature')->nullable();
            $table->string('key_version', 20)->nullable();

            // Timing that drives cache TTL + grace math.
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('last_verified_at')->nullable();
            $table->timestamp('next_verify_by')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('grace_ends_at')->nullable();

            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('next_verify_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mrh_license_settings');
    }
};
