<?php

namespace Modules\BusinessOperations\Repositories;

use App\Repositories\Repository;
use Modules\BusinessOperations\Models\Company;

class CompanyRepository extends Repository{

    public function __construct(Company $company)
    {
        $this->modelClass = $company;
    }
    public function withCompany($company){

    }
}
