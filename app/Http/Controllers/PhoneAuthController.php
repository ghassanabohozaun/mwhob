<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhoneAuthController extends Controller
{
    public function sms(){
        return view('sms');
    }

    public function verify($coderesult=null){
        return view('verfiy',compact('coderesult'));
    }
}
