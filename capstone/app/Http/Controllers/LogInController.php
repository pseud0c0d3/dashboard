<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordReset;
use Illuminate\Support\Str;


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
    public function forgotpass()
    {
        return view('loggedOut.forgotpassword');
    }

    public function sendreset(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    // Find the user by email
    $user = User::where('email', $request->email)->first();

    // Generate a unique token
    $token = Str::random(64);

    // Save token to a password_resets table (this is default in Laravel)
    \DB::table('password_resets')->updateOrInsert(
        ['email' => $user->email],
        [
            'token' => $token,
            'created_at' => now(),
        ]
    );

    // Send an email with the reset link
    $resetLink = url('/password-reset-form?token=' . $token . '&email=' . urlencode($user->email));
    Mail::to($user->email)->send(new PasswordReset($resetLink));

    return redirect()->back()->with('status', 'We have emailed your password reset link!');
}
public function showResetForm(Request $request)
{
    $token = $request->query('token');
    $email = $request->query('email');
    return view('user.reset', compact('token', 'email'));
}

public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|confirmed|min:8',
        'token' => 'required',
    ]);

    // Validate the token
    $reset = \DB::table('password_resets')->where([
        ['email', $request->email],
        ['token', $request->token],
    ])->first();

    if (!$reset) {
        return redirect()->back()->withErrors(['email' => 'Invalid or expired token.']);
    }

    // Update user's password
    $user = User::where('email', $request->email)->first();
    $user->password = bcrypt($request->password);
    $user->save();

    // Delete the token
    \DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect()->route('user.login')->with('status', 'Password has been reset!');
}



}
