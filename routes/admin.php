<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UsersController;

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

        // Route management for users with 'manage_users' permission
        Route::middleware(['permission:manage_users'])->group(function () {
            // User management routes can be added here
            Route::get('/users', [UsersController::class, 'index'])->name('admin.users.index');
            Route::post('/user/upgrade', [UsersController::class, 'upgrade']);

            // Change user status route
            Route::post('/user/updateStatus', [UsersController::class, 'updateStatus']);
        });
        
        // Route management for users with 'manage_categories' permission
        Route::middleware(['permission:manage_categories'])->group(function () {
            // User management routes can be added here
            Route::get('/categories/add', [CategoryController::class, 'showFormAddCategory'])->name('admin.categories.add');
            Route::post('/categories/add', [CategoryController::class, 'addCategory'])->name('admin.categories.store');
            
            Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
            Route::post('/categories/update', [CategoryController::class, 'updateCategory']);
            Route::post('/categories/delete', [CategoryController::class, 'deleteCategory']);
        });

        // Logout route
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });     
?>