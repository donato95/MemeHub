<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class SetLocal
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
        $lang = $request->segment(1);
        if ($lang && !in_array($lang, config('app.avalble_langs'))) {
            $lang = config('app.fallback_locale');
        }

        if(Session::has('lang')) {
            URL::defaults(['lang'=>$lang]);
            App::setLocale(Session::get('lang'));
        }
        return $next($request);
    }
}
