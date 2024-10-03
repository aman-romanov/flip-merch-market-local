<?php


    namespace App\Swagger\Resources\Schemas;

    use OpenApi\Annotations as OA;

    /**
     * @OA\Schema(
     *     schema="ProductResource",
     *     type="object",
     *     description="Класс продукта",
     *     required={"id", "name", "description", "price", "category_id", "sub_category_id"},
     *     @OA\Property(
     *         property="id", 
     *         type="integer",
     *         example=1,
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
     *         example=9990,
     *         description="Цена продукта"),
     *     @OA\Property(
     *         property="previousPrice", 
     *         type="integer",
     *         example=10990,
     *         description="Прежняя цена продукта"),
     *     @OA\Property(
     *         property="sub_category_id", 
     *         type="integer",
     *         example=3,
     *         description="ID подкатегории товара"),
     *     @OA\Property(
     *         property="category_id", 
     *         type="integer",
     *         example=3,
     *         description="ID категории товара"),
     *     @OA\Property(
     *         property="genders", 
     *         type="array",
     *         @OA\Items(
     *             type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="gender", type="string", example="Мужское")
     *         ),
     *         description="Пол товара"),
     *     @OA\Property(
     *         property="sizes", 
     *         type="array",
     *         @OA\Items(
     *             type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="size", type="string", example="XXS")
     *         ),
     *         description="Размеры товара"),
     *     @OA\Property(
     *         property="colors", 
     *         type="array",
     *         @OA\Items(
     *             type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="color", type="string", example="#0297c8")
     *         ),
     *         description="Цвета товара"),
     *     @OA\Property(
     *         property="images", 
     *         type="array",
     *         @OA\Items(
     *             type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="path", type="string", example="public/images/mockup.png"),
 *                 @OA\Property(property="product_id", type="integer", example=3),
 *                 @OA\Property(property="color_id", type="integer", example=3)
     *         ),
     *         description="Изображения товара"),
     * )
     */
    class ProductResourceSchema
    {
        // Пустой класс, только для аннотаций
    }