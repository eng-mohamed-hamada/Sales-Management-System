<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class check_permission
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
        if(!Auth::check()){
            return redirect('/login');
        }else if(Auth::check()){
            $permission = Auth::user()->permission;
            if($permission != 'admin'){
                return redirect('/sales');
            }else{
                return $next($request);
            }
        }
        
    }
}
