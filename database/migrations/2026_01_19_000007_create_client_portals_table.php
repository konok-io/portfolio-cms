<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_portals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('project_name');
            $table->string('project_token', 64)->unique();
            $table->enum('status', ['in_progress', 'review', 'completed', 'on_hold'])->default('in_progress');
            $table->decimal('progress', 5, 2)->default(0);
            $table->text('notes')->nullable();
            $table->date('deadline')->nullable();
            $table->json('files')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_portals');
    }
};
