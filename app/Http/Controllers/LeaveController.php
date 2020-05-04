<?php

namespace App\Http\Controllers;

use App\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Session;

class LeaveController extends Controller
{
    public function applyLeave(Request $request){
        $getholiday = DB::table('holiday')->pluck('date');
        $getplamount = DB::table('leave')
            ->where('type','=',1)
            ->value('lamount');

        $getclamount = DB::table('leave')
            ->where('type','=',2)
            ->value('lamount');

        $plcount = DB::table('employeeleave')
            ->where('empid','=',Auth::user()->id)
            ->where('type','=',1)
            ->count();

        $clcount = DB::table('employeeleave')
            ->where('empid','=',Auth::user()->id)
            ->where('type','=',2)
            ->count();



        return view('employee.leaveapply',compact('getclamount'),compact('getplamount'))->with('plcount',$plcount)->with('clcount',$clcount)->with('holiday',$getholiday);
    }

    public function submitRequest(Request $request){
        $request->validate([
            'leavetype' =>['required'],
            'fromdate' =>['required'],
            'todate' =>['required'],
            'duration' => ['required'],
            'reason' =>['required'],
        ]);
        if($request->input('reason')==3){
            $request->validate([
               'reasonbox' =>['required','max:255']
            ]);
        }
        $fromdate = $request->input('fromdate');
        $todate = $request->input('todate');
        $leavetype = $request->input('leavetype');
        $userid = $request->input('userid');
        $duration = $request->input('duration');
        $getYearFromdate = date('Y',strtotime($fromdate));
        $getMonthFromdate = date('m',strtotime($fromdate));
        $getYearTodate = date('Y',strtotime($todate));
        $getMonthTodate = date('m',strtotime($todate));

        $count = 0;
        $getDurationPerMonth = DB::table('employeeleave')
            ->whereYear('fromdate','=',$getYearFromdate)
            ->whereMonth('fromdate','=',$getMonthFromdate)
            ->where('empid','=',$userid)
            ->pluck('duration');
        foreach($getDurationPerMonth as $get){
            $count = $count + $get ;
        }
        $c = $count+$duration;

       if($leavetype == 2){
           if($getMonthFromdate == $getMonthTodate){
               if ($duration > 2){
                   Session::flash('message','You are not permitted to take casual leave more than two days per month');
                   return redirect()->back();
               }
               elseif($duration <=2){
                   if($c > 2 ) {
                       Session::flash('message','Sorry !! You have no more leave in applied month');
                       return redirect()->back();
                   }
               }
           }
           else{

               Session::flash('message','Sorry !! You cannot apply casual leave for two consecutive month ');
               return redirect()->back();

           }
       }

        $data = new Leave();
        $data->type =  $leavetype;
        $data->empid =  $userid ;
        $data->fromdate =  $fromdate;
        $data->todate = $todate;
        $data->duration = $duration;
        $data->reason = $request->input('reason');
        $data->reasonbox = $request->input('reasonbox');
        $data->save();

            if ($data->save()){
                Session::flash('message','Your request has been sent');
                return  redirect()->action('EmployeePanel@index');
            }
            else{
                return ['message' => 'fail',
                ];
            }
        }

}
