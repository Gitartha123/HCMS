<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeePanel extends Controller
{
    public function myProfile(){
        return view('employee.myprofile');
    }

    public function index(){
        return view('employeeHome');
    }

}
