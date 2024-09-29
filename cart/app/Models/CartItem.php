<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /**
     * @OA\Schema(
     *     schema="CartItem",
     *     type="object",
     *     title="CartItem",
     *     description="CartItem model",
     *     required={"user_id", "product_id", "color_id", "size_id", "sex_id", "count"},
     *     @OA\Property(
     *         property="user_id",
     *         type="integer",
     *         example=1,
     *         description="ID of the user"
     *     ),
     *     @OA\Property(
     *         property="product_id",
     *         type="integer",
     *         example=1,
     *         description="ID of the product"
     *     ),
     *     @OA\Property(
     *         property="color_id",
     *         type="integer",
     *         example=1,
     *         description="ID of the color"
     *     ),
     *     @OA\Property(
     *         property="size_id",
     *         type="integer",
     *         example=1,
     *         description="ID of the size"
     *     ),
     *     @OA\Property(
     *         property="sex_id",
     *         type="integer",
     *         example=1,
     *         description="ID of the sex"
     *     ),
     *     @OA\Property(
     *         property="count",
     *         type="integer",
     *         example=1,
     *         description="Count of the items"
     *     )
     * )
     */
    protected $fillable = ['user_id', 'product_id', 'color_id', 'size_id', 'sex_id', 'count'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function sex()
    {
        return $this->belongsTo(Sex::class);
    }
}
