<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegion;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::where('user_id', Auth::id())->get();
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        return view('event.insert', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userID = Auth::user()->id;

        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'method' => 'required|string|max:50',
            'region_name' => 'required|array',
            'region_name.*' => 'required|integer|exists:regions,id', // validasi isi array
        ]);

        $event = Event::create([
            'user_id' => $userID,
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'method' => $request->method,
        ]);

        if ($request->has('region_name')) {
            $event->regions()->attach($request->region_name);
        }

        return redirect()->route('event.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('event.index')->with('success', 'Event deleted successfully.');
    }
}
