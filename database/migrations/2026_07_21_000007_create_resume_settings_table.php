<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resume_settings', function (Blueprint $table) {
            $table->id();
            $table->string('template')->default('modern'); // modern, classic, minimal
            $table->string('primary_color')->default('#2563eb');
            $table->boolean('include_photo')->default(true);
            $table->boolean('include_skills')->default(true);
            $table->boolean('include_experience')->default(true);
            $table->boolean('include_education')->default(true);
            $table->boolean('include_projects')->default(false);
            $table->boolean('include_certifications')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resume_settings');
    }
};
