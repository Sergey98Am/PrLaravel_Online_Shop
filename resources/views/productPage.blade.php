@isset($products)
    @foreach($products as $product)
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="click-card d">
                <div class="img-d">
                    @foreach(json_decode($product->images) as $img)
                        <img src="{{asset('/images/'.$img)}}" alt="">
                    @endforeach
                </div>
                @guest
                    <div class="add-acc text-center" style="width: 100%;display: flex">
                        <a href="{{route('ms-reg')}}" class="rg-lg" style="width: 50%" >
                            <span><i class="fas fa-lock"></i></span> Account
                        </a>
                        <a href="{{route('ms-log')}}" class="rg-lg" style="width: 50%">
                            <span><i class="fas fa-user"></i></span> Login
                        </a>
                    </div>
                @else
                    <form action="" method="post" class="form-cart  " id="cart-form">
                        @csrf
                        <input type="hidden" name="title" value="{{$product->title}}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id ?? null}}">
                        <input type="hidden" name="web_id" value="{{$product->web_id}}">
                        <input type="hidden" name="price" value="{{$product->price}}">
                        <input type="hidden" name="image" value="{{json_decode($product->images)[0]}}">
                        <div class="nq-div">
                            <div class="num-quan">
                                <input type="button" value="-" class="qty-minus">
                                <input type="number" value="1" class="qty" name="quantity">
                                <input type="button" value="+" class="qty-plus">
                            </div>
                        </div>
                        <button id="add-to-cart" class="add-to-cart"> <i class="fas fa-shopping-cart"></i> <span>Add to Cart</span></button>
                    </form>
                @endguest
                <div class="info">
                    <a href="{{route('product',$product->id)}}"><h3>{{$product->title}}</h3></a>
                    <div class="p-y">
                        <p class="price">
                            ${{$product->price}}
                        </p>
                        <p class="year">
                            {{$product->year->title}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endisset
