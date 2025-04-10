<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::findOrFail($commentId);

        $reply = new Reply();
        $reply->content = $request->content;
        $reply->user_id = auth()->id();
        $reply->comment_id = $comment->id;  // Link reply to the comment
        $reply->save();

        return redirect()->back()->with('message', 'Reply added successfully!');
    }

    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);

        // Check if the logged-in user is the owner of the reply
        if ($reply->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action!');
        }

        $reply->delete();
        return redirect()->back()->with('message', 'Reply deleted successfully!');
    }
    // If in ReplyController:
public function showReplies($commentId)
{
    $replies = Reply::where('comment_id', $commentId)->get();
    return view('comments.replies', compact('replies'));
}

}
