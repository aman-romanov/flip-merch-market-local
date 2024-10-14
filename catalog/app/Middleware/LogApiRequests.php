<?php

namespace App\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogApiRequests
{
    public function handle($request, Closure $next)
    {
        Log::channel('api')->info('API request', ['request' => $request->all()]);

        return $next($request);
    }
}