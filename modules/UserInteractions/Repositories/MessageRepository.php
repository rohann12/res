<?php

namespace App\Repositories;

use Modules\Visitor\Models\Message;
use App\Repositories\Repository;


class MessageRepository extends Repository{

    public function __construct(Message $message)
    {
        $this->modelClass = $message;
    }
}
