<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Admin\V1\Pages\Event\StoreEvent;
use App\Http\Resources\Admin\EventResource;
use App\Services\Admin\V1\Event\EventService;
use Illuminate\Auth\Access\Gate;
use Illuminate\Database\QueryException;
use InvalidArgumentException;

class EventApiController extends Controller
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
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvent $request): JsonResponse
    {
        try {
            $sanitized = $request->getSanitized();
            $event = $this->eventService->storeNewEvent($sanitized);
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
        return (new EventResource($event))
            ->response()
            ->setStatusCode(\Symfony\Component\HttpFoundation\Response::HTTP_CREATED);
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
