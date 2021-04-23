<?php


namespace Core\Logging\Helpers;


use Carbon\Traits\Date;
use Illuminate\Support\Facades\Auth;
use Core\Logging\Entities\Logging;

class LoggingHelper
{
    public static function infor($method,$action,$detail){
        $log = new Logging;
        $log->userId = Auth::user()->id;
        $log->level = 1;
        $log->method = $method;
        $log->action = $action;
        $log->detail = $detail;
        $log->created_by = Auth::user()->id;
        $log->type = 2;
        $log->save();
    }
    public static function error($method,$action,$detail){
        $log = new Logging;
        $log->userId = Auth::user()->id;
        $log->level = 2;
        $log->method = $method;
        $log->action = $action;
        $log->detail = $detail;
        $log->created_by = Auth::user()->id;
        $log->type = 2;
        $log->save();
    }
}
