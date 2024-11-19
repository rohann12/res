<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'position',
        'description',
        'photo_url',
        'linkedin_link',
        'fb_link',
        'is_active',
        'insta_link',
        'email',
        'phone',
        'address',
        'joined_date',
        'order',
    ];
}
