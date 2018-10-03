<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;

class LoginMiddleware
{
    public function handle($request, Closure $next)
    {

        if (!session('usercount')){
            return redirect('/');
        }
        return $next($request);

    }
}
