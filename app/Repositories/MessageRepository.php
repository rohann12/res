<?php

namespace App\Repositories;

use App\Models\Message;
use App\Repositories\Repository;


class MessageRepository extends Repository{

    public function __construct(Message $message)
    {
        $this->modelClass = $message;
    }
}
