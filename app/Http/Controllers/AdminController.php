<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $totalEmployee = count(Employee::all());
        // $allAttendance = count(Attendance)
    }
}
