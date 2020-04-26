<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class GetHolidays extends Controller
{
   public function  getHolidays(){
       $holidays = DB::table('holiday')->get();
       return response()->json(['message' =>'list available','status'=>'success','data'=>$holidays]);
   }
}
