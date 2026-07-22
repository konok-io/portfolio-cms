<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('google_analytics_id', 50)->nullable()->after('mail_from_name');
            $table->string('google_tag_manager_id', 50)->nullable()->after('google_analytics_id');
            $table->boolean('analytics_enabled')->default(false)->after('google_tag_manager_id');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['google_analytics_id', 'google_tag_manager_id', 'analytics_enabled']);
        });
    }
};
