<?php

namespace App\Http\Middleware;
use Closure;

class LoginMiddleware
{
    public function handle($request, Closure $next)
    {

        if (empty(Session('usercount'))){
            return redirect('/');
        }
        return $next($request);
    }
}
