<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class IsUser
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
        if (Auth::user() &&  Auth::user()->permission == 'USER') {
            return $next($request);
        }

        Session::flash('danger', 'You dont have permission to access the page');
        return redirect('/home');
    }
}
