<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthDomainRedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the logged-in user is an admin
        if (auth()->check() && (auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'partner')) {
            // Get the protocol (http or https)
            $protocol = $request->isSecure() ? 'https' : 'http';
            $baseUrl = parse_url(config('app.url'), PHP_URL_HOST) ?? $request->getHost();
            // Define the main domain (no subdomains)
            $mainDomain = "{$protocol}://{$baseUrl}";

            // Check if the current host is not the main domain
            if ($request->getHost() !== parse_url($mainDomain, PHP_URL_HOST)) {
                // Set the session flag to avoid future redirects
                $request->session()->put('redirected_to_main_domain', true);

                // Redirect to the main domain
                return redirect()->to($mainDomain . $request->getRequestUri());
            }
        }

        // Proceed with the request if the user is not admin or already on the main domain
        return $next($request);
    }
}
