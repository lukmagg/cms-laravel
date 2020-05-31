<?php

namespace App\Http\Middleware;

use Closure, Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    // El metodo handle es comun a todos los middleware
    //  aqui dentro es donde se ejecutan las acciones.
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role == "1"):
            return $next($request);
        else:
            return redirect('/');
        endif;
    }
}
