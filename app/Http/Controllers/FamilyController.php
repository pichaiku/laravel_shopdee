<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Employee;
use DB;

class FamilyController extends Controller
{

    public function family()
    {
        return view('family');
    }

    public function compute(Request $request)
    {
        echo "hello";
        die();
    }


}