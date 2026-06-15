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
        if ($this->indexExists('pages_slug_unique')) {
            DB::statement('ALTER TABLE `pages` DROP INDEX `pages_slug_unique`');
        }

        if (!$this->indexExists('pages_user_id_slug_unique')) {
            DB::statement('ALTER TABLE `pages` ADD UNIQUE `pages_user_id_slug_unique` (`user_id`, `slug`)');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if ($this->indexExists('pages_user_id_slug_unique')) {
            DB::statement('ALTER TABLE `pages` DROP INDEX `pages_user_id_slug_unique`');
        }
    }

    private function indexExists(string $indexName): bool
    {
        $database = DB::getDatabaseName();

        return !empty(DB::select(
            'SELECT 1 FROM information_schema.statistics WHERE table_schema = ? AND table_name = ? AND index_name = ? LIMIT 1',
            [$database, 'pages', $indexName]
        ));
    }
};
