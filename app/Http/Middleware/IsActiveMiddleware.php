<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(isLoggedIn()){
            if(currentRoute() == 'distributor.stripe.success'){

                $request->merge(["stripeSuccess" => "Purchased Successfully"]);

                return $next($request);
            }

            if(!isActiveUser()){

                return $next($request);
            }
            return $next($request);
        }

        return to_route('login');
    }
}
