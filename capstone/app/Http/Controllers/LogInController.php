<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;


class LogInController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Regenerate the session to prevent session fixation
            $request->session()->regenerate();

            // Check the role of the authenticated user
            $user = Auth::user();
            if ($user->roles === 'admin') {
                // Redirect admin to the admin dashboard
                return redirect()->route('admin.calendar_admin');
            } elseif ($user->roles === 'user') {
                // Load posts for the user dashboard
                $posts = Post::latest()->paginate(6);
                return view('loggedIn.user', ['posts' => $posts]);
            }

            // Default fallback for unknown roles
            Auth::logout();
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        // Authentication failed, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
public function logoutgame(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/loggedIn/user');
}
}
