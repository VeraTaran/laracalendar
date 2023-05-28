<?php

namespace App\Services\Admin\V1\Event;

use App\Models\Admin\V1\Pages\Event;
use App\Services\Admin\V1\Event\Handlers\CreateEventHandler;
class EventService
{
    private CreateEventHandler $createEventHandler;

    public function __construct(
        CreateEventHandler $createEventHandler
    )
    {
        $this->createEventHandler = $createEventHandler;
    }

    /**
     * @param array $data
     * @return Event
     */
    public function storeNewEvent(array $data): Event
    {
        return $this->createEventHandler->handle($data);
    }
}
