<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('alt_text')->nullable()->after('featured_image');
        });
        
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('alt_text')->nullable()->after('featured_image');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('alt_text');
        });
        
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('alt_text');
        });
    }
};
