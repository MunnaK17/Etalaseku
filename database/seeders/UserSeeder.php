<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\Analytics;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. User seller biasa (tanpa store)
        $seller1 = User::create([
            'name' => 'Seller Biasa',
            'email' => 'seller@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 2. User admin
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@etalaseku.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 3. User seller peternak lele dengan store "Lele Pak Obit"
        $seller2 = User::create([
            'name' => 'Pak Obit',
            'email' => 'pakobit@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create store "Lele Pak Obit" dengan username `lelepakobit`
        $store = Store::create([
            'user_id' => $seller2->id,
            'name' => 'Lele Pak Obit',
            'username' => 'lelepakobit',
            'description' => 'Toko ikan lele segar dan berkualitas. Melayani penjualan eceran dan grosir untuk area sekitar.',
            'whatsapp' => '6281234567890',
            'theme' => 'minimal',
            'plan' => 'free',
            'is_inclusive_seller' => false,
            'is_active' => true,
        ]);

        // 4. Produk untuk store Lele Pak Obit
        $products = [
            [
                'name' => 'Paket Lele 50 Kg',
                'description' => 'Paket lele segar seberat 50 kg. Cocok untuk warung makan, restoran, atau cold storage. Ikan lele pilihan berkualitas export.',
                'price' => 1500000,
                'product_type' => 'physical',
                'cta_type' => 'whatsapp',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Paket Lele 100 Kg',
                'description' => 'Paket lele segar seberat 100 kg dengan harga lebih hemat. Free ongkir untuk area Jabodetabek.',
                'price' => 2800000,
                'product_type' => 'physical',
                'cta_type' => 'whatsapp',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Custom Order Lele',
                'description' => 'Pesan jumlah sesuai kebutuhan Anda. Bisa 20 kg, 30 kg, atau jumlah custom lainnya. Konsultasi gratis via WhatsApp!',
                'price' => null,
                'product_type' => 'custom',
                'cta_type' => 'whatsapp',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($products as $productData) {
            $product = $store->products()->create($productData);

            // Tambahkan beberapa analytics dummy
            $this->createDummyAnalytics($store, $product);
        }

        // Tambah analytics page view untuk store
        $this->createDummyPageViews($store);

        $this->command->info('Seeder berhasil dijalankan!');
        $this->command->info('---------------------------');
        $this->command->info('Akun demo:');
        $this->command->info('Admin: admin@etalaseku.test / password');
        $this->command->info('Seller: pakobit@example.com / password');
        $this->command->info('Store: etalaseku.test/lelepakobit');
    }

    /**
     * Create dummy analytics for a product.
     */
    protected function createDummyAnalytics(Store $store, Product $product): void
    {
        // Generate 5-15 random product clicks
        $clickCount = rand(5, 15);
        for ($i = 0; $i < $clickCount; $i++) {
            Analytics::create([
                'store_id' => $store->id,
                'product_id' => $product->id,
                'event_type' => Analytics::EVENT_PRODUCT_CLICK,
                'ip_address' => '192.168.1.' . rand(1, 255),
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
            ]);
        }

        // Generate 2-8 random CTA clicks
        $ctaClickCount = rand(2, 8);
        for ($i = 0; $i < $ctaClickCount; $i++) {
            Analytics::create([
                'store_id' => $store->id,
                'product_id' => $product->id,
                'event_type' => Analytics::EVENT_CTA_CLICK,
                'ip_address' => '192.168.1.' . rand(1, 255),
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
            ]);
        }
    }

    /**
     * Create dummy page views for a store.
     */
    protected function createDummyPageViews(Store $store): void
    {
        // Generate 20-50 random page views
        $viewCount = rand(20, 50);
        for ($i = 0; $i < $viewCount; $i++) {
            Analytics::create([
                'store_id' => $store->id,
                'product_id' => null,
                'event_type' => Analytics::EVENT_PAGE_VIEW,
                'ip_address' => '192.168.1.' . rand(1, 255),
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
            ]);
        }
    }
}
