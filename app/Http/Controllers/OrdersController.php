<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Order;
use App\OrderProduct;

class OrdersController extends Controller
{
    function index($id){
        $orders = OrderProduct::where('user_id',$id)->get();
        return view('my_orders',compact('orders'));
    }
}
