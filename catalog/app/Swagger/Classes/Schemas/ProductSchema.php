<?php


    namespace App\Swagger\Classes\Schemas;

    use OpenApi\Annotations as OA;

    /**
     * @OA\Schema(
     *     schema="Product",
     *     type="object",
     *     description="Класс продукта",
     *     required={"id", "name", "description", "price", "category_id", "sub_category_id"},
     *     @OA\Property(
     *         property="id", 
     *         type="integer",
     *         example="1",
     *         description="ID продукта"),
     *     @OA\Property(
     *         property="name", 
     *         type="string",
     *         example="Футболка",
     *         description="Название продукта"),
     *     @OA\Property(
     *         property="description", 
     *         type="text",
     *         example="Хлопок, сертифицированный по экологическим стандартам, при его производстве не используются агрессивные химикаты. Выбирая такой товар, вы проявляете заботу о себе и о планете.",
     *         description="Описание продукта"),
     *     @OA\Property(
     *         property="price", 
     *         type="integer",
     *         example="9 990",
     *         description="Цена продукта"),
     *     @OA\Property(
     *         property="previousPrice", 
     *         type="integer",
     *         example="10 990",
     *         description="Прежняя цена продукта"),
     *     @OA\Property(
     *         property="sub_category_id", 
     *         type="integer",
     *         example="3",
     *         description="ID подктаегории товара"),
     * )
     */
    class ProductSchema
    {
        // Пустой класс, только для аннотаций
    }