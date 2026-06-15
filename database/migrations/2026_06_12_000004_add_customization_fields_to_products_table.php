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
            // Customization fields
            $table->string('emoji')->nullable()->after('name');
            $table->string('thumbnail')->nullable()->after('image');
            $table->string('display_style')->default('card')->after('product_type');
            $table->string('button_color')->nullable()->after('display_style');

            // Index for faster queries
            $table->index('display_style');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['emoji', 'thumbnail', 'display_style', 'button_color']);
        });
    }
};
