<?php

use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\user\homeController;
use App\Http\Controllers\user\productController;
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
    Route::get('/checkout', [homeController::class, 'checkout'])->middleware('auth')->name('user.checkout');
    Route::get('/product/{slug}', [productController::class, 'detail'])->name('user.productDetail');
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
