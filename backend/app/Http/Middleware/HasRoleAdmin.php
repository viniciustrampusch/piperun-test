<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Constants\HttpResponseStatus;

class HasRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role()->slug !== 'admin') {
            return response()->json([
                'error' => 'Não autorizado'
            ], HttpResponseStatus::UNAUTHORIZED);
        }

        return $next($request);
    }
}
