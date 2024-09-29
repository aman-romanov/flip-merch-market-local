<?php

namespace App\Http\Controllers;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Models\Order;

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
class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @OA\Post(
     *     path="/api/orders",
     *     operationId="createOrder",
     *     tags={"Orders"},
     *     summary="Создание заказа",
     *     description="Создание заказа на основе содержимого корзины",
     *     @OA\Response(
     *         response=200,
     *         description="Заказ успешно создан"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Корзина пуста"
     *     )
     * )
     */
    public function createOrder(Request $request)
    {
        $user_id = $request->user()->id;
        $result = $this->orderService->createOrder($user_id);

        if ($result['success']) {
            return response()->json(['order' => $result['order'], 'message' => 'Order created successfully']);
        } else {
            return response()->json(['message' => $result['message']], 400);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/orders/{order}",
     *     operationId="getOrderDetails",
     *     tags={"Orders"},
     *     summary="Просмотр деталей заказа",
     *     description="Получение деталей заказа по ID",
     *     @OA\Parameter(
     *         name="order",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Детали заказа"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Заказ не найден"
     *     )
     * )
     */
    public function getOrderDetails($order_id)
    {
        $order = Order::findOrFail($order_id);
        return response()->json($order);
    }

    /**
     * @OA\Put(
     *     path="/api/orders/{order}",
     *     operationId="updateOrderStatus",
     *     tags={"Orders"},
     *     summary="Обновление статуса заказа",
     *     description="Обновление статуса заказа",
     *     @OA\Parameter(
     *         name="order",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="confirmed")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Статус заказа успешно обновлен"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Заказ не найден"
     *     )
     * )
     */
    public function updateOrderStatus(Request $request, $order_id)
    {
        $status = $request->input('status');
        $result = $this->orderService->updateOrderStatus($order_id, $status);

        return response()->json(['order' => $result['order'], 'message' => 'Order status updated successfully']);
    }
}
