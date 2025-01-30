<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // Ensure this line is present
use App\Models\Notification;


class PostController extends Controller
{   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');
    $filter = $request->input('filter', 'all'); // Default to 'all' posts

    $posts = Post::recent()
        ->when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', "%{$search}%");
        })
        ->when($filter === 'mine' && Auth::check(), function ($query) {
            return $query->where('user_id', Auth::id())
                 ->orWhereNotNull('admin_id');
        })
        ->with(['user', 'admin'])
        ->latest()
        ->paginate(10);

    return view('posts.index', compact('posts', 'filter'));
}




    public function admin(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter', 'all'); // Default to 'all' posts

        $posts = Post::recent()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'LIKE', "%{$search}%");
            })
            ->when($filter === 'mine' && Auth::check(), function ($query) {
                return $query->where('user_id', Auth::id())
                     ->orWhereNotNull('admin_id');
            })
            ->with(['user', 'admin'])
            ->latest()
            ->paginate(10);

        return view('posts.admin', compact('posts', 'filter'));;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg'],

        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::id(),
            // 'image' => $path,
        ]);




        return back()->with('success', 'Your post was created.');
    }

    public function storeadmin(Request $request)
{
    $request->validate([
        'title' => ['required', 'max:255'],
        'body' => ['required'],
    ]);

    // Check if the admin is authenticated
    $admin = Auth::guard('admin')->user();
    if (!$admin) {
        return back()->withErrors(['error' => 'Unauthorized. Please log in as an admin.']);
    }

    Post::create([
        'title' => $request->title,
        'body' => $request->body,
        'admin_id' => $admin->id, // Ensure this is set
    ]);

    return back()->with('success', 'Your post was created.');
}


    /**
     * Display the specified resource.
     */

    public function show(Post $post)
    {
        // Assuming the user is authenticated
        // $post->user_id = auth()->id();
        // $post->save();
        $post->load('user'); // Eager load the 'user' relationship
        return view('posts.show', ['post' => $post]);
    }

    public function showadmin(Post $post)
    {
        // Assuming the user is authenticated
        // $post->user_id = auth()->id();
        // $post->save();
        $post->load('admin'); // Eager load the 'admin' relationship
        return view('posts.showadmin', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', 'You do not have permission to edit this post.');
        }

        return view('posts.edit', ['post' => $post]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
{
    // Ensure the authenticated user is the owner of the post
    if ($post->user_id !== Auth::id()) {
        return redirect()->route('posts.index')->with('error', 'You are not authorized to edit this post.');
    }

    // Validate the form inputs
    $request->validate([
        'title' => ['required', 'max:255'],
        'body' => ['required'],
    ]);

    // Update the post
    $post->update([
        'title' => $request->title,
        'body' => $request->body,
    ]);

    return redirect()->route('posts.index')->with('success', 'Your post was updated.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
{
    if ($post->user_id !== Auth::id()) {
        return redirect()->route('posts.index')->with('error', 'You do not have permission to delete this post.');
    }

    if ($post->image) {
        Storage::disk('public')->delete($post->image);
    }

    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Your post was deleted.');
}

public function storeComment(Request $request, $postId)
{
    $request->validate([
        'comment' => 'required|string',
    ]);

    // Find the post by its ID
    $post = Post::findOrFail($postId);

    // Get the user who owns the post (the one who created the post)
    $postOwner = $post->user;

    // Initialize the comment model
    $comment = new Comment();
    $comment->post_id = $postId;
    $comment->content = $request->comment;

    // Check if the authenticated user is an admin
    if (Auth::guard('admin')->check()) {
        // If the user is an admin, save their admin_id
        $comment->admin_id = Auth::guard('admin')->id();
    } else {
        // If the user is a regular user, save their user_id
        $comment->user_id = Auth::id();
    }

    // Save the comment
    $comment->save();

    // Notify the post owner about the new comment
    $postOwner->notifications()->create([
        'type' => 'comment',
        'message' => 'You have a new comment on your post!',
        'post_id' => $postId,  // Link to the post
    ]);

    // Optional: Notify admins if the commenter is a user (not an admin)
    if (Auth::guard('admin')->check() === false) {
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            $admin->notifications()->create([
                'type' => 'comment',
                'message' => 'A new comment has been posted on a post by ' . Auth::user()->name,
                'post_id' => $postId,  // Link to the post
            ]);
        }
    }

    return back()->with('success', 'Comment posted and notification sent!');
}


public function updateComment(Request $request, Comment $comment)
{
    // Ensure the authenticated user owns the comment
    if (Auth::id() !== $comment->user_id) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'comment' => 'required|string',
    ]);

    $comment->update([
        'content' => $request->comment,
    ]);

    return back()->with('success', 'Comment updated successfully!');
}

public function destroyComment(Comment $comment)
{
    // Ensure the authenticated user owns the comment
    if (Auth::id() !== $comment->user_id) {
        abort(403, 'Unauthorized action.');
    }

    $comment->delete();

    return back()->with('success', 'Comment deleted successfully!');
}




}
