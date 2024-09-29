<?php

namespace App\Providers;

use App\Services\CartService;
use App\Services\CartServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(CartServiceInterface::class, CartService::class);
    }

    public function boot(): void
    {

    }
}
