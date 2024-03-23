<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CheckHeaderApiMiddleware 
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
        if($locale = $request->hasHeader('X-Locale')){
            $languages = ["en", "vi"];
            if(in_array($locale, $languages)){
                App::setLocale($locale);
            }
            // return abort(400, __("header.miss_param.location"));
        }

        if($request->hasHeader('X-DateTime')){
            return abort(400, __("header.miss_param.date_time"));
        }

        return $next($request);
    }
}
