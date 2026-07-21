<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('newsletter_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->text('content');
            $table->enum('status', ['draft', 'scheduled', 'sending', 'sent', 'failed'])->default('draft');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->integer('total_recipients')->default(0);
            $table->integer('successful_deliveries')->default(0);
            $table->integer('failed_deliveries')->default(0);
            $table->timestamps();
        });

        // Add email_sent field to subscribers table (only if column doesn't exist)
        if (Schema::hasTable('subscribers') && !Schema::hasColumn('subscribers', 'email_sent_at')) {
            Schema::table('subscribers', function (Blueprint $table) {
                $table->timestamp('email_sent_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('subscribers') && Schema::hasColumn('subscribers', 'email_sent_at')) {
            Schema::table('subscribers', function (Blueprint $table) {
                $table->dropColumn('email_sent_at');
            });
        }
        
        Schema::dropIfExists('newsletter_campaigns');
    }
};
