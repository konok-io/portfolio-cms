<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // 404 Page Custom Content
            $table->string('404_title', 255)->nullable()->after('cookie_expiry_days');
            $table->string('404_message', 500)->nullable()->after('404_title');
            $table->string('404_button_text', 100)->nullable()->after('404_message');
            $table->string('404_icon', 50)->default('fa-compass')->after('404_button_text');
            
            // Coming Soon Page Settings
            $table->string('coming_soon_title', 255)->nullable()->after('404_icon');
            $table->string('coming_soon_message', 500)->nullable()->after('coming_soon_title');
            $table->datetime('coming_soon_date')->nullable()->after('coming_soon_message');
            $table->boolean('coming_soon_enabled')->default(false)->after('coming_soon_date');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                '404_title',
                '404_message',
                '404_button_text',
                '404_icon',
                'coming_soon_title',
                'coming_soon_message',
                'coming_soon_date',
                'coming_soon_enabled',
            ]);
        });
    }
};
