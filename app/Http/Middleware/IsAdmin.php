<?php

namespace App\Http\Middleware;

use App\Configuration;
use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(!Configuration::check()){
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect(action('AuthController@login'));
            }
        }


        return $next($request);
    }
}
