@extends('layouts.general')

@section('sidebar')
@endsection

@section('cont')
    <div class="col-12 thank_you">
        <div class="thank_you_m">
            <h3>Thank You for <br> Your Order</h3>
            <p>A confirmation email was sent</p>
            <a href="{{route('front')}}" type="button" class="btn btn-light">Home Page</a>
        </div>
    </div>
@endsection
