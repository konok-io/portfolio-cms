<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This adds a page_content JSON column to settings table for storing
     * all page-specific content that can be edited from admin panel.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->json('page_content')->nullable()->after('og_image');
            $table->string('default_language', 10)->default('en')->after('header_display');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['page_content', 'default_language']);
        });
    }
};
