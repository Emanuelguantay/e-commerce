<?php

namespace App\Http\Middleware;

use Closure;
USE App\Role;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //seguridad
    public function handle($request, Closure $next, $role)
    {
        if (auth()->user()->role_id == Role::CLIENTE) {
            abort(401,__("No puedes acceder a esta zona"));
        }
        return $next($request);
    }


}
