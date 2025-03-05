<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventSelfFollow
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Prevent Follow Self
        if(auth()->user()->id === $request->user->id) {
            return response()->json("Cannot follow/unfollow self", 400);
        }

        return $next($request);
    }
}
