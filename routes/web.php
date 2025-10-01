<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\AuthController;

Route::get('/', function () {
    return view('clients.pages.home');
})->name('home');

Route::get('/about', function () {
    return view('clients.pages.about');
});

Route::get('/service', function () {
    return view('clients.pages.service');
});

Route::get('/team', function () {
    return view('clients.pages.team');
});

Route::get('/faq', function () {
    return view('clients.pages.faq');
});

// Registration Route
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('post-register');

Route::get('/activate/{token}', [AuthController::class, 'activateAccount'])->name('activateAccount');

// Login Route
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('post-login');

// Logout Route
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password Routes
Route::get('/forgot-password', [\App\Http\Controllers\Clients\ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [\App\Http\Controllers\Clients\ForgotPasswordController::class, 'sendResetLink'])->name('post-forgot-password');

Route::get('/reset-password/{token}', [\App\Http\Controllers\Clients\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [\App\Http\Controllers\Clients\ResetPasswordController::class, 'reset'])->name('password.update');
