<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::recent() // Only fetch posts from the last 15 days
            ->when($search, function ($query, $search) {
                $query->where('title', 'LIKE', "%{$search}%");
            })
            ->with('user') // Ensure the 'user' relationship is eagerly loaded
            ->latest()
            ->paginate(10);

        return view('posts.index', compact('posts'));
    }



    public function admin(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::recent() // Only fetch posts from the last 15 days
            ->when($search, function ($query, $search) {
                $query->where('title', 'LIKE', "%{$search}%");
            })
            ->with('user') // Ensure the 'user' relationship is eagerly loaded
            ->latest()
            ->paginate(10);

        return view('posts.admin', compact('posts'));
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
            'image' => $path,
        ]);




        return back()->with('success', 'Your post was created.');
    }

    // public function storeadmin(Request $request)
    // {
    //     $request->validate([
    //         'title' => ['required', 'max:255'],
    //         'body' => ['required'],
    //         'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg'],

    //     ]);

    //     $path = null;
    //     if ($request->hasFile('image')) {
    //         $path = Storage::disk('public')->put('posts_images', $request->image);
    //     }

    //     Post::create([
    //         'title' => $request->title,
    //         'body' => $request->body,
    //         'admin_id' => Auth::id(),
    //         'image' => $path,
    //     ]);

    //     return back()->with('success', 'Your post was created.');
    // }

    /**
     * Display the specified resource.
     */

    public function show(Post $post)
    {
        // Assuming the user is authenticated
        $post->user_id = auth()->id();
        $post->save();
        $post->load('user'); // Eager load the 'user' relationship
        return view('posts.show', ['post' => $post]);
    }

    public function showadmin(Post $post)
    {
        // Assuming the user is authenticated
        $post->user_id = auth()->id();
        $post->save();
        $post->load('user'); // Eager load the 'user' relationship
        return view('posts.showadmin', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg'],

        ]);

        $path = $post->image ?? null;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path,
        ]);

        return redirect()->route('posts.index')->with('success', 'Your post was updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return back()->with('success', 'Your post was deleted.');
    }
    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|max:500',
        ]);

        Comment::create([
            'post_id' => $postId,
            'user_id' => Auth::id(), // Associate the logged-in user
            'content' => $request->comment,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }


}
