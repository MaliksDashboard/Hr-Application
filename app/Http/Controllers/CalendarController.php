<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Ensure this matches your model namespace

class CalendarController extends Controller
{
    /**
     * Fetch all events in a format compatible with FullCalendar.
     */
    public function fetchEvents()
    {
        $events = Event::all();

        // Transform data for FullCalendar
        $formattedEvents = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
            ];
        });

        return response()->json($formattedEvents);
    }


    public function storeEvent(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'start' => 'required|date_format:Y-m-d H:i',
                'end' => 'nullable|date_format:Y-m-d H:i|after_or_equal:start',
            ]);

            $event = Event::create($validated);

            return response()->json(['success' => true, 'event' => $event]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function fetchEvent($id)
    {
        $event = Event::findOrFail($id);

        return response()->json($event);
    }

    /**
     * Edit an existing event.
     */
    public function editEvent(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'start' => 'required|date_format:Y-m-d H:i',
                'end' => 'nullable|date_format:Y-m-d H:i|after_or_equal:start',
            ]);

            $event = Event::findOrFail($id);
            $event->update($validated);

            return response()->json(['success' => true, 'message' => 'Event updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    /**
     * Delete an event by ID.
     */
    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['success' => true, 'message' => 'Event deleted successfully!']);
    }

    /**
     * Fetch upcoming events (for reminders or lists).
     */
    public function fetchUpcomingEvents()
    {
        $upcomingEvents = Event::where('start', '>=', now())
            ->orderBy('start', 'asc')
            ->get();

        return response()->json($upcomingEvents);
    }
}
