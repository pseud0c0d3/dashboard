<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleCalendarService;  // Make sure you import the service

class CalendarController extends Controller
{
    protected $googleCalendarService;

    public function __construct(GoogleCalendarService $googleCalendarService)
    {
        $this->googleCalendarService = $googleCalendarService;
    }

    public function calendar()
    {
        return view('admin.calendar_admin');
    }

    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'meeting_date' => 'required|date',
            'meeting_time' => 'required|date_format:H:i',
        ]);

        // Combine date and time to form a full datetime
        $meetingDateTime = $request->input('meeting_date') . ' ' . $request->input('meeting_time');

        // Get title, description, and name for the event
        $title = $request->input('title');
        $description = $request->input('description');
        $name = $request->input('name');

        // Prepare the start and end times for the event
        $startDateTime = new \DateTime($meetingDateTime);
        $endDateTime = clone $startDateTime;
        $endDateTime->add(new \DateInterval('PT1H')); // Assuming events are 1 hour long

        // Store the event in Google Calendar using the GoogleCalendarService
        $this->googleCalendarService->createEvent(
            $title,
            $startDateTime->format('Y-m-d\TH:i:s'),
            $endDateTime->format('Y-m-d\TH:i:s'),
            $description // Pass the description to the service
        );

        // Redirect with success message
        return redirect()->route('admin.calendar_admin')->with('success', 'Event added successfully to Google Calendar!');
    }

    // New function to fetch events from Google Calendar and send to frontend (FullCalendar)
    public function getGoogleCalendarEvents()
    {
        // Get events from Google Calendar using the service
        $events = $this->googleCalendarService->getEvents();

        // Format events to match FullCalendar's expected structure
        $formattedEvents = [];
        foreach ($events as $event) {
            $formattedEvents[] = [
                'title' => $event['summary'],
                'start' => $event['start'],
                'end' => $event['end'],
                'description' => $event['description'] ?? '',
            ];
        }

        // Return the events as a JSON response
        return response()->json($formattedEvents);
    }
}
