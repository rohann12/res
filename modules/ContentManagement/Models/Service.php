<?php

namespace Modules\ContentManagement\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
