<?php

namespace App\Http\Controllers;

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
use App\Mail\EventCreated; // Import the Mailable
use Illuminate\Support\Facades\Mail; // Import the Mail facade
use Carbon\Carbon;  
use App\Mail\EventUpdatedMail;
use App\Mail\EventDeletedMail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Jobs\SendPublicEventEmails;

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
    public function clients()
    {
    $users = User::select('id', 'name', 'email', 'bio', 'phone_number', 'username', 'status', 'created_at')
        ->latest() // Orders users by the most recently created
        ->paginate(10); // Fetch 10 users per page

    return view('admin.clients', compact('users'));
    }


    public function fullcalendar()
    {
        $events = Event::all(['id', 'title', 'start_time as start', 'end_time as end', 'is_public', 'user_id']);
        return view('admin.fullcalendar', ['events' => $events]);
    }
    public function viewAppointments()
    {
        $events = Event::with('user') // Fetch events with related user data
            ->latest() // Order by the most recently created events
            ->paginate(10) // Paginate with 10 events per page
            ->withQueryString(); // Ensure query strings (if any) persist

        return view('admin.appointments', compact('events'));
    }


    public function getEvents()
    {
        $events = Event::all(['id', 'title', 'start_time as start', 'end_time as end', 'is_public', 'user_id']);
        return response()->json($events);
    }

    public function createEvent(Request $request)
    {
        $request->merge([
            'is_public' => $request->has('is_public') && $request->input('is_public') === 'on',
        ]);
    
        $now = now();
    
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($now) {
                    if (Carbon::parse($value)->lt($now)) {
                        $fail('The start time must be in the future.');
                    }
                },
            ],
            'end_time' => 'required|date|after:start_time',
            'is_public' => 'required|boolean',
            'user_email' => 'nullable|email|exists:users,email',
        ]);
    
        $overlappingEvent = Event::where(function ($query) use ($validated) {
            $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                ->orWhere(function ($query) use ($validated) {
                    $query->where('start_time', '<=', $validated['start_time'])
                        ->where('end_time', '>=', $validated['end_time']);
                });
        })->first();
    
        if ($overlappingEvent) {
            return response()->json(['message' => 'Cannot create an event. The selected time overlaps with another event.'], 422);
        }
    
        $user = $validated['is_public'] ? null : User::where('email', $validated['user_email'])->first();
    
        $event = Event::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'is_public' => $validated['is_public'],
            'user_id' => $user?->id,
        ]);
    
        if ($user) {
            Mail::to($user->email)->send(new EventCreated($event));
        } else {
            // Dispatch the job to send emails to all users for public events
            SendPublicEventEmails::dispatch($event,'created');
        }
    
        return response()->json(['message' => 'Event created successfully.']);
    }
    


        public function updateAppointment(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
        ]);

        $event->update($validated);
        

        if ($event->is_public) {
            SendPublicEventEmails::dispatch($event, 'updated');
        } else {
            Mail::to($event->user->email)->send(new EventUpdatedMail($event));
        }
        
        

        return redirect()->route('appointments.index')->with('success', 'Event updated successfully.');
    }
        public function deleteAppointment(Event $event)
    {
        $event->delete();

        if ($event->is_public) {
            SendPublicEventEmails::dispatch($event, 'deleted');
        } else {
            Mail::to($event->user->email)->send(new EventDeletedMail($event));
        }
        
        

        return redirect()->route('appointments.index')->with('success', 'Event deleted successfully.');
    }
    public function chats()
    {
        $LoggedAdminInfo = Auth::guard('admin')->user(); // Use Auth guard to get the logged-in admin
        if (!$LoggedAdminInfo) {
            return redirect()->route('admin.login')->with('fail', 'You must be logged in to access the dashboard');
        }

        // Fetch chats where the admin is either the sender or the receiver
        $chats = Chat::with(['senderProfilee', 'receiverProfilee', 'senderSellerProfile', 'receiverSellerProfile'])
            ->where('sender_id', $LoggedAdminInfo->id)
            ->orWhere('receiver_id', $LoggedAdminInfo->id)
            ->get();

        // Combine both results and remove duplicates
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

        // Pass the logged-in admin's information and chats to the view
        return view('admin.chats', [
            'LoggedAdminInfo' => $LoggedAdminInfo,
            'chats' => $allChats,
        ]);
    }

    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12',
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

        // Use the admin guard to log in the admin
        Auth::guard('admin')->login($adminInfo);

        // Redirect to the admin dashboard
        return redirect()->route('admin.forum');
    }

    

    public function dashboard(Request $request)
    {
        // Get the start and end dates from the request, default to today
        $startDate = $request->input('start_date', Carbon::today()->toDateString());
        $endDate = $request->input('end_date', Carbon::today()->toDateString());
    
        // Format the dates for query purposes
        $startDateTime = Carbon::parse($startDate)->startOfDay();
        $endDateTime = Carbon::parse($endDate)->endOfDay();
    
        // Fetch the counts from the database
        $newPostsCount = \DB::table('posts')
            ->whereBetween('created_at', [$startDateTime, $endDateTime])
            ->count();
    
        $newUsersCount = \DB::table('users')
            ->whereBetween('created_at', [$startDateTime, $endDateTime])
            ->count();
    
        $appointmentsCount = \DB::table('events')
            ->whereBetween('created_at', [$startDateTime, $endDateTime])
            ->count();
    
        // Count all registered users
        $totalUsersCount = \DB::table('users')->count();
    
        // Count total number of posts
        $totalPostsCount = \DB::table('posts')->count();
    
        // Count upcoming events
        $upcomingEventsCount = \DB::table('events')
            ->where('start_time', '>=', Carbon::now())
            ->count();
    
        // Fetch all users for the CRUD
       
    
        // Return the data to the view
        return view('admin.dashboard', [
            'newPostsCount' => $newPostsCount,
            'newUsersCount' => $newUsersCount,
            'appointmentsCount' => $appointmentsCount,
            'totalUsersCount' => $totalUsersCount,
            'totalPostsCount' => $totalPostsCount,
            'upcomingEventsCount' => $upcomingEventsCount,
            'startDate' => $startDate,
            'endDate' => $endDate,
            
        ]);
    }

    public function downloadDashboard(Request $request)
{
    // Fetch the same data as the dashboard
    $startDate = $request->input('start_date', Carbon::today()->toDateString());
    $endDate = $request->input('end_date', Carbon::today()->toDateString());
    $startDateTime = Carbon::parse($startDate)->startOfDay();
    $endDateTime = Carbon::parse($endDate)->endOfDay();

    $newPostsCount = \DB::table('posts')
        ->whereBetween('created_at', [$startDateTime, $endDateTime])
        ->count();

    $newUsersCount = \DB::table('users')
        ->whereBetween('created_at', [$startDateTime, $endDateTime])
        ->count();

    $appointmentsCount = \DB::table('events')
        ->whereBetween('created_at', [$startDateTime, $endDateTime])
        ->count();

    $totalUsersCount = \DB::table('users')->count();
    $totalPostsCount = \DB::table('posts')->count();
    $upcomingEventsCount = \DB::table('events')
        ->where('start_time', '>=', Carbon::now())
        ->count();

    $users = User::select('id', 'name', 'email', 'bio', 'picture', 'phone_number', 'username', 'status', 'created_at')->get();

    // Load the view and pass data
    $pdf = Pdf::loadView('admin.dashboard-pdf', [
        'newPostsCount' => $newPostsCount,
        'newUsersCount' => $newUsersCount,
        'appointmentsCount' => $appointmentsCount,
        'totalUsersCount' => $totalUsersCount,
        'totalPostsCount' => $totalPostsCount,
        'upcomingEventsCount' => $upcomingEventsCount,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'users' => $users,
    ]);

    return $pdf->download('dashboard.pdf');
}


    public function logout()
    {
        Auth::guard('admin')->logout(); // Use Auth guard to log out the admin
        return redirect()->route('admin.login');
    }
}
