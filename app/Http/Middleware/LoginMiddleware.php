<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    public function handle($request, Closure $next)
    {
        if(!session()->has('usercount')){
            return redirect('/');
        }
        return $next($request);
    }
}
