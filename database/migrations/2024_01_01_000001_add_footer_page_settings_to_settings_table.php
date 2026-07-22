<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('show_privacy_in_footer')->default(true)->after('maintenance_mode');
            $table->boolean('show_terms_in_footer')->default(true)->after('show_privacy_in_footer');
            $table->boolean('show_privacy_in_header')->default(true)->after('show_terms_in_footer');
            $table->boolean('show_terms_in_header')->default(true)->after('show_privacy_in_header');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['show_privacy_in_footer', 'show_terms_in_footer', 'show_privacy_in_header', 'show_terms_in_header']);
        });
    }
};
