<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('warehouses.index');
});

Route::resource('warehouses', WarehouseController::class);
Route::resource('products', ProductController::class);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
