<?php

namespace App\Console\Commands;

use App\Models\Block;
use App\Models\Page;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateProductsToBlocks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:products-to-blocks
                            {--dry-run : Show what would be migrated without making changes}
                            {--force : Skip confirmation prompt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate existing products from the old products table to the new block-based system';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('🚀 Starting products to blocks migration...');
        $this->newLine();

        $isDryRun = $this->option('dry-run');
        $isForce = $this->option('force');

        if ($isDryRun) {
            $this->warn('⚠️  DRY RUN MODE - No changes will be made');
            $this->newLine();
        }

        // Get all users with products
        $usersWithProducts = DB::table('products')
            ->join('stores', 'products.store_id', '=', 'stores.id')
            ->join('users', 'stores.user_id', '=', 'users.id')
            ->select('users.id as user_id', 'users.name as user_name', 'stores.id as store_id', 'stores.username')
            ->groupBy('users.id', 'users.name', 'stores.id', 'stores.username')
            ->get();

        $totalUsers = $usersWithProducts->count();
        $totalProducts = Product::count();

        $this->info("📊 Found {$totalUsers} users with {$totalProducts} products");
        $this->newLine();

        if ($totalProducts === 0) {
            $this->info('✅ No products to migrate. Exiting.');
            return Command::SUCCESS;
        }

        // Confirmation prompt
        if (!$isForce && !$isDryRun) {
            $confirm = $this->confirm("Proceed with migration of {$totalProducts} products to blocks?", true);
            if (!$confirm) {
                $this->info('❌ Migration cancelled.');
                return Command::SUCCESS;
            }
        }

        $this->newLine();
        $this->info('📦 Processing migration...');
        $this->newLine();

        $progressBar = $this->output->createProgressBar($totalProducts);
        $progressBar->start();

        $stats = [
            'users_processed' => 0,
            'pages_created' => 0,
            'blocks_created' => 0,
            'products_skipped' => 0,
        ];

        DB::beginTransaction();

        try {
            foreach ($usersWithProducts as $userData) {
                $userId = $userData->user_id;
                $storeId = $userData->store_id;

                // Get or create default page for this user
                $page = Page::ensureDefaultForUser($userId, 'Home', 0);

                if ($page->wasRecentlyCreated) {
                    $stats['pages_created']++;
                    $this->line("  + Created page 'Home' for user: {$userData->user_name}");
                }

                // Get products for this store
                $products = Product::where('store_id', $storeId)
                    ->orderBy('sort_order')
                    ->get();

                if ($products->isEmpty()) {
                    continue;
                }

                $stats['users_processed']++;

                // Get max sort_order for existing blocks
                $maxSortOrder = $page->blocks()->max('sort_order') ?? -1;

                foreach ($products as $index => $product) {
                    if ($isDryRun) {
                        $stats['blocks_created']++;
                        $progressBar->advance();
                        continue;
                    }

                    // Check if product already migrated (has block with matching product_id in content)
                    $existingBlock = Block::where('page_id', $page->id)
                        ->where('type', 'product')
                        ->whereNotNull('content')
                        ->get()
                        ->first(function ($block) use ($product) {
                            $content = json_decode($block->content, true);
                            return isset($content['product_id']) && $content['product_id'] == $product->id;
                        });

                    if ($existingBlock) {
                        $stats['products_skipped']++;
                        $progressBar->advance();
                        continue;
                    }

                    // Get store for WhatsApp link
                    $store = Store::find($storeId);

                    // Build content JSON
                    $content = [
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'emoji' => $product->emoji ?? '',
                        'description' => $product->description ?? '',
                        'price' => $product->price ?? 0,
                        'image' => $product->image ?? '',
                        'thumbnail' => $product->thumbnail ?? '',
                        'cta_type' => $product->cta_type ?? 'whatsapp',
                        'cta_url' => $product->cta_url ?? '',
                        'whatsapp_link' => $store ? $store->whatsapp_link : '',
                        'checkout_url' => route('checkout.show', $product->id),
                    ];

                    // Create block
                    Block::create([
                        'page_id' => $page->id,
                        'type' => 'product',
                        'title' => $product->name,
                        'content' => json_encode($content),
                        'thumbnail_url' => $product->image ?: $product->thumbnail,
                        'is_active' => $product->is_active,
                        'sort_order' => $maxSortOrder + $index + 1,
                    ]);

                    $stats['blocks_created']++;
                    $progressBar->advance();
                }
            }

            if (!$isDryRun) {
                DB::commit();
            } else {
                DB::rollBack();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $this->newLine(2);
            $this->error('❌ Migration failed: ' . $e->getMessage());
            return Command::FAILURE;
        }

        $progressBar->finish();
        $this->newLine(2);

        // Summary
        $this->info('=' . str_repeat('=', 50));
        $this->info('📋 MIGRATION SUMMARY');
        $this->info('=' . str_repeat('=', 50));

        if ($isDryRun) {
            $this->warn('⚠️  DRY RUN - No actual changes were made');
            $this->newLine();
        }

        $this->table(
            ['Metric', 'Count'],
            [
                ['Users with products', $totalUsers],
                ['Users processed', $stats['users_processed']],
                ['Pages created', $stats['pages_created']],
                ['Products migrated to blocks', $stats['blocks_created']],
                ['Products skipped (already migrated)', $stats['products_skipped']],
            ]
        );

        $this->newLine();

        if (!$isDryRun) {
            $this->info('✅ Migration completed successfully!');
            $this->info('💡 Note: The old products table is preserved as backup.');
            $this->info('💡 You can verify the blocks in: /seller/dashboard');
        } else {
            $this->info('💡 Run without --dry-run to perform actual migration.');
        }

        return Command::SUCCESS;
    }
}
