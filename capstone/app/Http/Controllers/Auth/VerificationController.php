<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Verified;
use App\Models\User;

class VerificationController extends Controller
{
    /**
     * Mark the given user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @param  string  $hash
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request, $id, $hash)
{
    if (!$request->hasValidSignature()) {
        return redirect('/login')->with('error', 'Invalid or expired verification link.');
    }

    $user = User::findOrFail($id);

    if (sha1($user->getEmailForVerification()) !== $hash) {
        return redirect('/login')->with('error', 'Invalid verification link.');
    }

    if (!$user->hasVerifiedEmail()) {
        $user->email_verified_at = now();  // Manually update email_verified_at
        $user->save(); // Save to database
        event(new Verified($user)); // Fire the event
    }

    return redirect('/dashboard')->with('verified', true);
}


    /**
     * Resend the email verification link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/dashboard');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }
}
