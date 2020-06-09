<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;
class CheckCategory
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
        if(Category::all()->count()<1){
            return redirect(route('categories.create'))->with('info', 'You do not have categories yet.');
        }
        return $next($request);
    }
}
