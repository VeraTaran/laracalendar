<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests\Admin\V1\Pages\Calendar\StoreCalendar;
use App\Http\Requests\Admin\V1\Pages\Calendar\UpdateCalendar;
use App\Http\Resources\Admin\CalendarResource;
use App\Services\Admin\V1\Calendar\CalendarService;
use Illuminate\Auth\Access\Gate;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class CalendarApiController extends Controller
{
    /**
     * @var CalendarService
     */
    private $calendarService;

    public function __construct(CalendarService $calendarService){
        //$this->middleware(['auth']);
        $this->calendarService = $calendarService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
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
     * Update the specified resource in storage.
     */
    public function update(UpdateCalendar $request, string $id): JsonResponse
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
