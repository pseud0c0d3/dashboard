<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function userprofile()
    {
        return view('loggedIn.userprofile');
    }
    public function faq()
    {
        return view('loggedIn.faq');
    }
    public function colormatch()
    {
        return view('workspace.colormatch');
    }

    public function game()
    {
        return view('workspace.game');
    }

    public function calendar_user()
    {
        return view('loggedIn.calendar_user');
    }
    public function user()
    {
        $posts = Post::latest()->paginate(6);
        return view('loggedIn.user', ['posts' => $posts]);
    }

    //register for new user
    public function store(Request $request)
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

        return redirect()->route('index')->with('success', 'Registration successful!');
    }
}
