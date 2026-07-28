<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * license_logs
 * ------------
 * Unified transport/event log for the client. One row per meaningful event:
 * activation attempts, verification calls, resets, signature failures,
 * grace transitions, blocks, and HTTP/transport errors. This is the
 * diagnostic trail a support engineer reads first. Broad and denormalized on
 * purpose; not a foreign-key-heavy audit table.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mrh_license_logs', function (Blueprint $table): void {
            $table->id();

            // Loose links (nullable, nullOnDelete) so a log survives cleanup.
            $table->foreignId('license_setting_id')
                ->nullable()
                ->constrained('mrh_license_settings')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            // Classification.
            $table->string('channel', 20)->default('license'); // activation|verification|reset|guard|transport
            $table->string('event', 40);                       // e.g. activated, verified, blocked, http_error
            $table->string('level', 10)->default('info');      // debug|info|warning|error|critical

            // Outcome + directive.
            $table->string('action', 20)->nullable();          // continue|grace|expire|kill|reactivate|deny
            $table->string('result', 40)->nullable();
            $table->boolean('signature_valid')->nullable();

            // Request context.
            $table->string('installation_id', 191)->nullable();
            $table->string('normalized_domain', 191)->nullable();
            $table->string('server_type', 20)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();

            // Transport detail.
            $table->string('endpoint', 60)->nullable();        // activate|verify|check-domain|...
            $table->unsignedSmallInteger('http_status')->nullable();
            $table->unsignedInteger('latency_ms')->nullable();

            // Human message + structured context (keep payloads redacted).
            $table->string('message', 500)->nullable();
            $table->json('context')->nullable();

            $table->timestamp('logged_at')->nullable();
            $table->timestamps();

            $table->index(['channel', 'event']);
            $table->index('level');
            $table->index(['license_setting_id', 'created_at']);
            $table->index('logged_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mrh_license_logs');
    }
};
