<?php


namespace Core\Logging\Helpers;


use Illuminate\Support\Facades\Auth;
use Core\Logging\Entities\Loggingactivity;

class LoggingActivityHelper
{
    public static function infor($method,$action,$detail){
        $log = new Loggingactivity;
        $log->userId = Auth::user()->id;
        $log->level = 1;
        $log->method = $method;
        $log->action = $action;
        $log->detail = $detail;
        $log->type = 2;
        $log->save();
    }
    public static function error($method,$action,$detail){
        $log = new Loggingactivity;
        $log->userId = Auth::user()->id;
        $log->level = 2;
        $log->method = $method;
        $log->action = $action;
        $log->detail = $detail;
        $log->type = 2;
        $log->save();
    }
}
