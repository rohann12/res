<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Repository;


class EmployeeRepository extends Repository{

    public function __construct(Employee $employee)
    {
        $this->modelClass = $employee;
    }
}
