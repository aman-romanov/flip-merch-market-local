<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        foreach($products as $product){
            foreach($product->colors as $color){
                Image::factory()->create( [
                    'product_id' => $product->id,
                    'color_id' => $color->id
                ]
                );
            }
        }
    }
}
