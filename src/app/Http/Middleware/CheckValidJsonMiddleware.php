<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckValidJsonMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->expectsJson() && $request->isJson()) {
            json_decode($request->getContent());

            if (json_last_error() !== JSON_ERROR_NONE) {
                return response()->json([
                    'message' => 'invalid_json_format',
                ], 400);
            }
        }

        return $next($request);
    }
}
