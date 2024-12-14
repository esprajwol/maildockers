<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->check()) {
            if (isAdmin()) {


                if(!empty(user()->email_verified_at)) {
                    return $next($request);
                }

               // return $next($request);

               return to_route("verification.notice");
            }


            // Partner
            if (isPartner() || isPartnerStaff()) {
                return to_route("partner.dashboard");
            }

        }

        abort(404);
    }
}
