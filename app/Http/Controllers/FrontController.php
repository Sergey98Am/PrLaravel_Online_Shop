<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Category;
use App\Brand;
use App\Color;
use App\Year;
use App\Slider;
use App\Cart;
use App\WishList;
use Illuminate\Http\Request;
use App\Home;
use Illuminate\Support\Facades\App;
use Validator;

class FrontController extends Controller
{
    function index()
    {
        $products = Product::limit(6)->orderBy('id','desc')->get();
        $categories = Category::limit(4)->orderBy('id','desc')->get();
        $brands = Brand::limit(4)->orderBy('id','desc')->get();
        $colors = Color::limit(4)->orderBy('id','desc')->get();
        $years = Year::limit(4)->orderBy('id','desc')->get();
        $sliders = Slider::orderBy('sort_id','ASC')->get();
        $recommendedItems = Product::limit(12)->orderBy('quantity','desc')->get();
        if (Auth::user()) {
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            $wishList = WishList::where('user_id',Auth::user()->id)->get();
            return view('front',compact('products','categories','sliders','cart','brands','colors','years','wishList','recommendedItems'));
        }else{
            return view('front',compact('products','categories','sliders','brands','colors','years','recommendedItems'));
        }

    }
//    function show($id){
//        $phone = Product::find($id);
//        return view('show',compact('phone'));
//    }


}
