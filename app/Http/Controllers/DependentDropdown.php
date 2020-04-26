<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DependentDropdown extends Controller
{
    public function getdesignation($id)
    {
        $designation = DB::table("designation")->where("deptid",$id)->pluck("dname",'salary');
        return json_encode($designation);
    }
}
