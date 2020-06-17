<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class EmailAvailable extends Controller
{
    function check(Request $request){

        if ($request->get('email')){
            $email = $request->get('email');
            $data =  User::where('email',$email)->count();
            if ($data > 0){
                echo 'not_unique';
            }else{
                echo 'unique';
            }
        }
    }
}
