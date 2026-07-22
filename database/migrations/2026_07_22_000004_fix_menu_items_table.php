<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Check if menu_items table exists
        if (!Schema::hasTable('menu_items')) {
            Schema::create('menu_items', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('url')->nullable();
                $table->string('route')->nullable();
                $table->string('icon')->nullable();
                $table->integer('order')->default(0);
                $table->boolean('is_active')->default(true);
                $table->string('target')->default('_self');
                $table->timestamps();
            });
            return;
        }

        // Add missing columns if they don't exist
        if (!Schema::hasColumn('menu_items', 'name')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->string('name')->nullable();
            });
        }
        if (!Schema::hasColumn('menu_items', 'url')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->string('url')->nullable();
            });
        }
        if (!Schema::hasColumn('menu_items', 'route')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->string('route')->nullable();
            });
        }
        if (!Schema::hasColumn('menu_items', 'icon')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->string('icon')->nullable();
            });
        }
        if (!Schema::hasColumn('menu_items', 'order')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->integer('order')->default(0);
            });
        }
        if (!Schema::hasColumn('menu_items', 'is_active')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->boolean('is_active')->default(true);
            });
        }
        if (!Schema::hasColumn('menu_items', 'target')) {
            Schema::table('menu_items', function (Blueprint $table) {
                $table->string('target')->default('_self');
            });
        }
    }

    public function down(): void
    {
        //
    }
};
