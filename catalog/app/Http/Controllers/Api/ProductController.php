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
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Вывод всех товаров",
     *     tags={"Products"},
     *     @OA\Response(response="200", description="Массив со свойствами товара", 
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/ProductResource")
     *             )
     *         )
     *     ),
     *     @OA\Response(response="500", description="Server error")
     * )
     */

    public function index(){
        $products = Product::all();

        return ProductResource::collection($products->load('colors', 'sizes', 'images', 'genders'));
    }

    /**
     * @OA\Get(
     *     path="/api/{category}/{sub_category}/{product}",
     *     summary="Карточка товара определенной подкатегории",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID категории", example="1")
     *     ),
     *     @OA\Parameter(
     *         name="sub_category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID подкатегории", example="3")
     *     ),
     *     @OA\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID товара", example="3")
     *     ),
     *     @OA\Response(response="200", description="Карточка товара", 
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/ProductResource")
     *             )
     *         )
     *     ),
     *     @OA\Response(response="500", description="Server error")
     * )
     */

    public function show(Category $category, SubCategory $sub_category, Product $product){
        $product = $product->load('colors', 'sizes', 'images', 'genders');

        return new ProductResource($product);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{product}",
     *     summary="Карточка любого товара",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID товара", example="3")
     *     ),
     *     @OA\Response(response="200", description="Карточка товара", 
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/ProductResource")
     *             )
     *         )
     *     ),
     *     @OA\Response(response="500", description="Server error")
     * )
     */

    public function product(Product $product){

        $product = $product->load('colors', 'sizes', 'images', 'genders');

        return new ProductResource($product);
    }

    /**
     * @OA\Post(
     *     path="/api/admin/{category}/{sub_category}/product/create",
     *     summary="Создание товара в разделе подкатегории",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID категории", example="1")
     *     ),
     *     @OA\Parameter(
     *         name="sub_category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID подкатегории", example="3")
     *     ),
     * 
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProductRequest")
     *     ),
     * 
     *     @OA\Response(response="201", description="Карточка товара", 
     *         @OA\JsonContent(
     *            @OA\Property(property="data", type="array",
     *                @OA\Items(ref="#/components/schemas/ProductResource")
     *            )
     *         )
     *     ),
     * 
     *     @OA\Response(response="500", description="Server error")
     * )
     */


    public function storeWithCategory(Category $category, SubCategory $sub_category, Request $request){
        $validated = $request->validate([
            'name' => 'required | string | max:50',
            'description' => 'required',
            'price' => 'required | integer',
            'previousPrice' => 'integer'
        ]);

        // return $validated['price'];

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'previousPrice' => $validated['previousPrice'],
            'sub_category_id' => $sub_category->id
        ]);

        if($request->colors){
            foreach($request->colors as $color){
                $product->colors()->attach($color['id']);
            }
        }

        if($request->images){
            foreach($request->images as $image){
                Image::create([
                    'product_id' => $product->id,
                    'color_id' => $image['color_id'],
                    'path'=> $image['path']
                ]);
            } 
        }

        if($request->sizes){
            foreach($request->sizes as $size){
                $product->sizes()->attach($size['id']);
            }
        }

        if($request->images){
            foreach($request->genders as $gender){
                $product->genders()->attach($gender['id']);
            }
        }

        $product->categories()->attach($category->id);
        
        return new ProductResource($product->load('colors', 'sizes', 'images', 'genders'));
    }

    /**
     * @OA\Post(
     *     path="/api/admin/products/create",
     *     summary="Создание нового товара",
     *     tags={"Products"},
     * 
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *     ),
     * 
     *     @OA\Response(response="201", description="Карточка товара", 
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/ProductRequest")
     *             )
     *         )
     *     ),
     * 
     *     @OA\Response(response="500", description="Server error")
     * )
     */

    public function store (ProductRequest $request){
        $validated = $request->validated();

        // return response()->json($validated['sub_category_id']);

        $product = Product::create($validated);
        
        if($request->colors){
            foreach($request->colors as $color){
                $product->colors()->attach($color['id']);
            }
        }

        if($request->images){
            foreach($request->images as $image){
                Image::create([
                    'product_id' => $product->id,
                    'color_id' => $image['color_id'],
                    'path'=> $image['path']
                ]);
            }
        }
        if($request->sizes){
            foreach($request->sizes as $size){
                $product->sizes()->attach($size['id']);
            }
        }
        if($request->genders){
            foreach($request->genders as $gender){
                $product->genders()->attach($gender['id']);
            }
        }

        $product->categories()->attach($request->category_id);

        $product->load('colors', 'sizes', 'images');

        return new ProductResource($product);
    }

    /**
     * @OA\Put(
     *     path="/api/admin/products/{product}",
     *     summary="Обновление товара",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID товара", example="3")
     *     ),
     * 
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProductRequest")
     *     ),
     * 
     *     @OA\Response(response="200", description="Карточка товара", 
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/ProductResource")
     *             )
     *         )
     *     ),
     * 
     *     @OA\Response(response="500", description="Server error")
     * )
     */

    public function update (Product $product, ProductRequest $request){

        $validated = $request->validated();

        // return response()->json($validated['sub_category_id']);

        $product->update($validated);
        if($request->colors){
            foreach($request->colors as $color){
                $product->colors()->sync($color['id']);
            }
        }
        if($request->images){
            foreach($request->images as $image){
                Image::create([
                    'product_id' => $product->id,
                    'color_id' => $image['color_id'],
                    'path'=> $image['path']
                ]);
            }
        }

        if($request->sizes){
            foreach($request->sizes as $size){
                $product->sizes()->sync($size['id']);
            }
        }
        
        if($request->genders){
            foreach($request->genders as $gender){
                $product->genders()->attach($gender['id']);
            }
        }

        if($request->category_id){
            $product->categories()->sync($request->category_id);
        }

        $product->load('colors', 'sizes', 'images', 'genders');

        return new ProductResource($product);
    }

    /**
     * @OA\Delete(
     *     path="/api/admin/products/{product}",
     *     summary="Удаление товара",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="product",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID товара", example="3")
     *     ),
     *     @OA\Response(response="200", description="Товар удален"),
     * 
     *     @OA\Response(response="500", description="Server error")
     * )
     */

    public function delete(Product $product){
        $product->delete();

        return response()->json('Продукт удален успешно!');
    }

    /**
     * @OA\Post(
     *     path="/api/products/find",
     *     summary="Поиск товаров по массиву ID",
     *     tags={"Products"},
     * 
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="array",
     *                @OA\Items(type="integer", example="3")
     *            )
     *         )
     *     ),
     * 
     *     @OA\Response(response="200", description="Массив товаров", 
     *         @OA\JsonContent(
     *            @OA\Property(property="data", type="array",
     *                @OA\Items(ref="#/components/schemas/ProductResource")
     *            )
     *         )
     *     ),
     * 
     *     @OA\Response(response="500", description="Server error")
     * )
     */

    public function findProductsByID(Request $request){
        $request->validate([
            "id" => "required|array",
            "id.*" => "integer"
        ]);

        $products = Product::whereIn('id', $request->input('id'))->orderByRaw('FIELD(id, ' . implode(',', $request->input('id')) . ')')->with('sizes', 'genders', 'colors', 'images')->get();

        return ProductResource::collection($products);
    }
}
