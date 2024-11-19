<?php

namespace App\Repositories;

use App\Models\Photo;
use App\Repositories\Repository;


class PhotoRepository extends Repository{

    public function __construct(Photo $photo)
    {
        $this->modelClass = $photo;
    }
}
