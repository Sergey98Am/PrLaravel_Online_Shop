<?php

namespace App\Http\Controllers;

use App\Cart;
use App\WishList;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index(){
        $user = Auth::user();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $wishList = WishList::where('user_id',Auth::user()->id)->get();
        return view('user', compact('user','cart','wishList'));
    }
    function change_avatar(Request $request){
        if ($request->hasFile('user_avatar')){
            $file = $request->file('user_avatar');
            $file_name = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/',$file_name);
            $user = Auth::user();
            $user->avatar = $file_name;
            $user->update();
            echo $file_name;
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
            'password' => 'sometimes|nullable|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $input = $request->except('password', 'password_confirmation');

        if (! $request->filled('password')) {
            $user->fill($input)->save();

            return back();
        }

        $user->password = bcrypt($request->password);
        $user->fill($input)->save();

        return back();
    }
}
