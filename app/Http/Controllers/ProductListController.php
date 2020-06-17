<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Brand;
use App\Color;
use App\Year;
use App\Product;
use App\Cart;
use App\WishList;
use Validator;

class ProductListController extends Controller
{
    function allProducts(){

        $categories = Category::limit(4)->orderBy('id','desc')->get();
        $brands = Brand::limit(4)->get();
        $years = Year::limit(4)->get();
        $colors = Color::limit(4)->get();
        $products = Product::paginate(6);
        if (Auth::user()){
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            $wishList = WishList::where('user_id',Auth::user()->id)->get();
            return view('products',compact('products','brands','categories','colors','years','cart','wishList'));
        }else{
            return view('products',compact('products','categories','brands','colors','years'));
        }
    }

    public function categoryItems($id){
        $products = Product::where('category_id',$id)->paginate(6);
        $brands = Brand::limit(4)->get();
        $years = Year::limit(4)->get();
        $colors = Color::limit(4)->get();
        $categories = Category::limit(4)->get();
        if (Auth::user()){
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            $wishList = WishList::where('user_id',Auth::user()->id)->get();
            return view('products',compact('products','categories','brands','colors','years','cart','wishList'));
        }else{
            return view('products',compact('products','categories','brands','colors','years'));
        }
    }
    public function brandItems($id){
        $products = Product::where('brand_id',$id)->paginate(6);
        $brands = Brand::limit(4)->get();
        $years = Year::limit(4)->get();
        $colors = Color::limit(4)->get();
        $categories = Category::limit(4)->get();
        if (Auth::user()){
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            $wishList = WishList::where('user_id',Auth::user()->id)->get();
            return view('products',compact('products','brands','categories','colors','years','cart','wishList'));
        }else{
            return view('products',compact('products','brands','categories','colors','years'));
        }
    }
    public function colorItems($id){
        $products = Product::where('color_id',$id)->paginate(6);
        $brands = Brand::limit(4)->get();
        $years = Year::limit(4)->get();
        $colors = Color::limit(4)->get();
        $categories = Category::limit(4)->get();
        if (Auth::user()){
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            $wishList = WishList::where('user_id',Auth::user()->id)->get();
            return view('products',compact('products','brands','categories','colors','years','cart','wishList'));

        }else{
            return view('products',compact('products','brands','categories','colors','years'));
        }
    }
    public function yearItems($id){
        $products = Product::where('year_id',$id)->paginate(6);
        $brands = Brand::limit(4)->get();
        $years = Year::limit(4)->get();
        $colors = Color::limit(4)->get();
        $categories = Category::limit(4)->get();
        if (Auth::user()){
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            $wishList = WishList::where('user_id',Auth::user()->id)->get();
            return view('products',compact('products','brands','categories','colors','years','cart','wishList'));
        }else{
            return view('products',compact('products','brands','categories','colors','years'));
        }
    }
    function singleProduct($id){
        $categories = Category::limit(4)->orderBy('id','desc')->get();
        $product = Product::find($id);
        $brands = Brand::limit(4)->get();
        $years = Year::limit(4)->get();
        $colors = Color::limit(4)->get();
        $recommendedItems = Product::limit(12)->orderBy('quantity','desc')->get();
        if (Auth::user()){
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            $wishList = WishList::where('user_id',Auth::user()->id)->get();
            return view('product',compact('product','brands','categories','colors','years','cart','wishList','recommendedItems'));
        }else{
            return view('product',compact('product','brands','categories','colors','years','recommendedItems'));
        }
    }

    function search(Request $request){
        $search = $request->search;
        if ($search == ''){
            return redirect()->back();
        }else{
            $products = Product::where('title','LIKE', '%'.$search.'%')->paginate(1);
            $products->appends($request->only('search'));
            $categories = Category::all();
            if (Auth::user()){
                $cart = Cart::where('user_id',Auth::user()->id)->get();
                $wishList = WishList::where('user_id',Auth::user()->id)->get();
                return view('products',compact('products','categories','cart','wishList'));
            }else{
                return view('products',compact('products','categories'));
            }
        }
    }

    function productsPr(Request $request){
        $brands = Brand::limit(4)->get();
        $years = Year::limit(4)->get();
        $colors = Color::limit(4)->get();
        $categories = Category::limit(4)->get();

            $price = explode("-",$request->price);
            $start = $price[0];
            $end = $price[1];

            $products = Product::where('price', ">=", $start)
               ->where('price', "<=", $end)
                ->orderBy('id','desc')->paginate(6);

        if (Auth::user()){
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            $wishList = WishList::where('user_id',Auth::user()->id)->get();
            return view('products',compact('products','brands','categories','colors','years','cart','wishList'));
        }else{
            return view('products',compact('products','brands','categories','colors','years'));
        }
    }
    function allSections(){
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $years = Year::all();
        if (Auth::user()){
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            $wishList = WishList::where('user_id',Auth::user()->id)->get();
            return view('all_sections',compact('categories','brands','colors','years','cart','wishList'));
        }else{
            return view('all_sections',compact('categories','brands','colors','years'));
        }
    }
    function actions(){
        $products = Product::where('old_price','!=',0)->paginate(6);
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $years = Year::all();
        if (Auth::user()){
            $cart = Cart::where('user_id',Auth::user()->id)->get();
            $wishList = WishList::where('user_id',Auth::user()->id)->get();
            return view('products',compact('products','categories','brands','colors','years','cart','wishList'));
        }else{
            return view('products',compact('products','categories','brands','colors','years'));
        }
    }
    function sort_price(Request $request){
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $years = Year::all();
            if ($request->sort == 'low_high'){
                $products = Product::orderBy('price','ASC')->paginate(6);
            }else if($request->sort == 'high_low'){
                $products = Product::orderBy('price','DESC')->paginate(6);
            }
            if (Auth::user()){
                $cart = Cart::where('user_id',Auth::user()->id)->get();
                $wishList = WishList::where('user_id',Auth::user()->id)->get();
                return view('products',compact('products','categories','brands','colors','years','cart','wishList'));
            }else{
                return view('products',compact('products','categories','brands','colors','years'));
            }
    }
}
