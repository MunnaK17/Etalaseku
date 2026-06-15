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
            // Page Style
            $table->string('layout')->default('modern')->after('theme');
            $table->boolean('show_member_menu')->default(false)->after('layout');
            $table->string('banner')->nullable()->after('show_member_menu');
            $table->string('profile_image')->nullable()->after('banner');
            $table->text('about_text')->nullable()->after('profile_image');
            $table->string('profile_text_color')->default('#FFFFFF')->after('about_text');

            // Background
            $table->string('background_type')->default('flat')->after('profile_text_color');
            $table->string('background_color')->default('#FFFFFF')->after('background_type');
            $table->string('background_gradient_start')->nullable()->after('background_color');
            $table->string('background_gradient_end')->nullable()->after('background_gradient_start');
            $table->string('background_image')->nullable()->after('background_gradient_end');

            // Fonts
            $table->string('font_family')->default('Inter')->after('background_image');
            $table->string('heading_font_family')->nullable()->after('font_family');

            // Button Style
            $table->string('button_style')->default('box')->after('heading_font_family');
            $table->string('cta_button_style')->default('fill')->after('button_style');
            $table->string('cta_button_shape')->default('rounded')->after('cta_button_style');
            $table->string('cta_button_color')->default('#4F46E5')->after('cta_button_shape');
            $table->string('cta_button_text_color')->default('#FFFFFF')->after('cta_button_color');
            $table->boolean('cta_button_shadow')->default(false)->after('cta_button_text_color');

            // Social Links
            $table->string('social_telegram')->nullable()->after('cta_button_shadow');
            $table->string('social_website')->nullable()->after('social_telegram');
            $table->string('social_email')->nullable()->after('social_website');
            $table->string('social_discord')->nullable()->after('social_email');
            $table->string('social_tiktok')->nullable()->after('social_discord');
            $table->string('social_instagram')->nullable()->after('social_tiktok');
            $table->string('social_youtube')->nullable()->after('social_instagram');
            $table->string('social_twitch')->nullable()->after('social_youtube');
            $table->string('social_linkedin')->nullable()->after('social_twitch');
            $table->string('social_x')->nullable()->after('social_linkedin');
            $table->string('social_facebook')->nullable()->after('social_x');
            $table->string('social_behance')->nullable()->after('social_facebook');
            $table->string('social_dribbble')->nullable()->after('social_behance');
            $table->string('social_whatsapp')->nullable()->after('social_dribbble');
            $table->string('social_spotify')->nullable()->after('social_whatsapp');
            $table->string('social_threads')->nullable()->after('social_spotify');

            // Header Gradient Colors
            $table->string('header_gradient_start')->nullable()->after('social_threads');
            $table->string('header_gradient_end')->nullable()->after('header_gradient_start');

            // Indexes
            $table->index('layout');
            $table->index('font_family');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $columns = [
                'layout',
                'show_member_menu',
                'banner',
                'profile_image',
                'about_text',
                'profile_text_color',
                'background_type',
                'background_color',
                'background_gradient_start',
                'background_gradient_end',
                'background_image',
                'font_family',
                'heading_font_family',
                'button_style',
                'cta_button_style',
                'cta_button_shape',
                'cta_button_color',
                'cta_button_text_color',
                'cta_button_shadow',
                'social_telegram',
                'social_website',
                'social_email',
                'social_discord',
                'social_tiktok',
                'social_instagram',
                'social_youtube',
                'social_twitch',
                'social_linkedin',
                'social_x',
                'social_facebook',
                'social_behance',
                'social_dribbble',
                'social_whatsapp',
                'social_spotify',
                'social_threads',
                'header_gradient_start',
                'header_gradient_end',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('stores', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
