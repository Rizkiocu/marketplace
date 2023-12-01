<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBuyer
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'buyer') {
            return $next($request);
        }

        return response()->json([
            'message' => 'Unauthorized | no access'
        ], 401);
    }
}
