<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $table = 'careers';
    protected $fillable = [
        'title',
        'description',
        'type',
        'category',
        'requirements',
        'responsibilities',
        'published_at',
        'expiration_date',
    ];

    protected $dates = [
        'published_at',
        'expiration_date',
    ];
}
