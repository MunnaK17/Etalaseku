


<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'store' => null,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'store' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    // Handle both array (dummy) and Model (real) data
    $isModel = is_object($store) && method_exists($store, 'products');
    $storeName = $isModel ? $store->name : ($store['name'] ?? 'Store Name');
    $username = $isModel ? $store->username : ($store['username'] ?? 'store');
    $aboutText = $isModel ? $store->about_text : ($store['about_text'] ?? '');
    $description = $isModel ? $store->description : ($store['description'] ?? '');
    $category = $isModel ? ($store->category ?? $store->description) : ($store['category'] ?? '');
    $logoInitial = $isModel ? substr($storeName, 0, 1) : ($store['logo_initial'] ?? substr($storeName, 0, 1));
    $isVerified = $isModel ? $store->is_verified_seller : ($store['is_verified'] ?? false);
    $isInclusive = $isModel ? $store->is_inclusive_seller : ($store['is_inclusive'] ?? false);

    // Header gradient
    $headerStart = $isModel ? ($store->header_gradient_start ?? '#4F46E5') : ($store['header_gradient_start'] ?? '#4F46E5');
    $headerEnd = $isModel ? ($store->header_gradient_end ?? '#4338CA') : ($store['header_gradient_end'] ?? '#4338CA');
    $headerStyle = "background: linear-gradient(135deg, {$headerStart} 0%, {$headerEnd} 100%);";

    // Products
    if ($isModel) {
        $products = $store->activeProducts->take(2);
        $productCount = $store->products()->count();
    } else {
        $products = collect($store['products'] ?? [])->take(2);
        $productCount = count($store['products'] ?? []);
    }

    // CTA Button Color
    $buttonColor = $isModel ? ($store->cta_button_color ?? '#25D366') : ($store['cta_button_color'] ?? '#25D366');

    // WhatsApp
    $whatsappLink = $isModel ? $store->whatsapp_link : ($store['whatsapp_link'] ?? '#');

    // Stats (for model, count events instead of direct columns)
    if ($isModel) {
        // Get product count
        $totalProducts = $store->products()->count();
        // Get visit count from analytics (count page_view events)
        $totalVisits = $store->analytics()->where('event_type', 'page_view')->count();
        // Get order count
        $totalOrders = $store->orders()->count();
    } else {
        $totalProducts = $store['stats']['products'] ?? $productCount;
        $totalVisits = $store['stats']['visits'] ?? 0;
        $totalOrders = $store['stats']['orders'] ?? 0;
    }

    // Format numbers
    $formatNumber = function($num) {
        if ($num >= 1000) {
            return number_format($num / 1000, 1) . 'K';
        }
        return $num;
    };
?>

<article class="store-preview-card flex-shrink-0 w-[280px] md:w-[300px] rounded-2xl overflow-hidden border shadow-lg transition-all duration-300 hover:scale-[1.03] hover:shadow-2xl hover:-translate-y-1"
         style="background: var(--bg-primary); border-color: var(--border-color);">

    
    <div class="h-14 relative" style="<?php echo e($headerStyle); ?>">
        
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <pattern id="dots-<?php echo e($username); ?>" x="0" y="0" width="10" height="10" patternUnits="userSpaceOnUse">
                    <circle cx="2" cy="2" r="1" fill="white"/>
                </pattern>
                <rect fill="url(#dots-<?php echo e($username); ?>)" width="100%" height="100%"/>
            </svg>
        </div>

        
        <div class="absolute bottom-0 left-3 translate-y-1/2">
            <?php if($isModel && $store->logo): ?>
                <img src="<?php echo e($store->logo); ?>"
                     alt="<?php echo e($storeName); ?>"
                     class="w-11 h-11 rounded-xl object-cover border-2 border-white shadow-md">
            <?php else: ?>
                <div class="w-11 h-11 rounded-xl flex items-center justify-center text-lg font-bold border-2 border-white shadow-md"
                     style="background: <?php echo e($headerStart); ?>; color: white;">
                    <?php echo e($logoInitial); ?>

                </div>
            <?php endif; ?>
        </div>

        
        <div class="absolute bottom-0 right-3 translate-y-1/2 flex gap-1">
            <?php if($isVerified): ?>
                <div class="w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center" title="Verified">
                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </div>
            <?php endif; ?>
            <?php if($isInclusive): ?>
                <div class="w-5 h-5 bg-amber-500 rounded-full flex items-center justify-center" title="Inclusive Seller">
                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                    </svg>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="px-3 pt-6 pb-2">
        <div class="flex items-start justify-between gap-2">
            <div class="flex-1 min-w-0">
                <h3 class="font-bold text-sm truncate" style="color: var(--text-primary);"><?php echo e($storeName); ?></h3>
                <?php if($category || $description): ?>
                    <p class="text-[10px] mt-0.5 leading-tight line-clamp-1" style="color: var(--text-secondary);">
                        <?php echo e($category ?: $description); ?>

                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="px-3 pb-2">
        <div class="grid grid-cols-2 gap-2">
            <?php if($products->count() > 0): ?>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="rounded-lg p-2 text-center" style="background: var(--bg-secondary);">
                        <?php if($isModel): ?>
                            <div class="w-full aspect-square rounded-md mb-1.5 overflow-hidden" style="background: var(--bg-tertiary);">
                                <?php if($product->image): ?>
                                    <img src="<?php echo e($product->image); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-2xl">
                                        <?php echo e($product->emoji ?? '📦'); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                            <p class="text-[10px] font-medium truncate leading-tight" style="color: var(--text-primary);">
                                <?php echo e($product->name); ?>

                            </p>
                            <p class="text-[9px] font-bold mt-0.5" style="color: <?php echo e($buttonColor); ?>;">
                                Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                            </p>
                        <?php else: ?>
                            <div class="w-full aspect-square rounded-md mb-1.5 flex items-center justify-center text-2xl" style="background: var(--bg-tertiary);">
                                <?php echo e($product['emoji'] ?? '📦'); ?>

                            </div>
                            <p class="text-[10px] font-medium truncate leading-tight" style="color: var(--text-primary);">
                                <?php echo e($product['name']); ?>

                            </p>
                            <p class="text-[9px] font-bold mt-0.5" style="color: <?php echo e($buttonColor); ?>;">
                                Rp <?php echo e(number_format($product['price'], 0, ',', '.')); ?>

                            </p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-span-2 rounded-lg p-3 text-center" style="background: var(--bg-secondary);">
                    <p class="text-xs" style="color: var(--text-muted);">Belum ada produk</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="px-3 pb-2">
        <div class="flex items-center gap-3 text-[10px]" style="color: var(--text-muted);">
            <span class="flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <?php echo e($totalProducts); ?> produk
            </span>
            <span class="flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                <?php echo e($formatNumber($totalVisits)); ?> kunjungan
            </span>
            <?php if($totalOrders > 0): ?>
            <span class="flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <?php echo e($totalOrders); ?> pesanan
            </span>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="px-3 py-2 border-t flex items-center justify-between" style="border-color: var(--border-color);">
        <div class="flex items-center gap-1">
            <img src="<?php echo e(asset('images/image4-removebg-preview.png')); ?>"
                 alt="Logo EtalaseKu"
                 class="h-4 w-auto object-contain">
            <span class="text-[9px] font-medium" style="color: var(--text-muted);">EtalaseKu</span>
        </div>
        <a href="<?php echo e($isModel ? $store->public_url : '#'); ?>"
           class="text-[9px] font-medium hover:underline truncate max-w-[120px]"
           style="color: var(--accent);">
            @etalaseku/<?php echo e($username); ?>

        </a>
    </div>
</article>
<?php /**PATH C:\laragon\www\EtalaseKU\resources\views/components/store-preview-card.blade.php ENDPATH**/ ?>