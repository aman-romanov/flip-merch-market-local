<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
   $product = Product::all();
   /* foreach($sub_categories as $sub_category){
      dd($sub_category->name);
   } */
});
