<?php

namespace Modules\ContentManagement\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\BusinessOperations\Models\Project;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photos';
    protected $fillable = ['photo_link', 'is_cover'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function news(){
        return $this->belongsTo(News::class);
    }
}
