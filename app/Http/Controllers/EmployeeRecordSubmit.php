<?php

namespace App\Http\Controllers;

use App\User;
use Hash;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Http\Request;

class EmployeeRecordSubmit extends Controller
{
    public function  FinalSubmit(Request $request){
        $id = $request->input('id');
        $validator = \Validator::make($request->all(),[
            'email' =>'unique:users',
            'id' =>'unique:users'
        ]);

        if($validator -> fails()){
            $errors = $validator->errors()->first();
            Session::flash('erroruser',$errors);
            return view('employee.previewregister');
        }
        else{
            $data = new User();
            $data->fname = $request->input('fname');
            $data->mname = $request->input('mname');
            $data->lname = $request->input('lname');
            $data->gender = $request->input('gender');
            $data->dob = $request->input('dob');
            $data->nationality = $request->input('nationality');
            $data->father = $request->input('father');
            $data->mother = $request->input('mother');
            $data->mstatus = $request->input('mstatus');
            $data->paddress = $request->input('paddress');
            $data->caddress = $request->input('caddress');
            $data->ph = $request->input('ph');
            $data->altph = $request->input('altph');
            $data->email = $request->input('email');
            $data->dept = $request->input('deptid');
            $data->desg= $request->input('desgid');
            $data->salary = $request->input('salary');
            $data->joindate = $request->input('joindate');
            $data->photo = $request->input('IMG');
            $data->sign = $request->input('sign');
            $characters = '1234567890';
            $data->id = $id;
            $password = substr(str_shuffle($characters), 0, 4);
            $data->password = Hash::make($password);



            //** send message to mobile number  */

            $message = 'You%20are%20successfully%20registered,%20Use%20your%20id=%20'.$id.'%20and%20password%20=%20'.$password.'%20to%20login';
            $url = 'http://198.24.149.4/API/pushsms.aspx?loginID=atcpl123&password=123456&mobile=' . $request->input('ph') . '&text=' . $message . '&senderid=SLPRBA&route_id=2&Unicode=0';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);

            //do get request

            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($ch);
            if($result){
                curl_close($ch);
                $data->save();
                Session::flash('message','Submitted Successfully');
                return view('home');
            }
            else{
                Session::flash('errornetwork','Please check your internet connection !');
                Return view('employee.previewregister');
            }
        }


    }


}
