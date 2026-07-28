<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('google_analytics_id', 50)->nullable();
            $table->string('google_tag_manager_id', 50)->nullable();
            $table->boolean('analytics_enabled')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['google_analytics_id', 'google_tag_manager_id', 'analytics_enabled']);
        });
    }
};
