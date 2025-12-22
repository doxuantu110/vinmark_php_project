<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Middleware\DefaultAdminData;

Route::prefix('admin')->group(function () {

    // Middleware to prevent authenticated admin from accessing login page
    Route::middleware(['check.auth.admin'])->group(function () {
        // Login routes
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    });

    Route::middleware(['auth.custom', DefaultAdminData::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/profile', [AccountController::class, 'index'])->name('admin.profile');
        Route::post('/profile/update', [AccountController::class, 'update'])->name('profile.update');
        Route::get('/notifications',[NotificationController::class, 'index'])->name('admin.notifications.index');
        Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('admin.notifications.markAsRead');

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

        // Route management for users with 'manage_products' permission
        Route::middleware(['permission:manage_products'])->group(function () {
            // User management routes can be added here
            Route::get('/product/add', [ProductController::class, 'showFormAddProduct'])->name('admin.product.add');
            Route::post('/product/add', [ProductController::class, 'addProduct'])->name('admin.product.store');

            Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
            Route::post('/products/update', [ProductController::class, 'updateProduct']);
            Route::post('/products/delete', [ProductController::class, 'deleteProduct']);
        });

        // Route management for users with 'manage_orders' permission
        Route::middleware(['permission:manage_orders'])->group(function () {
            // User management routes can be added here
            Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
            // Xác nhận đơn hàng
            Route::post('/orders/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
            // Show order details route
            Route::get('/order-detail/{id}', [OrderController::class, 'showOrderDetail'])->name('admin.order-detail');
            // Send order detail email route
            Route::post('/orders-detail/send-invoice', [OrderController::class, 'sendInvoice']);
            // Cancel order route
            Route::post('/orders/cancel-order', [OrderController::class, 'cancelOrder']);
        });

        // Route management for users with 'manage_contact' permission
        Route::middleware(['permission:manage_contacts'])->group(function () {
            Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
            Route::post('/contact/reply', [ContactController::class, 'replyContact']);
        });
    });

    // Logout route
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});
