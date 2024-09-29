<?php
namespace App\Services;

use App\Services\CartServiceInterface;
use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Http;

class CartService implements CartServiceInterface{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository){
        $this->cartRepository = $cartRepository;
    }

    public function addToCart($userId, $productId, $colorId, $sizeId, $sexId, $count)
    {
        $response = Http::get('http://localhost:8003/admin/products/' . $productId);

        if ($response->failed()){
            return response()->json(['error' => 'Product not found in catalog'], 404);
        }

        return $this->cartRepository->create([
            'user_id' => $userId,
            'product_id' => $productId,
            'color_id' => $colorId,
            'size_id' => $sizeId,
            'sex_id' => $sexId,
            'count' => $count,
        ]);
    }

    public function updateCart($cartItemId, $count)
    {
         return $this->cartRepository->update($cartItemId, ['count' => $count]);
    }

    public function removeFromCart($cartItemId)
    {
        return $this->cartRepository->delete($cartItemId);
    }

    public function getCartItems($userId)
    {
        return $this->cartRepository->getByUserId($userId);
    }
}
