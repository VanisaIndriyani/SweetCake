<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;


// Halaman home publik
use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('home');

// Detail produk publik
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('produk.show');

// Halaman login & proses login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Halaman register & proses register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');


// ===========================
// Link verifikasi yang dikirim via email
Route::get('/verify-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');


//  DASHBOARD & LOGOUT (hanya untuk user login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Keranjang & Checkout (harus login)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // Payment page for uploading proof
    Route::get('/payment/{id}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/{id}', [PaymentController::class, 'store'])->name('payment.store');

    // Detail pesanan untuk user yang bersangkutan
    Route::get('/pesanan', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/pesanan/{id}', [OrderController::class, 'show'])->name('orders.show');
    // Notifikasi user
    Route::get('/notifikasi', [OrderController::class, 'notifications'])->name('orders.notifications');

    // Edit profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin area
use App\Http\Controllers\AdminController;
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/pesanan', [AdminController::class, 'orders'])->name('admin.orders.index');
    // Admin pages: products management, notifications, settings
    Route::get('/admin/produk', [AdminController::class, 'products'])->name('admin.products.index');
    Route::get('/admin/produk/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/admin/produk', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/admin/produk/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/admin/produk/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/admin/produk/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');
    Route::get('/admin/notifikasi', [AdminController::class, 'notifications'])->name('admin.notifications.index');
    Route::get('/admin/laporan', [AdminController::class, 'reports'])->name('admin.reports.index');
    Route::get('/admin/laporan/export', [AdminController::class, 'exportPdf'])->name('admin.reports.export');
    // Admin actions: update order status & verify payments
    Route::post('/admin/pesanan/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::post('/admin/pembayaran/{id}/verify', [AdminController::class, 'verifyPayment'])->name('admin.payments.verify');
    // Admin actions: create notification
    Route::post('/admin/notifikasi', [AdminController::class, 'storeNotification'])->name('admin.notifications.store');
});
