<?php

namespace App\Services\Admin\V1\Event\Repositories;

use App\Models\Admin\V1\Pages\Event;

class EloquentEventRepository implements EventRepositoryInterface
{
    public function createFromArray(array $data): Event
    {
        $event = new Event();
        $event = $event->create($data);
        return $event;
    }
    public function updateFromArray(Event $event, array $data)
    {
        $event->update($data);
        return $event;
    }
}
