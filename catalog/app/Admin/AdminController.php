<?php
    namespace App\Product\Controllers;

    use App\Admin\Services\ProductsService;
    use Illuminate\Http\Request;
    
    class AdminController extends UserController
    {
        protected $productsService;
    
        public function __construct(ProductsService $productsService)
        {
            $this->productsService = $productsService;
        }
    
        public function index()
        {
            $products = $this->productsService->getAllProducts();
            return response()->json($products);
        }
    
        public function show($id)
        {
            $product = $this->productsService->getProductById($id);
            return response()->json($product);
        }
    
        public function update(Request $request, $id)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'quantity' => 'nullable|integer|min:0',
                'is_active' => 'boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg'
            ]);
    
            $product = $this->productsService->updateProduct($id, $validatedData);
            return response()->json($product);
        }
    
        public function delete($id)
        {
            $this->productsService->deleteProduct($id);
            return response()->json(null, 200);
        }

        public function create(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric',
                'category_id' => 'required|exists:categories,id',
                'quantity' => 'nullable|integer|min:0',
                'is_active' => 'boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg'
            ]);

            $this->productsService->createProduct($validatedData);
            return response()->json(null, 200);
        }
    }