<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPenjual
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'penjual') {
            return $next($request);
        }

        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }
}
