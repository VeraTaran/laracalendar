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

    /**
     * @param array $data
     * @return Calendar
     */
    public function storeNewCalendar(array $data): Calendar
    {
        return $this->createCalendarHandler->handle($data);
    }
//    public function updateEventCalendar(array $data): Calendar
//    {
//        return $this->createCalendarHandler->handle($data);
//    }
    /**
     * @param Calendar $calendar
     * @param array $data
     * @return Calendar
     */
    public function updateEventCalendar(Calendar $calendar, array $data): Calendar
    {
        return $this->calendarRepository->updateFromArray($calendar, $data);
    }
}
