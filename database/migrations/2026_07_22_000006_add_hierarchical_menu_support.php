<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Only run if menu_items table exists
        if (!Schema::hasTable('menu_items')) {
            return;
        }

        // Add parent_id for hierarchical menu support
        if (!Schema::hasColumn('menu_items', 'parent_id')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->foreignId('parent_id')->nullable()->after('target')
                    ->constrained('menu_items')->onDelete('cascade');
                $table->integer('sort_order')->default(0)->after('parent_id');
                $table->string('menu_type')->default('header')->after('sort_order'); // header, footer, mobile
                $table->boolean('has_children')->default(false)->after('menu_type');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('menu_items')) {
            return;
        }

        Schema::table('menu_items', function (Blueprint $table) {
            if (Schema::hasColumn('menu_items', 'parent_id')) {
                $table->dropForeign(['parent_id']);
                $table->dropColumn('parent_id');
            }
            if (Schema::hasColumn('menu_items', 'sort_order')) {
                $table->dropColumn('sort_order');
            }
            if (Schema::hasColumn('menu_items', 'menu_type')) {
                $table->dropColumn('menu_type');
            }
            if (Schema::hasColumn('menu_items', 'has_children')) {
                $table->dropColumn('has_children');
            }
        });
    }
};
