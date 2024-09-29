<?php

namespace App\Service;

use Illuminate\Support\Facades\Http;

class SearchService
{
    public function getProducts()
    {
        $response = Http::get('http://product-service/api/products');
        return response()->json($response);
    }
}
