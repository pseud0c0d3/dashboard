<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications; // Retrieve the user's notifications

        return view('user.notifications', compact('notifications')); // Pass notifications to the view
    }

    // Method to mark a notification as read
    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead(); // Mark the notification as read

        return redirect()->route('notifications.index'); // Redirect back to notifications page
    }

    
}
