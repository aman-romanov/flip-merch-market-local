<?php
    namespace App\Http\Controllers;

    use App\Models\Product;
    use Illuminate\Http\Request;
    
    class UserController extends Controller
    {
        public function index()
        {
            $products = Product::all();
            return response()->json($products, 200);
        }
    
        public function addToCart(Request $request, $id)
        {
            $product = Product::findOrFail($id);

            // Логика добавления товара в корзину (здесь может быть создание заказа, добавление в сессию и т.д.)
            // В данном примере просто возвращаем сообщение об успешном добавлении
            return response()->json([
                'message' => 'Product added to cart successfully.',
                'product' => $product,
            ]);
        }
    }