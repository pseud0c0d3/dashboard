<?php

namespace App\Http\Controllers;

use App\Services\GoogleCalendarService;  // Make sure you import the service
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\View\View;
use App\Models\Admin;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function fullcalendar()
    {
        $events = Event::all(['id', 'title', 'start_time as start', 'end_time as end', 'is_public', 'user_id']);
        return view('admin.fullcalendar', ['events' => $events]);
    }
    public function getEvents()
{
    
    $events = Event::all(['id', 'title', 'start_time as start', 'end_time as end', 'is_public', 'user_id']);
    return response()->json($events);
}

    public function createEvent(Request $request)
{
    // Preprocess 'is_public' to always have a boolean value
    $request->merge([
        'is_public' => $request->has('is_public') && $request->input('is_public') === 'on' ? true : false,
    ]);

    // Validate the request
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after_or_equal:start_time',
        'is_public' => 'required|boolean',
        'user_email' => 'nullable|email|exists:users,email',
    ]);

    // Handle optional user assignment
    $user = $validated['is_public'] ? null : User::where('email', $validated['user_email'])->first();

    // Create the event
    Event::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'start_time' => $validated['start_time'],
        'end_time' => $validated['end_time'],
        'is_public' => $validated['is_public'],
        'user_id' => $user?->id,
    ]);

    return response()->json(['message' => 'Event created successfully.']);
}




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
public function chats()
{
    $LoggedAdminInfo = Admin::find(session('LoggedAdminInfo'));
    if (!$LoggedAdminInfo) {
        return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard');
    }

    // Fetch chats where the admin is either the sender or the receiver
    $chats = Chat::with(['senderProfilee', 'receiverProfilee', 'senderSellerProfile', 'receiverSellerProfile'])
        ->where('sender_id', $LoggedAdminInfo->id)
        ->orWhere('receiver_id', $LoggedAdminInfo->id)
        ->get();

    // Combine both results and remove duplicates
    $allChats = $chats->map(function($chat) use ($LoggedAdminInfo) {
        if ($chat->sender_id == $LoggedAdminInfo->id) {
            if ($chat->receiverProfilee) {
                $chat->user_id = $chat->receiver_id;
                $chat->profile = $chat->receiverProfilee;
            } else {
                $chat->user_id = $chat->receiver_id;
                $chat->profile = $chat->receiverSellerProfile;
            }
        } else {
            if ($chat->senderProfilee) {
                $chat->user_id = $chat->sender_id;
                $chat->profile = $chat->senderProfilee;
            } else {
                $chat->user_id = $chat->sender_id;
                $chat->profile = $chat->senderSellerProfile;
            }
        }
        return $chat;
    })->unique('user_id')->values();

    // Pass the logged-in admin's information and chats to the view
    return view('admin.chats', [
        'LoggedAdminInfo' => $LoggedAdminInfo,
        'chats' => $allChats
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
        return redirect()->route('admin.forum');
    }
    public function logout()
    {
        if (Session::has('LoggedAdminInfo')) {
            Session::forget('LoggedAdminInfo');
        }
        Session::flush();

        return redirect()->route('admin.login');
    }

}
