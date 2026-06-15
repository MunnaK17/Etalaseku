<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('inclusive_applications', function (Blueprint $table) {
            // Add applicant contact info (bisa langsung apply tanpa login)
            if (!Schema::hasColumn('inclusive_applications', 'applicant_name')) {
                $table->string('applicant_name')->nullable()->after('expected_benefits');
            }
            if (!Schema::hasColumn('inclusive_applications', 'whatsapp')) {
                $table->string('whatsapp')->nullable()->after('applicant_name');
            }
            if (!Schema::hasColumn('inclusive_applications', 'email')) {
                $table->string('email')->nullable()->after('whatsapp');
            }

            // Add file upload paths
            if (!Schema::hasColumn('inclusive_applications', 'ktp_file')) {
                $table->string('ktp_file')->nullable()->after('email');
            }
            if (!Schema::hasColumn('inclusive_applications', 'certificate_file')) {
                $table->string('certificate_file')->nullable()->after('ktp_file');
            }

            // Add rejection reason
            if (!Schema::hasColumn('inclusive_applications', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable()->after('admin_notes');
            }

            // Add user account info (after approved)
            if (!Schema::hasColumn('inclusive_applications', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('certificate_file');
            }
            if (!Schema::hasColumn('inclusive_applications', 'temp_password')) {
                $table->string('temp_password')->nullable()->after('user_id');
            }

            // Add indexes only if they don't exist
            if (!$this->indexExists('inclusive_applications', 'inclusive_applications_status_index')) {
                $table->index('status');
            }
            if (!$this->indexExists('inclusive_applications', 'inclusive_applications_status_created_at_index')) {
                $table->index(['status', 'created_at']);
            }
        });

        // Add foreign key for user only if it doesn't exist
        if (!Schema::hasColumn('inclusive_applications', 'user_id')) {
            Schema::table('inclusive_applications', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            });
        }
    }

    /**
     * Check if an index exists.
     */
    private function indexExists(string $table, string $index): bool
    {
        return DB::select("SHOW INDEX FROM {$table} WHERE Key_name = ?", [$index]) !== [];
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inclusive_applications', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn([
                'applicant_name',
                'whatsapp',
                'email',
                'ktp_file',
                'certificate_file',
                'rejection_reason',
                'user_id',
                'temp_password',
            ]);
        });
    }
};
