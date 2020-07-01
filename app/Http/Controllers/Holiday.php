<?php

namespace App\Http\Controllers;

use App\holidayentry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class Holiday extends Controller
{
    public function saveHoliday(Request $request){
        $fromdate[] = $request->input('from');
        $todate[] = $request->input('to');
        $event = $request->input('event');

        $array = array();
        $interval = new \DateInterval('P1D');

        for($i=0;$i<count($todate);$i++){
            $real_end = new \DateTime($todate[$i]);
            $real_end->add($interval);
            $real_start = new \DateTime($fromdate[$i]);
            $period = new \DatePeriod($real_start,$interval,$real_end);
            foreach ($period as $p){
                $array[]= $p->format('Y-m-d');
            }
        }

        foreach ($array as $a){
            $data = new holidayentry();
            $data->date = $a;
            $data->title = $event;
            $data->save();
        }


        Session::flash('msg','Holiday entered successfully');
        return  view('home');
    }

    public function showHoliday(){
        $data = DB::table('holiday')
            ->whereYear('date','=',date('Y'))
            ->orderBy('date','asc')
            ->get();

        return view('HR.holidayview')->with('data',$data);
    }
    public function deleteHoliday(Request $request){
        $dateid = $request->input('id');
        DB::table('holiday')
            ->where('dateid','=',$dateid)
            ->delete();
        Session::flash('holidaydelete','Deleted Successfully');
        return view('home');
    }
}
