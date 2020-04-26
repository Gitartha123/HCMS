<?php

namespace App\Http\Controllers;

use App\EmployeeRequest;
use Dotenv\Validator;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Session;

class RequestController extends Controller
{
    public function sendRequest(Request $request){

      $data = $request->all([
          'phone' => 'phone',
          'email' => 'email',
          'uid' => 'uid',
      ]);

      if($data['phone'] == null and $data['email'] == null){
            Session::flash('radio','Choose atleast one option, otherwise you can exit');
            return back();
      }
      else{
          if ($data['phone'] == null){
              $item = 2;
          }
          else if($data['email'] == null){
              $item = 1;
          }
          else if($data['phone'] != null and $data['email'] != null){
              $item = 3;
          }


          $count = DB::table('request')
              ->where('uid','=',$data['uid'])
              ->where(function ($query){
                  $query ->where('count','=',0)
                      ->orWhere('count','=',1)
                      ->orWhere('count','=',3);
              })
              ->count('count');

          if( $count  >= 1){

              echo '<script>alert(" You can send one request at one time only.")</script>';
              return view('employeeHome');
          }

          else{
              DB::table('request')
                  ->where('uid','=',$data['uid'])
                  ->where('count','=',0)
                  ->update(['count'=>1]);

              $info = new EmployeeRequest();
              $info->uid = $data['uid'];
              $info->item = $item;
              $info->phone = $data['phone'];
              $info->mail = $data['email'];
              $info->save();

              echo '<script>alert("Request Sent")</script>';
              return view('employeeHome');
          }
      }

    }

    public function viewRequest(Request $request){
        if($request->ajax()){
            $info = DB::table('request')
                ->join('users','request.uid','=','users.id')
                ->get();
            return DataTables::of($info)->addIndexColumn()->addColumn('view',function ($row){
            })->rawColumns(['view'])->make(true);

        }
        return view('HR.viewrequest');
    }

    public function viewEdit(Request $request){
        $mail = $request->input('email');
        $phone = $request->input('phone');
        $uid = $request->input('uid');

        $data = DB::table('users')->where('id','=',$uid)->get();

        return view('HR.viewedit',compact('data'))->with('mail',$mail)->with('phone',$phone);
    }
    public function Ignore(Request $request){
        $uid = $request->input('uid');
        DB::table('request')
            ->where('uid','=',$uid)
            ->where('count','=',0)
            ->update([
               'rstatus' => 1,
                'count' => 3
            ]);
        return view('home');
    }

    public function Accept(Request $request){
        $uid = $request->input('uid');
        $mail = $request->input('mail');
        $phone = $request->input('phone');

        if($phone == 0 and $mail != "null"){
            DB::table('request')
                ->where('uid','=',$uid)
                ->where('count','==',0)
                ->update([
                    'rstatus' => 2,
                    'count' => 3,
                ]);

            DB::table('users')
                ->where('id','=',$uid)
                ->update([
                    'email' => $mail,
                ]);

            return view('home');
        }

        else if($mail == "null" and $phone !=0){
            DB::table('request')
                ->where('uid','=',$uid)
                ->where('count','==',0)
                ->update([
                    'rstatus' => 2,
                    'count' => 3,
                ]);

            DB::table('users')
                ->where('id','=',$uid)
                ->update([
                    'ph' => $phone,
                ]);

            return view('home');
        }

        if($mail != "null" and $phone != 0){
            DB::table('request')
                ->where('uid','=',$uid)
                ->where('count','==',0)
                ->update([
                    'rstatus' => 2,
                    'count' => 3,
                ]);

            DB::table('users')
                ->where('id','=',$uid)
                ->update([
                    'email' => $mail,
                    'ph' => $phone
                ]);

            return view('home');
        }

    }

    public function Response(Request $request){
        DB::table('request')
            ->where('uid','=',Auth::user()->id)
            ->where('count','=',3)
            ->update([
                'count' => 2
            ]);
        if ($request -> ajax()){
            $data = DB::table('request')
                ->where('uid','=',Auth::user()->id)
                ->get();
            return DataTables::of($data)->addIndexColumn()->make(true);
        }
        return view('employee.myrequests');

    }

    public function  sendContact(Request $request){
        $phone = $request->input('ph');
        $email = $request->input('email');


            if($email != null){
                DB::table('users')
                    ->where('id','=',Auth::user()->id)
                    ->update([
                        'email' => $email
                    ]);

                DB::table('request')
                    ->where('uid','=',Auth::user()->id)
                    ->update([
                        'count' => 2
                    ]);

                return view('employeeHome');
            }
            else if($phone != null){
                DB::table('users')
                    ->where('id','=',Auth::user()->id)
                    ->update([
                        'ph' => $phone
                    ]);

                DB::table('request')
                    ->where('uid','=',Auth::user()->id)
                    ->update([
                        'count' => 2
                    ]);
                return view('employeeHome');
            }
            else{
                DB::table('users')
                    ->where('id','=',Auth::user()->id)
                    ->update([
                        'ph' => $phone,
                        'email' => $email
                    ]);

                DB::table('request')
                    ->where('uid','=',Auth::user()->id)
                    ->update([
                        'count' => 2
                    ]);
                return view('employeeHome');
            }


    }
}
