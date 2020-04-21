<?php

namespace App\Http\Middleware;

use Closure;

class HasAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $access)
    {   
        // if (!$request->user())
        $accesses = $request->user()->role->accesses;

        foreach ($accesses as $key => $value) {
            if ($value->access == $access) {
                return $next($request);
            }
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized',
            'accesses' => $accesses,
            'access' => $access
        ], 401);
    }
}
