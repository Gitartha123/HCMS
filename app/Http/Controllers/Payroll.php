<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Payroll extends Controller
{
    public function generateSalary(){
        return view('HR.generatesalary');
    }
}
