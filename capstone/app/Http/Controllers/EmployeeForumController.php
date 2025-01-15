<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeForumController extends Controller
{
    public function EmployeeForum()
    {
        return view('employee.EmployeeForum');
    }
}
