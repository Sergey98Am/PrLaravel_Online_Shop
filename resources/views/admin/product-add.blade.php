@extends('layouts.app')


@section('content')
<div class="create">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" name="images[]" multiple>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Title</label>
                        <input type="text" class="form-control {{$errors->has('title')?'form-control is-invalid': ''}}" id="formGroupExampleInput" name="title" value="{{old('title')}}">
                        @if($errors->has('title'))
                            <span class="error">{{$errors->first('title')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Price</label>
                        <input type="text" class="form-control {{$errors->has('price')?'form-control is-invalid': ''}}" id="formGroupExampleInput2" name="price" value="{{old('price')}}">
                        @if($errors->has('price'))
                            <span class="error">{{$errors->first('price')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput3">Year</label>
                        <input type="text" class="form-control {{$errors->has('year')?'form-control is-invalid': ''}}" id="formGroupExampleInput3" name="year" value="{{old('year')}}">
                        @if($errors->has('year'))
                            <span class="error">{{$errors->first('year')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="product-availability">Availability</label>
                        <select name="availability" class="form-control  {{$errors->has('availability')?'form-control is-invalid': ''}}" id="product-availability">
                            <option selected disabled="disabled">Product availability</option>
                            <option value="0">no</option>
                            <option value="1">yes</option>
                        </select>
                        @if($errors->has('availability'))
                            <span class="error">{{$errors->first('availability')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="product-condition">Condition</label>
                        <select name="condition" class="form-control {{$errors->has('condition')?'form-control is-invalid': ''}}" id="product-condition">
                            <option selected disabled="disabled">Product condition</option>
                            <option value="0">Old</option>
                            <option value="1">New</option>
                        </select>
                        @if($errors->has('condition'))
                            <span class="error">{{$errors->first('condition')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="product-quantity">Quantity</label>
                        <input name="quantity" value="{{ old('quantity') }}" type="number" class="form-control" id="product-quantity" placeholder="Add product quantity...">
                    </div>
                    <div class="form-group">
                        <label for="web">Web_id</label>
                        <input name="web_id" value="{{ old('web_id') }}" type="text" class="form-control" id="web" placeholder="Add product web_id...">
                    </div>
                    <div class="form-group">
                        <label for="category_list">Select category</label>
                        <select name="category_id" class="form-control" id="category_list">
                            <option selected disabled="disabled">Select category</option>
                            @isset($categories)
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="brand_list">Select brand</label>
                        <select name="brand_id" class="form-control" id="brand_list">
                            <option selected disabled="disabled">Select brand</option>
                            @isset($brands)
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->title}}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="color_list">Select color</label>
                        <select name="color_id" class="form-control" id="color_list">
                            <option selected disabled="disabled">Select color</option>
                            @isset($colors)
                                @foreach($colors as $color)
                                    <option value="{{$color->id}}">{{$color->title}}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year_list">Select year</label>
                        <select name="year_id" class="form-control" id="year_list">
                            <option selected disabled="disabled">Select year</option>
                            @isset($years)
                                @foreach($years as $year)
                                    <option value="{{$year->id}}">{{$year->title}}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <button class="btn btn-success">Success</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
