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
        Schema::table('link_clicks', function (Blueprint $table) {
            if (!Schema::hasColumn('link_clicks', 'block_id')) {
                $table->unsignedBigInteger('block_id')->nullable()->after('product_id');
                $table->index('block_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('link_clicks', function (Blueprint $table) {
            if (Schema::hasColumn('link_clicks', 'block_id')) {
                $table->dropColumn('block_id');
            }
        });
    }
};