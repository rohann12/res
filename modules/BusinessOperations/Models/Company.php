<?php

namespace Modules\BusinessOperations\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Event\Test\PartialMockObjectCreated;

class Company extends Model
{
    use HasFactory;
    protected $table = "companies";
    protected $fillable = [
        'name',
        'slogan',
        'logo',
        'welcome_text',
        'description',
        'email',
        'contact',
        'address',
        'fbLink',
        'instaLink',
        'linkedInLink'

    ];


}
