<?php

namespace App\Repositories;

use Modules\ContentManagement\Models\News;
use App\Repositories\Repository;

class NewsRepository extends Repository
{
    protected $modelClass;
    public function __construct(News $news)
    {
        $this->modelClass = $news;
    }    

    public function getAllWithCoverPhoto()
    {
        return $this->modelClass->with('coverPhoto')->get();
    }

    public function getByTypeWithPhotos($type)
    {
        return $this->modelClass->with(['coverPhoto', 'photos'])
            ->where('type', $type)
            ->get();
    }

    public function countByType($type)
    {
        return $this->modelClass->where('type', $type)->count();
    }

    public function countAll()
    {
        return $this->modelClass->count();
    }
}
