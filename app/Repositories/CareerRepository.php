<?php

namespace App\Repositories;

use App\Models\Career;
use App\Repositories\Repository;


class CareerRepository extends Repository{

    public function __construct(Career $career)
    {
        $this->modelClass = $career;
    }
}
