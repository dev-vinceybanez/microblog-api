<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAPIKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $reqApiKey = $request->header('x-api-key');
        $validApiKey = env('API_KEY');

        if($reqApiKey !== $validApiKey) {
            return response()->json("Unauthorized", 401);
        }

        return $next($request);
    }
}
