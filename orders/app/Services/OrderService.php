<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
public function createOrder($user_id)
{
$cartItems = CartItem::where('user_id', $user_id)->get();
if ($cartItems->isEmpty()) {
return ['success' => false, 'message' => 'Cart is empty'];
}

$items = $cartItems->map(function ($cartItem) {
return [
'product_id' => $cartItem->product_id,
'color_id' => $cartItem->color_id,
'size_id' => $cartItem->size_id,
'sex_id' => $cartItem->sex_id,
'count' => $cartItem->count,
];
});

$order = new Order();
$order->user_id = $user_id;
$order->status = 'new';
$order->items = $items;
$order->save();

CartItem::where('user_id', $user_id)->delete(); // Удаляем товары из корзины после создания заказа

return ['success' => true, 'order' => $order];
}

public function updateOrderStatus($order_id, $status)
{
$order = Order::findOrFail($order_id);
$order->status = $status;
$order->save();

return ['success' => true, 'order' => $order];
}
}
