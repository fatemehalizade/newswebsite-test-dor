<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$roles): Response
    {
        $roles=explode("|",$roles);
        $userRoles=Auth::user()->roles;
        foreach ($userRoles as $key => $userRole) {
            if(in_array($userRole->name,$roles))
                return $next($request);
        }
        // abort returns a json formatted with message and code.
        return abort(Response::HTTP_FORBIDDEN);
    }
}
