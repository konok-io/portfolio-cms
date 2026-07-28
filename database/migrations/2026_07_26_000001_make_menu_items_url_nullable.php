<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('menu_items') && Schema::hasColumn('menu_items', 'url')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->string('url')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('menu_items') && Schema::hasColumn('menu_items', 'url')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->string('url')->nullable(false)->change();
            });
        }
    }
};
