<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mobile Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e8fcb2f199.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
</head>

<body>
    <header>
        <div class="full-menu ">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="navig ">
                            <div class="logo-div">
                                <a href="{{route('front')}}">
                                    <h3><b><i>Mobile Shop</i></b></h3>
                                </a>
                                <div class="menu-toggle">
                                    <div class="hambourger">
                                    </div>
                                </div>
                            </div>
                            <nav class="menu-nav">
                                <ul class="account">
                                    @guest
                                    <div class="dropdown show" style="width: 100%">
                                        <a class="btn btn-success dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" style="width: 100%">
                                            <span><i class="fas fa-lock"></i></span> Account
                                        </a>

                                        <div class="dropdown-menu text-center" aria-labelledby="dropdownMenuLink"
                                            style="width: 100%">
                                            <a class="dropdown-item" href="{{route('register')}}"
                                                style="padding: 5px">Register</a>
                                            <a class="dropdown-item" href="{{route('login')}}"
                                                style="padding: 5px">Login</a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Your Account
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="{{route('user')}}" class="dropdown-item">
                                                <li><i class="fa fa-user"></i> <span>{{ Auth::user()->name }}</span>
                                                </li>
                                            </a>
                                            <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                                {{ csrf_field() }}
                                                <input type="submit" value="Log Out" class="btn btn-danger lo">
                                            </form>
                                        </div>
                                    </div>
                                    @endguest
                                </ul>
                                <ul class="m">
                                    <li><a href="{{route('front')}}">Home</a></li>
                                    <li><a href="{{route('products')}}">Products</a></li>
                                    <li><a href="{{route('wish_list')}}">
                                            <span class="dd"> <i class="far fa-heart"></i> WishList <span class="a">
                                                    @if(isset($wishList))
                                                    ({{$wishList->count()}})
                                                    @endif
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li><a href="{{route('cart')}}">
                                            <span class="dd"> <i class="fas fa-shopping-cart"></i> Cart <span class="a">
                                                    @if(isset($cart))
                                                    ({{$cart->count()}})
                                                    @endif
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="home">
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>
            <div class="cube"></div>


            <div class="container sect-cont">

                <div class="row">
                    @section('sidebar')
                    <div class="col-xl-3 col-lg-12">

                        <div class="sidebar">
                            <header>Search</header>
                            <ul>
                                <li class="search-li">
                                    <form action="{{route('search')}}" class="navbar-form navbar-right search-form"
                                        role="search" method="get">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" placeholder="Search..." name="search">
                                            <button type="submit" class="fa fa-search"></button>
                                        </div>
                                    </form>
                                </li>
                                <li>
                                    <div class="filter">
                                        <h4>Filter</h4>
                                        <div class="toggle-btn">
                                            <div class="hambourger">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>

                                    <div class="cat-items">
                                        <ul>
                                            <a href="{{route('actions')}}">
                                                <li class="btn-sect">
                                                    <span><i class="fas fa-percentage"></i></span> <span>Actions</span>
                                                    <span>({{App\Product::where('old_price','!=',0)->count()}})</span>
                                                </li>
                                            </a>
                                        </ul>
                                        <div class="filter">
                                            <h4>Filter Price</h4>
                                        </div>
                                        <form action="{{route('productsPr')}}" method="get">
                                            <ul>
                                                <li>
                                                    <div class="anim_button">
                                                        <button name="price" value="1-100"><span>1-100</span></button>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="anim_button">
                                                        <button name="price"
                                                            value="100-300"><span>100-300</span></button>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="anim_button">
                                                        <button name="price"
                                                            value="300-500"><span>300-500</span></button>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="anim_button">
                                                        <button name="price"
                                                            value="500-2000"><span>500-2000</span></button>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="anim_button">
                                                        <button name="price"
                                                            value="2000-4000"><span>2000-4000</span></button>
                                                    </div>
                                                </li>

                                            </ul>
                                        </form>
                                        <div class="filter">
                                            <h4>Sort</h4>
                                        </div>
                                        <form action="{{route('sort_price')}}" method="get">
                                            <button class="btn-sect" name="sort" value="low_high"
                                                style="color: #fff">Low To High Price</button>
                                            <button class="btn-sect" name="sort" value="high_low"
                                                style="color: #fff">High To Low Price</button>
                                        </form>
                                        <div class="filter">
                                            <h4>Categories</h4>
                                        </div>
                                        <ul>
                                            @if(isset($categories))
                                            @foreach($categories as $category)
                                            <a href="{{route('category',$category->id)}}">
                                                <li class="btn-sect">
                                                    <span>{{$category->title}}</span>
                                                    <span>({{App\Product::where('category_id',$category->id)->count()}})</span>
                                                </li>
                                            </a>
                                            @endforeach
                                            @endisset
                                        </ul>
                                        <div class="filter">
                                            <h4>Brands</h4>
                                        </div>
                                        <ul>
                                            @if(isset($brands))
                                            @foreach($brands as $brand)
                                            <a href="{{route('brand',$brand->id)}}">
                                                <li class="btn-sect">
                                                    <span>{{$brand->title}}</span>
                                                    <span>({{App\Product::where('brand_id',$brand->id)->count()}})</span>
                                                </li>
                                            </a>
                                            @endforeach
                                        </ul>
                                        @endisset
                                        <div class="filter">
                                            <h4>Color</h4>
                                        </div>
                                        <ul>
                                            @if(isset($colors))
                                            @foreach($colors as $color)
                                            <a href="{{route('color',$color->id)}}">
                                                <li class="btn-sect">
                                                    <span>{{$color->title}}</span>
                                                    <span>({{App\Product::where('brand_id',$color->id)->count()}})</span>
                                                </li>
                                            </a>
                                            @endforeach
                                            @endisset
                                        </ul>

                                        <div class="filter">
                                            <h4>Year</h4>
                                        </div>
                                        <ul>
                                            @if(isset($years))
                                            @foreach($years as $year)
                                            <a href="{{route('year',$year->id)}}">
                                                <li class="btn-sect">
                                                    <span>{{$year->title}}</span>
                                                    <span>({{App\Product::where('brand_id',$year->id)->count()}})</span>
                                                </li>
                                            </a>
                                            @endforeach
                                            @endisset
                                        </ul>
                                        <div class="all_sections">
                                            <a href="{{route('all_sections')}}"
                                                style="width: 100%;color: #212529!important;" type="button"
                                                class="btn btn-light">
                                                <span><i class="fas fa-angle-double-right"></i></span>
                                                <span>All Sections</span>
                                            </a>
                                        </div>
                                    </div>

                                </li>

                            </ul>

                        </div>

                    </div>
                    <div class="col-xl-9 col-lg-12">
                        @show
                        @yield('cont')

                        @yield('product')


                    </div>
                    @yield('user-profile')
                    @yield('multi_slider')
                </div>
                @yield('multiple_slider')
            </div>
        </div>
    </main>

    <footer>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4><sub>Made By</sub> <i>Sergey Gabrielyan</i></h4>
                    </div>
                </div>
            </div>
        </div>
    </footer>



    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function () {

            $('.log-form').on('submit', function (e) {
                e.preventDefault()
                var form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    beforeSend: function (xhr) {
                        form.find('.help-block').detach()
                    },
                    success: function () {
                        window.location.href = 'http://prlaravel.loc/';
                    },
                    error: function (xhr) {
                        var response = xhr.responseJSON;
                        var errors = response.errors;

                        if ($.isEmptyObject(xhr) == false) {
                            $.each(errors, (key, value) => {
                                $(`#${key}`).addClass('has-error').closest(
                                    '.inp-div').append(
                                    `<p class="help-block">${value.join(", ")}</p>`
                                    )
                                console.log(key)
                            })
                            console.log(xhr)
                        }
                    }
                })
            })
            $('.reg-form').on('submit', function (e) {
                e.preventDefault()
                var form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    beforeSend: function (xhr) {
                        form.find('.help-block').detach()
                    },
                    success: function () {
                        window.location.href = 'http://prlaravel.loc/';
                    },
                    error: function (xhr) {
                        var response = xhr.responseJSON;
                        var errors = response.errors;

                        if ($.isEmptyObject(xhr) == false) {
                            $.each(errors, (key, value) => {
                                $(`#${key}`).addClass('has-error').closest(
                                    '.inp-div').append(
                                    `<p class="help-block">${value.join(", ")}</p>`
                                    )
                                console.log(key)
                            })
                            console.log(xhr)
                        }
                    }
                })
            })


            $('.update-form').on('submit', function (e) {
                e.preventDefault()
                var form = $(this);

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: form.serialize(),
                    beforeSend: function (xhr) {
                        form.find('.help-block').detach()
                    },
                    success: function () {
                        location.reload()
                    },
                    error: function (xhr) {
                        var response = xhr.responseJSON;
                        var errors = response.errors;

                        if ($.isEmptyObject(xhr) == false) {
                            $.each(errors, (key, value) => {
                                $(`#${key}`).addClass('has-error').closest(
                                    '.inp-div').append(
                                    `<p class="help-block">${value.join(", ")}</p>`
                                    )
                                console.log(key)
                            })
                            console.log(xhr)
                        }
                    }
                })
            })
        });
    </script>
    @yield('scr')
</body>

</html>