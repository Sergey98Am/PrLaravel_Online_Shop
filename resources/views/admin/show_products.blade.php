@extends('layouts.app')


@section('content')
    @foreach($products as $product)
        <div class="admin">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-4 col-lg-3">
                        <div class="click-card d">
                            <div class="img-d">
                                <img class="cart-img" src="{{asset('/images/'.$product->image)}}" alt="">
                            </div>
                            <div class="info">
                                <h3>{{$product->title}}</h3>
                                <div class="p-y">
                                    @if($product->old_price == 0)
                                        <p class="price">
                                            ${{$product->price}}
                                        </p>
                                    @else
                                        <p class="price">
                                            <sub>
                                                <del>${{$product->old_price}}</del>
                                            </sub>
                                            <span>
                                                ${{$product->price}}
                                            </span>
                                        </p>
                                        <div class="discount">
                                            <span>
                                                {{floor(($product->old_price - $product->price) / $product->old_price * 100)}}%
                                            </span>
                                        </div>
                                    @endif
                                    <p class="year">
                                        {{$product->year->title}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
