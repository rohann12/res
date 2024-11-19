<?php

namespace App\Repositories;

use App\Models\Service;
use App\Repositories\Repository;


class ServiceRepository extends Repository{

    protected $modelClass;

    public function __construct(Service $model)
    {
        $this->modelClass = $model;
    }

    public function getAllWithPhotos()
    {
        return $this->modelClass->with('photos')->get();
    }
    
    public function getByIdWithPhotos($id)
    {
        return $this->modelClass->with('photos')->findOrFail($id);
    }
}
