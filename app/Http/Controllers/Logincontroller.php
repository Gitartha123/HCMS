<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class Logincontroller extends Controller
{
    public function Login(Request $request){
        $userid = $request->input('username');
        $password = $request->input('password');
            $user = User::where('userid',$request->userid)->first();

            if ($user->role == 0){
                return redirect()->route('/viewdashboard');
            }
            elseif ($user->role == 1){
                return 'hello';
            }

        return redirect()->back();
    }
}
