@extends('layouts.general')

@section('sidebar')
@endsection

@section('user-profile')
        <div class="col-12">
                <div class="bottom">
                    <div class="inform">
                        <h3>My Products</h3>

                        @if($cart->count() != 0)
                            <div class="cart-buttons">
                                <a href="{{route('products')}}" class="btn btn-secondary">Continue Shopping</a>
                                <a href="{{route('checkout')}}" class="btn btn-success">Proceed To Checkout</a>
                            </div>
                            <h3 style="font-style: italic"><sub>Total Amount</sub> ${{$sum}}</h3>

                        @endif


                        <div class="info_data">
                            <table>
                                <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Delete</th>
                                </tr>
                                </thead>

                               @foreach($cart as $key => $product)

                                    <tbody>
                                    <tr>
                                        <td>
                                            <img class="cart-img" src="{{asset('/images/'.$product->image)}}" alt="">
                                        </td>
                                        <td>{{$product->price}}</td>
                                        <td>
                                            {{$product->quantity}}
                                            <form action="{{route('add-to-cart')}}" method="post" >
                                                @csrf
                                                <input type="hidden" name="title" value="{{$product->title}}">
                                                <input type="hidden" name="user_id" value="{{Auth::user()->id ?? null}}">
                                                <input type="hidden" name="web_id" value="{{$product->web_id}}">
                                                <input type="hidden" name="old_price" value="{{$product->old_price}}">
                                                <input type="hidden" name="price" value="{{$product->price}}">
                                                <input type="hidden" name="image" value="{{$product->image}}">
                                                <input type="hidden" name="category_id" value="{{$product->category_id}}">
                                                <input type="hidden" name="brand_id" value="{{$product->brand_id}}">
                                                <input type="hidden" name="color_id" value="{{$product->color_id}}">
                                                <input type="hidden" name="year_id" value="{{$product->year_id}}">

                                                <div class="nq-div">
                                                    <div class="num-quan">
                                                        <input type="button" value="-" class="qty-minus">
                                                        <input type="number" value="1" class="qty" name="quantity">
                                                        <input type="button" value="+" class="qty-plus">
                                                    </div>
                                                </div>
                                                    <button class="btn btn-success"> <span><i class="fas fa-shopping-cart"></i></span> Add Again</button>
                                            </form>
                                        </td>
                                        <td>{{$product->total_price}}</td>
                                        <td>
                                            <form action="{{route('hide-product')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$product->id}}">
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

        </div>

@endsection


