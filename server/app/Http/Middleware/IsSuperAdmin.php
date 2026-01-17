<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Check if user is superadmin
        if ($request->user()->hasAnyRole(['superadmin'])) {
            return $next($request);
        } else {
            return redirect()->route('main')->with('error', 'Nie znaleziono.');
        }
    }
}
