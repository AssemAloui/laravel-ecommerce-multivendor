<?php

use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoriesController;

Route::group([
    'middleware' => ['auth'],
    'as' => 'dashboard.',
    'prefix' => 'dashboard',
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/categories', CategoriesController::class);
});
