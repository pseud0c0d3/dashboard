<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function chat()
    {
        return view('loggedIn.chat');
    }
    public function adminchat()
    {
        return view('admin.adminchat');
    }
}
