@extends('layouts.general')

@section('sidebar')
@endsection

@section('cont')

        @isset($wishList)
            @foreach($wishList as $item)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="click-card d">
                        <div class="img-d">
                            <img src="{{asset('/images/'.$item->image)}}" alt="">
                        </div>
                            <form action="{{route('add-to-cart')}}" method="post" >
                                @csrf
                                <input type="hidden" name="title" value="{{$item->title}}">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id ?? null}}">
                                <input type="hidden" name="web_id" value="{{$item->web_id}}">
                                <input type="hidden" name="old_price" value="{{$item->old_price}}">
                                <input type="hidden" name="price" value="{{$item->price}}">
                                <input type="hidden" name="image" value="{{$item->image}}">
                                <input type="hidden" name="category_id" value="{{$item->category_id}}">
                                <input type="hidden" name="brand_id" value="{{$item->brand_id}}">
                                <input type="hidden" name="color_id" value="{{$item->color_id}}">
                                <input type="hidden" name="year_id" value="{{$item->year_id}}">

                                <div class="nq-div">
                                    <div class="num-quan">
                                        <input type="button" value="-" class="qty-minus">
                                        <input type="number" value="1" class="qty" name="quantity">
                                        <input type="button" value="+" class="qty-plus">
                                    </div>
                                </div>
                                <div class="c-hv-d text-center">
                                    <button class="c-hv"> <span><i class="fas fa-shopping-cart"></i></span> Add to Cart</button>
                                </div>
                            </form>
                        <form action="{{route('hide-product-wish-list')}}" method="post">
                            <div class="c-hv-d-1">
                                @csrf
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <button class="c-hv-1"> <span><i class="fas fa-trash"></i></span> Remove</button>
                            </div>
                        </form>
                        <div class="info">
                            <a href="{{route('product',$item->pro_id)}}"><h3>{{$item->title}}</h3></a>
                            <div class="p-y">
                                @if($item->dis_price == 0)
                                    <p class="price">
                                        ${{$item->price}}
                                    </p>
                                @else
                                    <p class="price">
                                        <sub>
                                            <del>${{$item->price}}</del>
                                        </sub>
                                        <span>
                                        ${{$item->dis_price}}
                                    </span>
                                    </p>
                                    <div class="discount">
                                        <span>
                                            {{floor(($item->price - $item->dis_price) / $item->price * 100)}}%
                                        </span>
                                    </div>
                                @endif
                                <p class="year">
                                    {{$item->year->title}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset

@endsection
