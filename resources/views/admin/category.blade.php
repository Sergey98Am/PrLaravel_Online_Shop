@extends('layouts.app')

@section('content')

    <div class="admin">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <a href="{{route('category.create')}}" class="btn btn-primary add">Add Category</a>
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
                        @if(isset($categories))
                            @foreach($categories as $key => $category)
                                <tbody>
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$category->title}}</td>
                                    <td>
                                        <a href="{{route('category.edit', $category->id)}}" type="button" class="btn btn-info">Edit</a>
                                    </td>
                                    <td>
                                        <form action="{{route('category.destroy',$category->id)}}" method="post">
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
