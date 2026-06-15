<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminSubscriptionController;
use App\Http\Controllers\Admin\AdminVerificationController;
use App\Http\Controllers\Admin\AdminWithdrawalController;
use App\Http\Controllers\InclusivePublicController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\PublicStoreController;
use App\Http\Controllers\Seller\AppearanceController;
use App\Http\Controllers\Seller\BlockController;
use App\Http\Controllers\Seller\CheckoutController;
use App\Http\Controllers\Seller\InclusiveProgramController;
use App\Http\Controllers\Seller\SellerVerificationController;
use App\Http\Controllers\Seller\LinkGroupController;
use App\Http\Controllers\Seller\OnboardingController;
use App\Http\Controllers\Seller\QrCodeController;
use App\Http\Controllers\Seller\StoreController;
use App\Http\Controllers\Seller\SubscriptionController;
use App\Http\Controllers\Seller\WalletController;
use App\Http\Controllers\Seller\WithdrawalController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('home');

// Inclusive Program Public Routes
Route::get('/inclusive-program', [InclusivePublicController::class, 'showForm'])->name('inclusive-program.form');
Route::post('/inclusive-program', [InclusivePublicController::class, 'submit'])->name('inclusive-program.submit');

// Authentication Routes (using Breeze)
require __DIR__ . '/auth.php';

// Seller Dashboard Routes (Protected)
Route::middleware(['auth', 'has.store'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/dashboard', [BlockController::class, 'index'])->name('dashboard');
    Route::get('/upgrade', [SubscriptionController::class, 'index'])->name('upgrade');
    Route::post('/upgrade', [SubscriptionController::class, 'checkout'])->name('upgrade.checkout');
    Route::get('/upgrade/payment/{order_id}', [SubscriptionController::class, 'payment'])->name('subscription.payment');
    Route::get('/upgrade/finish/{order_id}', [SubscriptionController::class, 'finish'])->name('subscription.finish');
    Route::post('/upgrade/callback', [SubscriptionController::class, 'callback'])->name('subscription.callback');
    Route::post('/notifications/mark-all-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.mark-all-read');
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::get('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw.form');
    Route::post('/wallet/withdraw', [WithdrawalController::class, 'store'])->name('wallet.withdraw.store');
    Route::get('/store', [StoreController::class, 'edit'])->name('store.edit');
    Route::patch('/store', [StoreController::class, 'update'])->name('store.update');
    Route::post('/store/toggle-active', [StoreController::class, 'toggleActive'])->name('store.toggle-active');
    Route::get('/appearance', [AppearanceController::class, 'index'])->name('appearance.index');
    Route::patch('/appearance', [AppearanceController::class, 'update'])->name('appearance.update');
    Route::get('/appearance/preview', [AppearanceController::class, 'preview'])->name('appearance.preview');
    Route::post('/appearance/preview-save', [AppearanceController::class, 'previewSave'])->name('appearance.preview-save');
    Route::post('/appearance/preview-clear', [AppearanceController::class, 'previewClear'])->name('appearance.preview-clear');
    Route::get('/verification', [SellerVerificationController::class, 'index'])->name('verification.index');
    Route::get('/verification/show', [SellerVerificationController::class, 'show'])->name('verification.show');
    Route::post('/verification', [SellerVerificationController::class, 'store'])->name('verification.store');
    Route::delete('/verification/{verification}', [SellerVerificationController::class, 'destroy'])->name('verification.destroy');
    Route::get('/links/groups', [LinkGroupController::class, 'index'])->name('links.groups.index');
    Route::post('/links/groups', [LinkGroupController::class, 'store'])->name('links.groups.store');
    Route::patch('/links/groups/{linkGroup}', [LinkGroupController::class, 'update'])->name('links.groups.update');
    Route::delete('/links/groups/{linkGroup}', [LinkGroupController::class, 'destroy'])->name('links.groups.destroy');
    Route::post('/links/groups/{linkGroup}/toggle-active', [LinkGroupController::class, 'toggleActive'])->name('links.groups.toggle-active');
    Route::post('/links/groups/reorder', [LinkGroupController::class, 'reorder'])->name('links.groups.reorder');
    Route::get('/qr-code', [QrCodeController::class, 'index'])->name('qr-code.index');
    Route::post('/qr-code/preview', [QrCodeController::class, 'preview'])->name('qr-code.preview');
    Route::post('/qr-code/download', [QrCodeController::class, 'download'])->name('qr-code.download');
    Route::post('/upload/image', [BlockController::class, 'uploadImage'])->name('upload.image');
    Route::get('/dashboard/blocks/{page}', [BlockController::class, 'getBlocks'])->name('dashboard.blocks');
    Route::post('/dashboard/blocks', [BlockController::class, 'store'])->name('dashboard.blocks.store');
    Route::patch('/dashboard/blocks/{block}', [BlockController::class, 'update'])->name('dashboard.blocks.update');
    Route::post('/dashboard/blocks/{block}/toggle', [BlockController::class, 'toggleActive'])->name('dashboard.blocks.toggle');
    Route::delete('/dashboard/blocks/{block}', [BlockController::class, 'destroy'])->name('dashboard.blocks.destroy');
    Route::post('/dashboard/blocks/reorder', [BlockController::class, 'reorder'])->name('dashboard.blocks.reorder');
    Route::post('/dashboard/pages', [BlockController::class, 'createPage'])->name('dashboard.pages.store');
    Route::patch('/dashboard/pages/{page}', [BlockController::class, 'updatePage'])->name('dashboard.pages.update');
    Route::delete('/dashboard/pages/{page}', [BlockController::class, 'destroyPage'])->name('dashboard.pages.destroy');
    Route::get('/orders', [CheckoutController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [CheckoutController::class, 'showOrder'])->name('orders.show');
});

// Onboarding Routes (Protected - For users without store)
Route::middleware(['auth'])->group(function () {
    Route::get('/onboarding', [OnboardingController::class, 'index'])->name('seller.onboarding');
    Route::post('/onboarding', [OnboardingController::class, 'store'])->name('seller.onboarding.store');
});

// Admin Routes (Protected - Admin Only)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/stores', [AdminController::class, 'stores'])->name('stores.index');
    Route::get('/stores/{store}', [AdminController::class, 'showStore'])->name('stores.show');
    Route::get('/inclusive-applications', [AdminController::class, 'inclusiveApplications'])->name('inclusive-applications.index');
    Route::get('/inclusive-applications/{application}', [AdminController::class, 'showApplication'])->name('inclusive-applications.show');
    Route::post('/inclusive-applications/{application}/approve', [AdminController::class, 'approveApplication'])->name('inclusive-applications.approve');
    Route::post('/inclusive-applications/{application}/reject', [AdminController::class, 'rejectApplication'])->name('inclusive-applications.reject');
    Route::get('/subscriptions', [AdminSubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/{subscription}', [AdminSubscriptionController::class, 'show'])->name('subscriptions.show');
    Route::patch('/subscriptions/{subscription}/status', [AdminSubscriptionController::class, 'updateStatus'])->name('subscriptions.update-status');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/approve', [AdminOrderController::class, 'approve'])->name('orders.approve');
    Route::post('/orders/{order}/reject', [AdminOrderController::class, 'reject'])->name('orders.reject');
    Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::post('/withdrawals/{withdrawal}/approve', [AdminWithdrawalController::class, 'approve'])->name('withdrawals.approve');
    Route::post('/withdrawals/{withdrawal}/reject', [AdminWithdrawalController::class, 'reject'])->name('withdrawals.reject');
    Route::get('/verifications', [AdminVerificationController::class, 'index'])->name('verifications.index');
    Route::get('/verifications/{verification}', [AdminVerificationController::class, 'show'])->name('verifications.show');
    Route::get('/verifications/{verification}/approve', function (App\Models\SellerVerification $verification) {
        return redirect()
            ->route('admin.verifications.show', $verification)
            ->with('error', 'Gunakan tombol Approve untuk memproses verifikasi.');
    });
    Route::get('/verifications/{verification}/reject', function (App\Models\SellerVerification $verification) {
        return redirect()
            ->route('admin.verifications.show', $verification)
            ->with('error', 'Gunakan tombol Reject untuk memproses verifikasi.');
    });
    Route::post('/verifications/{verification}/approve', [AdminVerificationController::class, 'approve'])->name('verifications.approve');
    Route::post('/verifications/{verification}/reject', [AdminVerificationController::class, 'reject'])->name('verifications.reject');
    Route::get('/verifications/{verification}/download/{document}', [AdminVerificationController::class, 'downloadDocument'])->name('verifications.download');
});

// Checkout Routes (Public)
Route::get('/checkout/{product}', [CheckoutController::class, 'show'])
    ->where('product', '[0-9]+')
    ->name('checkout.show');

Route::post('/checkout/{product}', [CheckoutController::class, 'process'])
    ->where('product', '[0-9]+')
    ->name('checkout.process');

Route::get('/checkout/success/{orderNumber}', [CheckoutController::class, 'success'])
    ->name('checkout.success');

Route::get('/checkout/payment/{orderNumber}', [CheckoutController::class, 'payment'])
    ->name('checkout.payment');

Route::post('/checkout/callback', [CheckoutController::class, 'callback'])
    ->name('checkout.callback');

// Tracking Routes (Public)
Route::get('/track/{product}/{event}', [TrackController::class, 'click'])
    ->name('track.click');

Route::post('/track/pageview/{username}', [TrackController::class, 'pageView'])
    ->name('track.pageview');

// Public Store Routes (Block-based pages)
Route::get('/{username}', [PublicPageController::class, 'show'])
    ->where('username', '[a-z0-9\-]+')
    ->name('public.store');

Route::get('/{username}/{slug}', [PublicPageController::class, 'showPage'])
    ->where('username', '[a-z0-9\-]+')
    ->where('slug', '[a-z0-9\-]+')
    ->name('public.store.page');

Route::post('/{username}/{product}/click', [PublicStoreController::class, 'productClick'])
    ->where('username', '[a-z0-9\-]+')
    ->name('public.product.click');

Route::get('/{username}/{product}/cta', [PublicStoreController::class, 'ctaClick'])
    ->where('username', '[a-z0-9\-]+')
    ->name('public.cta.click');

// Public API Routes
Route::post('/api/inclusive-program/submit', [InclusiveProgramController::class, 'submitPublic'])
    ->name('api.inclusive-program.submit');

// Social Media Templates API (Public)
Route::get('/api/templates', [App\Http\Controllers\Api\SocialMediaTemplateController::class, 'index'])
    ->name('api.templates.index');
Route::get('/api/templates/category/{category}', [App\Http\Controllers\Api\SocialMediaTemplateController::class, 'byCategory'])
    ->name('api.templates.category');
Route::get('/api/templates/{slug}', [App\Http\Controllers\Api\SocialMediaTemplateController::class, 'show'])
    ->name('api.templates.show');
