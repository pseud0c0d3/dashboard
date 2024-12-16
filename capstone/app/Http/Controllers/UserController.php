<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userprofile()
    {
        return view('loggedIn.userprofile');
    }
}
