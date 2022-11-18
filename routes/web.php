<?php

use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\user\homeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Router for user
|--------------------------------------------------------------------------
*/

Route::prefix('/')->group(function () {
    Route::get('/',[homeController::class, 'home'])->name('user.home');
    Route::get('/product',[homeController::class, 'product'])->name('user.product');
    Route::get('/checkout',[homeController::class, 'checkout'])->name('user.checkout');
    Route::get('/page-search',[homeController::class, 'pageSearch'])->name('user.pageSearch');
});

/*
|--------------------------------------------------------------------------
| Web Router for admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::get('/',[dashboardController::class, 'dashboard'])->name('admin.dashboard');
});