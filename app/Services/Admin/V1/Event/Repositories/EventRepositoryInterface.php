<?php

namespace App\Services\Admin\V1\Event\Repositories;

use App\Models\Admin\V1\Pages\Event;

interface EventRepositoryInterface
{
    public function createFromArray(array $data): Event;

    public function updateFromArray(Event $event, array $data): Event;
}
