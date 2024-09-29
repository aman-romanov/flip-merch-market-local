<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::post('/orders', [OrderController::class, 'createOrder']);
Route::get('/orders/{order}', [OrderController::class, 'getOrderDetails']);
Route::put('/orders/{order}', [OrderController::class, 'updateOrderStatus']);
