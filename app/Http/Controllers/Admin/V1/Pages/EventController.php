<?php

namespace App\Http\Controllers\Admin\V1\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests\Admin\V1\Pages\Event\StoreEvent;
use App\Models\Admin\V1\Pages\Event;
use App\Services\Admin\V1\Event\EventService;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class EventController extends Controller
{
    /**
     * @var EventService
     */
    private $eventService;

    public function __construct(EventService $eventService){
        //$this->middleware(['auth']);
        $this->eventService = $eventService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $events = Event::all();
        return response()->json($events);
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
    public function store(StoreEvent $request): JsonResponse
    {
        try {
            // $data = $request->getFormData();
            $sanitized = $request->getSanitized();
            $this->eventService->storeNewEvent($sanitized);
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
//        return redirect()->back();
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
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
