@extends('layouts.general')

@section('sidebar')
@endsection

@section('cont')

     <div class="col-lg-3 col-md-4 col-sm-6 col-12 all-sect text-center">
         <h3>Categories</h3>
         <ul>
             @if(isset($categories))
                 @foreach($categories as $category)
                     <a href="{{route('category',$category->id)}}">
                         <li class="btn-sect">
                             <span>{{$category->title}}</span> <span>({{App\Product::where('brand_id',$category->id)->count()}})</span>
                         </li>
                     </a>
                 @endforeach
             @endisset
         </ul>
     </div>
     <div class="col-lg-3 col-md-4 col-sm-6 col-12 all-sect text-center">
         <h3>Brands</h3>
         <ul>
             @if(isset($brands))
                 @foreach($brands as $brand)
                     <a href="{{route('brand',$brand->id)}}">
                         <li class="btn-sect">
                             <span>{{$brand->title}}</span> <span>({{App\Product::where('brand_id',$brand->id)->count()}})</span>
                         </li>
                     </a>
                 @endforeach
             @endisset
         </ul>
     </div>
     <div class="col-lg-3 col-md-4 col-sm-6 col-12 all-sect text-center">
         <h3>Colors</h3>
         <ul>
             @if(isset($colors))
                 @foreach($colors as $color)
                     <a href="{{route('color',$color->id)}}">
                         <li class="btn-sect">
                             <span>{{$color->title}}</span> <span>({{App\Product::where('color_id',$color->id)->count()}})</span>
                         </li>
                     </a>
                 @endforeach
             @endisset
         </ul>
     </div>
     <div class="col-lg-3 col-md-4 col-sm-6 col-12 all-sect text-center">
         <h3>Years</h3>
         <ul>
             @if(isset($years))
                 @foreach($years as $year)
                     <a href="{{route('year',$year->id)}}">
                         <li class="btn-sect">
                             <span>{{$year->title}}</span> <span>({{App\Product::where('year_id',$year->id)->count()}})</span>
                         </li>
                     </a>
                 @endforeach
             @endisset
         </ul>
     </div>


@endsection
