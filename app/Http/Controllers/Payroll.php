<?php

namespace App\Http\Controllers;

use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class Payroll extends Controller
{
    public function generateSalary(Request $request){
        $month = date('m');
        $item = DB::table('attendance')
            ->leftJoin('users','attendance.employeeid','=','users.id')
            ->join('designation', 'users.desg', '=', 'designation.id')
            ->join('department', 'designation.deptid', '=', 'department.id')
            ->select('employeeid','fname','mname','lname','users.salary','users.id','dname','name',DB::raw('count(*) as total'))
            ->where('checkin','!=',null)
            ->whereMonth('date','=',$month)
            ->groupBy('employeeid')
            ->get();


        return view('HR.generatesalary')->with('item',$item);
    }

    public function generate(Request $request){
        $msg = "This is a simple message.";
        $data= $request->all();
        return response()->json(array('msg'=> $msg,'data'=>$data), 200);
    }
}
