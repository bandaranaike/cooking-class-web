<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{

    const EVENT_IMAGES_COUNT = 4;
    const EVENT_STATUS_ACTIVE = "ACTIVE";

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $events = Event::all();
        return Inertia::render("Events/EventList", compact("events"));
    }

    /**
     * @return JsonResponse
     */
    public function getList(): JsonResponse
    {
        return new JsonResponse(Event::orderByDesc('id')->whereStatus("ACTIVE")->limit(3)->get());
    }

    public function getItemsForCalendar()
    {
        $items = Event::select('id', 'public_id as publicId', 'date as startDate', 'title')->get();
        return new JsonResponse($items);
    }

    /**
     * @return Response
     */
    public function showEventCalendar(): Response
    {
        return Inertia::render('Events/EventCalendar');
    }

    public function getEventData($public_id)
    {
        return Event::wherePublicId($public_id)->firstOrFail();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render("Events/Create");
    }

    private function getActiveEventCount()
    {
        return Event::whereStatus(self::EVENT_STATUS_ACTIVE)->count();
    }

    private function getNextEventImageNumber(): int
    {
        $active_event_count = $this->getActiveEventCount();
        return ($active_event_count % self::EVENT_IMAGES_COUNT) + 1;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventRequest $request
     * @return JsonResponse
     */
    public function store(StoreEventRequest $request): JsonResponse
    {
        $event = new Event();
        $event->date = $request->get('date');
        $event->image = "event-" . $this->getNextEventImageNumber() . ".jpg";
        $event->public_id = Str::uuid()->toString();
        $event->status = self::EVENT_STATUS_ACTIVE;
        $event->title = $request->get('title');
        $event->description = $request->get('description');
        $event->url = Str::slug($event->title);
        $event->number_of_pax = $request->get('number_of_pax');

        $event->save();

        return new JsonResponse($event);
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return HttpResponse
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return HttpResponse
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEventRequest $request
     * @param $public_id
     * @return JsonResponse
     */
    public function update(UpdateEventRequest $request, $public_id): JsonResponse
    {
        $event = Event::wherePublicId($public_id)->firstOrFail();

        $event->date = $request->get('date');
        $event->title = $request->get('title');
        $event->description = $request->get('description');
        $event->url = Str::slug($event->title);
        $event->number_of_pax = $request->get('number_of_pax');

        $event->save();

        return new JsonResponse($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $public_id
     * @return JsonResponse
     */
    public function destroy($public_id): JsonResponse
    {
        Event::wherePublicId($public_id)->delete();
        return new JsonResponse(true);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateStatus(Request $request): JsonResponse
    {
        $event = Event::wherePublicId($request->get('public_id'))->firstOrFail();
        $event->status = $request->get('status');
        $event->save();
        return new JsonResponse($event->status);
    }
}
