<?php

namespace App\Http\Middleware;

use Closure;

class IsSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if user is superadmin
        if ($request->user()->hasAnyRole(['superadmin'])) {
            return $next($request);
        } else {
            // Nie dozwolono (brak admina/superadmina)
            return redirect()->route('main')->with('error', 'Nie znaleziono.');
        }
    }
}
