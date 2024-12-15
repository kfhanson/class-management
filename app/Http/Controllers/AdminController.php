<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Schedule;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $totalEmployee = count(Employee::all());
        $allAttendance = count(Attendance::whereAttendance_date(date("Y-m-d"))->get());
        $ontimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('1')->get());
        $latetimeEmp = count(Attendance::whereAttendance_date(date("Y-m-d"))->whereStatus('0')->get());
        $totalSchedule = count(Schedule::all());

        if($allAttendance > 0){
            $percentageOntime = str_split(($ontimeEmp/$allAttendance)*100, 4)[0];
        }else{
            $percentageOntime = 0;
        }
        $data = [$totalEmployee, $ontimeEmp, $latetimeEmp, $percentageOntime, $totalSchedule];
        return view('admin.index')->with(['data' => $data]);
    }
}
