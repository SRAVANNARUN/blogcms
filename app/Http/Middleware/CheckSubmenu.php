<?php

namespace App\Http\Middleware;

use Closure;
use App\Submenu;
class CheckSubmenu
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
        if(Submenu::all()->count()<1){
            return redirect()->route('submenus.index')->with('info', 'You do not have submenus yet, please create submenu first.');
        }
        return $next($request);
    }
}
