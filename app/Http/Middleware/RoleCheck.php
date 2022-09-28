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
    public function handle(Request $request, Closure $next, ...$roles)
    {

        if(!Auth::check()){
            return redirect('/login');

        }

        // dd($roles);


        if(!in_array($request->user()->role,$roles)){
            return redirect()->back()->withErrors(['errors' => 'invalid role']);
        }

        return $next($request);













    }
}
