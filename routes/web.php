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
});

/*
|--------------------------------------------------------------------------
| Web Router for admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::get('/',[dashboardController::class, 'dashboard'])->name('admin.dashboard');
});