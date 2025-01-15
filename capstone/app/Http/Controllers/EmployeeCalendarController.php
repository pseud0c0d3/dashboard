<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeCalendarController extends Controller
{
    public function EmployeeCalendar()
    {
        return view('employee.EmployeeCalendar');
    }
}
