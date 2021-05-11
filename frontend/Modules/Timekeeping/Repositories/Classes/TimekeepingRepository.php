<?php


namespace Modules\Timekeeping\Repositories\Classes;

use App\Repositories\Classes\BaseRepository;
use Modules\Timekeeping\Entities\Timekeeping;
use Modules\Timekeeping\Repositories\Interfaces\ITimekeepingRepository;

class TimekeepingRepository extends BaseRepository implements ITimekeepingRepository
{
    protected $_modelClass = Timekeeping::class;

    public function getReport(string $from,string $to)
    {
        $result = $this->_model->whereBetween('working_day', [$from, $to])->get();
        return $result;
    }
}
