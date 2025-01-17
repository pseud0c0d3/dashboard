<?php

namespace App\Http\Controllers;

use App\Services\GoogleCalendarService;  // Make sure you import the service
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\View\View;
use App\Models\Admin;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function calendar()
    {
        return view('admin.calendar');
    }

    public function login()
    {
        return view('admin.login');
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

    public function chats()
{
    // Use the Auth facade to get the currently authenticated admin
    $LoggedAdminInfo = Auth::guard('web')->user(); // Assuming you're using the default 'web' guard for Admins

    if (!$LoggedAdminInfo) {
        return redirect()->route('admin.forum')->with('fail', 'You must be logged in to access this section');
    }

    // Fetch chats where the admin is either the sender or the receiver
    $chats = Chat::with(['senderProfilee', 'receiverProfilee', 'senderSellerProfile', 'receiverSellerProfile'])
        ->where('sender_id', $LoggedAdminInfo->id)
        ->orWhere('receiver_id', $LoggedAdminInfo->id)
        ->get();

    // Map and organize chats
    $allChats = $chats->map(function ($chat) use ($LoggedAdminInfo) {
        if ($chat->sender_id == $LoggedAdminInfo->id) {
            $chat->user_id = $chat->receiver_id;
            $chat->profile = $chat->receiverProfilee ?? $chat->receiverSellerProfile;
        } else {
            $chat->user_id = $chat->sender_id;
            $chat->profile = $chat->senderProfilee ?? $chat->senderSellerProfile;
        }
        return $chat;
    })->unique('user_id')->values();

    $users = User::all();

    return view('admin.chats', [
        'LoggedAdminInfo' => $LoggedAdminInfo,
        'chats' => $allChats,
    ]);
}

public function check(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:5|max:12'
    ]);

    // Find the admin by email
    $adminInfo = Admin::where('email', $request->email)->first();

    // Check if the admin exists
    if (!$adminInfo) {
        return back()->withInput()->withErrors(['email' => 'Email not found']);
    }

    // Check if the admin's account is inactive
    if ($adminInfo->status === 'inactive') {
        return back()->withInput()->withErrors(['status' => 'Your account is inactive']);
    }

    // Check if the password is correct
    if (!Hash::check($request->password, $adminInfo->password)) {
        return back()->withInput()->withErrors(['password' => 'Incorrect password']);
    }

    // Set session variables
    session([
        'LoggedAdminInfo' => $adminInfo->id,
        'LoggedAdminName' => $adminInfo->name,
    ]);

    // Redirect to the admin dashboard
    return redirect()->route('admin.calendar');
}

}
