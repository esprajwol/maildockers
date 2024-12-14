<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Session;
class SubdomainRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $excludedRoutes = [
            // '/login', // login
            '/oauth/gmail/callback' // Google callback route
        ];

        if (in_array($request->path(), $excludedRoutes)) {
            return $next($request);
            }
        if ($request->is('login')) {
            return $next($request); // If it's the login page, don't apply the subdomain redirect
        }

        $protocol = $request->isSecure() ? 'https' : 'http';
        $baseUrl = parse_url(config('app.url'), PHP_URL_HOST) ?? $request->getHost();
        $currentHost = $request->getHost();
        $mainDomain = "{$protocol}://{$baseUrl}";
        if(Auth::guest()){
                return $this->handleGeoIPLogic($request, $mainDomain, $currentHost, $protocol, $baseUrl, $next);
        }

        return $next($request);
    }

    protected function handleGeoIPLogic(
        Request $request,
        string $mainDomain,
        string $currentHost,
        string $protocol,
        string $baseUrl,
        Closure $next
    ){
        $geoDetails = geoip(request()->ip());

        $countryCode = $geoDetails->iso_code ?? null;
        $country = $countryCode ? Country::where('code', $countryCode)->first() : null;

        // If no country information is found, just proceed
        if (!$country) {
            // If we're not on the main domain, redirect back
            if ($currentHost !== parse_url($mainDomain, PHP_URL_HOST)) {
                return redirect()->to($mainDomain . $request->getRequestUri());
            }
            return $next($request);
        }

        $partner = User::where('country_id', $country->id)->where('user_type', 'partner')->first();
        // If a partner exists and has a subdomain prefix, redirect to the subdomain
        /* $targetDomain = $partner && $partner->sub_domain_prefix
           ? "{$protocol}://" . strtolower($partner->sub_domain_prefix) . ".{$baseUrl}"
            : $mainDomain;*/
        if ($partner && !empty($partner->sub_domain_prefix)) {
            $subDomainPrefix = strtolower($partner->sub_domain_prefix);
            $targetDomain = "{$protocol}://{$subDomainPrefix}.{$baseUrl}";
            $country = Country::find($partner->country_id);
            $lang = \App\Models\Language::where("is_active", 1)->where("code", $country->language_code)->first();

        } else {
            $targetDomain = $mainDomain;
            $lang = \App\Models\Language::where("is_active", 1)->where("code", 'en')->first();
        }
        $targetHost = parse_url($targetDomain, PHP_URL_HOST);

        // If we're not already on the correct subdomain, perform the redirect
        if ($currentHost !== $targetHost) {
            setLangSession($lang->code,$lang->direction);
            return redirect()->to($targetDomain . $request->getRequestUri());
        }

        return $next($request);
    }
}
