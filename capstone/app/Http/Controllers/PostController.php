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
use App\Models\Like;


class PostController extends Controller
{   /**
     * Display a listing of the resource.
     */
    public function index(Request $request) 
{
    $search = $request->input('search');
    $filter = $request->input('filter', 'all'); // Default to 'all' posts

    $posts = Post::query()
        ->when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', "%{$search}%");
        })
        ->when($filter === 'mine' && Auth::check(), function ($query) {
            return $query->where('user_id', Auth::id());
        })
        ->when($filter === 'admin', function ($query) {
            return $query->where('admin_id', 1); 
        })
        ->where(function ($query) {
            // Hide archived posts unless the user is admin or the author
            $query->where('archived', false)
                ->orWhere(function ($q) {
                    $q->where('user_id', Auth::id());
                });

            
        })
        ->with(['user', 'admin', 'likes', 'comments'])
        ->latest()
        ->paginate(10);

    return view('posts.index', compact('posts', 'filter'));
}


    public function archive($id)
    {
        $post = Post::findOrFail($id);
        if (!Auth::guard('admin')->check()) {
            return back()->with('error', 'Unauthorized');
        }
    
        $post->archived = true;
        $post->save();
    
        return back()->with('success', 'Post archived.');
    }
    
    public function unarchive($id)
    {
        $post = Post::findOrFail($id);
        if (!Auth::guard('admin')->check()) {
            return back()->with('error', 'Unauthorized');
        }
    
        $post->archived = false;
        $post->save();
    
        return back()->with('success', 'Post unarchived.');
    }
    public function toggleArchive(Post $post)
{
    $post->archived = !$post->archived;
    $post->save();

    return redirect()->back()->with('status', 'Post ' . ($post->archived ? 'archived' : 'unarchived') . ' successfully.');
}

    

public function admin(Request $request)
{
    $search = $request->input('search');
    $filter = $request->input('filter', 'all'); // Default to 'all' posts

    $posts = Post::recent()
        ->when($filter !== 'archived', function ($query) {
            return $query->where('archived', false);
        })
        ->when($filter === 'archived', function ($query) {
            return $query->where('archived', true);
        })
        ->when($search, function ($query, $search) {
            return $query->where('title', 'LIKE', "%{$search}%");
        })
        ->when($filter === 'mine' && Auth::check(), function ($query) {
            return $query->where(function ($q) {
                $q->where('user_id', Auth::id())
                  ->orWhereNotNull('admin_id');
            });
        })
        ->with(['user', 'admin'])
        ->latest()
        ->paginate(10);

    return view('posts.admin', compact('posts', 'filter'));
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
    // Validate the request
    $request->validate([
        'title' => ['required', 'max:255'],
        'body' => ['required'],
        'image' => 'nullable|image|mimes:webp,png,jpg,jpeg|max:2048', // Adjust the validation rules as needed
    ]);

    // Handle the image upload if there's a file
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = Storage::disk('public')->put('posts_images', $request->file('image')); // Store the image in 'public/posts_images'
    }

    // Create the post
    Post::create([
        'title' => $request->title,
        'body' => $request->body,
        'user_id' => Auth::id(), // Assuming the post is associated with the logged-in user
        'image' => $imagePath, // Save the image path to the database (if any)
    ]);

    // Redirect with success message
    return back()->with('success', 'Your post was created.');
}

public function storeadmin(Request $request)
{
    $request->validate([
        'title' => ['required', 'max:255'],
        'body' => ['required'],
        'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'], // 5MB max
    ]);

    // Check if the admin is authenticated
    $admin = Auth::guard('admin')->user();
    if (!$admin) {
        return back()->withErrors(['error' => 'Unauthorized. Please log in as an admin.']);
    }

    // Handle image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        // Store in storage/app/public/posts_images
        $imagePath = $request->file('image')->store('posts_images', 'public');
        
        // Alternative if you want to customize the filename:
        // $imageName = time().'_'.$request->file('image')->getClientOriginalName();
        // $imagePath = $request->file('image')->storeAs('posts_images', $imageName, 'public');
    }

    Post::create([
        'title' => $request->title,
        'body' => $request->body,
        'admin_id' => $admin->id,
        'image' => $imagePath, // This will be null if no image was uploaded
    ]);

    return back()->with('success', 'Your post was created.');
}


    /**
     * Display the specified resource.
     */

     public function show(Post $post)
     {
         $post->load(['user', 'comments.user', 'comments.admin']); // eager load related models
     
         return view('posts.show', ['post' => $post]);
     }
     
     public function showadmin(Post $post)
     {
         $post->load(['admin', 'comments.user', 'comments.admin']); // eager load related models
     
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
    public function adminEdit(Post $post)
{
    // Check if the logged-in user is an admin
    if (!auth()->user()->is_admin) {
        return redirect()->route('posts.index')->with('error', 'You do not have permission to edit this post.');
    }

    return view('posts.edit', ['post' => $post]); // You can use the same edit view or adjust it for the admin
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
public function adminUpdate(Request $request, $id)
{
    $post = Post::findOrFail($id);

    // Check if the logged-in user is the admin who created the post
    if ($post->admin_id !== auth()->user()->id) {
        return redirect()->route('posts.admin')->with('error', 'You are not authorized to update this post.');
    }

    // Validate the request
    $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    // Update the post
    $post->update([
        'title' => $request->title,
        'body' => $request->body,
    ]);

    return redirect()->route('posts.admin')->with('success', 'Post updated successfully.');
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
public function adminDestroy($id)
{
    $post = Post::findOrFail($id);

    // Check if the logged-in user is the admin who created the post
    if ($post->admin_id !== auth()->user()->id) {
        return redirect()->route('posts.admin')->with('error', 'You are not authorized to delete this post.');
    }

    // Delete the post
    $post->delete();

    return redirect()->route('posts.admin')->with('success', 'Post deleted successfully.');
}


public function storeComment(Request $request, $postId)
{
    $request->validate([
        'comment' => 'required|string',
    ]);

    // Assuming the post belongs to a user
    $post = Post::findOrFail($postId);
    $user = $post->user; // Get the user who owns the post

    // Save the comment (you'll have your own logic for saving comments)
    $comment = new Comment();
    $comment->user_id = Auth::id();
    $comment->post_id = $postId;
    $comment->content = $request->comment;
    $comment->save();

    // Create a notification for the post owner, linking to the specific post
    $user->notifications()->create([
        'type' => 'comment',
        'message' => 'You have a new comment on your post!',
        'post_id' => $postId,  // Link to the post
    ]);

    return back()->with('success', 'Comment posted and notification sent!');
}
public function adminComment(Request $request, $postId) 
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

public function toggleLike(Post $post)
{
    $user = Auth::user();

    // Check if the user has already liked the post
    $like = Like::where('user_id', $user->id)->where('post_id', $post->id)->first();

    if ($like) {
        // If the user has already liked the post, unlike it
        $like->delete();
        $message = 'Post unliked!';
    } else {
        // If the user hasn't liked the post, like it
        $like = new Like();
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        $like->save();
        $message = 'Post liked!';
    }

    return back()->with('success', $message);
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
public function adminUpdateComment(Request $request, Comment $comment)
{
    // Ensure the authenticated user owns the comment
    if (Auth::id() !== $comment->admin_id) {
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

public function adminDestroyComment(Comment $comment)
{
    // Ensure the authenticated user owns the comment
    if (Auth::id() !== $comment->admin_id) {
        abort(403, 'Unauthorized action.');
    }

    $comment->delete();

    return back()->with('success', 'Comment deleted successfully!');
}

////////////////////



}
