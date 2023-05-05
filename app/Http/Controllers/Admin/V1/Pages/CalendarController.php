<?php

namespace App\Http\Controllers\Admin\V1\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests\Admin\V1\Pages\Calendar\UpdateCalendar;
use App\Models\Admin\V1\Pages\Calendar;
use App\Models\Admin\V1\Pages\Event;
use App\Http\Requests\Admin\V1\Pages\Calendar\StoreCalendar;
use App\Services\Admin\V1\Calendar\CalendarService;
use Illuminate\View\View;
use InvalidArgumentException;

class CalendarController extends Controller
{
    /**
     * @var CalendarService
     */
    private $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        //$this->middleware(['auth']);
        $this->calendarService = $calendarService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $events = Event::all();
        $calendar_events_db = Calendar::with(['event']);
        $calendar_events[] = [];
        if($calendar_events_db->exists()){
            $calendar_events_db = $calendar_events_db->get();
            foreach($calendar_events_db as $event){
                $calendar_events[] = [
                    'id'   => $event->id,
                    'title' => $event->event->name,
                    'start' => $event->date,
                    'end' => $event->date,
                    'backgroundColor' => $event->event->color,
                    'borderColor' => $event->event->color,
                    'allDay'         => true
                ];
            }
        }
        return view('admin.v1.calendar.index', compact('events', 'calendar_events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCalendar $request): JsonResponse
    {
        try {
            $sanitized = $request->getSanitized();
            $this->calendarService->storeNewCalendar($sanitized);
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
        return response()->json($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCalendar $request, string $id): JsonResponse
    {
        try {
            $calendar = Calendar::find($id);
            $sanitized = $request->getSanitized();
            $this->calendarService->updateEventCalendar($calendar, $sanitized);
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
