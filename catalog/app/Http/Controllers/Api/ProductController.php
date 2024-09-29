<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();

        return ProductResource::collection($products->load('colors', 'sizes', 'images'));
    }

    public function products(Category $category, SubCategory $sub_category){
        $current_sub_category = SubCategory::where([
            'category_id' => $category->id,
            'name' => $sub_category->name
        ])->first();

        $products = Product::where('sub_category_id', $current_sub_category->id)->get();

        $products->load('colors', 'images');

        return ProductResource::collection($products);
    }

    public function show(Category $category, SubCategory $sub_category, Product $product){
        $product->load('colors', 'sizes', 'images');

        return new ProductResource($product);
    }

    public function product(Product $product){

        $product ->load('colors', 'sizes', 'images');

        return new ProductResource($product);
    }


    public function storeWithCategory(Category $category, SubCategory $sub_category, Request $request){
        
        $validated = $request->validate([
            'name' => 'required | string | max:50',
            'description' => 'required',
            'price' => 'required | integer',
        ]);

        // return $validated['price'];

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'sub_category_id' => $sub_category->id
        ]);

        foreach($request->colors as $color){
            $product->colors()->attach($color['id']);
        }

        foreach($request->images as $image){
            Image::create([
                'product_id' => $product->id,
                'color_id' => $image['color_id'],
                'path'=> $image['path']
            ]);
        } 

        foreach($request->sizes as $size){
            $product->sizes()->attach($size['id']);
        }

        $product->categories()->attach($category->id);

        $product->load('colors', 'sizes', 'images');
        
        return new ProductResource($product);
    }

    public function store (ProductRequest $request){
        $validated = $request->validated();

        // return response()->json($validated['sub_category_id']);

        $product = Product::create($validated);

        foreach($request->colors as $color){
            $product->colors()->attach($color['id']);
        }

        foreach($request->images as $image){
            Image::create([
                'product_id' => $product->id,
                'color_id' => $image['color_id'],
                'path'=> $image['path']
            ]);
        } 

        foreach($request->sizes as $size){
            $product->sizes()->attach($size['id']);
        }

        $product->categories()->attach($request->category_id);

        $product->load('colors', 'sizes', 'images');

        return new ProductResource($product);
    }

    public function update (Product $product, ProductRequest $request){
        $validated = $request->validated();

        // return response()->json($validated['sub_category_id']);

        $product->update($validated);

        foreach($request->colors as $color){
            $product->colors()->sync($color['id']);
        }

        foreach($request->images as $image){
            Image::create([
                'product_id' => $product->id,
                'color_id' => $image['color_id'],
                'path'=> $image['path']
            ]);
        } 

        foreach($request->sizes as $size){
            $product->sizes()->sync($size['id']);
        }

        $product->categories()->sync($request->category_id);

        $product->load('colors', 'sizes', 'images');

        return new ProductResource($product);
    }

    public function delete(Product $product){
        $product->delete();

        return response()->json('Продукт удален успешно!');
    }
}
