<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function user()
{
    $posts = Post::latest()->paginate(6);
    return view('loggedIn.user', ['posts' => $posts]);
}


}
