<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Message;

class MessageController extends Controller
{
    public function chat()
    {
        return view('loggedIn.chat');
    }

    public function message(Request $request)
    {
        event(new Message($request->input('username'), $request->input('message')));
        return response()->json([]);
    }
}

