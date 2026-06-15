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
            // Change banner and profile_image to longText to support base64 data URLs
            $table->longText('banner')->nullable()->change();
            $table->longText('profile_image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('banner')->nullable()->change();
            $table->string('profile_image')->nullable()->change();
        });
    }
};