<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopkeeperController;
use App\Http\Controllers\CustomerProfileController;

Route::get('/', function () {
    return view('index');
});


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Shopkeeper Dashboard Routes
Route::middleware('auth')->prefix('dashboard/shopkeeper')->group(function () {
    Route::get('/', [ShopkeeperController::class, 'dashboard'])->name('shopkeeper.dashboard');
    Route::get('/products', [ShopkeeperController::class, 'products'])->name('shopkeeper.products');
    Route::get('/orders', [ShopkeeperController::class, 'orders'])->name('shopkeeper.orders');
    Route::get('/analytics', [ShopkeeperController::class, 'analytics'])->name('shopkeeper.analytics');
    Route::get('/customers', [ShopkeeperController::class, 'customers'])->name('shopkeeper.customers');
    Route::get('/settings', [ShopkeeperController::class, 'settings'])->name('shopkeeper.settings');
});

Route::get('/dashboard/customer', function () {
    $products = collect(); // Empty collection as fallback
    $orders = collect(); // Empty collection as fallback
    
    try {
        $products = \App\Models\Product::where('is_active', true)->where('stock_quantity', '>', 0)->with('shopkeeper')->get();
        $orders = \App\Models\Order::where('customer_id', Auth::id())->with(['product', 'shopkeeper'])->orderBy('created_at', 'desc')->get();
    } catch (\Exception $e) {
        // Tables might not exist yet, use empty collections
    }
    
    return view('dashboard.customer', compact('products', 'orders'));
})->middleware('auth');

// Product Routes
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->middleware('auth');
Route::put('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->middleware('auth');
Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->middleware('auth');

// Order Routes
Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->middleware('auth');
Route::post('/orders/bulk', [App\Http\Controllers\OrderController::class, 'storeBulk'])->middleware('auth');
Route::put('/orders/{order}/status', [App\Http\Controllers\OrderController::class, 'updateStatus'])->middleware('auth');
Route::post('/orders/{order}/accept', [App\Http\Controllers\OrderController::class, 'acceptOrder'])->middleware('auth');
Route::post('/orders/{order}/cancel', [App\Http\Controllers\OrderController::class, 'cancelOrder'])->middleware('auth');
Route::post('/orders/{order}/flag', [App\Http\Controllers\OrderController::class, 'flagOrder'])->middleware('auth');
Route::post('/orders/{order}/received', [App\Http\Controllers\OrderController::class, 'markOrderReceived'])->middleware('auth');
Route::post('/orders/{order}/feedback', [App\Http\Controllers\OrderController::class, 'submitFeedback'])->middleware('auth');
Route::post('/orders/{order}/cancel-customer', [App\Http\Controllers\OrderController::class, 'cancelCustomerOrder'])->middleware('auth');
Route::get('/orders/pending', [App\Http\Controllers\OrderController::class, 'getPendingOrders'])->middleware('auth');
Route::get('/notifications', [App\Http\Controllers\OrderController::class, 'notifications'])->middleware('auth');

// Chat Routes
Route::get('/chats', [App\Http\Controllers\ChatController::class, 'getChatsForShopkeeper'])->middleware('auth');
Route::get('/chats/{customerId}', [App\Http\Controllers\ChatController::class, 'getConversation'])->middleware('auth');
Route::post('/chats/send', [App\Http\Controllers\ChatController::class, 'sendMessage'])->middleware('auth');
Route::post('/chats/send-customer', [App\Http\Controllers\ChatController::class, 'sendMessageFromCustomer'])->middleware('auth');
Route::get('/chats/unread/count', [App\Http\Controllers\ChatController::class, 'getUnreadCount'])->middleware('auth');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
});

Route::middleware('auth')->group(function () {
    Route::post('/profile/update', [ProfileController::class, 'updateProfile']);
    Route::get('/profile', [ProfileController::class, 'getProfile']);
    // Customer personal profile (name + phone)
    Route::get('/customer/profile', [CustomerProfileController::class, 'show']);
    Route::post('/customer/profile', [CustomerProfileController::class, 'update']);
});
