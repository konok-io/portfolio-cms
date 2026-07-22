<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * This migration adds a scalable JSON-based translation system for all page content.
     * The translations table stores key-value pairs for each language.
     */
    public function up(): void
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('group', 50)->default('content'); // content, labels, messages
            $table->string('key', 100)->unique();
            $table->text('en')->nullable();
            $table->text('bn')->nullable();
            $table->text('ar')->nullable();
            $table->text('default_value')->nullable(); // Fallback if translation missing
            $table->timestamps();
            
            $table->index(['group', 'key']);
        });

        // Add JSON column to settings for flexible content storage
        Schema::table('settings', function (Blueprint $table) {
            $table->json('page_content')->nullable()->after('og_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
        
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('page_content');
        });
    }
};
