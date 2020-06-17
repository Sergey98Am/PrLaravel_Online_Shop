@extends('layouts.app')

@section('content')

    <div class="admin">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <a href="{{route('brand.create')}}" class="btn btn-primary add">Add Brand</a>
                </div>
                <div class="col-12">
                    <table class="table ">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        @if(isset($brands))
                            @foreach($brands as $key => $brand)
                                <tbody>
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$brand->title}}</td>
                                    <td>
                                        <a href="{{route('brand.edit', $brand->id)}}" type="button" class="btn btn-info">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{route('brand.destroy',$brand->id)}}" method="post">
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
