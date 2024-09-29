<?php

namespace App\Models;

use App\Models\Size;
use App\Models\Color;
use App\Models\Image;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Gender;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name', 'description', 'price', 'sub_category_id'
    ];

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function colors(){
        return $this->belongsToMany(Color::class);
    }

    public function sizes(){
        return $this->belongsToMany(Size::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function genders(){
        return $this->belongsToMany(Gender::class);
    }
}
