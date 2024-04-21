<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

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
        if($locale = $request->header('X-Locale')){
            $languages = ["en", "vi"];
            if(in_array($locale, $languages)){
                App::setLocale($locale);
            }
            // return abort(400, __("header.miss_param.location"));
        }
        $date = $request->header('X-DateTime');
        $version = $this->detectVersionApi($date);
        $request->server->set('REQUEST_URI', $version . $request->getRequestUri());
        return $next($request);
    }

    private function detectVersionApi($date)
    {
        switch($date){
            case "2024-04-15":
                return "/v2";
            default:
                return "/v1";
        }
    }
}
