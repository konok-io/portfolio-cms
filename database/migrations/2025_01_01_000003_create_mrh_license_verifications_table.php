<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * license_verifications
 * ---------------------
 * Rolling history of the signed verdicts this client received from the
 * server's /verify heartbeat. Each row is a point-in-time decision the
 * client acted on. Kept for troubleshooting and to prove the last-known-good
 * state during grace. Prune old rows on a schedule.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mrh_license_verifications', function (Blueprint $table): void {
            $table->id();

            $table->foreignId('license_setting_id')
                ->nullable()
                ->constrained('mrh_license_settings')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('license_activation_id')
                ->nullable()
                ->constrained('mrh_license_activations')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            // Verdict as returned by the server.
            $table->string('action', 20);                       // continue|grace|expire|kill|reactivate|deny
            $table->string('result', 40)->nullable();           // success|expired|blacklisted|...
            $table->boolean('operational')->default(false);     // was the app allowed to run?
            $table->boolean('signature_valid')->nullable();     // did the RSA check pass?

            // Context sent/received.
            $table->string('installation_id', 191)->nullable();
            $table->string('normalized_domain', 191)->nullable();
            $table->string('nonce', 64)->nullable();
            $table->string('payload_hash', 64)->nullable();
            $table->string('key_version', 20)->nullable();

            // Whether this verdict came from the network or the offline fallback.
            $table->string('source', 20)->default('remote');    // remote|cache|grace_fallback

            $table->unsignedInteger('latency_ms')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('next_verify_by')->nullable();

            $table->json('payload')->nullable();
            $table->timestamps();

            $table->index(['license_setting_id', 'verified_at']);
            $table->index('action');
            $table->index('result');
            $table->index('nonce');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mrh_license_verifications');
    }
};
