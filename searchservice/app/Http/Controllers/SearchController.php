<?php

namespace App\Http\Controllers;

use App\Service\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    protected $searchService;
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function searchByProducts()
    {
        $products = $this->searchService->getProducts();
        return response()->json($products);
    }
}
