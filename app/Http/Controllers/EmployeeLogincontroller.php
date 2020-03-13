<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Str;
use Hash;

class EmployeeLogincontroller extends Controller
{

    public function login(Request $request){

        $uname = $request->input('username');
        $password = $request->input('password');
        if (Auth::attempt(array('id' => $uname, 'password' => $password))){
            if(Auth::user()->status == 1){
                if(Auth::user()->dept==1) {
                    return redirect()->route('home');
                }
                else{
                    return redirect()->route('employee');
                }
            }
            else{
                Session::flash('nopermit','Ooops !! You are not permitted to log in ...');
                return back();
            }
        }
        else {
            if (! $request->expectsJson()) {
                Session::flash('error','Invalid userid or password !');
                return redirect()->back();
            }
        }
        if (Auth::guest()){
            return redirect('/auth/login');
        }
    }

}