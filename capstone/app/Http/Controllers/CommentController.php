<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = auth()->id();
        $comment->post_id = $request->post_id;
        $comment->parent_id = null; // This is a top-level comment

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('comments', 'public');
            $comment->image = $path;
        }

        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
