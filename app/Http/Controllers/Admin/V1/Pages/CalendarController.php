<?php

namespace App\Http\Controllers\Admin\V1\Pages;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CalendarResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\V1\Pages\Calendar\UpdateCalendar;
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
        try {
            $calendar = $this->calendarService->getCalendar();
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
        return view('admin.v1.calendar.index', $calendar);
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
            $calendar = $this->calendarService->storeNewCalendar($sanitized);
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
        return (new CalendarResource($calendar))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
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
    public function update(UpdateCalendar $request, int $id): JsonResponse
    {
        try {
            $sanitized = $request->getSanitized();
            $calendar = $this->calendarService->updateEventCalendar($id, $sanitized);
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
        return (new CalendarResource($calendar))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
