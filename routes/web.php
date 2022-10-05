<?php

use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\user\homeController;
use App\Http\Controllers\user\orderController;
use App\Http\Controllers\user\productController;
use App\Http\Controllers\user\userController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Web Router for user
|--------------------------------------------------------------------------
*/

Route::prefix('/')->group(function () {
    Route::get('/', [homeController::class, 'home'])->name('user.home');
    Route::get('/product/{slug}', [productController::class, 'detail'])->name('user.productDetail');

    Route::prefix('/')->middleware('auth')->group(function () {   
        // cart
        Route::get('/your-cart', [userController::class, 'cart'])->name('user.cart');
        Route::post('/checkout', [orderController::class, 'checkout'])->name('user.checkout');
        Route::post('/store-cart', [userController::class, 'store_cart'])->name('user.store_cart');
        Route::post('/delete-item-cart', [userController::class, 'delete_item_cart'])->name('user.delete_item_cart');
        Route::post('/update-item-cart', [userController::class, 'update_item_cart'])->name('user.update_item_cart');
        
        // profile
        Route::get('/profile', [userController::class, 'profile'])->name('user.profile');
        Route::post('/profile', [userController::class, 'updateProfile'])->name('user.update_profile');
    });
});

/*
|--------------------------------------------------------------------------
| Web Router for admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::get('/', [dashboardController::class, 'dashboard'])->name('admin.dashboard');
});

require __DIR__ . '/auth.php';
