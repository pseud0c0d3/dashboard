<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function colormatch()
    {
        return view('workspace.colormatch');
    }

    public function sonar()
    {
        return view('workspace.sonar');
    }
}

