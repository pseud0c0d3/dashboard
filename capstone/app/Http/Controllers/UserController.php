<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Admin;
use App\Http\Controllers\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller; // Import the base controller class


class UserController extends Controller
{
    public function fullcalendar()
    {
        return view('user.fullcalendar');
    }

    public function getEvents(Request $request)
{
    // Ensure the user is authenticated
    $userId = auth()->id();
    if (!$userId) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Retrieve public events or events assigned to the authenticated user
    $events = Event::where(function ($query) use ($userId) {
        $query->where('is_public', true)
              ->orWhere('user_id', $userId);
    })
    ->get(['id', 'title', 'start_time', 'end_time', 'description', 'is_public']) // Make sure you are including description and is_public
    ->map(function($event) {
        $event->start = $event->start_time->toIso8601String();  // Ensure start is in ISO 8601 format
        $event->end = $event->end_time ? $event->end_time->toIso8601String() : null;  // Ensure end is in ISO 8601 format
        // Add additional properties inside extendedProps
        $event->extendedProps = [
            'description' => $event->description ?? 'No description available',
            'is_public' => $event->is_public,
        ];
        return $event;
    });

    return response()->json($events);
}


    public function login()
    {
        return view("user.login");
    }

    public function register()
    {
        return view("user.register");
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function faq()
    {
        return view('user.faq');
    }

    public function colormatch()
    {
        return view('workspace.colormatch');
    }

    public function game()
    {
        return view('workspace.game');
    }

    public function calendar()
    {
        return view('user.calendar');
    }

    public function forum()
    {
        $posts = Post::latest()->paginate(6);
        return view('user.forum', ['posts' => $posts]);
    }

    // Register for new user
    public function save(Request $request)
    {
        // Validate the incoming request
        $validated = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'], // Include username validation
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        // Create the user
        $user = User::create([
            'email' => $request->email,
            'name' => $request->username, // Include username field
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.login')->with('success', 'Registration successful!');
    }

    public function chats()
    {
        // Use Auth facade to get the authenticated user
        $LoggedUserInfo = Auth::user();

        if (!$LoggedUserInfo) {
            return redirect('user/login')->with('fail', 'You must be logged in to access the chats page.');
        }

        // Retrieve all admins
        $admins = Admin::all();

        return view('user.chats', [
            'LoggedUserInfo' => $LoggedUserInfo,
            'admins' => $admins, // Pass only admins to the view
        ]);
    }

    public function check(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:5|max:12',
    ]);

    $userInfo = User::where('email', $request->email)->first();

    if (!$userInfo) {
        return back()->withInput()->withErrors(['email' => 'Email not found']);
    }


    if (!Hash::check($request->password, $userInfo->password)) {
        return back()->withInput()->withErrors(['password' => 'Incorrect password']);
    }

    // Update status to active (1) on successful login
    $userInfo->update(['status' => 1]);

    // Use built-in authentication for proper session handling
    Auth::login($userInfo);

    return redirect()->route('user.forum');
}


    public function viewProfile()
    {
        // Ensure user is authenticated, or replace with actual user fetching logic
        $user = Auth::user();  // Use Auth facade instead of helper
        return view('user.profile', compact('user'));
    }

    // Edit Profile
    public function editProfile()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'bio' => 'nullable|string',
            'picture' => 'nullable|image|max:2048',
            'phone_number' => [
                'nullable',
                'regex:/^(09|\+639)\d{9}$/',  // Ensure 09 or +63 followed by 9 digits
                'max:11',
                'min:11',
            ],
            'username' => 'nullable|string|max:255|unique:users,username,' . Auth::id(),
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->phone_number = $request->phone_number;
        $user->username = $request->username;

        // Handle profile picture upload
        if ($request->hasFile('picture')) {
            // Delete the old profile picture if it exists
            if ($user->picture) {
                Storage::disk('public')->delete($user->picture);
            }

            // Store the new profile picture
            $path = $request->file('picture')->store('profile_pictures', 'public');
            $user->picture = $path;
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }


    // Change Password View
    public function changePassword()
    {
        return view('profile.change_password');
    }

    // Update Password
    public function updatePassword(Request $request)
{
    $user = Auth::user();

    // Validate the input
    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed',
        'new_password_confirmation' => 'required|string|min:8',
    ]);

    // Check if the current password is correct
    if (!Hash::check($request->current_password, $user->password)) {
        // Return error message if current password is incorrect
        return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

    // Update the password
    $user->password = Hash::make($request->new_password);
    $user->save();

    return redirect()->route('user.profile')->with('success', 'Password updated successfully!');
}

public function logout()
{
    // Get the authenticated user
    $user = Auth::user();

    if ($user) {
        // Update the user's status to inactive (0)
        $user->update(['status' => 0]);
    }

    // Use Auth facade for logout
    Auth::logout();

    // Redirect to the index page
    return redirect()->route('index');
}

}
