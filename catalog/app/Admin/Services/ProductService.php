<?php
    namespace App\Admin\Services;

    use App\Models\Product;
    
    class ProductService
    {
        public function getAllProducts()
        {
            return Product::all();
        }
    
        public function getProductById($id)
        {
            return Product::findOrFail($id);
        }
    
        public function createProduct($data)
        {   
            $product = Product::create($data);
            
            if (isset($data['image'])) {
                $this->uploadProductImage($data['image']);
            }
    
            if (isset($data['categories'])) {
                $product->categories()->sync($data['categories']);
            }
    
            return $product;
        }
    
        public function updateProduct($id, $data)
        {
            $product = Product::findOrFail($id);
            $product->update($data);
            return $product;
        }
    
        public function deleteProduct($id)
        {
            $product = Product::findOrFail($id);
            $product->delete();
        }

        public function uploadProductImage($image)
    {
        
    }
    }