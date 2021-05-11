<?php

namespace Modules\Timekeeping\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        $month = '05';
        $year = '2021';
        $data = $this->_timekeepingService->getReport($month,$year);

        return view('timekeeping::index',compact('data'));
    }
}
