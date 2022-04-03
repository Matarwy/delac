<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (\Session::has('timezone')) {
            config('app.timezone', \Session::get('timezone'));
        } else {
            $ip = $request->ip();
            $ipInfo = file_get_contents('http://ip-api.com/json/' . $ip);
            $ipInfo = json_decode($ipInfo);
            $timezone = "UTC";
            if(isset($ipInfo->timezone)){
                $timezone = $ipInfo->timezone;
            }
            config('app.timezone', $timezone);
            \Session::put('timezone', $timezone);

        }
        if (\Session::has('locale')) {
            \App::setLocale(\Session::get('locale'));
            Carbon::setLocale(\Session::get('locale'));
        }

        if(\Session::has('currantstep') && !$request->is('instructor/courses/create') && !$request->ajax()){
            \Session::forget('currantstep');
            \Session::forget('courseid');
        }

        return $next($request);
    }
}
