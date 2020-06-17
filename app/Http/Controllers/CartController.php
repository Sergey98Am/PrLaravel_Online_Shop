<?php

namespace App\Http\Controllers;

use App\Product;
use App\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Cart;
use Validator;

class CartController extends Controller
{
    function index()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();
        $wishList = WishList::where('user_id', $user->id)->get();
        $sum = 0;
        foreach ($cart as $item){
            $sum += $item->total_price;
        }
        $products = Product::all();
        return view('cart', compact('cart','wishList','sum','products'));

    }

    function add(Request $request)
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();
        $input = $request->except('_token');
        $a = true;

        foreach ($cart as $product) {
            if ($product['web_id'] == $input['web_id']){
                $input['quantity'] = $product['quantity'] + $input['quantity'];
                $input['total_price'] = $input['quantity'] * $input['price'];
                $product->fill($input);
                $product->update();
                $a = false;
                break;
            }
        }
        if ($a) {
            $input['total_price'] = $input['quantity'] * $input['price'];
            $cart = new Cart;
            $cart->fill($input);
            $cart->save();
        }
        return redirect()->route('cart');
    }

    function hide_product(Request $request){
        $destroy = Cart::where('id',$request->id)->where('user_id', Auth::user()->id)->first();
        if (!empty($destroy)){
            $image = $destroy->image;
            \File::delete(public_path().'/images/',$image);
            $destroy->delete();
            return redirect()->route('cart');
        }
    }



}
