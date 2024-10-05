<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

/**
 * @OA\Info(title="Catalog API", version="1.0.0")
 */

class CategoryController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/categories",
     *     summary="Вывод всех категорий",
     *     tags={"Categories"},
     * 
     *     @OA\Response(response="200", description="Массив категорий", 
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/CategoryResource")
     *             )
     *         )
     *     ),
     * 
     *     @OA\Response(response="500", description="Server error")
     * )
     */

    public function index(){
        $categories = Category::with(['sub_categories'])->latest()->get();
        return CategoryResource::collection($categories);
    }

    /**
     * @OA\Get(
     *     path="/api/categories/{category}",
     *     summary="Вывод категории с подкатегориями",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID категории", example="1")
     *     ),
     *     @OA\Response(response="200", description="Массив категории с подкатегорями", 
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/CategoryResource")
     *             )
     *         )
     *     ),
     *     @OA\Response(response="500", description="Server error")
     * )
     */

    public function show(Category $category){
        $category ->load('sub_categories')->get();
        return new CategoryResource($category);
    }

    /**
     * @OA\Post(
     *     path="/api/admin/categories/create",
     *     summary="Создание новой категории",
     *     tags={"Categories"},
     * 
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Игрушки")
     *         )
     *     ),
     * 
     *     @OA\Response(response="201", description="Массив с данными категории", 
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Category")
     *              )
     *         )
     *     ),
     * 
     *     @OA\Response(response="500", description="Server error")
     * )
     */

    public function store(CategoryRequest $request){
        $validated = $request->validated();
        $category = Category::create($validated);

        if(!$category){
            response()->json('Возникла ошибка');
        }

        return new CategoryResource($category);

        // return redirect()->route('categories.index')->with('success', 'Категория создана успешно!');
    }

    /**
     * @OA\Put(
     *     path="/api/admin/categories/{category}",
     *     summary="Обновление категории",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID категории", example="3")
     *     ),
     * 
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Игрушки")
     *         )
     *     ),
     * 
     *     @OA\Response(response="200", description="Массив с данными категории", 
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Category")
     *             )
     *         )
     *     ),
     * 
     *     @OA\Response(response="500", description="Server error")
     * )
     */

    public function update(Category $category, CategoryRequest $request){
        $validated = $request->validated();
        $category->update($validated);

        return new CategoryResource($category);

        // return redirect()->route('categories.index')->with('success', 'Категория создана успешно!');
    }

    /**
     * @OA\Delete(
     *     path="/api/admin/categories/{category}",
     *     summary="Удаление категории",
     *     tags={"Categories"},
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID категории", example="3")
     *     ),
     *     @OA\Response(response="200", description="Категория удалена"),
     * 
     *     @OA\Response(response="500", description="Server error")
     * )
     */

    public function delete(Category $category){
        $category->delete();

        return response()->json('Категория удалена успешно!');

        // return redirect()->route('categories.index')->with('success', 'Категория создана успешно!');
    }
}
