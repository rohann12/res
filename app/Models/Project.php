<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'name',
        'description',
        'short_description',
        'on_carousel',
        // 'client',
        // 'architect',
        // 'builder',
        // 'budget',
        'status',
        ];

    // Assuming 'status' is an enum, you can define its possible values
    const STATUS_UPCOMING = 'upcoming';
    const STATUS_RUNNING = 'running';
    const STATUS_COMPLETED = 'completed';

    public static function getStatusOptions()
    {
        return [
            self::STATUS_UPCOMING,
            self::STATUS_RUNNING,
            self::STATUS_COMPLETED,
        ];
    }

    // Relationships

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function photos(){
        return $this->hasMany(Photo::class);
    }

}
