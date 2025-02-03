<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'content' => 'required|string|max:1000',
            'post_id' => 'required|exists:posts,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
            'admin_comment_id' => 'nullable|exists:comments,id', // Allow replies to comments
        ]);

        // Create a new Comment instance
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id(); // Ensure the user is authenticated
        $comment->parent_comment_id = $request->parent_comment_id; // Set the parent comment ID for replies

        // Check if an image is uploaded
        if ($request->hasFile('image')) {
            // Store the image in 'comments' folder in public storage
            $imagePath = $request->file('image')->store('comments', 'public');
            $comment->image = $imagePath; // Save the image path to the database
        }

        // Save the comment
        $comment->save();

        // Redirect back to the post page with a success message
        return redirect()->route('posts.show', $request->post_id)->with('success', 'Comment added successfully.');
    }
    
}
