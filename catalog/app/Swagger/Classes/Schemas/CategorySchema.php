<?php


    namespace App\Swagger\Classes\Schemas;

    use OpenApi\Annotations as OA;

    /**
     * @OA\Schema(
     *     schema="Category",
     *     type="object",
     *     description="Категория для продуктов",
     *     required={"id", "name"},
     *     @OA\Property(
     *         property="id", 
     *         type="integer",
     *         example="1",
     *         description="ID категории"),
     *     @OA\Property(
     *         property="name", 
     *         type="string",
     *         example="Футболка",
     *         description="Название категории")
     * )
     */
    class CategorySchema
    {
        // Пустой класс, только для аннотаций
    }