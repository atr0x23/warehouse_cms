<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductApiController;

Route::apiResource('products', ProductApiController::class);
