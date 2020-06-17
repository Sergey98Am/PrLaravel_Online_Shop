@extends('layouts.general')


@section('sidebar')
@endsection
@section('cont')
    <div class="col-12">
        <div class="card">
            <form action="{{route('register')}}" class="form reg-form" method="post">
                @csrf
                <div class="inputs">
                    <div class="inp-div">
                        <div class="input">
                            <input id="name" placeholder="Name" name="name" type="text">
                            <span> <i class="far fa-user"></i></span>
                        </div>
                    </div>

                    <div class="inp-div">
                        <div class="input">
                            <input id="email" placeholder="Email" type="text" name="email" >
                            <span><i class="fas fa-envelope"></i></span>
                        </div>
                    </div>
                    <div class="inp-div">
                        <div class="input">
                            <input id="password" placeholder="Password" type="password" name="password">
                            <span><i class="fas fa-key"></i></span>
                        </div>
                    </div>
                    <div class="inp-div">
                        <div class="input">
                            <input id="con-pass" placeholder="Confirm Password" type="password" name="password_confirmation">
                            <span><i class="fas fa-key"></i></span>
                        </div>
                    </div>
                </div>
                <button id="reg-btn">Register</button>
            </form>
        </div>
    </div>
@endsection
