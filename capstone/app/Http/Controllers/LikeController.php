<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        $like = new Like();
        $like->user_id = Auth::id();
        $like->post_id = $post->id;
        $like->save();

        return back()->with('success', 'Post liked!');
    }

    public function unlike(Post $post)
    {
        $like = Like::where('user_id', Auth::id())->where('post_id', $post->id)->first();
        if ($like) {
            $like->delete();
        }

        return back()->with('success', 'Post unliked!');
    }
}