<?php


namespace Core\Logging\Http\Middleware;
use Closure;
use Core\Logging\Entities\Logging;
use Core\Logging\Helpers\LoggingHelper;
use Spatie\Activitylog\Contracts\Activity;


class LogRequests
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if ($response->exception){
            LoggingHelper::error($request->method(),$request->path(),json_encode($request->query()) . " \n " . $response->exception->getMessage());
        }else{
            LoggingHelper::infor($request->method(),$request->path(), json_encode($request->query()));
        }
        return $response;
    }

}
