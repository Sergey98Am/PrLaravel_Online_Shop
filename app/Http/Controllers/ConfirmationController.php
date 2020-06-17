<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    function index(){
        if (!session()->has('success_message')){
            return redirect('/');
        }
        return view('thank_you');
    }
}
