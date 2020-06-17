@extends('layouts.app')

@section('content')

    <div class="admin orders">
        <div class="container">
           <div class="row">
               @foreach($orders as $order)
                   <div class="col-12">
                       <div class="accordeon">
                           <div class="holder">
                               <div class="title">
                                   <div class="icon"><span class="plus"></span></div>
                                   <a href="#!">{{$order->billing_name}}</a>
                               </div>
                               <div class="content">
                                   <ul class="list-group">
                                       <li class="list-group-item list-group-item-secondary show">
                                           <a href="{{route('show_products',$order->id)}}">Show Products</a>
                                       </li>
                                       <li class="list-group-item list-group-item-success">User ID</li>
                                       <li class="list-group-item">{{$order->user_id}}</li>
                                       <li class="list-group-item list-group-item-success">Billing Email</li>
                                       <li class="list-group-item">{{$order->billing_email}}</li>
                                       <li class="list-group-item list-group-item-success">Billing Name</li>
                                       <li class="list-group-item">{{$order->billing_name}}</li>
                                       <li class="list-group-item list-group-item-success">Billing Address</li>
                                       <li class="list-group-item">{{$order->billing_address}}</li>
                                       <li class="list-group-item list-group-item-success">Billing City</li>
                                       <li class="list-group-item">{{$order->billing_city}}</li>
                                       <li class="list-group-item list-group-item-success">Billing Province</li>
                                       <li class="list-group-item">{{$order->billing_province}}</li>
                                       <li class="list-group-item list-group-item-success">Billing Postal Code</li>
                                       <li class="list-group-item">{{$order->billing_postalcode}}</li>
                                       <li class="list-group-item list-group-item-success">Billing Phone</li>
                                       <li class="list-group-item">{{$order->billing_phone}}</li>
                                       <li class="list-group-item list-group-item-success">Billing Name On Card</li>
                                       <li class="list-group-item">{{$order->billing_name_on_card}}</li>
                                       <li class="list-group-item list-group-item-success">Billing Discount</li>
                                       <li class="list-group-item">
                                           @if($order->billing_discount)
                                               {{$order->billing_discount}}
                                           @else
                                               No Discount
                                           @endif
                                       </li>
                                       <li class="list-group-item list-group-item-success">Billing Discount Code</li>
                                       <li class="list-group-item">
                                           @if($order->billing_discount_code)
                                               {{$order->billing_discount_code}}
                                           @else
                                               No Discount Code
                                           @endif
                                       </li>
                                       <li class="list-group-item list-group-item-success">Billing Total</li>
                                       <li class="list-group-item">{{$order->billing_total}}</li>
                                       <li class="list-group-item list-group-item-success">Payment Gateway</li>
                                       <li class="list-group-item">{{$order->payment_gateway}}</li>
                                       <li class="list-group-item list-group-item-success">Shipped</li>
                                       <li class="list-group-item">{{$order->shipped}}</li>
                                       <li class="list-group-item list-group-item-success">Card Error</li>
                                       <li class="list-group-item">
                                           @if($order->error)
                                               {{$order->error}}
                                           @else
                                               No
                                           @endif
                                       </li>
                                   </ul>
                               </div>
                           </div>
                       </div>
                   </div>
               @endforeach
           </div>

        </div>
    </div>

@endsection
