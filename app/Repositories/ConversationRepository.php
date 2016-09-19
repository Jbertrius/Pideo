<?php
namespace App\Repositories;

use App\Models\Conversation;

class ConversationRepository extends BaseRepository
{
    /**
     * @var Conversation
     */
    protected $model;

    public function __construct(Conversation $model)
    {
        $this->model = $model;
    }

    public function getByName($name)
    {
        return $this->model->where('name', $name)->firstOrFail();
    }
}