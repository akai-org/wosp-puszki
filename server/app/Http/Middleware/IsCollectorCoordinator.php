<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsCollectorCoordinator
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
        //Check if user is admin or superadmin
        if ($request->user()->hasAnyRole(['collectorcoordinator', 'admin', 'superadmin'])) {
            return $next($request);
        } else {
            //Nie dozwolono (brak admina/superadmina)
            return redirect()->route('main')->with('error', 'Nie znaleziono.');
        }
    }
}
