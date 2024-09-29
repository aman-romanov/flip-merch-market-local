<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * @OA\Schema(
     *     schema="Order",
     *     type="object",
     *     title="Order",
     *     description="Order model",
     *     required={"user_id", "status", "items"},
     *     @OA\Property(
     *         property="user_id",
     *         type="integer",
     *         example=1,
     *         description="ID of the user"
     *     ),
     *     @OA\Property(
     *         property="status",
     *         type="string",
     *         example="new",
     *         description="Status of the order"
     *     ),
     *     @OA\Property(
     *         property="items",
     *         type="array",
     *         description="List of items in the order",
     *         @OA\Items(
     *             type="object",
     *             required={"product_id", "color_id", "size_id", "sex_id", "count"},
     *             @OA\Property(
     *                 property="product_id",
     *                 type="integer",
     *                 example=1,
     *                 description="ID of the product"
     *             ),
     *             @OA\Property(
     *                 property="color_id",
     *                 type="integer",
     *                 example=1,
     *                 description="ID of the color"
     *             ),
     *             @OA\Property(
     *                 property="size_id",
     *                 type="integer",
     *                 example=1,
     *                 description="ID of the size"
     *             ),
     *             @OA\Property(
     *                 property="sex_id",
     *                 type="integer",
     *                 example=1,
     *                 description="ID of the sex"
     *             ),
     *             @OA\Property(
     *                 property="count",
     *                 type="integer",
     *                 example=1,
     *                 description="Quantity of the product"
     *             )
     *         )
     *     )
     * )
     */

    protected $fillable = ['user_id', 'status', 'items'];

    protected $casts = [
        'items' => 'array',
    ];
}
