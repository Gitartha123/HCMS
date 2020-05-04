<?php

namespace App\Http\Controllers\Api;

use App\Leave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestLeave extends Controller
{
    public function submitRequest(Request $request){


        $data = new Leave();
        $leavetype = $request->leavetype;
        $userid = $request->userid;
        $data->type = $leavetype;
        $data->empid = $userid;

        $data->save();

        if ($data->save()){
            return (['message'=>'Request Sent','status'=>'success','data'=>$data]);
        }
        else{
            return ['message' => 'Request not sent','status'=>'fail','data'=>$data];
        }
    }
}
