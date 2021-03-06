<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckUserType
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

        if (!Auth::user()->admin) {
            return redirect()->back()->with('info', 'You do not have permissions.');
        }
        return $next($request);
    }
}
