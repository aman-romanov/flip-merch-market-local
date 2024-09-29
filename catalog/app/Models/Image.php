<?php

namespace App\Models;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = ['path', 'is_main', 'color_id', 'product_id'];

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
