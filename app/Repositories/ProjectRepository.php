<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\Repository;


class ProjectRepository extends Repository
{


    protected $modelClass;

    public function __construct(Project $model)
    {
        $this->modelClass = $model;
    }

    public function getAllWithPhotos()
    {
        return $this->modelClass->with('photos')->get();
    }

    public function getByStatusWithPhotos($status)
    {
        return $this->modelClass->with('photos')->where('status', $status)->get();
    }
}

