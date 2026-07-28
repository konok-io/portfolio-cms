<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('group')->index(); // e.g., 'services', 'projects', 'blogs'
            $table->unsignedBigInteger('entity_id')->index();
            $table->string('locale', 10)->index(); // e.g., 'en', 'bn'
            $table->string('key'); // e.g., 'title', 'description'
            $table->text('value')->nullable();
            $table->timestamps();

            // Unique constraint to prevent duplicate translations
            $table->unique(['group', 'entity_id', 'locale', 'key'], 'translations_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
