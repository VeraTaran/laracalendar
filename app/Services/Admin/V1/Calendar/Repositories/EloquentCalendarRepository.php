<?php

namespace App\Services\Admin\V1\Calendar\Repositories;

use App\Models\Admin\V1\Pages\Calendar;
use App\Models\Admin\V1\Pages\Event;
use Illuminate\Database\Eloquent\Builder;

class EloquentCalendarRepository implements CalendarRepositoryInterface
{
    public function find(int $id):Calendar
    {
        return Calendar::find($id);
    }
    public function getCalendar():array
    {
        $events = Event::all();
        $calendar_events_db = Calendar::with(['event']);
        $calendar_events[] = [];
        if($calendar_events_db->exists()){
            $calendar_events = $this->getCalendarEvents($calendar_events_db, $calendar_events);
        }
        return compact('events', 'calendar_events');
    }
    public function createFromArray(array $data): Calendar
    {
        $calendar = new Calendar();
        $calendar = $calendar->create($data);
        return $calendar;
    }
    public function updateFromArray(int $id, array $data):Calendar
    {
        $calendar = $this->find($id);
        $calendar->update($data);
        return $calendar;
    }
    private function getCalendarEvents(Builder $calendar_events_db, array $calendar_events):array
    {
        $calendar_events_db = $calendar_events_db->get();
        foreach($calendar_events_db as $event){
            $calendar_events[] = [
                'id'                => $event->id,
                'title'             => $event->event->name,
                'start'             => $event->date,
                'end'               => $event->date,
                'backgroundColor'   => $event->event->color,
                'borderColor'       => $event->event->color,
                'allDay'            => true
            ];
        }
        return $calendar_events;
    }
}
