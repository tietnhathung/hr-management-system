<?php


namespace Core\Logging\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;
use Core\Logging\Helpers\LoggingActivityHelper;


class Logactivityrequests
{
    public function handle($request, Closure $next)
    {

        $response = $next($request);
        if (isset(Auth::user()->id)){
            if (isset($response->exception)){
                if (!($request->path() == 'login' || $request->path() == 'logout')){
                    LoggingActivityHelper::error($request->method(),$request->path(),json_encode($request->query()) . " \n " . $response->exception->getMessage());
                }
            }else{
                if ( !($request->path() == "logging/activity" || $request->path() == "logging" || $request->path() == 'login' || $request->path() == 'logout' )){
                    LoggingActivityHelper::infor($request->method(),$request->path(), json_encode($request->query()));
                }
            }
        }
        return $response;
    }
}
