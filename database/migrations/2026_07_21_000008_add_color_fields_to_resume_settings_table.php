<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resume_settings', function (Blueprint $table) {
            $table->string('heading_color')->default('#1a1a2e')->after('primary_color');
            $table->string('text_color')->default('#4a5568')->after('heading_color');
            $table->string('background_color')->default('#ffffff')->after('text_color');
            $table->string('header_bg_color')->default('#1a1a2e')->after('background_color');
            $table->string('header_text_color')->default('#ffffff')->after('header_bg_color');
            $table->string('footer_bg_color')->default('#1a1a2e')->after('header_text_color');
            $table->string('footer_text_color')->default('#9ca3af')->after('footer_bg_color');
        });
    }

    public function down(): void
    {
        Schema::table('resume_settings', function (Blueprint $table) {
            $table->dropColumn(['heading_color', 'text_color', 'background_color', 'header_bg_color', 'header_text_color', 'footer_bg_color', 'footer_text_color']);
        });
    }
};
