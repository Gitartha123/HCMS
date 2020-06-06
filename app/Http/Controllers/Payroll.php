<?php

namespace App\Http\Controllers;

use function GuzzleHttp\Promise\all;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class Payroll extends Controller
{
    public function getMonth(Request $request){
        $month = $request->input('month');
        return $month;
    }


    public function getData($typevalue,Request $request){
        $year = date('Y');
        $holiday = DB::table('holiday')->whereMonth('date','=',$this->getMonth($request))->whereYear('date','=',$year)->get();
        $holi[] = $holiday->pluck('date');
        $holidayarray = array();
        $leavecount = DB::table('employeeleave')
            ->whereYear('employeeleave.fromdate','=',$year)
            ->whereMonth('fromdate','=',$this->getMonth($request))
            ->orWhereMonth('todate','=',$this->getMonth($request))
            ->where('status','=',1)
            ->get();



        $data = $leavecount->where('type','=',$typevalue)->values();
        $array = array();
        $interval = new \DateInterval('P1D');
        $fromdate = $data->pluck('fromdate');
        $todate = $data->pluck('todate');
        $dur = array();

        for($i=0;$i<count($todate);$i++){
            if(date('m',strtotime($fromdate[$i])) != $this->getMonth($request)){
                $fromdate[$i] = date('Y-m-d',strtotime('01-'.$this->getMonth($request).'-'.$year.''));
            }

            if(date('m',strtotime($todate[$i])) != $this->getMonth($request)){
                $todate[$i] = date('Y-m-t',strtotime($todate[$i]));
            }
            $real_end = new \DateTime($todate[$i]);
            $real_end->add($interval);
            $real_start = new \DateTime($fromdate[$i]);
            $period = new \DatePeriod($real_start,$interval,$real_end);

            foreach ($period as $p) {
                $sunday = $p->format('N');
                if ($sunday <= 6){
                    $array[$i][] = $p->format('Y-m-d');
                }
                foreach($holiday as $h){
                    $holidayarray[$i][] =  $h->date;
                }
            }
        }

        $result1 = array();
        foreach($array as $key => $val) {
            if(isset($holidayarray[$key])){
                if(is_array($val) && $holidayarray[$key]){
                    $result1[$key] = array_diff($val, $holidayarray[$key]);
                }
            } else {
                $result1[$key] = $val;
            }
        }


        foreach ($result1 as $aarr=>$aa){
            $result[]= count($result1[$aarr]);
        }


        foreach($data as $l){
            $empid[]=$l->empid;
        }


        $g[]=array_combine($empid,$result);


        return $g;

    }

    public function generateSalary(Request $request){
        // Leavecount for cl leave of selected month

        $g = $this->getData(2,$request);

        $item = DB::table('attendance')
            ->leftJoin('users','attendance.employeeid','=','users.id')
            ->join('designation', 'users.desg', '=', 'designation.id')
            ->join('department', 'designation.deptid', '=', 'department.id')
            ->select('employeeid','fname','mname','lname','users.salary','users.id','dname','name',DB::raw('count(*) as total'))
            ->where('checkin','!=',null)
            ->whereMonth('date','=',$this->getMonth($request))
            ->groupBy('employeeid')
            ->get();

        foreach($item as $i){
            $new_item[] = $i;
        }

        foreach($g as $f){
            $array_keys = array_keys($g[0]);
            $array_values = array_values($g[0]);
        }



        for($i=0;$i<count($array_keys);$i++){
            $empid_duration[$i][] = $array_keys[$i];
            $empid_duration[$i][] = $array_values[$i];
        }


        for ($i=0;$i< count($new_item);$i++){
                $new_item[$i]->clleave=0;
                for($j=0;$j<count($empid_duration);$j++){
                    if($empid_duration[$j][0] == $item[$i]->employeeid){
                        $new_item[$i]->clleave = $empid_duration[$j][1];
                    }
                }
            }

        // Leavecount for pl leave of selected month

        $g = $this->getData(1,$request);

        foreach($g as $f){
            $array_keys1 = array_keys($g[0]);
            $array_values1= array_values($g[0]);
        }



        for($i=0;$i<count($array_keys1);$i++){
            $empid_duration1[$i][] = $array_keys1[$i];
            $empid_duration1[$i][] = $array_values1[$i];
        }


        for ($i=0;$i< count($new_item);$i++){
            $new_item[$i]->plleave=0;
            for($j=0;$j<count($empid_duration1);$j++){
                if($empid_duration1[$j][0] == $item[$i]->employeeid){
                    $new_item[$i]->plleave = $empid_duration1[$j][1];
                }
            }
        }

        // Leavecount for lop leave of selected month

        $g = $this->getData(3,$request);

        foreach($g as $f){
            $array_keys2 = array_keys($g[0]);
            $array_values2 = array_values($g[0]);
        }



        for($i=0;$i<count($array_keys2);$i++){
            $empid_duration2[$i][] = $array_keys2[$i];
            $empid_duration2[$i][] = $array_values2[$i];
        }


        for ($i=0;$i< count($new_item);$i++){
            $new_item[$i]->lopleave=0;
            for($j=0;$j<count($empid_duration2);$j++){
                if($empid_duration2[$j][0] == $item[$i]->employeeid){
                    $new_item[$i]->lopleave = $empid_duration2[$j][1];
                }
            }
        }
        return view('HR.generatesalary')->with('new_item',$new_item);
    }

    public function generate(Request $request){
        $msg = "This is a simple message.";
        $data= $request->all();
        return response()->json(array('msg'=> $msg,'data'=>$data), 200);
    }
}
