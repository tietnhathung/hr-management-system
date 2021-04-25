<?php


namespace Core\Role\Repositories\Classes;

use App\Repositories\Classes\BaseRepository;
use Core\Role\Repositories\Interfaces\IRoleRepository;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements IRoleRepository
{
    protected $_modelClass = Role::class;

    public function paginate()
    {
    }
}
