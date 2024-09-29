<?php

namespace App\Services;

interface CartServiceInterface{
    public function addToCart($userId, $productId, $colorId, $sizeId, $sexId, $count);
    public function updateCart($cartItemId, $count);
    public function removeFromCart($cartItemId);
    public function getCartItems($userId);
}
