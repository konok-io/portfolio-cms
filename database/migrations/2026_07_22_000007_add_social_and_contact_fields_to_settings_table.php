<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // WhatsApp and additional social fields
            $table->string('whatsapp', 50)->nullable()->after('instagram');
            $table->string('whatsapp_number', 50)->nullable()->after('whatsapp');
            $table->string('whatsapp_default_message', 255)->nullable()->after('whatsapp_number');
            $table->string('tiktok')->nullable()->after('youtube');
            $table->string('snapchat')->nullable()->after('tiktok');
            $table->string('pinterest')->nullable()->after('snapchat');
            $table->string('reddit')->nullable()->after('pinterest');
            $table->string('discord')->nullable()->after('reddit');
            $table->string('twitch')->nullable()->after('discord');
            
            // Cookie consent settings
            $table->boolean('cookie_consent_enabled')->default(true)->after('analytics_enabled');
            $table->boolean('cookie_essential_only')->default(false)->after('cookie_consent_enabled');
            $table->string('cookie_expiry_days', 10)->default('365')->after('cookie_essential_only');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp',
                'whatsapp_number',
                'whatsapp_default_message',
                'tiktok',
                'snapchat',
                'pinterest',
                'reddit',
                'discord',
                'twitch',
                'cookie_consent_enabled',
                'cookie_essential_only',
                'cookie_expiry_days',
            ]);
        });
    }
};
