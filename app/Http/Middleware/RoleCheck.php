<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Auth;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(!Auth::check()){
            return redirect('/login');

        }

        if(auth()->user()->role == 'admin' || auth()->user()->role == 'kordinator' || auth()->user()->role == 'user' || auth()->user()->role == 'guest' ){
            return $next($request);
        }
        return redirect('/login')->withErrors(['errors' => 'invalid role']);







    }
}
