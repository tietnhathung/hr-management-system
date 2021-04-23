<?php

namespace Core\User\Repositories\Interfaces;

use App\Repositories\Interfaces\IBaseRepository;

interface IUserRepository extends IBaseRepository {

    public function paginate(?string $username);

    public function create(array $attributes);

    public function update($id, array $attributes);
}
