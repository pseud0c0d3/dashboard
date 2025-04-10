<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function EmployeeCalendar()
    {
        return view('employee.Calendar');
    }

    public function EmployeeChat()
    {
        return view('employee.Chat');
    }

    public function EmployeeForum()
    {
        $posts = Post::latest()->paginate(6);
        return view('employee.forum', ['posts' => $posts]);
    }
    
}
