@extends('layouts.app')


      @section('content')
          <div class="admin">
      <div class="container">
          <div class="row text-center">
              <div class="col-12">
                  <a href="{{route('product.create')}}" class="btn btn-primary add">Add Product</a>
              </div>
              <div class="col-12">
                  <table class="table ">
                      <thead class="thead-dark">
                      <tr>
                          <th scope="col">Title</th>
                          <th scope="col">Image(s)</th>
                          <th scope="col">Price</th>
                          <th scope="col">Availability</th>
                          <th scope="col">Condition</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Web_id</th>
                          <th scope="col">Edit</th>
                          <th scope="col">Delete</th>
                      </tr>
                      </thead>
                    @if(isset($products))
                            @foreach($products as $key => $product)
                              <tbody>
                              <tr>
                                  <td>{{$product->title}}</td>
                                  <td>
                                      @foreach(json_decode($product->images) as $img)
                                          <img src="{{asset('images/'.$img)}}"  width="60">
                                      @endforeach
                                  </td>
                                  <td>{{$product->price}}</td>
                                  <td>
                                      @if($product->availability)
                                            Yes
                                          @else
                                            No
                                      @endif
                                  </td>
                                  <td>
                                      @if($product->condition)
                                            New
                                          @else
                                            Old
                                      @endif
                                  </td>
                                  <td>{{$product->quantity}}</td>
                                  <td>{{$product->web_id}}</td>
                                  <td>
                                      <a href="{{route('product.edit', $product->id)}}" type="button" class="btn btn-info">Edit</a>
                                  </td>
                                  <td>
                                      <form action="{{route('product.destroy',$product->id)}}" method="post">
                                          @csrf
                                          @method("DELETE")
                                          <input type="submit" class="btn btn-danger" value="Delete">
                                      </form>
                                  </td>
                              </tr>
                              </tbody>
                            @endforeach
                      @endif
                  </table>

              </div>
          </div>
      </div>
          </div>

@endsection

