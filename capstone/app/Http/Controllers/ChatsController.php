<?php

namespace App\Http\Controllers;

use App\Events\SendAdminMessage;
use App\Events\SendSellerMessage;
use App\Events\SendUserMessage;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class ChatsController extends Controller
{
    public function fetchMessagesFromUserToAdmin(Request $request)
    {
        $receiverId = $request->input('receiver_id');
        $sellerId = Auth::id(); // Get the authenticated user's ID

        if (!$sellerId) {
            return response()->json(['error' => 'You must be logged in to fetch messages.'], 401);
        }

        $messages = Chat::where(function ($query) use ($sellerId, $receiverId) {
            $query->where('sender_id', $sellerId)
                  ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($sellerId, $receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $sellerId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json(['messages' => $messages]);
    }

    public function sendMessageFromUserToAdmin(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:admins,id',
        ]);

        // Get the authenticated user's ID
        $userId = Auth::id();

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to send a message',
            ], 401);
        }

        // Create a new chat message
        $chat = new Chat();
        $chat->sender_id = $userId;
        $chat->receiver_id = $request->input('receiver_id');
        $chat->message = $request->input('message');
        $chat->seen = 0; // Default to not seen
        $chat->save();

        // Broadcast the message using the SendUserMessage event
        event(new SendUserMessage($chat));

        // Return a JSON response indicating success
        return response()->json(['success' => true, 'message' => 'Message sent successfully']);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|integer|exists:users,id', // Ensure the receiver_id is a valid user id
        ]);

        // Use the admin guard to get the authenticated admin
        $LoggedAdminInfo = Auth::guard('admin')->user();

        if (!$LoggedAdminInfo) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to send a message',
            ], 401);
        }

        $message = new Chat();
        $message->sender_id = $LoggedAdminInfo->id;
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        // Broadcast the message using the SendAdminMessage event
        broadcast(new SendAdminMessage($message))->toOthers();

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
        ]);
    }

    public function fetchMessages(Request $request)
    {
        $receiverId = $request->input('receiver_id');

        // Use the admin guard to get the authenticated admin
        $LoggedAdminInfo = Auth::guard('admin')->user();

        if (!$LoggedAdminInfo) {
            return response()->json([
                'error' => 'You must be logged in to access messages.',
            ], 401);
        }

        // Fetch messages between the admin and the specified receiver
        $messages = Chat::where(function ($query) use ($LoggedAdminInfo, $receiverId) {
            $query->where('sender_id', $LoggedAdminInfo->id)
                  ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($LoggedAdminInfo, $receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $LoggedAdminInfo->id);
        })->orderBy('created_at', 'asc')->get();

        return response()->json([
            'messages' => $messages,
        ]);
    }
}
