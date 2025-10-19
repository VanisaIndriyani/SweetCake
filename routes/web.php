<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


// Halaman home publik
use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('home');

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
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin area
use App\Http\Controllers\AdminController;
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});
