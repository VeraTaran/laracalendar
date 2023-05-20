<?php

namespace App\Services\Admin\V1\Calendar\Repositories;

use App\Models\Admin\V1\Pages\Calendar;

interface CalendarRepositoryInterface
{
    public function find(int $id): Calendar;
    public function getCalendar():array;
    public function createFromArray(array $data): Calendar;
    public function updateFromArray(int $id, array $data);
}
