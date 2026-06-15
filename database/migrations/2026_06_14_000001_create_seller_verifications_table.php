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
        Schema::create('seller_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('store_id')->constrained()->onDelete('cascade');

            // Personal Info
            $table->string('nik', 20)->nullable(); // KTP Number
            $table->string('full_name')->nullable();

            // Business Info
            $table->string('business_name')->nullable();
            $table->string('business_type')->nullable(); // personal/company/cooperative
            $table->string('nib_number', 50)->nullable(); // NIB Number

            // Documents (file paths)
            $table->string('ktp_path')->nullable();
            $table->string('npwp_path')->nullable();
            $table->string('siu_path')->nullable(); // Surat Izin Usaha
            $table->string('selfie_with_ktp_path')->nullable();

            // Status
            $table->string('status')->default('pending'); // pending/verified/rejected
            $table->text('admin_notes')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_verifications');
    }
};
