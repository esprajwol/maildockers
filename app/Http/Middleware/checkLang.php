<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Str;

class checkLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check Ip for localization
        $geoDetails = geoip(request()->ip());
        if (!getSession('lang')) {
            $country = Country::where("code", "=", Str::lower($geoDetails->iso_code))->first();
            if ($country)
                setValueSession($country->language_code);
            else
                setValueSession("en");
        }
        return $next($request);
    }
}
