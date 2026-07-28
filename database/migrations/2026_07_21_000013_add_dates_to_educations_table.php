<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('educations', function (Blueprint $table) {
            $table->renameColumn('start_year', 'start_date');
            $table->renameColumn('end_year', 'end_date');
        });
    }

    public function down(): void
    {
        Schema::table('educations', function (Blueprint $table) {
            $table->renameColumn('start_date', 'start_year');
            $table->renameColumn('end_date', 'end_year');
        });
    }
};
