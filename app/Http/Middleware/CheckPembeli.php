<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPembeli
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'pembeli') {
            return $next($request);
        }

        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }
}
