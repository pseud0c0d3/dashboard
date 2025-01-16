<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeChatController extends Controller
{
    public function EmployeeChat()
    {
        return view('employee.EmployeeChat');
    }
}
