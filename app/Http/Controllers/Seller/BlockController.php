<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Page;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlockController extends Controller
{
    /**
     * Display the block management dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        $store = $user->store;

        if (!$store) {
            return redirect()->route('seller.store.create')
                ->with('error', 'Anda perlu membuat toko terlebih dahulu.');
        }

        $pages = $store->user->pages()->orderBy('sort_order')->get();
        $defaultPage = $pages->where('is_default', true)->first();

        // If no default page exists, create or promote one
        if (!$defaultPage) {
            $defaultPage = Page::ensureDefaultForUser($user->id, 'Beranda', 0);
            $pages = $store->user->pages()->orderBy('sort_order')->get();
        }

        return view('seller.blocks.index', [
            'store' => $store,
            'pages' => $pages,
            'defaultPage' => $defaultPage,
            'products' => $store->products()->where('is_active', true)->get(),
        ]);
    }

    /**
     * Upload image for block editor.
     */
    public function uploadImage(Request $request)
    {
        // Log request for debugging
        \Log::info('Upload Image Request', [
            'has_file' => $request->hasFile('image'),
            'file' => $request->file('image'),
        ]);

        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,gif,webp|max:5120', // 5MB max
            'context' => 'nullable|in:block,product',
        ]);

        $user = auth()->user();

        if (!$user->store) {
            return response()->json(['success' => false, 'error' => 'Store tidak ditemukan'], 403);
        }

        try {
            $directory = ($validated['context'] ?? 'block') === 'product' ? 'product-blocks' : 'blocks';

            // Generate unique filename
            $filename = time() . '_' . Str::random(20) . '.' . $request->file('image')->getClientOriginalExtension();

            // Store the image in public disk
            $path = $request->file('image')->storeAs($directory, $filename, 'public');

            \Log::info('Image stored', ['path' => $path]);

            // Get full URL
            $url = url('storage/' . $path);

            return response()->json([
                'success' => true,
                'url' => $url,
                'path' => $path,
            ]);
        } catch (\Exception $e) {
            \Log::error('Upload failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'error' => 'Gagal upload gambar'
            ], 500);
        }
    }

    /**
     * Get blocks for a specific page (API endpoint).
     */
    public function getBlocks(Page $page)
    {
        $user = auth()->user();

        // Ensure page belongs to authenticated user
        if ($page->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $blocks = $page->blocks()->orderBy('sort_order')->get();

        return response()->json([
            'blocks' => $blocks,
            'page' => $page,
        ]);
    }

    /**
     * Store a new block.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $store = $user->store;
        $validated = $request->validate([
            'page_id' => 'required|exists:pages,id',
            'type' => 'required|in:link,text,image,video,social_connect,social_network,product,digital_product',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable',
            'thumbnail_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        // Verify page belongs to user
        $page = Page::findOrFail($validated['page_id']);
        if ($page->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Check if user can add digital product
        if ($validated['type'] === 'digital_product' && !$store->isPro()) {
            return response()->json([
                'error' => 'Digital Product hanya tersedia untuk paket Pro.'
            ], 403);
        }

        // Check block limit for Free users (max 5 blocks)
        if (!$store->isPro()) {
            $blockCount = $page->blocks()->count();
            if ($blockCount >= 5) {
                return response()->json([
                    'error' => 'Batas maksimal 5 block tercapai. Upgrade ke PRO untuk block unlimited!'
                ], 403);
            }
        }

        $content = $validated['content'] ?? null;
        if (in_array($validated['type'], ['social_connect', 'social_network'], true)) {
            $decodedContent = $content ? json_decode($content, true) : [];
            if (empty($decodedContent['socials']) || !is_array($decodedContent['socials'])) {
                return response()->json([
                    'error' => 'Pilih minimal satu platform sosial dan isi link/username.',
                ], 422);
            }
        }

        $content = $this->normalizeProductCtaContent(
            $validated['type'],
            $content,
            $store,
            $validated['title'] ?? null,
            $validated['thumbnail_url'] ?? null
        );

        // Get max sort_order for this page
        $maxSort = $page->blocks()->max('sort_order') ?? -1;

        $block = Block::create([
            'page_id' => $validated['page_id'],
            'type' => $validated['type'],
            'title' => $validated['title'] ?? null,
            'content' => $content,
            'thumbnail_url' => $validated['thumbnail_url'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
            'sort_order' => $validated['sort_order'] ?? ($maxSort + 1),
        ]);

        return response()->json([
            'success' => true,
            'block' => $block->fresh(),
            'message' => 'Block berhasil ditambahkan.',
        ]);
    }

    /**
     * Update a block.
     */
    public function update(Request $request, Block $block)
    {
        $user = auth()->user();

        // Verify block belongs to user
        if ($block->page->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable',
            'thumbnail_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        if (in_array($block->type, ['social_connect', 'social_network'], true)) {
            $decodedContent = isset($validated['content']) ? json_decode($validated['content'], true) : [];
            if (empty($decodedContent['socials']) || !is_array($decodedContent['socials'])) {
                return response()->json([
                    'error' => 'Pilih minimal satu platform sosial dan isi link/username.',
                ], 422);
            }
        }

        if (array_key_exists('content', $validated)) {
            $validated['content'] = $this->normalizeProductCtaContent(
                $block->type,
                $validated['content'],
                $user->store,
                $validated['title'] ?? $block->title,
                $validated['thumbnail_url'] ?? $block->thumbnail_url
            );
        }

        $block->update($validated);

        return response()->json([
            'success' => true,
            'block' => $block->fresh(),
            'message' => 'Block berhasil diperbarui.',
        ]);
    }

    /**
     * Toggle block active status.
     */
    public function toggleActive(Block $block)
    {
        $user = auth()->user();

        if ($block->page->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $block->update(['is_active' => !$block->is_active]);

        return response()->json([
            'success' => true,
            'block' => $block->fresh(),
            'message' => $block->is_active ? 'Block diaktifkan.' : 'Block dinonaktifkan.',
        ]);
    }

    /**
     * Reorder blocks within a page.
     */
    public function reorder(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'block_ids' => 'required|array',
            'block_ids.*' => 'exists:blocks,id',
        ]);

        DB::transaction(function () use ($validated, $user) {
            foreach ($validated['block_ids'] as $index => $blockId) {
                $block = Block::find($blockId);
                if ($block && $block->page->user_id === $user->id) {
                    $block->update(['sort_order' => $index]);
                }
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Urutan block berhasil diperbarui.',
        ]);
    }

    /**
     * Delete a block.
     */
    public function destroy(Block $block)
    {
        $user = auth()->user();

        if ($block->page->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $block->delete();

        return response()->json([
            'success' => true,
            'message' => 'Block berhasil dihapus.',
        ]);
    }

    /**
     * Create a new page.
     */
    public function createPage(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'slug' => 'required|string|max:100|alpha_dash',
        ]);

        // Check if slug already exists for this user
        $exists = Page::where('user_id', $user->id)
            ->where('slug', $validated['slug'])
            ->exists();

        if ($exists) {
            return response()->json([
                'error' => 'Slug sudah digunakan. Gunakan slug lain.'
            ], 422);
        }

        // Get max sort_order
        $maxSort = $user->pages()->max('sort_order') ?? -1;

        $page = Page::create([
            'user_id' => $user->id,
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'is_default' => false,
            'sort_order' => $maxSort + 1,
        ]);

        return response()->json([
            'success' => true,
            'page' => $page,
            'message' => 'Page berhasil dibuat.',
        ]);
    }

    /**
     * Delete a page.
     */
    public function destroyPage(Page $page)
    {
        $user = auth()->user();

        if ($page->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Cannot delete default page
        if ($page->is_default) {
            return response()->json([
                'error' => 'Tidak dapat menghapus page default.'
            ], 422);
        }

        $page->delete();

        return response()->json([
            'success' => true,
            'message' => 'Page berhasil dihapus.',
        ]);
    }

    /**
     * Edit a page - return page data for editing.
     */
    public function editPage(Page $page)
    {
        $user = auth()->user();

        if ($page->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json([
            'success' => true,
            'page' => $page,
        ]);
    }

    /**
     * Update a page.
     */
    public function updatePage(Request $request, Page $page)
    {
        $user = auth()->user();

        if ($page->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'slug' => 'required|string|max:100|alpha_dash',
        ]);

        // Check if slug already exists for this user (excluding current page)
        $exists = Page::where('user_id', $user->id)
            ->where('slug', $validated['slug'])
            ->where('id', '!=', $page->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'error' => 'Slug sudah digunakan. Gunakan slug lain.'
            ], 422);
        }

        $page->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
        ]);

        return response()->json([
            'success' => true,
            'page' => $page->fresh(),
            'message' => 'Page berhasil diperbarui.',
        ]);
    }

    /**
     * Import products to blocks.
     */
    public function importProducts(Store $store)
    {
        $user = auth()->user();

        if ($store->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = request()->validate([
            'page_id' => 'required|exists:pages,id',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $page = Page::findOrFail($validated['page_id']);
        $maxSort = $page->blocks()->max('sort_order') ?? -1;

        $blocks = [];
        $index = 0;

        foreach ($validated['product_ids'] as $productId) {
            $product = Product::find($productId);
            if ($product && $product->store_id === $store->id) {
                $index++;
                $content = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'emoji' => $product->emoji,
                    'description' => $product->description,
                    'price' => $product->price,
                    'image' => $product->image,
                    'cta_type' => $product->product_type === 'digital' ? 'checkout' : 'whatsapp',
                ];

                $blocks[] = Block::create([
                    'page_id' => $page->id,
                    'type' => $product->product_type === 'digital' ? 'digital_product' : 'product',
                    'title' => $product->name,
                    'content' => json_encode($content),
                    'thumbnail_url' => $product->image,
                    'is_active' => $product->is_active,
                    'sort_order' => $maxSort + $index,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'blocks' => $blocks,
            'message' => count($blocks) . ' produk berhasil diimpor sebagai block.',
        ]);
    }

    /**
     * Keep product block CTA data valid, and create a checkout Product when needed.
     */
    private function normalizeProductCtaContent(
        string $type,
        mixed $content,
        Store $store,
        ?string $title,
        ?string $thumbnailUrl
    ): mixed
    {
        if (!in_array($type, ['product', 'digital_product'], true)) {
            return $content;
        }

        $data = is_array($content) ? $content : json_decode($content ?: '{}', true);

        if (!is_array($data)) {
            $data = [];
        }

        $ctaType = $data['cta_type'] ?? ($type === 'digital_product' ? 'checkout' : 'whatsapp');
        $data['cta_type'] = in_array($ctaType, ['whatsapp', 'checkout'], true) ? $ctaType : 'whatsapp';

        if ($type === 'product') {
            $data['cta_type'] = 'whatsapp';
            unset($data['product_id']);
        }

        unset($data['cta_url']);

        if ($data['cta_type'] === 'checkout') {
            $data['product_id'] = $this->syncCheckoutProduct(
                $store,
                $type,
                $data,
                $title,
                $thumbnailUrl
            )->id;
        }

        return json_encode($data);
    }

    private function syncCheckoutProduct(
        Store $store,
        string $blockType,
        array $content,
        ?string $title,
        ?string $thumbnailUrl
    ): Product {
        $product = null;

        if (!empty($content['product_id'])) {
            $product = Product::where('store_id', $store->id)
                ->where('id', $content['product_id'])
                ->first();
        }

        if (!$product) {
            $product = new Product([
                'store_id' => $store->id,
                'sort_order' => (Product::where('store_id', $store->id)->max('sort_order') ?? 0) + 1,
            ]);
        }

        $product->fill([
            'name' => $title ?: 'Produk',
            'emoji' => $content['emoji'] ?? null,
            'description' => $content['description'] ?? null,
            'price' => (int) ($content['price'] ?? 0),
            'image' => $thumbnailUrl,
            'thumbnail' => $thumbnailUrl,
            'product_type' => $blockType === 'digital_product' ? 'digital' : 'physical',
            'display_style' => 'card',
            'cta_type' => 'checkout',
            'cta_url' => null,
            'is_active' => true,
        ]);

        $product->save();

        return $product;
    }
}
