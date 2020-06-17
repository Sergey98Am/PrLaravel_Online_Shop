<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\WishList;
use App\Cart;
use Validator;

class WishListController extends Controller
{
    function index(){
        $user = Auth::user();
        $wishList = WishList::where('user_id', $user->id)->get();
        $cart = Cart::where('user_id', $user->id)->get();
        return view('wish_list', compact('wishList','cart'));
    }
    function add(Request $request){
        $user = Auth::user();
        $input = $request->except('_token');
        $product = new WishList();
        $product->fill($input);
        $product->save();

        return redirect()->route('wish_list');
    }
    function hide_product(Request $request){
        $destroy = WishList::where('id',$request->id)->where('user_id', Auth::user()->id)->first();
        if (!empty($destroy)){
            $image = $destroy->image;
            \File::delete(public_path().'/images/',$image);
            $destroy->delete();
            return redirect()->route('wish_list');
        }
    }
}
