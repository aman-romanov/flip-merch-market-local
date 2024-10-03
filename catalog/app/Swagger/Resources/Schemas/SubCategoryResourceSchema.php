<?php


    namespace App\Swagger\Resources\Schemas;

    use OpenApi\Annotations as OA;

    /**
     * @OA\Schema(
     *     schema="SubCategoryResource",
     *     type="object",
     *     description="Подкатегория для продуктов",
     *     required={"id", "name", "category_id"},
     *     @OA\Property(
     *         property="id", 
     *         type="integer",
     *         example="1",
     *         description="ID подкатегории"),
     *     @OA\Property(
     *         property="name", 
     *         type="string",
     *         example="Футболка",
     *         description="Название подкатегории"),
     *     @OA\Property(
     *         property="category_id", 
     *         type="integer",
     *         example="3",
     *         description="Основная категория для подкатегории"),
     *     @OA\Property(
     *         property="products", 
     *         type="array",
     *         @OA\Items(ref="#/components/schemas/Category"),
     *         example={
     *         {"id": 1,
                "name": "Худи",
                "description": "Ea ut consequatur natus sed occaecati hic. Adipisci repellendus id cum itaque quis aliquid. Aut sunt suscipit in sequi tenetur. Sit illo quo velit quia quia possimus.",
                "price": "KZT 34,227.00",
                "previousPrice": "KZT 92,848.00",
                "sub_category": "Верхняя одежда",
                "category_id": "Одежда"},
     *         {"id": 2,
                "name": "Худи",
                "description": "Suscipit et modi magnam in dolorum. Sit deserunt sunt aut non. Nulla nihil veritatis aut fuga consectetur quidem quae. Numquam earum excepturi sapiente et illo nisi sint.",
                "price": "KZT 64,807.00",
                "previousPrice": "KZT 42,079.00",
                "sub_category": "Верхняя одежда",
                "category_id": "Одежда"}
     *         },
     *         description="Товары подктаегории"),
     * )
     */
    class SubCategoryResourceSchema
    {
        // Пустой класс, только для аннотаций
    }