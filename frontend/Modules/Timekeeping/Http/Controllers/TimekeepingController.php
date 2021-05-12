<?php

namespace Modules\Timekeeping\Http\Controllers;

use App\Exports\TimeskeepingExcel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Timekeeping\Services\TimekeepingService;

class TimekeepingController extends Controller
{
    private $_timekeepingService;

    public function __construct(TimekeepingService $timekeepingService)
    {
        $this->_timekeepingService = $timekeepingService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $month = $request->month ?? date('m');
        $year =  $request->year ?? date('Y');
        $data = $this->_timekeepingService->getReport($month,$year);

        return view('timekeeping::index',compact('data'));
    }

    public function download(Request $request){
        $month = $request->month ?? date('m');
        $year =  $request->year ?? date('Y');
        $data = $this->_timekeepingService->getReport($month,$year);

        return Excel::download(new TimeskeepingExcel($data,$month,$year), "bao cao cham cong thang $month nam $year.xlsx");
    }
}
