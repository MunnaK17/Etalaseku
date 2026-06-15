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
        Schema::table('stores', function (Blueprint $table) {
            $table->string('payout_bank_name')->nullable()->after('whatsapp');
            $table->string('payout_account_number', 50)->nullable()->after('payout_bank_name');
            $table->string('payout_account_name')->nullable()->after('payout_account_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn([
                'payout_bank_name',
                'payout_account_number',
                'payout_account_name',
            ]);
        });
    }
};
