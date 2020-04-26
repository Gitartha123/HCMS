<?php

namespace App\Http\Controllers\Api;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;
use Hash;

class LoginController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        if(Auth::attempt(['id' => request('id'), 'password' => request('password')])){
            $user = Auth::user();
            $token = Str::random(30);
            $request->user()->forceFill([
                'api_token'=>hash('sha256',$token)
            ])->save();
            return response()->json(['message'=>'Login Successfull','status'=>'Success','data'=>$user],$this-> successStatus);
        }
        else{
            return response()->json(['message'=>'Login unsuccessfull','status'=>'fail','data'=>'null'], 200);
        }
    }
}
