<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HRController extends Controller
{
     public function show(){
        return view('hr.dashboard');
    }
}
