<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        foreach($categories as $category){
            if($category->name === 'Одежда'){
                $names = ['Верхняя одежда', 'Штаны', 'Головной убор', 'Аксессуар'];
                foreach($names as $name){
                    SubCategory::create([
                        'name' => $name,
                        'category_id' => $category->id
                    ]);
                }
            }
        }
    }
}
