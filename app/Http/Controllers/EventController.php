<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Show all events for alumni (only their own events).
     */
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('dashboard.admin.events.index', compact('events'));
    }

    /**
     * Show all events for public UI.
     */
    public function front()
    {
        $events = Event::latest()->paginate(9);
        return view('dashboard.admin.events.front', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('dashboard.admin.events.create');
    }

    /**
     * Store a newly created event.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required|date_format:H:i', 
            'location' => 'required|string|max:255', 
            'rsvp_required' => 'required|boolean', 
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image upload
        $imagePath = $request->file('image') ? $request->file('image')->store('events', 'public') : null;

        // Create the event
        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'location' => $request->location, 
            'rsvp_required' => $request->rsvp_required, 
            'image' => $imagePath,
            'user_id' => auth()->id(), 
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Show the form for editing an event.
     */
    public function edit(Event $event)
    {
        return view('dashboard.admin.events.edit', compact('event'));
    }

    /**
     * Update an existing event.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'required|date_format:H:i', 
            'location' => 'required|string|max:255', 
            'rsvp_required' => 'required|boolean', 
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image update
        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $event->update(['image' => $imagePath]);
        }

        // Update event details
        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time, 
            'location' => $request->location, 
            'rsvp_required' => $request->rsvp_required, 
        ]);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Delete an event.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
