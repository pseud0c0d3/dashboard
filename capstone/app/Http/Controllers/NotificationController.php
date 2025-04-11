<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

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
    public function showPost(Notification $notification)
    {
        // Check if the notification belongs to the logged-in user
        if ($notification->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access');
        }
        
        // Redirect to the associated post if it exists
        if ($notification->post_id) {
            return redirect()->route('posts.show', $notification->post_id);
        } 
        
        // Otherwise, redirect to the support/chat route
        return redirect()->route('user.support');
    
}


}