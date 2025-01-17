<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function EmployeeCalendar()
    {
        return view('employee.EmployeeCalendar');
    }

    public function EmployeeChat()
    {
        return view('employee.EmployeeChat');
    }

    public function EmployeeForum()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts.index', ['posts' => $posts]);
    }
    
}
