<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\OrderProduct;
use Illuminate\Http\Request;
use App\Cart;
use App\WishList;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use App\Http\Requests\CheckoutRequest;
use Cartalyst\Stripe\Exception\CardErrorException;
use Illuminate\Support\Facades\Mail;
use Validator;

class CheckoutController extends Controller
{
    function index(){

        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $wishList = WishList::where('user_id',Auth::user()->id)->get();
        $sum = 0;
        foreach ($cart as $item){
            $sum += $item->total_price;
        }
        return view('checkout',compact('cart','wishList','sum'));
    }

    function store(CheckoutRequest $request){
        $cart = Cart::all();
        $sum = 0;
        foreach ($cart as $item){
            $sum += $item->total_price;
        }

        $contents = $cart->map(function ($item){
            return $item->title.','.$item->quantity;
        })->values()->toJson();


        try {
           Stripe::charges()->create([
                'amount' => $sum - session()->get('coupon')['discount'],
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => $cart->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ]
            ]);

            $this->AddToOrdersTables($request,null);

            Cart::truncate();
            session()->forget('coupon');

            return redirect()->route('thank_you')->with('success_message','Thank you! Your payment has been successfully accepted');
        }catch (CardErrorException $e){
            $this->AddToOrdersTables($request,$e->getMessage());
            return back()->withErrors('Error! '.$e->getMessage());
        }
    }

    protected function AddToOrdersTables($request,$error){
        $cart = Cart::all();
        $sum = 0;
        foreach ($cart as $item){
            $sum += $item->total_price;
        }
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => session()->get('coupon')['discount'] ?? 0,
            'billing_discount_code' => session()->get('coupon')['name'],
            'billing_total' =>  $sum - session()->get('coupon')['discount'],
            'error' => $error,
        ]);

        foreach ($cart as $item){
            OrderProduct::create([
                'order_id' => $order->id,
                'user_id' => Auth::user()->id,
                'product_id' => $item->id,
                'web_id' => $item->web_id,
                'title' => $item->title,
                'image' => $item->image,
                'old_price' => $item->old_price,
                'price' => $item->price,
                'total_price' => $item->total_price,
                'quantity' => $item->quantity,
                'category_id' => $item->category_id,
                'brand_id' => $item->brand_id,
                'color_id' => $item->color_id,
                'year_id' => $item->year_id,
            ]);
        }


    }
}
