<?php

namespace App\Http\Middleware;

use Closure;
use App\Mainmenu;
class CheckMainmenu
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
        if(Mainmenu::all()->count()<1){
            return redirect()->back()->with('info', 'You do not have main menu yet, please create main menu first.');
        }
        return $next($request);
    }
}
