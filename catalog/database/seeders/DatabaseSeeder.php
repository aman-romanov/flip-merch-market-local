<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\User;
use App\Models\Color;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
use Database\Seeders\ImageSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\SubCategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Color::factory(30)->create();
        $this->call(CategorySeeder::class);
        $this->call(SubCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SizeSeeder::class);

        $products = Product::all();
        foreach($products as $product){
            $colors = Color::inRandomOrder()->take(rand(3,6))->pluck('id');
            $category = Category::findOrFail(rand(1,2))->id;
            $sizes = Size::all()->pluck('id');
            $product->colors()->attach($colors);
            if($product->name == 'Очки' || $product->name == 'Бейсболка'){
                $product->sizes()->attach(4);
            }else{
                $product->sizes()->attach($sizes);
            }
            $product->categories()->attach($category);
            
        }

        $random_products = Product::inRandomOrder()->take(10)->get();
        foreach($random_products as $product){
            $product->categories()->syncWithoutDetaching(Category::findOrFail(3)->id);
        }

        $this->call(ImageSeeder::class);

        
        // Category::factory(3)->create()->each(function($category){
        //     SubCategory::factory(4)->for($category)->create();
        // });
        // Product::factory(25)->create()->each(function($product){
        //     ProductAttribute::factory(5)->for($product)->create();
        // });
        // ProductImage::factory(100)->create();
    }
}
