<?php

namespace App\Http\Controllers;

use App\Services\GoogleCalendarService;  // Make sure you import the service
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function calendar()
    {
        return view('admin.calendar');
    }

    public function forum()
{
    $posts = Post::latest()->paginate(6);
    return view('admin.forum', ['posts' => $posts]);
}

    protected $googleCalendarService;

    public function __construct(GoogleCalendarService $googleCalendarService)
    {
        $this->googleCalendarService = $googleCalendarService;
    }

    public function dashboard(): View
    {
        return view('admin.dashboard');
    }
    //calendar
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
        return redirect()->route('admin.calendar')->with('success', 'Event added successfully to Google Calendar!');
    }


}
