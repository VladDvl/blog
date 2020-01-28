<?php

namespace App\Http\Middleware;

use App;
//App::getLocale(); //-получить текущую локаль
use Closure;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);

        if($request -> get('lang')) {
            $lang = $_GET['lang'];
            //dd($lang);
            setcookie('lang',$request->get('lang'),time()+3600,'/');
            return redirect()->back();
        } else {
            if(isset($_COOKIE['lang'])) {
                $lang = $_COOKIE['lang'];
            }
        }

        App::setLocale($lang);
        return $next($request);
    }
}
