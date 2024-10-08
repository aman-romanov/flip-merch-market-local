<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sizes = ['XXS', 'XS', 'S', 'M', 'L', 'XL', 'XXL'];
        foreach($sizes as $size){
            Size::create([
                'size' => $size
            ]);
        }
    }
}
