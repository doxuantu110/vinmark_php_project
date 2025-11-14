<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;

    Route::prefix('admin')->group(function () {

        // Middleware to prevent authenticated admin from accessing login page
        Route::middleware(['check.auth.admin'])->group(function () {
            // Login routes
            Route::get('/login', [AdminAuthController::class,'showLoginForm'])->name('admin.login');
            Route::post('/login', [AdminAuthController::class,'login'])->name('admin.login.post');
        });

        Route::middleware(['auth.custom'])->group(function () {
             Route::get('/dashboard', function(){
            return view('admin.pages.dashboard');
        })->name('admin.dashboard');
        });

        Route::middleware(['permission:manage users'])->group(function () {
            // User management routes can be added here
            Route::get('/users', function(){
                return;
            })->name('admin.users.index');
        });
        
        // Logout route
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });    
?>