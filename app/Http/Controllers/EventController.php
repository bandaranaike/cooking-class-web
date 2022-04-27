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
        $event->image = "default.png";
        $event->public_id = Str::uuid()->toString();
        $event->status = "ACTIVE";
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
}
