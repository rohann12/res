<?php

namespace App\Repositories;

use Modules\Visitor\Models\Client;
use App\Repositories\Repository;


class ClientRepository extends Repository{

    public function __construct(Client $client)
    {
        $this->modelClass = $client;
    }
}
