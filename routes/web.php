<?php

use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\user\authController;
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

    Route::get('/login-google', [authController::class, 'loginGoogle'])->name('user.loginGoogle');
    Route::get('/login-facebook', [authController::class, 'loginFacebook'])->name('user.loginFacebook');
    Route::get('/', [homeController::class, 'home'])->name('user.home');
    Route::get('/product/{slug}', [productController::class, 'detail'])->name('user.productDetail');
    Route::get('/page-search', [homeController::class, 'pageSearch'])->name('user.pageSearch');
    Route::get('/store/10000000000{id}', [storeController::class, 'store'])->name('user.store');
    Route::get('/lucky-page', [homeController::class, 'lucky'])->name('user.lucky');
    Route::get('/update-view/{product}', [homeController::class, 'view'])->name('user.update_view');
    Route::get('/about', [homeController::class, 'about'])->name('user.about');
    Route::post('/marketing', [homeController::class, 'update_view_top'])->name('user.update_view_top');

    // ajax call category product children by parent
    Route::get("/filter-product-children", [homeController::class, 'filterProductChildren'])->name("filter_product_children");

    // ajax product filter
    Route::get("/filter-product", [homeController::class, 'filterProduct'])->name("filter_product");

    Route::prefix('/')->middleware('auth')->group(function () {
        // cart
        Route::get('/your-cart', [userController::class, 'cart'])->name('user.cart');
        Route::get('/checkout', [orderController::class, 'checkout'])->name('user.checkout');
        Route::post('/store-cart', [userController::class, 'store_cart'])->name('user.store_cart');
        Route::post('/delete-item-cart', [userController::class, 'delete_item_cart'])->name('user.delete_item_cart');
        Route::post('/update-item-cart', [userController::class, 'update_item_cart'])->name('user.update_item_cart');
        Route::post('/choose-cart', [orderController::class, 'chooseCart'])->name('user.chooseCart');
        Route::post('/checkout-store', [paymentController::class, 'checkout'])->name('user.checkout-store');
        Route::get('/pay-return', [paymentController::class, 'pay_return'])->name('user.pay-return');
        Route::get('/checkout-return/{order}', [paymentController::class, 'checkout_return'])->name('user.checkout-return');
        Route::post('/get-voucher', [storeController::class, 'get_voucher'])->name('user.get_voucher');

        // store
        Route::get('/dashboard/10000000000{id}',[storeController::class, 'dashboard'])->name('user.dashboard_store');
        Route::get('/payment/10000000000{id}', [storeController::class, 'payment'])->name('user.payment_store');
        Route::post('/payment-store/10000000000{id}', [storeController::class, 'store_payment'])->name('user.payment_store_post');
        Route::get('/pay-return-store', [storeController::class, 'payment_return'])->name('user.store_pay_return');
        Route::get('/product-store/10000000000{id}', [storeController::class, 'product'])->name('user.product_store');
        Route::get('/voucher-store/10000000000{id}', [storeController::class, 'voucher_store'])->name('user.voucher_store');
        Route::POST('/check-code', [storeController::class, 'check_code'])->name('user.check_code');
        Route::POST('/add-voucher/10000000000{id}', [storeController::class, 'add_voucher'])->name('user.add_voucher');
        Route::POST('/delete-voucher/10000000000{id}', [storeController::class, 'delete_voucher'])->name('user.delete_voucher');
        Route::POST('/update-voucher/10000000000{id}', [storeController::class, 'update_voucher'])->name('user.update_voucher');
        Route::get('/order-store/10000000000{id}', [storeController::class, 'order'])->name('user.order_store');
        Route::get('/detail-order-store/{id_order_store}/10000000000{id}', [storeController::class, 'order_detail'])->name('user.order_detail_store');
        Route::get('/update-store-store/10000000000{id}/{order}/{status}', [storeController::class, 'update_order_store'])->name('user.update_order_store');
        Route::post('/marketing/10000000000{id}/{product}', [storeController::class, 'marketing'])->name('user.marketing');

        // edit store
        Route::get("/store/edit/10000000000{id}", [storeController::class, 'editStore'])->name('user.store_edit');
        Route::put("/store/edit/10000000000{id}", [storeController::class, 'updateStore'])->name('user.update_store');

        // add product into store
        Route::get('/create-product-store/{id}', [storeController::class, 'createProduct'])->name('user.create-product-store');
        Route::post('/create-product-store/{id}', [storeController::class, 'storeAddProduct'])->name('user.add-product-store');
        Route::get('/store/{id_store}/edit-product/{id_product}', [storeController::class, 'editProduct'])->name('user.edit-product-store');
        Route::put('/store/{id_store}/edit-product/{id_product}', [storeController::class, 'updateProduct'])->name('user.update-product-store');

        // update status product
        Route::put("/update-status-product/{id}", [storeController::class, 'updateProductStatus'])->name("user.update-status-product");
        Route::delete("/delete-product/{id}", [storeController::class, 'deleteProduct'])->name("user.delete_product");

        // profile
        Route::get('/profile', [userController::class, 'profile'])->name('user.profile');
        Route::post('/profile', [userController::class, 'updateProfile'])->name('user.update_profile');

        // user address
        Route::get("/address-user", [userController::class, 'userAddress'])->name('user.address');
        Route::post("/address-user", [userController::class, 'c'])->name('user.add_address');
        Route::get("/edit-user/{id}", [userController::class, 'showUserAddress'])->name('user.show_address');
        Route::put("/update-address-user/{id}", [userController::class, 'updateUserAddress'])->name('user.update_address');
        Route::delete("/delete-address-user/{id}", [userController::class, 'deleteUserAddress'])->name('user.delete_address');
        Route::put("/update-status-address/{id}", [userController::class, 'updateAddressStatus'])->name('user.update_status_address');
        Route::post('/add-wishlist', [userController::class, 'add_wishlist'])->name('user.add_wishlist');
        Route::get('/wishlist', [userController::class, 'wishlist'])->name('user.wishlist');
        Route::get('/payment-user', [userController::class, 'payment'])->name('user.payment_user');
        Route::post('/payment-user', [userController::class, 'payment_checkout'])->name('user.payment_user_checkout');
        Route::get('/return-payment-user', [userController::class, 'payment_return'])->name('user.payment_user_return');
        Route::post('/comment/{id}/{store}', [userController::class, 'comment'])->name('user.comment');
        Route::get('/lucky-quay', [userController::class, 'lucky_random'])->name('user.lucky_random');

        // register booth
        Route::get("/register-booth", [userController::class, 'registerBooth'])->name("user.register_booth");
        Route::post("/register-booth", [userController::class, 'storeBooth'])->name("user.store_booth");

        // order
        Route::get('/manage-order', [orderController::class, 'manageOrder'])->name('user.manage-order');
        Route::get('/order-detail/{id_order}', [orderController::class, 'orderDetail'])->name('user.manager-orderDetail');

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

        Route::get('/category', [dashboardController::class, 'category'])->name('admin.category');
        Route::post('/category', [dashboardController::class, 'store_category'])->name('admin.store_category');
        Route::post('/category/{id}', [dashboardController::class, 'update_category'])->name('admin.update_category');
        Route::get('/delete-category/{id}', [dashboardController::class, 'delete_category'])->name('admin.delete_category');
        
        Route::get('/voucher-manager', [dashboardController::class, 'voucher'])->name('admin.voucher');
        Route::post('/voucher-manager', [dashboardController::class, 'add_voucher'])->name('admin.add_voucher');
        Route::get('/update-voucher/{voucher}/{status}', [dashboardController::class, 'update_voucher'])->name('admin.update_voucher');

        Route::get('/member', [dashboardController::class, 'member'])->name('admin.member');
        Route::get('/update-member/{member}/{status}', [dashboardController::class, 'update_member'])->name('admin.update_member');

        Route::get('/store', [dashboardController::class, 'store'])->name('admin.store');
        Route::get('/update-store/{store}/{status}', [dashboardController::class, 'update_store'])->name('admin.update_store');
        Route::get('/update-ticket-store/{ticket}/{status}', [dashboardController::class, 'update_ticket_store'])->name('admin.update_ticket_store');

        Route::get('/payment', [dashboardController::class, 'payment'])->name('admin.payment');
        Route::get('/update_payment/{id}/{status}', [dashboardController::class, 'update_payment'])->name('admin.update_payment');
    }); 
});

require __DIR__ . '/auth.php';
