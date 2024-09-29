<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function categories(){
        $categories = Category::with(['sub_categories'])->latest()->get();
        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request){
        $validated = $request->validated();
        $category = Category::create($validated);

        if(!$category){
            response()->json('Возникла ошибка');
        }

        return new CategoryResource($category);

        // return redirect()->route('categories.index')->with('success', 'Категория создана успешно!');
    }

    public function update(Category $category, CategoryRequest $request){
        $validated = $request->validated();
        $category->update($validated);

        return new CategoryResource($category);

        // return redirect()->route('categories.index')->with('success', 'Категория создана успешно!');
    }

    public function delete(Category $category){
        $category->delete();

        return response()->json('Категория удалена успешно!');

        // return redirect()->route('categories.index')->with('success', 'Категория создана успешно!');
    }
}
