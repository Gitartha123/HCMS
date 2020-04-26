<?php

namespace App\Http\Controllers;

use App\User;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Session;

class ViewEmployee extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = DB::table('users')
                ->join('designation', 'users.desg', '=', 'designation.id')
                ->join('department', 'designation.deptid', '=', 'department.id')
                ->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('action',function ($row){
            })->rawColumns(['action'])->make(true);
        }
        return view('employee.viewemployee');
    }

    public function Action(Request $request){
        $email = $request->input('email');
        $dept = $request->input('name');
        $dname = $request->input('dname');
        $data = DB::table('users')
            ->where('email','=',$email)
            ->get();
        return view('HR.action',compact('data'),compact('dept'))->with('dname',$dname);
    }

    public function UpdateStatus(Request $request){

        $data[] =$request->all([
            "email" => "email",
            "action" => "action",
            "fromdate" => "fromdate",
            "todate" => "todate"
        ]);

        if($data[0]['action']==1){
            DB::table('users')
                ->where('email','=',$data[0]['email'])
                ->update([
                    'status' => $data[0]['action'],
                    'fromdate'=>null,
                    'todate'=>null,
                ]);

            return view('home');
        }
        else{
            if($data[0]['fromdate']== null && $data[0]['todate']==null){
                Session::flash('date','Please enter duration');
                return Redirect::back();
            }
            else{
                DB::table('users')
                    ->where('email','=',$data[0]['email'])
                    ->update([
                        'status' => $data[0]['action'],
                        'fromdate'=>$data[0]['fromdate'],
                        'todate'=>$data[0]['todate']
                    ]);

                return view('home');
            }
        }
    }
}
