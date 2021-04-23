<?php

namespace Core\Logging\Http\Controllers;

use App\Helpers\DateTimeHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Matrix\Exception;
use Core\Logging\Entities\Logging;
use Core\Logging\Entities\Loggingactivity;
use Core\Logging\Entities\LogItem;
use Spatie\Activitylog;
class LoggingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    private $_view = 'logging::';

    public function index(Request $request)
    {
        list($from, $to) = DateTimeHelper::getDateTime($request);
//        $company = Auth::user()->company;
//        $cps = $company->childrenIds;
        //dd($cps);
        $data ['users'] = User::all()->pluck("fullname", "id")->prepend("All", "");;

        $logs = Logging::whereBetween('created_at',[$from, $to])->with("User");
        if ($request->canbo != null){
//            $logs = $logs->where("userId",$request->canbo);
            $logs = $logs->where("userId",$request->canbo);
        }
        if ($request->level != null){
            $logs = $logs->where("level","=",$request->level);
        }
        if ($request->type != null){
            $logs = $logs->where("type","=",$request->type);
        }else{
            $logs = $logs->where("type","=",2);
        }
         $logs=  $logs->orderBy("created_at", "DESC")->paginate(30);
        return view($this->_view . __FUNCTION__, compact('from', 'to', 'data','logs'));
    }

    public function loggingactivity(Request $request){
        list($from, $to) = DateTimeHelper::getDateTime($request);
//        $company = Auth::user()->company;
//        $cps = $company->childrenIds;
        $data ['users'] = User::all()->pluck("fullname", "id")->prepend("All", "");;

        $logs = Loggingactivity::whereBetween('created_at',[$from, $to])->with("User");
        if ($request->canbo != null){
            $logs = $logs->where("userId",$request->canbo);
        }
        if ($request->level != null){
            $logs = $logs->where("level","=",$request->level);
        }
//        if ($request->type != null){
//            $logs = $logs->where("type","=",$request->type);
//        }
        $logs=  $logs->where("type","=",2)->orderBy("created_at", "DESC")->paginate(30);
        return view($this->_view . __FUNCTION__, compact('from', 'to', 'data','logs'));

    }

}
