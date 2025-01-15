<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class EmployeeForumController extends Controller
{
    public function EmployeeForum()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts.index', ['posts' => $posts]);
    }
}
