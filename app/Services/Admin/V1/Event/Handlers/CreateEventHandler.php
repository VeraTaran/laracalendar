<?php

namespace App\Services\Admin\V1\Event\Handlers;

use App\Models\Admin\V1\Pages\Event;
use App\Services\Admin\V1\Event\Repositories\EventRepositoryInterface;

class CreateEventHandler
{

    private EventRepositoryInterface $eventRepository;

    public function __construct(
        EventRepositoryInterface $eventRepository
    )
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @param array $data
     * @return Event
     */
    public function handle(array $data): Event
    {
        return $this->eventRepository->createFromArray($data);
    }
}
