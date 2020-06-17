@extends('layouts.general')


@section('sidebar')
@endsection
@section('cont')
    <div class="card">
        <form action="{{route('login')}}" class="form log-form" method="post">
            @csrf
            <div class="inputs">
                <div class="inp-div">
                    <div class="input">
                        <input id="email" placeholder="Email" type="email" name="email" value="{{old('email')}}">
                        <span><i class="fas fa-envelope"></i></span>
                    </div>
                </div>
                <div class="inp-div">
                    <div class="input">
                        <input id="password" placeholder="Password" type="password" name="password">
                        <span><i class="fas fa-key"></i></span>
                    </div>
                </div>
                <label class="checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Remember me</span>
                </label>
            </div>
            <button>Login</button>
        </form>
    </div>
@endsection

{{--@if (Route::has('password.request'))--}}
{{--    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--        {{ __('Forgot Your Password?') }}--}}
{{--    </a>--}}
{{--@endif--}}
