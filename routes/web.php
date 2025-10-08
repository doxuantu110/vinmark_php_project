<?php

use App\Http\Controllers\Clients\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\AuthController;
use App\Http\Controllers\Clients\HomeController;
use App\Http\Controllers\Clients\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('clients.pages.about');
})->name('about');

Route::get('/service', function () {
    return view('clients.pages.service');
})->name('service');

Route::get('/team', function () {
    return view('clients.pages.team');
})->name('team');

Route::get('/faq', function () {
    return view('clients.pages.faq');
})->name('faq');

// guest routes
Route::middleware('guest')->group(function () {

    // Registration Route
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('post-register');

    // Login Route
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('post-login');

    // Forgot Password Routes
    Route::get('/forgot-password', [\App\Http\Controllers\Clients\ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password');
    Route::post('/forgot-password', [\App\Http\Controllers\Clients\ForgotPasswordController::class, 'sendResetLink'])->name('post-forgot-password');

    Route::get('/reset-password/{token}', [\App\Http\Controllers\Clients\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\Clients\ResetPasswordController::class, 'reset'])->name('password.update');
});

// Email Verification Route
Route::get('/activate/{token}', [AuthController::class, 'activateAccount'])->name('activateAccount');

// Logout Route
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware protected routes
Route::middleware(['auth.custom'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('account')->group(function (){
        Route::get('/', [AccountController::class, 'index'])->name('account');
        Route::put('/update', [AccountController::class, 'update'])->name('account.update');

        Route::post('/change-password', [AccountController::class, 'changePassword'])->name('account.change-password');

        // Add address
        Route::post('/addresses', [AccountController::class, 'addAddress'])->name('account.addresses.add');
        Route::put('/addresses/{id}', [AccountController::class, 'updatePrimaryAddress'])->name('account.addresses.update');
        Route::delete('/addresses/{id}', action: [AccountController::class, 'deleteAddress'])->name('account.addresses.delete');
    });
});

// Product
Route::get('/product', [ProductController::class, 'index'])->name('products.index');