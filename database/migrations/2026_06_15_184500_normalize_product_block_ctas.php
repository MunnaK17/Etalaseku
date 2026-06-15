<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('blocks')
            ->whereIn('type', ['product', 'digital_product'])
            ->orderBy('id')
            ->each(function ($block) {
                $content = json_decode($block->content ?: '{}', true);

                if (!is_array($content)) {
                    $content = [];
                }

                $content['cta_type'] = $block->type === 'digital_product' ? 'checkout' : 'whatsapp';
                unset($content['cta_url']);

                DB::table('blocks')
                    ->where('id', $block->id)
                    ->update(['content' => json_encode($content)]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
