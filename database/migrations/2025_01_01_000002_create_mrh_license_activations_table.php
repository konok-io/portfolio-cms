<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * license_activations
 * -------------------
 * The client's record of activation attempts and the resulting binding grant
 * returned by the server. Normally a single active row, but history is kept
 * (re-activations after a reset, domain moves) for support/audit.
 *
 * Mirrors the fields the server binds (installation_id, domain, server_type)
 * plus the signed grant payload the client received.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mrh_license_activations', function (Blueprint $table): void {
            $table->id();

            // Links to the local state row (nullable so an activation attempt
            // can be logged before settings is finalized).
            $table->foreignId('license_setting_id')
                ->nullable()
                ->constrained('mrh_license_settings')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Server-side identifiers echoed back on success.
            $table->uuid('license_uuid')->nullable()->index();
            $table->uuid('activation_uuid')->nullable()->unique();

            // Binding material.
            $table->string('installation_id', 191);
            $table->string('normalized_domain', 191)->nullable();
            $table->boolean('is_wildcard')->default(false);
            $table->string('server_type', 20)->nullable();      // localhost | shared | vps
            $table->string('fingerprint_hash', 64)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('os_info', 191)->nullable();

            // Lifecycle of this binding as seen by the client.
            $table->string('status', 20)->default('active');    // active|revoked|superseded|failed

            // The signed activation grant + signature (offline re-verifiable).
            $table->json('grant_payload')->nullable();
            $table->text('grant_signature')->nullable();

            $table->timestamp('activated_at')->nullable();
            $table->timestamp('revoked_at')->nullable();

            $table->json('meta')->nullable();
            $table->timestamps();

            // One active binding per installation on this client.
            $table->unique(['license_setting_id', 'installation_id'], 'la_setting_install_unique');
            $table->index('installation_id');
            $table->index('status');
            $table->index('normalized_domain');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mrh_license_activations');
    }
};
