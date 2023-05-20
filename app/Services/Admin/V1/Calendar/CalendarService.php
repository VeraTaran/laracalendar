<?php

namespace App\Services\Admin\V1\Calendar;

use App\Models\Admin\V1\Pages\Calendar;
use App\Services\Admin\V1\Calendar\Handlers\CreateCalendarHandler;
use App\Services\Admin\V1\Calendar\Repositories\CalendarRepositoryInterface;

class CalendarService
{
    private $createCalendarHandler;
    private $calendarRepository;

    public function __construct(
        CreateCalendarHandler $createCalendarHandler,
        CalendarRepositoryInterface $calendarRepository
    )
    {
        $this->createCalendarHandler = $createCalendarHandler;
        $this->calendarRepository = $calendarRepository;
    }
    public function getCalendar(): array
    {
        return $this->calendarRepository->getCalendar();
    }

    /**
     * @param array $data
     * @return Calendar
     */
    public function storeNewCalendar(array $data): Calendar
    {
        return $this->createCalendarHandler->handle($data);
    }
    /**
     * @param string $id
     * @param array $data
     * @return Calendar
     */
    public function updateEventCalendar(int $id, array $data): Calendar
    {
        return $this->calendarRepository->updateFromArray($id, $data);
    }
}
