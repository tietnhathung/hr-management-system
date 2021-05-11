<?php


namespace Modules\Timekeeping\Services;


use Core\User\Repositories\Interfaces\IUserRepository;
use DateTime;
use Modules\Timekeeping\Repositories\Interfaces\ITimekeepingRepository;

class TimekeepingService
{
    private $timekeepingRepository;
    protected $userRepository;

    public function __construct(ITimekeepingRepository $iTimekeepingRepository,IUserRepository $iUserRepository)
    {
        $this->timekeepingRepository = $iTimekeepingRepository;
        $this->userRepository = $iUserRepository;
    }

    public function getReport(int $month,int $year){
        $from = date("$year-$month-01");
        $to = date("$year-$month-t");
        $lastDay = date( "t",strtotime($to) );
        $listDay = array();
        $dataUser = $this->userRepository->getAll();
        $dataTimekeeping = $this->timekeepingRepository->getReport($from,$to)->groupBy("user_id");


        for ($day=1 ; $day <= (int)$lastDay ;  $day++ ){
            $thueng = date('l',strtotime(date("$year-$month-$day")));
            $listDay[] = [
                'date' => date("$year-$month-$day"),
                "thu" => $this->eng2vn($thueng),
                "dayOff" => $thueng == "Sunday" || $thueng == "Saturday" ? true : false
            ];
        }
        return [
            "users" => $dataUser,
            "listDay" => $listDay,
            "timekeeping" => $dataTimekeeping
        ];
    }

    private function eng2vn($thuEng){
        $thu = 'Chủ nhật';
        switch ($thuEng) {
            case 'Monday':
                $thu = 'Thứ 2';
                break;
            case 'Tuesday':
                $thu = 'Thứ 3';
                break;
            case 'Wednesday':
                $thu = 'Thứ 4';
                break;
            case 'Thursday':
                $thu = 'Thứ 5';
                break;
            case 'Friday':
                $thu = 'Thứ 6';
                break;
            case 'Saturday':
                $thu = 'Thứ 7';
                break;
            default:
                $thu = 'Chủ nhật';
        }
        return $thu;
    }
}
