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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('link_group_id')
                ->nullable()
                ->after('store_id')
                ->constrained('link_groups')
                ->onDelete('set null');

            $table->index(['store_id', 'link_group_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['link_group_id']);
            $table->dropColumn('link_group_id');
        });
    }
};
