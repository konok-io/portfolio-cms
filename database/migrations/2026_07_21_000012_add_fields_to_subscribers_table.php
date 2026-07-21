<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('email');
            $table->timestamp('unsubscribed_at')->nullable()->after('subscribed_at');
            $table->timestamp('email_sent_at')->nullable()->after('unsubscribed_at');
        });
    }

    public function down(): void
    {
        Schema::table('subscribers', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'unsubscribed_at', 'email_sent_at']);
        });
    }
};
