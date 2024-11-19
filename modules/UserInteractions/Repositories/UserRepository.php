<?php

namespace Modules\UserInteractions\Repositories;

use Modules\UserInteractions\Models\User;


use App\Repositories\Repository;


class UserRepository extends Repository{

    public function __construct(User $user)
    {
        $this->modelClass = $user;
    }
}
