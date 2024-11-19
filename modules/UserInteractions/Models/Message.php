<?php

namespace Modules\Visitor\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'organization_name', 'message', 'status'];

    // Define the enum values for status
    public const STATUS_READ = 'read';
    public const STATUS_UNREAD = 'unread';
}
