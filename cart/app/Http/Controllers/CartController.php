<?php

namespace App\Http\Controllers;

use App\Services\CartServiceInterface;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API документация",
 *     description=""
 * )
 *
 * @OA\Server(
 *     url="http://localhost:8000/api",
 *     description="Local API Server"
 * )
 */
class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @OA\Post(
     *     path="/api/cart",
     *     operationId="addToCart",
     *     tags={"Cart"},
     *     summary="Добавить товар в корзину",
     *     description="Добавление товара в корзину",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CartItem")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Товар добавлен в корзину"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Некорректные данные"
     *     )
     * )
     */
    public function addToCart(Request $request){
        $this->cartService->addToCart(
            $request->user()->id,
            $request->product_id,
            $request->color_id,
            $request->size_id,
            $request->sex_id,
            $request->count

        );
        return response()->json(['message' => 'Item added to cart']);
    }

    /**
     * @OA\Put(
     *     path="/api/cart",
     *     operationId="updateCart",
     *     tags={"Cart"},
     *     summary="Обновить товар в корзине",
     *     description="Обновление товара в корзине",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CartItem")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Товар обновлен в корзине"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Некорректные данные"
     *     )
     * )
     */
    public function updateCart(Request $request, $cartItemId){
        $this->cartService->updateCart($cartItemId, $request->count);

        return response()->json(['message' => 'Cart updated']);
    }

    /**
     * @OA\Delete(
     *     path="/api/cart",
     *     operationId="removeFromCart",
     *     tags={"Cart"},
     *     summary="Удалить товар из корзины",
     *     description="Удаление товара из корзины",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CartItem")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Товар удален из корзины"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Некорректные данные"
     *     )
     * )
     */
    public function removeFromCart($cartItemId){
        $this->cartService->removeFromCart($cartItemId);

        return response()->json(['message' => 'Item removed from cart']);
    }

    /**
     * @OA\Get(
     *     path="/api/cart",
     *     operationId="getCartItems",
     *     tags={"Cart"},
     *     summary="Получить все товары из корзины",
     *     description="Возвращает все товары в корзине пользователя",
     *     @OA\Response(
     *           response=200,
     *           description="Successful operation",
     *           @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/CartItem")
     *           )
     *       ),
     *       @OA\Response(
     *           response=422,
     *           description="Bad Request"
     *       ),
     *       @OA\Response(
     *           response=403,
     *           description="Forbidden"
     *       )
     * )
    */
    public function getCartItems(Request $request){
        $cartItems = $this->cartService->getCartItems($request->user()->id);

        return response()->json($cartItems);
    }
}
