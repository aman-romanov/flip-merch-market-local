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
    public function sub_categories(Category $category){
        $current_category = Category::where('id', $category->id)->first();
        $sub_categories = $current_category->sub_categories->load('products');
        return SubCategoryResource::collection( $sub_categories);
    }

    public function store(Category $category, SubCategoryRequest $request){
        $validated = $request->validated();

        $sub_category = SubCategory::create([
            'name' => $validated['name'],
            'category_id' => $category->id
        ]);

        return new SubCategoryResource($sub_category);
    }

    public function update(Category $category, SubCategory $sub_category, Request $request){
        $validated = $request->validate([
            'name' =>'required | string | max:50',
            'category_id' => 'required | integer'
        ]);

        $sub_category->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id']
        ]);

        return new SubCategoryResource($sub_category);
    }

    public function delete(SubCategory $sub_category){
        $sub_category->delete();

        return response()->json('Подкатегория удалена успешно!');
    }
}
