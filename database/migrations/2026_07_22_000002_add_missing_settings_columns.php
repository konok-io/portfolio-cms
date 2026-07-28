<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // reCAPTCHA
            if (!Schema::hasColumn('settings', 'recaptcha_site_key')) {
                $table->string('recaptcha_site_key')->nullable();
            }
            if (!Schema::hasColumn('settings', 'recaptcha_secret_key')) {
                $table->string('recaptcha_secret_key')->nullable();
            }
            if (!Schema::hasColumn('settings', 'recaptcha_enabled')) {
                $table->boolean('recaptcha_enabled')->default(false);
            }
            
            // Mail settings
            if (!Schema::hasColumn('settings', 'mail_driver')) {
                $table->string('mail_driver', 50)->nullable();
            }
            if (!Schema::hasColumn('settings', 'mail_host')) {
                $table->string('mail_host')->nullable();
            }
            if (!Schema::hasColumn('settings', 'mail_port')) {
                $table->string('mail_port', 10)->nullable();
            }
            if (!Schema::hasColumn('settings', 'mail_username')) {
                $table->string('mail_username')->nullable();
            }
            if (!Schema::hasColumn('settings', 'mail_password')) {
                $table->string('mail_password')->nullable();
            }
            if (!Schema::hasColumn('settings', 'mail_encryption')) {
                $table->string('mail_encryption', 10)->nullable();
            }
            if (!Schema::hasColumn('settings', 'mail_from_address')) {
                $table->string('mail_from_address')->nullable();
            }
            if (!Schema::hasColumn('settings', 'mail_from_name')) {
                $table->string('mail_from_name')->nullable();
            }
            
            // Analytics
            if (!Schema::hasColumn('settings', 'google_analytics_id')) {
                $table->string('google_analytics_id', 50)->nullable();
            }
            if (!Schema::hasColumn('settings', 'google_tag_manager_id')) {
                $table->string('google_tag_manager_id', 50)->nullable();
            }
            if (!Schema::hasColumn('settings', 'analytics_enabled')) {
                $table->boolean('analytics_enabled')->default(false);
            }
        });
    }

    public function down(): void
    {
        // Don't drop columns on rollback as they may not exist
    }
};
