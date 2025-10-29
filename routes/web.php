<?php

use App\Http\Controllers\Clients\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\AuthController;
use App\Http\Controllers\Clients\HomeController;
use App\Http\Controllers\Clients\ProductController;
use App\Http\Controllers\Clients\OrderController;
use App\Http\Controllers\Clients\ReviewController;
use App\Http\Controllers\Clients\ContactController;
use App\Http\Controllers\Clients\WishlistController;
use App\Http\Controllers\Clients\SearchController;
use App\Http\Controllers\CartController;
use \App\Http\Controllers\CheckoutController;

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

    Route::prefix('account')->group(function () {
        Route::get('/', [AccountController::class, 'index'])->name('account');
        Route::put('/update', [AccountController::class, 'update'])->name('account.update');

        Route::post('/change-password', [AccountController::class, 'changePassword'])->name('account.change-password');

        // Add address
        Route::post('/addresses', [AccountController::class, 'addAddress'])->name('account.addresses.add');
        Route::put('/addresses/{id}', [AccountController::class, 'updatePrimaryAddress'])->name('account.addresses.update');
        Route::delete('/addresses/{id}', action: [AccountController::class, 'deleteAddress'])->name('account.addresses.delete');
    });
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/checkout/get-address', [CheckoutController::class, 'getAddress'])->name('checkout.getAddress');

    // Place Order Route
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');

    // Paypal route
    Route::post('/checkout/paypal', [CheckoutController::class, 'placeOrderPaypal'])->name('checkout.placeOrderPaypal');

    // MoMo routes
    Route::post('/checkout/momo', [CheckoutController::class, 'placeOrderMoMo'])->name('checkout.placeOrderMoMo');
    Route::get('/checkout/momo/return', [CheckoutController::class, 'momoReturn'])->name('checkout.momoReturn');
    Route::post('/checkout/momo/notify', [CheckoutController::class, 'momoNotify'])->name('checkout.momoNotify');

    // Order
    Route::get('/order/{id}', [OrderController::class, 'showOrder'])->name('order.show');
    // Cancel Order
    Route::post('/order/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('order.cancel');

    // Review Product
    Route::post('/review', [ReviewController::class, 'createReview']);
    Route::get('/review/{product}', [ReviewController::class, 'index']);

    //Wishlist Route
    Route::get('/wishlist',[WishListController::class,'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishListController::class,'addToWishList']);
    Route::post('/wishlist/remove', [WishListController::class,'removeWishListItem']);
});

// Product
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');

// Product Detail
Route::get('/product/{slug}', [ProductController::class, 'detail'])->name('product.detail');

// Add Cart Item
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

// ****** Handle Mini Cart ******
// Load Mini Cart
Route::get('/mini-cart', [CartController::class, 'loadMiniCart'])->name('cart.mini');

// Delete Cart Item
Route::post('/cart/remove', [CartController::class, 'removeFromMiniCart'])->name('cart.remove');

//Handle Page Cart
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeCart'])->name('cart.remove');

 // Contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'sendContact'])->name('contact');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');