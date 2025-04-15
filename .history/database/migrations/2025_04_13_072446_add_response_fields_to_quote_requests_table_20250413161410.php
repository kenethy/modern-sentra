<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('quote_requests', function (Blueprint $table) {
            $table->enum('response_status', ['pending', 'accepted', 'rejected', 'negotiation'])->default('pending')->after('status');
            $table->text('response_message')->nullable()->after('response_status');
            $table->text('rejection_reason')->nullable()->after('response_message');
            $table->decimal('quoted_price', 15, 2)->nullable()->after('rejection_reason');
            $table->enum('response_method', ['email', 'whatsapp', 'both'])->nullable()->after('quoted_price');
            $table->timestamp('responded_at')->nullable()->after('response_method');
            $table->text('admin_notes')->nullable()->after('responded_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quote_requests', function (Blueprint $table) {
            //
        });
    }
};
