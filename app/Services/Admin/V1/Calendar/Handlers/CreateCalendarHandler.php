<?php

namespace App\Services\Admin\V1\Calendar\Handlers;

use App\Models\Admin\V1\Pages\Calendar;
use App\Services\Admin\V1\Calendar\Repositories\CalendarRepositoryInterface;

class CreateCalendarHandler
{

    private $calendarRepository;

    public function __construct(
        CalendarRepositoryInterface $calendarRepository
    )
    {
        $this->calendarRepository = $calendarRepository;
    }

    /**
     * @param array $data
     * @return Calendar
     */
    public function handle(array $data): Calendar
    {
        return $this->calendarRepository->createFromArray($data);
    }
}
