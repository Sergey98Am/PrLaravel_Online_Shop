@extends('layouts.general')

@section('sidebar')
@endsection

@section('user-profile')
    <div class="col-12">
        <div class="wrapper">
            <div class="top">
                <img src="{{(Auth::user()->avatar) ? asset('images').'/'. Auth::user()->avatar : asset('/images/avatar.png')}}" id="avatar">
                <form action="#" method="post" enctype="multipart/form-data" id="form-img">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="file" name="user_avatar" id="user_avatar" hidden="hidden">
                    <button type="button" id="upload" >Choose image</button>
                </form>
                <h4>{{Auth::user()->name}}</h4>
               <div class="other-pages">
                   <a href="{{route('cart')}}" class="btn btn-dark" style="margin-top: 20px"><i class="fas fa-shopping-cart" aria-hidden="true"></i> Cart</a>
                   <a href="{{route('wish_list')}}" class="btn btn-dark" style="margin-top: 20px"><i class="far fa-heart"></i> WishList</a>
                   <a href="{{route('my_orders', Auth::user()->id)}}" class="btn btn-dark" style="margin-top: 20px"> Orders</a>
               </div>
            </div>
            <div class="card" style="margin-top: 0!important;border-radius: 0!important;background: none!important;">
                <form action="{{route('update_profile')}}" class="form update-form" method="post">
                    @method('PUT')
                    @csrf
                    <div class="inputs">
                        <div class="inp-div">
                            <div class="input">
                                <input id="name" placeholder="Name" name="name" type="text" value="{{ old('name', $user->name)}}">
                                <span> <i class="far fa-user"></i></span>
                            </div>
                        </div>

                        <div class="inp-div">
                            <div class="input">
                                <input id="email" placeholder="Email" type="text" name="email" value="{{ old('email', $user->email) }}">
                                <span><i class="fas fa-envelope"></i></span>
                            </div>
                        </div>
                        <div class="inp-div">
                            <div class="input">
                                <input id="password" placeholder="Password" type="password" name="password">
                                <span><i class="fas fa-key"></i></span>
                            </div>
                            <p style="color: #fff">Leave password blank to keep current password
                            </p>
                        </div>
                        <div class="inp-div">
                            <div class="input">
                                <input id="con-pass" placeholder="Confirm Password" type="password" name="password_confirmation">
                                <span><i class="fas fa-key"></i></span>
                            </div>
                        </div>
                    </div>
                    <button id="reg-btn update-btn">Update</button>
                </form>
            </div>
        </div>
    </div>

@endsection

