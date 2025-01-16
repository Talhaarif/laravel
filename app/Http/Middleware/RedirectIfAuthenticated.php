<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): mixed
    {
        if (auth()->guard($guards)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
