<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Http\Response as HttpResponse;
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
     * @return HttpResponse
     */
    public function store(StoreEventRequest $request): HttpResponse
    {
        $event = new Event();
        $event->date = $request->get('date');
        $event->image = $request->get('image');
        $event->title = $request->get('title');
        $event->description = $request->get('description');
        $event->url = $request->get('url');
        $event->number_of_pax = $request->get('number_of_pax');

        $event->save();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Event $event
     * @return HttpResponse
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Event $event
     * @return HttpResponse
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateEventRequest $request
     * @param \App\Models\Event $event
     * @return HttpResponse
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     * @return HttpResponse
     */
    public function destroy(Event $event)
    {
        //
    }
}
