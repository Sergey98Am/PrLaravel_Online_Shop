@extends('layouts.app')


@section('content')

<div class="admin">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <a href="{{route('slider.create')}}" class="btn btn-primary add">Add Image</a>
            </div>
        </div>
        <div class="row" id="sortable">
            @if(isset($slider) && is_object($slider))
            @foreach($slider as $item)
            <div class="col-3">
                <div class="image-area" data-sort-id="{{$item->id}}">
                    <img src="{{asset('images/'.$item->path)}}" alt="" style="width: 100%;height: 100%">
                    <form action="{{route('slider.destroy',$item->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="remove-image" style="display: inline;" value="&#215;">
                    </form>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div id="wrap" data-sort-order-image="">
            <div class="loader"></div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#sortable').sortable({
            cursor: 'move',
            stop: function () {
                var result = $.map($('.image-area'), function (n) {
                    return n.attributes[1].value;

                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('update-order')}}",
                    method: "POST",
                    data: {
                        ids: result
                    },
                    beforeSend: function () {
                        $('#wrap').addClass('wrap');
                    },
                    success: function (data) {
                        $('#wrap').removeClass('wrap');
                    }
                })
            }

        })
        $(".image-area").on('mousedown', function () {
            $(this).css({
                'opacity': '0.5',
            })
        })
        $(".image-area").on('mouseup', function () {
            $(this).css({
                'opacity': '1',
            })
        })
    })
</script>
@endsection