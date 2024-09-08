<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products/{slug?}/{subSlug?}', [\App\Http\Controllers\ProductController::class, 'showListProduct'])
    ->name('product-category.list');

Route::get('/product/{slug}', [\App\Http\Controllers\ProductController::class, 'showDetailProduct'])
    ->name('product.detail');

Route::post('/product-filter', [\App\Http\Controllers\ProductController::class, 'filterProduct'])
    ->name('product.filter');

Route::get('/search', [\App\Http\Controllers\ProductController::class, 'searchProduct'])
    ->name('product.search');

Route::prefix('cart')->as('cart.')->group(function () {
    Route::get('/', [\App\Http\Controllers\CartController::class, 'viewCart'])->name('view');
    Route::post('/add-to-cart', [\App\Http\Controllers\CartController::class, 'addToCart'])->name('add-to-cart');
    Route::post('/update-cart', [\App\Http\Controllers\CartController::class, 'updateCart'])->name('update-cart');
    Route::get('/delete-cart/{id}', [\App\Http\Controllers\CartController::class, 'deleteCart'])
        ->name('delete-cart');
});

Route::prefix('checkout')->as('checkout.')->group(function () {
    Route::get('/', [\App\Http\Controllers\CheckoutController::class, 'showFormCheckout'])
        ->name('show-form-checkout');
    Route::post('/', [\App\Http\Controllers\CheckoutController::class, 'handleCheckout'])
        ->name('handle-checkout');
});

Route::get('/districts/{province_id}', [\App\Http\Controllers\LocationController::class, 'getDistricts'])
    ->name('get-districts');
Route::get('/wards/{districts_id}', [\App\Http\Controllers\LocationController::class, 'getWards'])
    ->name('get-wards');

Route::prefix('auth')->as('auth.')->group(function () {

    Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showFormRegister'])
        ->name('register.show');
    Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'handleRegister'])
        ->name('register');

    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'handleLogin'])->name('login');
    Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logOut'])->name('logout');

    Route::get('/verify-email/{token}', [\App\Http\Controllers\Auth\RegisterController::class, 'verifyEmail'])
        ->name('verify');

    Route::get('/forgot-password', [\App\Http\Controllers\Auth\ForgotPassswordController::class, 'showFormForgotPassword'])
        ->name('forgot-password.show');
    Route::post('/forgot-password', [\App\Http\Controllers\Auth\ForgotPassswordController::class, 'handleForgotPassword'])
        ->name('forgot-password');

    Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\ForgotPassswordController::class, 'showFormResetPassword'])
        ->name('reset-password.show');
    Route::post('/reset-password', [\App\Http\Controllers\Auth\ForgotPassswordController::class, 'handleResetPassword'])
        ->name('reset-password');
});

