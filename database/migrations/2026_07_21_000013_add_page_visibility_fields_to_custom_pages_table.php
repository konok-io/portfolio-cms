<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('custom_pages', function (Blueprint $table) {
            $table->boolean('show_site_header')->default(true)->after('show_in_footer');
            $table->boolean('show_site_footer')->default(true)->after('show_site_header');
        });
    }

    public function down(): void
    {
        Schema::table('custom_pages', function (Blueprint $table) {
            $table->dropColumn(['show_site_header', 'show_site_footer']);
        });
    }
};
