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
        Schema::create('link_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('link_type'); // product_click, whatsapp_click, checkout_click, external_click, download_click, cta_click
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('clicked_at');
            $table->timestamps();

            // Indexes for analytics queries
            $table->index(['product_id', 'link_type']);
            $table->index(['product_id', 'clicked_at']);
            $table->index('clicked_at');
        });

        // Add click_count to products table
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('click_count')->default(0)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('click_count');
        });

        Schema::dropIfExists('link_clicks');
    }
};
