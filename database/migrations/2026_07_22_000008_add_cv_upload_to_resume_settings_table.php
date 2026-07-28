<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resume_settings', function (Blueprint $table) {
            // CV Upload Field
            $table->string('cv_file')->nullable()->after('include_certifications');
            $table->string('cv_filename')->nullable()->after('cv_file');
            
            // Use custom CV option
            $table->boolean('use_custom_cv')->default(false)->after('cv_filename');
        });
    }

    public function down(): void
    {
        Schema::table('resume_settings', function (Blueprint $table) {
            $table->dropColumn(['cv_file', 'cv_filename', 'use_custom_cv']);
        });
    }
};
