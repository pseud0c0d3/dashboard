<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'post_id' => 'required|exists:posts,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $comment = new Comment();
        $comment->content = $validated['content'];
        $comment->post_id = $validated['post_id'];
        $comment->parent_id = null;

        // Handle both regular users and admin users
        if (auth()->guard('admin')->check()) {
            $comment->admin_id = auth('admin')->id();
        } else {
            $comment->user_id = auth()->id();
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('comments', 'public');
            $comment->image = $path;
        }

        $comment->save();

        return back()->with('success', 'Comment added successfully!');
    }
}