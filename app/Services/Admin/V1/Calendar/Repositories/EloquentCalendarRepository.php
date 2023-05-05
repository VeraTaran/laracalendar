<?php

namespace App\Services\Admin\V1\Calendar\Repositories;

use App\Models\Admin\V1\Pages\Calendar;

class EloquentCalendarRepository implements CalendarRepositoryInterface
{
//    public function find(int $id)
//    {
//        return Calendar::find($id);
//    }
//
//    public function search(array $filters = [])
//    {
//        $query = Calendar::query();
//        $this->applyFilters($query, $filters);
//        return $query->paginate();
//    }

    public function createFromArray(array $data): Calendar
    {
        $calendar = new Calendar();
        $calendar->create($data);
        return $calendar;
    }
    public function updateFromArray(Calendar $calendar, array $data)
    {
        $calendar->update($data);
        return $calendar;
    }
//
//    private function applyFilters(Builder $builder, array $filters)
//    {
//        if (isset($filters['name'])) {
//            $builder->where('name', $filters['name']);
//        }
//    }
}
