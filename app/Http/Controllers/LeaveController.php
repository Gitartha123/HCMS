<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    public function applyLeave(Request $request){
        $getholiday = DB::table('holiday')->pluck('date');
        $getplamount = DB::table('leave')
            ->where('type','=','pl')
            ->value('lamount');

        $getclamount = DB::table('leave')
            ->where('type','=','cl')
            ->value('lamount');

        $plcount = DB::table('employeeleave')
            ->where('empid','=',Auth::user()->id)
            ->where('type','=','pl')
            ->count();

        $clcount = DB::table('employeeleave')
            ->where('empid','=',Auth::user()->id)
            ->where('type','=','cl')
            ->count();



        return view('employee.leaveapply',compact('getclamount'),compact('getplamount'))->with('plcount',$plcount)->with('clcount',$clcount)->with('holiday',$getholiday);
    }
}
