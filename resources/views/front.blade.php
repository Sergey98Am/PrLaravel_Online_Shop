@extends('layouts.general')

        @section('cont')
           <div class="row">
               <div class="col-12">
                   <div class="slider">
                       @foreach($sliders as $key => $value)
                           <div class="img @if($key==0) curry @endif">
                               <img src="{{asset('/images/'.$value->path)}}" alt="">
                               @if($value->id == 1)
                                   <div class="title">
                                       <h6>We Create Beautiful </h6>
                                       <h5>Branding and Indentity</h5>
                                       <div><a href="">Read More</a></div>
                                   </div>
                               @endif
                           </div>
                       @endforeach
                       <div class="dots">
                           @foreach($sliders as $key => $value)
                               <span class="dot @if($key==0) active @endif"></span>
                           @endforeach
                       </div>
                       <div class="prev arrows"><span><i class="fas fa-angle-left"></i></span></div>
                       <div class="next arrows"><span><i class="fas fa-angle-right"></i></span></div>
                   </div>
               </div>
           </div>

@endsection

@section('product')
    <div class="row products" id="productData">
        @foreach($products as $product)
            <div class="col-12 col-sm-6 col-lg-4 ">
                <div class="click-card d">
                    <div class="img-d">
                        @foreach(json_decode($product->images) as $img)
                            <img src="{{asset('/images/'.$img)}}" alt="">
                        @endforeach
                    </div>
                    @guest
                        <div class="c-hv-d text-center" >
                            <a href="{{route('register')}}" class="c-hv" >
                                <span><i class="fas fa-lock"></i> </span> Account
                            </a>
                        </div>
                        <div class="c-hv-d-1">
                            <a href="{{route('login')}}" class="c-hv-1" >
                                <span><i class="fas fa-user"></i></span> Login
                            </a>
                        </div>
                    @else
                        <form action="{{route('add-to-cart')}}" method="post" >
                            @csrf
                            <input type="hidden" name="title" value="{{$product->title}}">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="web_id" value="{{$product->web_id}}">
                            <input type="hidden" name="old_price" value="{{$product->old_price}}">
                            <input type="hidden" name="price" value="{{$product->price}}">
                            <input type="hidden" name="image" value="{{json_decode($product->images)[0]}}">
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
                            <div class="c-hv-d text-center">
                                <button class="c-hv"> <span><i class="fas fa-shopping-cart"></i></span> Add to Cart</button>
                            </div>
                        </form>
                        @if(App\WishList::where('pro_id',$product->id)->count() == 0)
                        <div class="c-hv-d-1">
                        <form action="{{route('add_to_wish_list')}}" method="post">
                            @csrf
                            <input type="hidden" name="title" value="{{$product->title}}">
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="web_id" value="{{$product->web_id}}">
                            <input type="hidden" name="old_price" value="{{$product->old_price}}">
                            <input type="hidden" name="price" value="{{$product->price}}">
                            <input type="hidden" name="image" value="{{json_decode($product->images)[0]}}">
                            <input type="hidden" name="pro_id" value="{{$product->id}}">
                            <input type="hidden" name="category_id" value="{{$product->category_id}}">
                            <input type="hidden" name="brand_id" value="{{$product->brand_id}}">
                            <input type="hidden" name="color_id" value="{{$product->color_id}}">
                            <input type="hidden" name="year_id" value="{{$product->year_id}}">
                            <button class="c-hv-1"> <span><i class="far fa-heart"></i></span> Add to WishList</button>
                        </form>
                        </div>
                            @else
                                <div class="c-hv-d-1">
                                <a href="{{route('wish_list')}}" class="c-hv-1"> <span><i class="fas fa-check"></i></span> Added </a>
                                </div>
                            @endif
                    @endguest

                    <div class="info">
                        <a href="{{route('product',$product->id)}}"><h3>{{$product->title}}</h3></a>
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
        @endforeach
    </div>

@endsection
@section('multi_slider')
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




