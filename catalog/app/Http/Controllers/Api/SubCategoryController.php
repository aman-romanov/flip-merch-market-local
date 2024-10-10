<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;

class SubCategoryController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/{category}/{sub_category}",
     *     summary="Вывод подкатегории с товарами",
     *     tags={"SubCategories"},
     *     @OA\Parameter(
     *         name="sub_category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID подкатегории", example="3")
     *     ),
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID категории", example="1")
     *     ),
     *     @OA\Response(response="200", description="Массив подкатегории с товарами", 
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                    @OA\Items(ref="#/components/schemas/SubCategoryResource")
     *             )
     *         )
     *     ),
     *     @OA\Response(response="500", description="Server error")
     * )
     */

    public function show(Category $category, SubCategory $sub_category){
        $sub_category = $sub_category::with(['products'])->latest()->get();
        return SubCategoryResource::collection( $sub_category);
    }

    /**
     * @OA\Post(
     *     path="/api/admin/{category}/sub_category/create",
     *     summary="Создание новой подкатегории",
     *     tags={"SubCategories"},
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
     *             @OA\Property(property="name", type="string", example="Игрушки")
     *         )
     *     ),
     * 
     *     @OA\Response(response="201", description="Массив подкатегории с данными", 
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/SubCategory")
     *             )
     *         )
     *     ),
     * 
     *     @OA\Response(response="500", description="Server error"),
     * 
     *     @OA\Response(response="422", description="Field is required")
     * )
     */

    public function store(Category $category, SubCategoryRequest $request){
        $validated = $request->validated();

        $sub_category = SubCategory::create([
            'name' => $validated['name'],
            'category_id' => $category->id
        ]);

        return new SubCategoryResource($sub_category);
    }

    /**
     * @OA\Put(
     *     path="/api/admin/{category}/{sub_category}",
     *     summary="Обновление подкатегории",
     *     tags={"SubCategories"},
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID категории", example="3")
     *     ),
     *     @OA\Parameter(
     *         name="sub_category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID подкатегорий", example="3")
     *     ),
     * 
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Игрушки")
     *         )
     *     ),
     * 
     *     @OA\Response(response="200", description="Массив подкатегории с товарами", 
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/SubCategoryResource")
     *             )
     *         )
     *     ),
     * 
     *     @OA\Response(response="500", description="Server error"),
     * 
     *     @OA\Response(response="422", description="Field is required")
     * )
     */
    public function update(Category $category, SubCategory $sub_category, Request $request){
        $validated = $request->validate([
            'name' =>'sometimes | string | max:50'
        ]);

        $sub_category->update([
            'name' => $validated['name'],
            'category_id' => $category->id
        ]);

        return new SubCategoryResource($sub_category);
    }

    /**
     * @OA\Delete(
     *     path="/api/admin/{category}/{sub_category}",
     *     summary="Удаление подкатегории",
     *     tags={"SubCategories"},
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID категории", example="3")
     *     ),
     *     @OA\Parameter(
     *         name="sub_category",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", description="ID подкатегорий", example="3")
     *     ),
     * 
     *     @OA\Response(response="200", description="Подкатегория удалена"),
     * 
     *     @OA\Response(response="500", description="Server error")
     * )
     */
    public function delete(Category $category, SubCategory $sub_category){
        $sub_category->delete();

        return response()->json('Подкатегория удалена успешно!');
    }
}
