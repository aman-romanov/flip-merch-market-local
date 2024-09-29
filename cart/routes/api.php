<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::middleware('auth:api')->group(function () {
    Route::post('/cart', [CartController::class, 'create']);
    Route::get('/cart/{cartId}', [CartController::class, 'getCart']);
    Route::post('/cart/{cartId}/items', [CartController::class, 'addItem']);
    Route::put('/cart/{cartId}/items/{itemId}', [CartController::class, 'updateItem']);
    Route::delete('/cart/{cartId}/items/{itemId}', [CartController::class, 'removeItem']);
});
