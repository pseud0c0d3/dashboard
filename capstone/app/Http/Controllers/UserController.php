<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userprofile()
    {
        return view('loggedIn.userprofile');
    }
    public function faq()
    {
        return view('loggedIn.faq');
    }
    public function colormatch()
    {
        return view('workspace.colormatch');
    }

    public function game()
    {
        return view('workspace.game');
    }

    public function calendar_user()
    {
        return view('loggedIn.calendar_user');
    }
    public function user()
    {
        $posts = Post::latest()->paginate(6);
        return view('loggedIn.user', ['posts' => $posts]);
    }
}
