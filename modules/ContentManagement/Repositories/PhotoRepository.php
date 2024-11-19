<?php

namespace Modules\ContentManagement\Repositories;

use Modules\ContentManagement\Models\Photo;
use App\Repositories\Repository;


class PhotoRepository extends Repository{

    public function __construct(Photo $photo)
    {
        $this->modelClass = $photo;
    }
}
