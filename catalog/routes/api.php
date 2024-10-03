<?php

use App\Models\Product;
use App\User\UserController;
use Illuminate\Http\Request;
use App\Admin\AdminController;
use App\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
   
// Маршруты для пользователей

Route::get('/', function(){return redirect()->route('products.index');}
);

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::post('/products/find', [ProductController::class, 'findProductsByID'])->name('products.find');

Route::get('/products/{product}', [ProductController::class, 'product'])->name('products.product');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/{category}/{sub_category}', [SubCategoryController::class, 'show'])->name('sub_categories.show');

Route::get('/{category}/{sub_category}/{product}', [ProductController::class, 'show'])->name('products.show');

// Маршруты для администратора

Route::prefix('admin')->group(function(){
    Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store'); // Создать новую категорию

    Route::post('/{category}/sub_category/create', [SubCategoryController::class, 'store'])->name('sub_categories.store'); // Создать новую подкатегорию

    Route::post('/{category}/{sub_category}/product/create', [ProductController::class, 'storeWithCategory'])->name('sub_categories.product.store'); // Создать товар через раздел категорий

    Route::post('/products/create', [ProductController::class, 'store'])->name('products.store'); // Создать товар

    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update'); // Обновление данных товара по ID

    Route::delete('/products/{product}', [ProductController::class, 'delete'])->name('products.delete'); // Удаление товара

    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update'); // Обновить категорию

    Route::delete('/categories/{category}', [CategoryController::class, 'delete'])->name('categories.delete'); // Удалить категорию

    Route::put('/{category}/{sub_category}', [SubCategoryController::class, 'update'])->name('sub_categories.update'); // Обновить подкатегорию

    Route::delete('/{category}/{sub_category}', [SubCategoryController::class, 'delete'])->name('sub_categories.delete'); // Удалить подкатегорию
});