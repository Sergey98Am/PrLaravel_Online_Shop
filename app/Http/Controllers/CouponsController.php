<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponsController extends Controller
{
    function store(Request $request){
        $coupon = Coupon::where('code',$request->coupon_code)->first();

        if (!$coupon){
            return back()->withErrors('Invalid coupon code. Please try again');
        }
            session()->put('coupon',[
                'name' => $coupon->code,
                'discount' => $coupon->discount(),
            ]);
        return redirect()->route('checkout')->with('success_message', 'Coupon has been applied!');
    }

    function destroy(){
        session()->forget('coupon');

        return back()->with('success_message', 'Coupon has been removed.');
    }
}
