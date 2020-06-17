@extends('layouts.general')

@section('cont')

 <div class="row">
     <div class="col-12">
         <div class="row no-gutters single-card">
             <div class="col-md-6 img-div">
                 @foreach(json_decode($product->images) as $img)
                     <img src="{{asset('images/'.$img)}}" class="card-img" alt="...">
                 @endforeach
             </div>
             <div class="col-md-6">
                 <div class="card-body  sc-info">
                     <h2 class="card-title ">{{$product->title}}</h2>
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
                     @endif

                     <p class="year"> {{$product->year->title}}</p>
                     @guest
                         <a href="{{route('register')}}" class="btn btn-secondary">
                             <span><i class="fas fa-lock"></i></span> Account
                         </a>
                     @else
                         <form action="{{route('add-to-cart')}}" method="post" class="form-cart">
                             @csrf
                             <input type="hidden" name="title" value="{{$product->title}}">
                             <input type="hidden" name="user_id" value="{{Auth::user()->id ?? null}}">
                             <input type="hidden" name="web_id" value="{{$product->web_id}}">
                             <input type="hidden" name="old_price" value="{{$product->old_price}}">
                             <input type="hidden" name="price" value="{{$product->price}}">
                             <input type="hidden" name="image" value="{{json_decode($product->images)[0]}}">
                             <input type="hidden" name="category_id" value="{{$product->category_id}}">
                             <input type="hidden" name="brand_id" value="{{$product->brand_id}}">
                             <input type="hidden" name="color_id" value="{{$product->color_id}}">
                             <input type="hidden" name="year_id" value="{{$product->year_id}}">
                             <div class="num-quan">
                                 <input type="button" value="-" class="qty-minus">
                                 <input type="number" value="1" class="qty" name="quantity">
                                 <input type="button" value="+" class="qty-plus">
                             </div>
                             <button class="btn btn-dark add-cart">Add To Cart</button>
                         </form>
                         @if(App\WishList::where('pro_id',$product->id)->count() == 0)
                             <form action="{{route('add_to_wish_list')}}" method="post">
                                 @csrf
                                 <input type="hidden" name="title" value="{{$product->title}}">
                                 <input type="hidden" name="user_id" value="{{Auth::user()->id ?? null}}">
                                 <input type="hidden" name="web_id" value="{{$product->web_id}}">
                                 <input type="hidden" name="price" value="{{$product->price}}">
                                 <input type="hidden" name="dis_price" value="{{$product->dis_price}}">
                                 <input type="hidden" name="image" value="{{json_decode($product->images)[0]}}">
                                 <input type="hidden" name="pro_id" value="{{$product->id}}">
                                 <input type="hidden" name="category_id" value="{{$product->category_id}}">
                                 <input type="hidden" name="brand_id" value="{{$product->brand_id}}">
                                 <input type="hidden" name="color_id" value="{{$product->color_id}}">
                                 <input type="hidden" name="year_id" value="{{$product->year_id}}">
                                 <button class="btn btn-light add-cart">Add To WishList</button>
                             </form>
                         @else
                             <a href="{{route('wish_list')}}" class="btn btn-light"> <span><i class="fas fa-check"></i></span> Added </a>
                         @endif
                     @endguest
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection
@section('multiple_slider')
    <div class="col-12 multi_slider">
        <h3>Recommended Items</h3>
        <div class="owl-carousel owl-theme" id="carousel1">
            @foreach($recommendedItems as $recommendedItem)
                @php $img = json_decode($recommendedItem->images); @endphp
                <div class="item text-center">
                    <img src="{{asset('/images/'.$img[0])}}" alt="">
                    <a href="{{route('product',$recommendedItem->id)}}" class="btn btn-outline-success" style="margin-top: 20px">View</a>
                </div>
            @endforeach
        </div>
@endsection

