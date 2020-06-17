<?php

namespace App\Http\Controllers\adminka;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    function index(){
        $orders = Order::all();
        return view('admin/orders',compact('orders'));
    }
    function show($id){
        $products = OrderProduct::where('order_id',$id)->get();
        return view('admin/show_products',compact('products'));
    }
}
