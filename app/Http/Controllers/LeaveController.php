<?php

namespace App\Http\Controllers;

use App\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Session;
use Yajra\DataTables\DataTables;

class LeaveController extends Controller
{
    public function applyLeave(Request $request){
        $year = date('Y');
        $getholiday = DB::table('holiday')->pluck('date');
        $getplamount = DB::table('leave')
            ->where('type','=',1)
            ->value('lamount');

        $getclamount = DB::table('leave')
            ->where('type','=',2)
            ->value('lamount');


        //extract approved applied number of paid leave to visualize to the employee

        $count1 = 0;
        $plcount = DB::table('employeeleave')
            ->where('empid','=',Auth::user()->id)
            ->whereYear('fromdate','=',$year)
            ->where('type','=',1)
            ->where('status','=',1)
            ->pluck('duration');
        foreach ($plcount as $pl){
            $count1 = $count1 + $pl;
        }

        //extract approved applied number of casual  leave to visualize to the employee

        $count2 = 0;
        $clcount = DB::table('employeeleave')
            ->where('empid','=',Auth::user()->id)
            ->whereYear('fromdate','=',$year)
            ->where('type','=',2)
            ->where('status','=',1)
            ->pluck('duration');
        foreach($clcount as $c){
            $count2 = $count2 + $c;
        }


        //extract all(approved/not approved) applied number of casual leave

        $CLcount = 0;
        $CL = DB::table('employeeleave')
            ->where('empid','=',Auth::user()->id)
            ->whereYear('fromdate','=',$year)
            ->where('type','=',2)
            ->pluck('duration');
        foreach($CL as $c){
            $CLcount = $CLcount + $c;
        }


        //extract all(approved/not approved) applied number of casual leave

        $PLcount = 0;
        $PL = DB::table('employeeleave')
            ->where('empid','=',Auth::user()->id)
            ->whereYear('fromdate','=',$year)
            ->where('type','=',1)
            ->pluck('duration');
        foreach($PL as $c){
            $PLcount = $PLcount + $c;
        }

        return view('employee.leaveapply',compact('getclamount'),compact('getplamount'))->with('PLcount',$PLcount)->with('CLcount',$CLcount)->with('plcount',$count1)->with('clcount',$count2)->with('holiday',$getholiday);
    }

    public function submitRequest(Request $request){
        $request->validate([
            'document' => 'mimes:pdf|max:1000|min:10',
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

        $document = $request->file('document');
        if ($document != null){
            $new_name  = $document->getClientOriginalExtension();
            Storage::disk('public')->put('document/'.$document->getFilename().'.'.$new_name,File::get($document));
            $myfile = $document->getFilename().'.'.$new_name;
        }
        else{
            $myfile = null;
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
            ->where('type','=',2)
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
                   elseif($duration < 2){
                       if($c > 2 ) {
                           Session::flash('message','Sorry !! You have no more casual leave in applied month');
                           return redirect()->back();
                       }
                   }
                   elseif($duration == 2){
                       if($count >= 2 ) {
                           Session::flash('message','Sorry !! You have no more casual leave in applied month');
                           return redirect()->back();
                       }
                       if($count == 1 ) {
                           Session::flash('message','You have only one day to apply casual leave in this month,please choose only one date');
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
        $data->document = $myfile;
        $data->save();

            if ($data->save()){
                Session::flash('message','Your request has been sent');
                return redirect()->action('LeaveController@status');
            }
            else{
                return ['message' => 'fail',
                ];
            }
    }
    public function  status(Request $request ){

        if($request->ajax()){
            $item = DB::table('employeeleave')
                ->where('empid','=',Auth::user()->id)
                ->get();
            return DataTables::of($item)->addIndexColumn()->addColumn('action',function ($row){
            })->rawColumns(['action'])->make(true);
        }
        return view('employee.leavestatus');
    }

    public function editLeave(Request $request){
        Session::put([
           'empid' => $request->input('empid'),
           'type'=>$request->input('type'),
           'fromdate'=>$request->input('fromdate'),
           'todate'=>$request->input('todate'),
           'duration'=>$request->input('duration'),
           'reason'=>$request->input('reason'),
            'id'=>$request->input('id'),
            'reasonbox'=>$request->input('reasonbox')
       ]);

        $year = date('Y');
        $getholiday = DB::table('holiday')->pluck('date');
        $getplamount = DB::table('leave')
            ->where('type','=',1)
            ->value('lamount');

        $getclamount = DB::table('leave')
            ->where('type','=',2)
            ->value('lamount');


        //extract approved applied number of paid leave to visualize to the employee

        $count1 = 0;
        $plcount = DB::table('employeeleave')
            ->where('empid','=',Auth::user()->id)
            ->whereYear('fromdate','=',$year)
            ->where('type','=',1)
            ->where('status','=',1)
            ->pluck('duration');
        foreach ($plcount as $pl){
            $count1 = $count1 + $pl;
        }

        //extract approved applied number of casual  leave to visualize to the employee

        $count2 = 0;
        $clcount = DB::table('employeeleave')
            ->where('empid','=',Auth::user()->id)
            ->whereYear('fromdate','=',$year)
            ->where('type','=',2)
            ->where('status','=',1)
            ->pluck('duration');
        foreach($clcount as $c){
            $count2 = $count2 + $c;
        }


        //extract all(approved/not approved) applied number of casual leave

        $CLcount = 0;
        $CL = DB::table('employeeleave')
            ->where('empid','=',Auth::user()->id)
            ->whereYear('fromdate','=',$year)
            ->where('id','!=',$request->input('id'))
            ->where('type','=',2)
            ->pluck('duration');
        foreach($CL as $c){
            $CLcount = $CLcount + $c;
        }


        //extract all(approved/not approved) applied number of casual leave

        $PLcount = 0;
        $PL = DB::table('employeeleave')
            ->where('empid','=',Auth::user()->id)
            ->where('id','!=',$request->input('id'))
            ->whereYear('fromdate','=',$year)
            ->where('type','=',1)
            ->pluck('duration');
        foreach($PL as $c){
            $PLcount = $PLcount + $c;
        }

        return view('employee.editleaveapply',compact('getclamount'),compact('getplamount'))->with('PLcount',$PLcount)->with('CLcount',$CLcount)->with('plcount',$count1)->with('clcount',$count2)->with('holiday',$getholiday);

    }

    public function UpdateLeave(Request $request){
        $request->validate([
            'document' => 'mimes:pdf|max:1000|min:10',
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

        $document = $request->file('document');
        if ($document != null){
            $new_name  = $document->getClientOriginalExtension();
            Storage::disk('public')->put('document/'.$document->getFilename().'.'.$new_name,File::get($document));
            $myfile = $document->getFilename().'.'.$new_name;
        }
        else{
            $myfile = null;
        }

        $fromdate = $request->input('fromdate');
        $todate = $request->input('todate');
        $leavetype = $request->input('leavetype');
        $userid = $request->input('userid');
        $id = $request->input('id');
        $duration = $request->input('duration');
        $getYearFromdate = date('Y',strtotime($fromdate));
        $getMonthFromdate = date('m',strtotime($fromdate));
        $getYearTodate = date('Y',strtotime($todate));
        $getMonthTodate = date('m',strtotime($todate));


        $count = 0;
        $getDurationPerMonth = DB::table('employeeleave')
            ->whereYear('fromdate','=',$getYearFromdate)
            ->whereMonth('fromdate','=',$getMonthFromdate)
            ->where('id','!=',$id)
            ->where('type','=',2)
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
                elseif($duration < 2){
                    if($c > 2 ) {
                        Session::flash('message','Sorry !! You have no more casual leave in applied month');
                        return redirect()->back();
                    }
                }
                elseif($duration == 2){
                    if($count >= 2 ) {
                        Session::flash('message','Sorry !! You have no more casual leave in applied month');
                        return redirect()->back();
                    }
                    if($count == 1 ) {
                        Session::flash('message','You have only one day to apply casual leave in this month,please choose only one date');
                        return redirect()->back();
                    }
                }
            }
            else{

                Session::flash('message','Sorry !! You cannot apply casual leave for two consecutive month ');
                return redirect()->back();

            }
        }



       $update = DB::table('employeeleave')
           ->where('id','=',$id)
           ->update([
               'type'=>$leavetype,
               'fromdate'=>$fromdate,
               'todate'=>$todate,
               'duration'=>$duration,
               'reason'=>$request->input('reason'),
               'reasonbox'=>$request->input('reasonbox'),
               'document'=>$myfile
           ]);

        if ($update){
            Session::flash('message','Your request has been updated');
            return redirect()->action('LeaveController@status');
        }
        else{
            return ['message' => 'fail',
            ];
        }
    }

    public  function deleteLeave(Request $request){
        $id = $request->input('id');
        DB::delete('delete from employeeleave where id = ?',[$id]);
        Session::flash('message','Successfully deleted');
        return view('employee.leavestatus');
    }

    public function showLeave(Request $request){
        if ($request->ajax()){
            $item = DB::table('users')
                ->join('employeeleave','employeeleave.empid','=','users.id')
                ->get();
            return DataTables::of($item)->addIndexColumn()->addColumn('action',function ($row){
            })->rawColumns(['action'])->make(true);
        }

        return view('HR.viewleaverequest');
    }

    public function acceptLeave(Request $request){
        $id = $request->input('id');
        DB::table('employeeleave')
            ->where('id','=',$id)
            ->update([
               'status'=> 1,
                'count'=>1
            ]);
        Session::flash('message','Request Accepted');
        return redirect()->back();
    }

    public function rejectLeave(Request $request){
        $id = $request->input('id');
        DB::table('employeeleave')
            ->where('id','=',$id)
            ->update([
                'status'=>2,
                'count'=>1
            ]);
        Session::flash('message','Request Rejected');
        return redirect()->back();
    }

    public function afterLeaveNoticeView(){
        $id = Auth::user()->id;
        DB::table('employeeleave')
            ->where('empid','=',$id)
            ->where('count','=',1)
            ->update([
                'count'=>2
            ]);
        return view('employee.leavestatus');
    }

    public function viewPDF(Request $request){
            $document = $request->input('document');
            return view('employee.viewpdf')->with('document',$document);


    }
}
