<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $roles): Response
    {
        if(!Auth::check())
            abort(403);

        // get user
        $user = Auth::user(); 

        foreach($roles as $role){
            // check role if exist in user
            if($role == $user->role)
                return $next($request);
        }
        
        abort(403);
    }
}
