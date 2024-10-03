<?php

    namespace App\Swagger\Resources\Schemas;

    use OpenApi\Annotations as OA;

    /**
     * @OA\Schema(
     *     schema="CategoryResource",
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
     *         example="Одежда",
     *         description="Название категории"),
     *     @OA\Property(
     *         property="sub_categories", 
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/SubCategory"),
     *         example={
     *         {"id":"1",
     *          "name":"Верхняя одежда"},
     *         {"id":"2",
     *          "name":"Штаны"}
     *         },
     *         description="Подкатегорий основной категории"),
     * )
     */
    class CategoryResourceSchema
    {
        // Пустой класс, только для аннотаций
    }