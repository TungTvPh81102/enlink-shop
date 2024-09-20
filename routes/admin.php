<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');

    // ROUTE CATEGORIES
    Route::prefix('categories')->as('categories.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\CategoryController::class, 'index'])
            ->name('index');
        Route::get('/create', [\App\Http\Controllers\Backend\CategoryController::class, 'create'])
            ->name('create');
        Route::post('/', [\App\Http\Controllers\Backend\CategoryController::class, 'store'])
            ->name('store');
        Route::post('/update-status', [\App\Http\Controllers\Backend\CategoryController::class, 'updateStatus'])
            ->name('updateStatus');
        Route::get('/{id}/edit', [\App\Http\Controllers\Backend\CategoryController::class, 'edit'])
            ->name('edit');
        Route::put('/{category}', [\App\Http\Controllers\Backend\CategoryController::class, 'update'])
            ->name('update');
        Route::delete('/{category}', [\App\Http\Controllers\Backend\CategoryController::class, 'destroy'])
            ->name('destroy');
    });

    // ROUTE BRANDS
    Route::prefix('brands')->as('brands.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\BrandController::class, 'index'])
            ->name('index');
        Route::get('/create', [\App\Http\Controllers\Backend\BrandController::class, 'create'])
            ->name('create');
        Route::get('/trash', [\App\Http\Controllers\Backend\BrandController::class, 'trash'])
            ->name('trash');
        Route::get('/restore/{id}', [\App\Http\Controllers\Backend\BrandController::class, 'restore'])
            ->name('restore');
        Route::post('/', [\App\Http\Controllers\Backend\BrandController::class, 'store'])
            ->name('store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Backend\BrandController::class, 'edit'])
            ->name('edit');
        Route::put('/{brand}', [\App\Http\Controllers\Backend\BrandController::class, 'update'])
            ->name('update');
        Route::delete('/{brand}', [\App\Http\Controllers\Backend\BrandController::class, 'destroy'])
            ->name('destroy');
    });

    // ROUTE SIZE
    Route::prefix('sizes')->as('sizes.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\SizeController::class, 'index'])
            ->name('index');
        Route::get('/create', [\App\Http\Controllers\Backend\SizeController::class, 'create'])
            ->name('create');
        Route::post('/', [\App\Http\Controllers\Backend\SizeController::class, 'store'])
            ->name('store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Backend\SizeController::class, 'edit'])
            ->name('edit');
        Route::put('/{size}', [\App\Http\Controllers\Backend\SizeController::class, 'update'])
            ->name('update');
    });

    // ROUTE COLOR
    Route::prefix('colors')->as('colors.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\ColorController::class, 'index'])
            ->name('index');
        Route::get('/create', [\App\Http\Controllers\Backend\ColorController::class, 'create'])
            ->name('create');
        Route::post('/', [\App\Http\Controllers\Backend\ColorController::class, 'store'])
            ->name('store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Backend\ColorController::class, 'edit'])
            ->name('edit');
        Route::put('/{color}', [\App\Http\Controllers\Backend\ColorController::class, 'update'])
            ->name('update');
    });

    // ROUTER COUPONS
    Route::prefix('coupons')->as('coupons.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\CouponController::class, 'index'])
            ->name('index');
        Route::get('/create', [\App\Http\Controllers\Backend\CouponController::class, 'create'])
            ->name('create');
        Route::post('/', [\App\Http\Controllers\Backend\CouponController::class, 'store'])
            ->name('store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Backend\CouponController::class, 'edit'])
            ->name('edit');
        Route::put('/{size}', [\App\Http\Controllers\Backend\CouponController::class, 'update'])
            ->name('update');
    });

    // ROUTE PRODUCTS
    Route::prefix('products')->as('products.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\ProductController::class, 'index'])
            ->name('index');
        Route::get('/create', [\App\Http\Controllers\Backend\ProductController::class, 'create'])
            ->name('create');
        Route::get('/trash', [\App\Http\Controllers\Backend\ProductController::class, 'trash'])
            ->name('trash');
        Route::get('/restore/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'restore'])
            ->name('restore');
        Route::post('/', [\App\Http\Controllers\Backend\ProductController::class, 'store'])
            ->name('store');
        Route::post('/gallery-sort', [\App\Http\Controllers\Backend\ProductController::class, 'gallerySort'])
            ->name('gallery.sort');
        Route::get('/{id}/edit', [\App\Http\Controllers\Backend\ProductController::class, 'edit'])
            ->name('edit');
        Route::put('/{product}', [\App\Http\Controllers\Backend\ProductController::class, 'update'])
            ->name('update');
        Route::delete('/{product}/gallery', [\App\Http\Controllers\Backend\ProductController::class, 'galleryDelete'])
            ->name('gallery.delete');
        Route::delete('/{product}/variant', [\App\Http\Controllers\Backend\ProductController::class, 'variantDelete'])
            ->name('variant.delete');
        Route::delete('/{product}', [\App\Http\Controllers\Backend\ProductController::class, 'destroy'])
            ->name('destroy');
    });

    // ROUTER ROLES
    Route::prefix('roles')->as('roles.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\RoleController::class, 'index'])
            ->name('index');
        Route::post('/', [\App\Http\Controllers\Backend\RoleController::class, 'store'])
            ->name('store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Backend\RoleController::class, 'edit'])
            ->name('edit');
        Route::put('/{role}', [\App\Http\Controllers\Backend\RoleController::class, 'update'])
            ->name('update');
    });

    // ROUTER USERS
    Route::prefix('users')->as('users.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\UserController::class, 'index'])
            ->name('index');
        Route::get('/create', [\App\Http\Controllers\Backend\UserController::class, 'create'])
            ->name('create');
        Route::post('/', [\App\Http\Controllers\Backend\UserController::class, 'store'])
            ->name('store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Backend\UserController::class, 'edit'])
            ->name('edit');
        Route::put('/{user}', [\App\Http\Controllers\Backend\UserController::class, 'update'])
            ->name('update');
        Route::delete('/{user}', [\App\Http\Controllers\Backend\UserController::class, 'destroy'])
            ->name('destroy');
    });

    // ROUTE ORDERS
    Route::prefix('orders')->as('orders.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\OrderController::class, 'index'])
            ->name('index');
        Route::get('/{id}/edit', [\App\Http\Controllers\Backend\OrderController::class, 'edit'])
            ->name('edit');
        Route::put('/{order}', [\App\Http\Controllers\Backend\OrderController::class, 'update'])
            ->name('update');
        Route::delete('/order-item/{id}', [\App\Http\Controllers\Backend\OrderController::class, 'orderItemDelete'])
            ->name('order-item.delete');
    });

    // ROUTE SETTINGS
    Route::prefix('settings')->as('settings.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\SettingController::class, 'index'])
            ->name('index');
        Route::put('/', [\App\Http\Controllers\Backend\SettingController::class, 'update'])
            ->name('update');
    });

    // ROUTE BANNERS
    Route::prefix('banners')->as('banners.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\BannerController::class, 'index'])
            ->name('index');
        Route::get('/create', [\App\Http\Controllers\Backend\BannerController::class, 'create'])
            ->name('create');
        Route::post('/', [\App\Http\Controllers\Backend\BannerController::class, 'store'])
            ->name('store');
        Route::get('/{id}/edit', [\App\Http\Controllers\Backend\BannerController::class, 'edit'])
            ->name('edit');
        Route::put('/{banner}', [\App\Http\Controllers\Backend\BannerController::class, 'update'])
            ->name('update');
    });

    // ROUTE CONTACTS
    Route::prefix('contacts')->as('contacts.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\ContactController::class, 'index'])
            ->name('index');
        Route::get('/{id}/edit', [\App\Http\Controllers\Backend\ContactController::class, 'edit'])
            ->name('edit');
        Route::put('/{contact}', [\App\Http\Controllers\Backend\ContactController::class, 'update'])
            ->name('update');
        Route::delete('/{contact}', [\App\Http\Controllers\Backend\ContactController::class, 'destroy'])
            ->name('destroy');
    });
});

Route::get('/districts/{province_id}', [\App\Http\Controllers\LocationController::class, 'getDistricts'])
    ->name('get-districts');
Route::get('/wards/{districts_id}', [\App\Http\Controllers\LocationController::class, 'getWards'])
    ->name('get-wards');
