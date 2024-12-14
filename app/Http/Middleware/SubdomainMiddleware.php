<?php

namespace App\Http\Middleware;

use App\Services\Models\User\UserService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubdomainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host        = $request->getHost();
        $hostExplode = explode('.', $host);
        $subdomain   = ($hostExplode[0] == 'www' ? $hostExplode[1] : $hostExplode[0]);

        $domain = (new UserService())->findByColumn(["username","=", $subdomain]);

        if (is_null($domain)) {
            abort(404);
        }

        $request->attributes->add(['subdomain' => $subdomain]);
        return $next($request);
    }
}
