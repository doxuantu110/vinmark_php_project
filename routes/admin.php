<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;

    Route::prefix('admin')->group(function () {
        
        Route::get('/dashboard', function(){
            return view('admin.pages.dashboard');
        })->name('admin.dashboard');

        // Login routes

        Route::get('/login', [AdminAuthController::class,'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class,'login'])->name('admin.login.post');

        // Logout route
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });    
?>