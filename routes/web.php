<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminSubscriptionController;
use App\Http\Controllers\Admin\AdminWithdrawalController;
use App\Http\Controllers\PublicStoreController;
use App\Http\Controllers\Seller\CheckoutController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\InclusiveProgramController;
use App\Http\Controllers\Seller\OnboardingController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StoreController;
use App\Http\Controllers\Seller\SubscriptionController;
use App\Http\Controllers\Seller\WalletController;
use App\Http\Controllers\Seller\WithdrawalController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authentication Routes (using Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Seller Dashboard Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'has.store'])->prefix('seller')->name('seller.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Upgrade to Pro
    Route::get('/upgrade', [SubscriptionController::class, 'index'])->name('upgrade');
    Route::post('/upgrade', [SubscriptionController::class, 'checkout'])->name('upgrade.checkout');
    Route::get('/upgrade/payment/{order_id}', [SubscriptionController::class, 'payment'])->name('subscription.payment');
    Route::get('/upgrade/finish/{order_id}', [SubscriptionController::class, 'finish'])->name('subscription.finish');
    Route::post('/upgrade/callback', [SubscriptionController::class, 'callback'])->name('subscription.callback');

    // Notifications
    Route::post('/notifications/mark-all-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.mark-all-read');

    // Wallet & Withdrawal
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::get('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw.form');
    Route::post('/wallet/withdraw', [WithdrawalController::class, 'store'])->name('wallet.withdraw.store');

    // Store Settings
    Route::get('/store', [StoreController::class, 'edit'])->name('store.edit');
    Route::patch('/store', [StoreController::class, 'update'])->name('store.update');
    Route::post('/store/toggle-active', [StoreController::class, 'toggleActive'])->name('store.toggle-active');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/products/{product}/toggle-active', [ProductController::class, 'toggleActive'])->name('products.toggle-active');
    Route::post('/products/reorder', [ProductController::class, 'reorder'])->name('products.reorder');
});

/*
|--------------------------------------------------------------------------
| Onboarding Routes (Protected - For users without store)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/onboarding', [OnboardingController::class, 'index'])->name('seller.onboarding');
    Route::post('/onboarding', [OnboardingController::class, 'store'])->name('seller.onboarding.store');
});

/*
|--------------------------------------------------------------------------
| Public Store Routes
|--------------------------------------------------------------------------
*/
Route::get('/{username}', [PublicStoreController::class, 'show'])
    ->where('username', '[a-z0-9\-]+')
    ->name('public.store');

Route::post('/{username}/{product}/click', [PublicStoreController::class, 'productClick'])
    ->where('username', '[a-z0-9\-]+')
    ->name('public.product.click');

Route::get('/{username}/{product}/cta', [PublicStoreController::class, 'ctaClick'])
    ->where('username', '[a-z0-9\-]+')
    ->name('public.cta.click');

/*
|--------------------------------------------------------------------------
| Tracking Routes (Public)
|--------------------------------------------------------------------------
*/
Route::get('/track/{product}/{event}', [TrackController::class, 'click'])
    ->name('track.click');

Route::post('/track/pageview/{username}', [TrackController::class, 'pageView'])
    ->name('track.pageview');

/*
|--------------------------------------------------------------------------
| Checkout Routes (Public)
|--------------------------------------------------------------------------
*/
Route::get('/checkout/{product}', [CheckoutController::class, 'show'])
    ->name('checkout.show');

Route::post('/checkout/{product}', [CheckoutController::class, 'process'])
    ->name('checkout.process');

Route::get('/checkout/success/{orderNumber}', [CheckoutController::class, 'success'])
    ->name('checkout.success');

Route::get('/checkout/payment/{orderNumber}', [CheckoutController::class, 'payment'])
    ->name('checkout.payment');

Route::post('/checkout/callback', [CheckoutController::class, 'callback'])
    ->name('checkout.callback');

/*
|--------------------------------------------------------------------------
| Seller Orders Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'has.store'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/orders', [CheckoutController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [CheckoutController::class, 'showOrder'])->name('orders.show');
    Route::patch('/orders/{order}/status', [CheckoutController::class, 'updateStatus'])->name('orders.update-status');
});

/*
|--------------------------------------------------------------------------
| Inclusive Program Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'has.store'])->group(function () {
    Route::get('/inclusive-program', [InclusiveProgramController::class, 'index'])->name('seller.inclusive-program');
    Route::post('/inclusive-program', [InclusiveProgramController::class, 'submit'])->name('seller.inclusive-program.submit');
});

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
*/
Route::post('/api/inclusive-program/submit', [InclusiveProgramController::class, 'submitPublic'])
    ->name('api.inclusive-program.submit');

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected - Admin Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/stores', [AdminController::class, 'stores'])->name('stores.index');
    Route::get('/stores/{store}', [AdminController::class, 'showStore'])->name('stores.show');
    Route::get('/inclusive-applications', [AdminController::class, 'inclusiveApplications'])->name('inclusive-applications.index');
    Route::get('/inclusive-applications/{application}', [AdminController::class, 'showApplication'])->name('inclusive-applications.show');
    Route::post('/inclusive-applications/{application}/approve', [AdminController::class, 'approveApplication'])->name('inclusive-applications.approve');
    Route::post('/inclusive-applications/{application}/reject', [AdminController::class, 'rejectApplication'])->name('inclusive-applications.reject');

    // Subscriptions / Upgrade Pro
    Route::get('/subscriptions', [AdminSubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/{subscription}', [AdminSubscriptionController::class, 'show'])->name('subscriptions.show');
    Route::patch('/subscriptions/{subscription}/status', [AdminSubscriptionController::class, 'updateStatus'])->name('subscriptions.update-status');

    // Orders / Checkout Payments
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/approve', [AdminOrderController::class, 'approve'])->name('orders.approve');
    Route::post('/orders/{order}/reject', [AdminOrderController::class, 'reject'])->name('orders.reject');

    // Withdrawals
    Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::post('/withdrawals/{withdrawal}/approve', [AdminWithdrawalController::class, 'approve'])->name('withdrawals.approve');
    Route::post('/withdrawals/{withdrawal}/reject', [AdminWithdrawalController::class, 'reject'])->name('withdrawals.reject');
});