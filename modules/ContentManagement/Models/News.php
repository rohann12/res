<?php

namespace Modules\ContentManagement\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = ['title', 'description', 'author', 'type'];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function coverPhoto()
    {
        return $this->hasOne(Photo::class)->where('is_cover', 1);
    }
}
