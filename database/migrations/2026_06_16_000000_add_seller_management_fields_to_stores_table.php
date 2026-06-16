<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            // Hiding field
            $table->boolean('is_hidden')->default(false)->after('is_active');

            // Suspension fields
            $table->boolean('is_suspended')->default(false)->after('is_hidden');
            $table->string('suspended_reason')->nullable()->after('is_suspended');
            $table->timestamp('suspended_at')->nullable()->after('suspended_reason');
            $table->unsignedBigInteger('suspended_by')->nullable()->after('suspended_at');

            // Inclusive tracking
            $table->timestamp('inclusive_granted_at')->nullable()->after('is_inclusive_seller');
            $table->timestamp('inclusive_revoked_at')->nullable()->after('inclusive_granted_at');
            $table->unsignedBigInteger('inclusive_reviewed_by')->nullable()->after('inclusive_revoked_at');
        });
    }

    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn([
                'is_hidden',
                'is_suspended',
                'suspended_reason',
                'suspended_at',
                'suspended_by',
                'inclusive_granted_at',
                'inclusive_revoked_at',
                'inclusive_reviewed_by',
            ]);
        });
    }
};
