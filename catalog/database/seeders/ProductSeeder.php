<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sub_categories = SubCategory::all();
        $names = ['Худи', 'Футболка', 'Бейсболка', 'Свитшот', 'Штаны', 'Перчатки' , 'Очки'];
        foreach($sub_categories as $sub_category){
            switch($sub_category->name){
                case $sub_category->name == 'Верхняя одежда':
                    $names = ['Худи', 'Футболка','Свитшот'];
                    foreach($names as $name){
                        Product::factory()->create([
                            'name' => $name,
                            'sub_category_id' => $sub_category->id
                        ]);
                    }
                    break;
                case $sub_category->name == 'Штаны':
                    Product::factory()->create([
                        'name' => 'Штаны',
                        'sub_category_id' => $sub_category->id
                    ]);
                    break;
                case $sub_category->name == 'Головной убор':
                    Product::factory()->create([
                        'name' => 'Бейсболка',
                        'sub_category_id' => $sub_category->id
                    ]);
                    break;
                case $sub_category->name == 'Аксессуар':
                    $names = ['Перчатки' , 'Очки'];
                    foreach($names as $name){
                        Product::factory()->create([
                            'name' => $name,
                            'sub_category_id' => $sub_category->id
                        ]);
                    }
                    break;
                    
            }
        }
    }
}
