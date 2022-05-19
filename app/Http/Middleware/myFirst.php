<?php

namespace App\Http\Middleware;

use Closure;

class myFirst
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->input('name') === 'maryam') {
            return $next($request);
        }
        return response()->json('error');

    }
}
