@extends('layouts.general')

@section('sidebar')
@endsection

@section('product')
    <div class="col-12 col-sm-4 col-lg-3">
        @foreach($orders as $order)
            <div class="click-card d">
                <div class="img-d">
                    <img src="{{asset('/images/'.$order->image)}}" alt="">
                </div>
                <div class="info">
                    <h3>{{$order->title}}</h3>
                    <div class="p-y">
                        @if($order->old_price == 0)
                            <p class="price">
                                ${{$order->price}}
                            </p>
                        @else
                            <p class="price">
                                <sub>
                                    <del>${{$order->old_price}}</del>
                                </sub>
                                <span>
                                        ${{$order->price}}
                                    </span>
                            </p>
                            <div class="disc">
                                    <span>
                                        {{floor(($order->old_price - $order->price) / $order->old_price * 100)}}%
                                    </span>
                            </div>
                        @endif
                        <p class="year">
                            {{$order->year->title}}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
