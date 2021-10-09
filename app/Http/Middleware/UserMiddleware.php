<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (auth()->user()->user_type == 'User') {
            return redirect(route('landing'));
        }

        return $next($request);
    }

}
