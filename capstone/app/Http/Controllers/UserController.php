<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
        })->get(['id', 'title', 'start_time as start', 'end_time as end']);

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

        if ($userInfo->status === 'inactive') {
            return back()->withInput()->withErrors(['status' => 'Your account is inactive']);
        }

        if (!Hash::check($request->password, $userInfo->password)) {
            return back()->withInput()->withErrors(['password' => 'Incorrect password']);
        }

        // Use built-in authentication for proper session handling
        Auth::login($userInfo);

        return redirect()->route('user.forum');
    }

    public function logout()
    {
        // Use Auth facade for logout
        Auth::logout();

        return redirect()->route('index');
    }
}
