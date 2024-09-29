<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['color'];

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
