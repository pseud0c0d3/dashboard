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
    // Fetch the current authenticated user ID
    $userId = auth()->id();

    // Retrieve events visible to the user (public or assigned exclusively)
    $events = Event::where('is_public', true)
        ->orWhere('user_id', $userId) // Get exclusive events for the user
        ->get(['id', 'title', 'start_time as start', 'end_time as end']);

    return response()->json($events);
}


    public function login() {
        return view("user.login");
    }
    public function register() {
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

    //register for new user
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

        // Optional: Login the user
        // auth()->login($user);

        return redirect()->route('user.login')->with('success', 'Registration successful!');
    }

    public function chats()
    {
        $userId = session('LoggedUserInfo');
        $LoggedUserInfo = User::find($userId);
    
        if (!$LoggedUserInfo) {
            return redirect('user/login')->with('fail', 'You must be logged in to access the dashboard');
        }
    
        // Retrieve all admins
        $admins = Admin::all();
    
        return view('user.chats', [
            'LoggedUserInfo' => $LoggedUserInfo,
            'admins' => $admins // Pass only admins to the view
        ]);
    }
    public function check(Request $request)
    {
         $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
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
    
         session([
            'LoggedUserInfo' => $userInfo->id,
            'LoggedUserName' => $userInfo->name,  
        ]);
         return redirect()->route('user.forum');
    }
    public function logout()
    {
         if (session()->has('LoggedUserInfo')) {
             session()->forget('LoggedUserInfo');
        }
        session()->flush();

         return redirect()->route('user.dashboard');
    }
    


}
