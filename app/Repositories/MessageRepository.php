<?php
namespace App\Repositories;

use App\Models\Message;

class MessageRepository extends BaseRepository
{
    private $model;

    public function __construct(Message $model)
    {
        $this->model = $model;
    }
}