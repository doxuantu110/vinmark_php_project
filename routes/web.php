<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clients\AuthController;

Route::get('/', function () {
    return view('clients.pages.home');
});

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