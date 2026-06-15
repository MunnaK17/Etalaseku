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
        Schema::create('social_media_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->comment('Emoji or icon identifier');
            $table->string('url_pattern')->nullable();
            $table->string('base_url')->nullable();
            $table->string('category')->comment('social_media, marketplace, payment, communication, other');
            $table->string('color')->default('#6366f1');
            $table->string('cta_type')->default('external_link');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_media_templates');
    }
};
