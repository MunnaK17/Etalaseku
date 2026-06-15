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
        // Only add column if it doesn't exist
        if (!Schema::hasColumn('stores', 'font_family')) {
            Schema::table('stores', function (Blueprint $table) {
                $table->string('font_family', 100)->default('Inter')->after('background_image');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('stores', 'font_family')) {
            Schema::table('stores', function (Blueprint $table) {
                $table->dropColumn('font_family');
            });
        }
    }
};
