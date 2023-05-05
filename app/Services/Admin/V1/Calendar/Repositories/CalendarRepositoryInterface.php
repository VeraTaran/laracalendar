<?php

namespace App\Services\Admin\V1\Calendar\Repositories;

use App\Models\Admin\V1\Pages\Calendar;

interface CalendarRepositoryInterface
{
    public function createFromArray(array $data): Calendar;

    public function updateFromArray(Calendar $calendar, array $data);
}
