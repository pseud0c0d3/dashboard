<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use App\Models\Employee;


class LogInController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Check in 'admins' table
        $admin = Admin::where('email', $credentials['email'])->first();
        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            Auth::loginUsingId($admin->id); // Log in the admin
            $request->session()->regenerate(); // Regenerate the session
            return redirect()->route('admin.calendar'); // Redirect to admin dashboard
        }

        // Check in 'employees' table
        $employee = Employee::where('email', $credentials['email'])->first();
        if ($employee && Hash::check($credentials['password'], $employee->password)) {
            Auth::loginUsingId($employee->id); // Log in the employee
            $request->session()->regenerate(); // Regenerate the session
            return redirect()->route('employee.Forum'); // Redirect to employee dashboard
        }

        // Check in 'users' table
        $user = User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::loginUsingId($user->id); // Log in the user
            $request->session()->regenerate(); // Regenerate the session
            $posts = Post::latest()->paginate(6); // Load posts for user dashboard
            return view('user.forum', ['posts' => $posts]); // Redirect to user dashboard
        }

        // If no matches were found, authentication failed
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
