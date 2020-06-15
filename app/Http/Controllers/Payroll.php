<?php

namespace App\Http\Controllers;

use App\salary;
use Barryvdh\DomPDF\Facade as PDF;
use function GuzzleHttp\Promise\all;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;
use Session;

class Payroll extends Controller
{

    public function getMonth(Request $request){
        $month = $request->input('month');
        return $month;
    }

    public function getStatus(Request $request){
        $status = DB::table('salary')
            ->where('year_month','=',date('Y-m',strtotime('01-'.$this->getMonth($request).'-'.date('Y').'')))
            ->value('status');

        return $status;
    }
    public function getHolidaycount(Request $request){
        $year = date('Y');
        $interval = new \DateInterval('P1D');
        $fromdate =date('Y-m-d',strtotime('01-'.$this->getMonth($request).'-'.$year.''));
        $todate = date('Y-m-t',strtotime('01-'.$this->getMonth($request).'-'.$year.''));
        $real_end = new \DateTime($todate);
        $real_end->add($interval);
        $real_start = new \DateTime($fromdate);
        $period = new \DatePeriod($real_start,$interval,$real_end);
        $array = [];
        foreach ($period as $p) {
            $sunday = $p->format('N');
            if ($sunday <= 6){
                $array[] = $p->format('Y-m-d');
            }
        }
        $arraycount = count($array);
        $holidaycount = DB::table('holiday')
            ->whereYear('date','=',$year)
            ->whereMonth('date','=',$this->getMonth($request))
            ->count();
        $finalcount = $holidaycount + cal_days_in_month(CAL_GREGORIAN,$this->getMonth($request),$year)-$arraycount;
        return $finalcount;
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
                $todate[$i] = date('Y-m-t',strtotime($fromdate[$i]));
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


        $result = [];
        foreach ($result1 as $aarr=>$aa){
            $result[]= count($result1[$aarr]);
        }

        $empid = [];
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
            ->whereYear('date','=',date('Y'))
            ->groupBy('employeeid')
            ->get();


        $new_item = [];
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
                $new_item[$i]->holidaycount = $this->getHolidaycount($request);
                $new_item[$i]->year_month = date('Y-m',strtotime('01-'.$this->getMonth($request).'-'.date('Y').''));
                for($j=0;$j<count($empid_duration);$j++){
                    if($empid_duration[$j][0] == $item[$i]->id){
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
                if($empid_duration1[$j][0] == $item[$i]->id){
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
                if($empid_duration2[$j][0] == $item[$i]->id){
                    $new_item[$i]->lopleave = $empid_duration2[$j][1];
                }
            }
        }


        return view('HR.generatesalary')->with('new_item',$new_item)->with('status',$this->getStatus($request));
    }

    public function generate(Request $request){
        $data= $request->all();
        $item = [];
        foreach ($data as $key){
           $item[] = $key;
        }

        for ($i=0;$i<count($item);$i++){
                $salary_entry = new salary();
                $button_id = $item[$i]['button_id'];
                $year_month = $item[$i]['year_month'];
                $empno = $item[$i]['emp_id'];
                $salary = $item[$i]['salary'];
                $salary_per_day = $salary/30;
                $attendance = $item[$i]['presentdays'];
                $clleave = $item[$i]['clleave'];
                $plleave = $item[$i]['plleave'];
                $lopleave = $item[$i]['lopleave'];
                $holidaycount = $item[$i]['holidaycount'];
                $deduction = $item[$i]['deduction'];
                $department = $item[$i]["department"];
                $designation = $item[$i]["designation"];
                $actual_salary = ($salary_per_day * ($attendance + $plleave + $clleave + $holidaycount));
                $deducted_salary = ($salary_per_day * $deduction);
                $final_salary = $actual_salary - $deducted_salary;
                $check_availability = DB::table('salary')
                    ->where('empno','=',$empno)
                    ->where('year_month','=',$year_month)
                    ->count();
                if($button_id == 1){
                    if($check_availability == 0){
                        $salary_entry->empno = $empno;
                        $salary_entry->empsalary = $final_salary;
                        $salary_entry->year_month = $year_month;
                        $salary_entry->department = $department;
                        $salary_entry->designation = $designation;
                        $salary_entry->clleave = $clleave;
                        $salary_entry->plleave = $plleave;
                        $salary_entry->lopleave = $lopleave;
                        $salary_entry->salperday = $salary_per_day;
                        $salary_entry->presentdays = $attendance;
                        $salary_entry->actualsal = $actual_salary;
                        $salary_entry->deductedsal = $deducted_salary;
                        $salary_entry->save();
                    }
                }
                elseif ($button_id == 2){
                    DB::table('salary')
                        ->where('empno','=',$empno)
                        ->where('year_month','=',$year_month)
                        ->update([
                            'empsalary'=>$final_salary,
                            'deductedsal'=>$deducted_salary,
                        ]);
                }
                elseif ($button_id == 3){
                    DB::table('salary')
                        ->where('year_month','=',$year_month)
                        ->update([
                            'status'=>1
                        ]);
                }


        }

        return  response()->json(array('data'=>$item,'count'=>$check_availability), 200);
    }

    public function viewSalary(Request $request){
        $month = $request->input('month');
        $year_month = date('Y-m',strtotime('01-'.$month.'-'.date('Y').''));
        $empid = $request->input('empid');
        $data= DB::table('salary')
            ->leftJoin('users','salary.empno','users.id')
            ->where('salary.empno','=',$empid)
            ->where('salary.status','=',1)
            ->where('year_month','=',$year_month)
            ->get();



        if($data->isNotEmpty()){
            $item = ['data'=>$data];
            $pdf = PDF::loadView('employee.mysalary',$item);

            return $pdf->download('mysalary.pdf');
        }
        else{
            Session::flash('salmessage','Salary is not generated');
            return view('employeeHome');
        }

    }
}
