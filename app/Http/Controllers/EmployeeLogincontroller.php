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
            return view('home',compact('token'));
        }
        else {
            if (! $request->expectsJson()) {
                Session::flash('message','Invalid userid or password !');
                return redirect()->back();
            }
        }
        if (Auth::guest()){
            return redirect('/auth/login');
        }
    }

}