<?php

namespace App\Models;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name'
    ];

    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
