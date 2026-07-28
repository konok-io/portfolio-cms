<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Only run if menu_items table exists
        if (!Schema::hasTable('menu_items')) {
            return;
        }

        // Migrate data from old columns to new columns if needed
        // Only if new columns exist but old ones don't have data
        if (Schema::hasColumn('menu_items', 'title') && Schema::hasColumn('menu_items', 'name')) {
            // Copy title to name where name is null/empty
            DB::statement("UPDATE menu_items SET name = title WHERE (name IS NULL OR name = '') AND title IS NOT NULL AND title != ''");
        }

        if (Schema::hasColumn('menu_items', 'position') && Schema::hasColumn('menu_items', 'order')) {
            // Copy position to order where order is 0 (default)
            DB::statement("UPDATE menu_items SET `order` = position WHERE `order` = 0 AND position > 0");
        }

        // Drop old columns if they exist (optional - comment out if you want to keep for rollback)
        if (Schema::hasColumn('menu_items', 'title')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->dropColumn('title');
            });
        }

        if (Schema::hasColumn('menu_items', 'position')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->dropColumn('position');
            });
        }

        // Add index for better performance on is_active and order columns
        if (!Schema::hasIndex('menu_items', ['is_active', 'order'])) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->index(['is_active', 'order']);
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('menu_items')) {
            return;
        }

        // Re-add old columns (with default values since we can't restore data)
        if (!Schema::hasColumn('menu_items', 'title')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->string('title')->nullable();
            });
        }

        if (!Schema::hasColumn('menu_items', 'position')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->integer('position')->default(0);
            });
        }

        // Restore data from new columns to old columns
        if (Schema::hasColumn('menu_items', 'name') && Schema::hasColumn('menu_items', 'title')) {
            DB::statement("UPDATE menu_items SET title = name WHERE title IS NULL");
        }

        if (Schema::hasColumn('menu_items', 'order') && Schema::hasColumn('menu_items', 'position')) {
            DB::statement("UPDATE menu_items SET position = `order` WHERE position = 0");
        }

        // Remove the composite index
        if (Schema::hasIndex('menu_items', ['is_active', 'order'])) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->dropIndex(['is_active', 'order']);
            });
        }
    }
};
