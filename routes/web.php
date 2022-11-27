<?php

use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\user\homeController;
use App\Http\Controllers\user\orderController;
use App\Http\Controllers\user\paymentController;
use App\Http\Controllers\user\productController;
use App\Http\Controllers\user\storeController;
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
    Route::get('/page-search',[homeController::class, 'pageSearch'])->name('user.pageSearch');

    Route::prefix('/')->middleware('auth')->group(function () {
        // cart
        Route::get('/your-cart', [userController::class, 'cart'])->name('user.cart');
        Route::get('/checkout', [orderController::class, 'checkout'])->name('user.checkout');
        Route::post('/store-cart', [userController::class, 'store_cart'])->name('user.store_cart');
        Route::post('/delete-item-cart', [userController::class, 'delete_item_cart'])->name('user.delete_item_cart');
        Route::post('/update-item-cart', [userController::class, 'update_item_cart'])->name('user.update_item_cart');
        Route::post('/choose-cart', [orderController::class, 'chooseCart'])->name('user.chooseCart');
        Route::post('/checkout-store', [paymentController::class, 'checkout'])->name('user.checkout-store');
        Route::get('/pay-return',[paymentController::class, 'pay_return'])->name('user.pay-return');
        Route::get('/checkout-return/{order}', [paymentController::class, 'checkout_return'])->name('user.checkout-return');
        Route::post('/get-voucher', [storeController::class, 'get_voucher'])->name('user.get_voucher');
        
        // store
        Route::get('/store/10000000000{id}', [storeController::class, 'store'])->name('user.store');
        Route::get('/voucher-store/10000000000{id}', [storeController::class, 'voucher_store'])->name('user.voucher_store');
        Route::POST('/check-code', [storeController::class, 'check_code'])->name('user.check_code');
        Route::POST('/add-voucher/10000000000{id}', [storeController::class, 'add_voucher'])->name('user.add_voucher');
        Route::POST('/delete-voucher/10000000000{id}', [storeController::class, 'delete_voucher'])->name('user.delete_voucher');
        Route::POST('/update-voucher/10000000000{id}', [storeController::class, 'update_voucher'])->name('user.update_voucher');

        // profile
        Route::get('/profile', [userController::class, 'profile'])->name('user.profile');
        Route::post('/profile', [userController::class, 'updateProfile'])->name('user.update_profile');

        // register booth
        Route::get("/register-booth", [userController::class, 'register_booth'])->name("user.register_booth");
        Route::post("/register-booth", [userController::class, 'store_booth'])->name("user.store_booth");
    });
});

/*
|--------------------------------------------------------------------------
| Web Router for admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::prefix('/')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [dashboardController::class, 'dashboard'])->name('admin.dashboard');
    }); 
});

require __DIR__ . '/auth.php';
