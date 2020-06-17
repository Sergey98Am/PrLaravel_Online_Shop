@extends('layouts.app')


@section('content')
    <div class="edit">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <form action="{{route('color.update',$color->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="formGroupExampleInput">Title</label>
                            <input type="text" class="form-control {{$errors->has('title')?'form-control is-invalid': ''}}" id="formGroupExampleInput" name="title" value="  {{$color->title}}">
                            @if($errors->has('title'))
                                <span class="error">{{$errors->first('title')}}</span>
                            @endif
                        </div>
                        <button class="btn btn-success">Success</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
