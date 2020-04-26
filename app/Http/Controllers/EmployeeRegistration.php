<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function MongoDB\BSON\toJSON;
use Session;
class EmployeeRegistration extends Controller
{

    public function  saveData(Request $request){

            $id_desg = DB::table('designation')->where('salary','=',$request->input('desgid') )->where('deptid','=',$request->input('department'))->value('id');
            $dept = DB::table('department')->where('id','=',$request->input('department'))->value('name');
            $designation = DB::table('designation')->where('id','=',$id_desg)->value('dname');
            $characters = '1234567890';
            $id = substr($request->fname,0,3).substr($request->lname,0,3).substr($request->dob,5,2).substr(str_shuffle($characters), 0, 4);

            //Photo upload

            $photo = $request->file('photo');
            $new_name = $photo->getClientOriginalExtension();
            Storage::disk('public')->put('uploads/'.$photo->getFilename().'.'.$new_name,File::get($photo));
            $myfile = $photo->getFilename().'.'.$new_name;

            //signature upload

            $signature = $request->file('signature');
            $file = $signature->getClientOriginalExtension();
            Storage::disk('public')->put('signature/'.$signature->getFilename().'.'.$file,File::get($signature));
            $sign_name = $signature->getFilename().'.'.$file;

            $value[] =Session::put([
                'fname'=>$request->input('fname'),
                'mname'=>$request->input('mname'),
                'lname'=>$request->input('lname'),
                'gender'=>$request->input('gender'),
                'dob'=>$request->input('dob'),
                'nationality'=>$request->input('nationality'),
                'father'=>$request->input('father'),
                'mother'=>$request->input('mother'),
                'mstatus'=>$request->input('mstatus'),
                'paddress'=>$request->input('paddress'),
                'caddress'=>$request->input('caddress'),
                'ph'=>$request->input('ph'),
                'altph'=>$request->input('altph'),
                'email'=>$request->input('email'),
                'deptname'=>$dept,
                'designationname'=> $designation,
                'department'=>$request->input('department'),
                'desg'=>$id_desg,
                'salary'=>$request->input('desgid'),
                'joindate' => $request->input('joindate'),
                'myfile' =>$myfile,
                'sign' =>$sign_name,
                'id' =>$id
            ]);



            if($value != 0){
                return view('employee.previewregister');
            }


    }

}
