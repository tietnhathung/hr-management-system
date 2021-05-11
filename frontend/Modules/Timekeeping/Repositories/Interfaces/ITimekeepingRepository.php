<?php

namespace Modules\Timekeeping\Repositories\Interfaces;

use App\Repositories\Interfaces\IBaseRepository;

interface ITimekeepingRepository extends IBaseRepository {
    function getReport(string $from,string $to);
}
