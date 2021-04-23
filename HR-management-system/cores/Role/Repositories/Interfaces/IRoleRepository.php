<?php

namespace Core\Role\Repositories\Interfaces;


use App\Repositories\Interfaces\IBaseRepository;

interface IRoleRepository extends IBaseRepository {

    public function paginate();

}
