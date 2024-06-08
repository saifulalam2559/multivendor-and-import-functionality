<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdminMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {


        if (auth()->user()->role === 'admin') {

            return $next($request);
            
        } elseif (auth()->user()->role === 'seller') {

            return redirect()->route('ukunden.listing');
            
        } elseif (auth()->user()->role === 'freelancer') {

            return redirect()->route('freelancer.dashboard');
            
        } else {

            return redirect()->route(auth()->user()->role)->with('error', 'You do not have access here !!');
        }
    }

}
