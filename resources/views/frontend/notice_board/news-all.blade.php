@extends('frontend.layouts.master')
@section('content')
    <div class="container spacet50 spaceb50 centerAndFont">
        <div class="row">
            @foreach($news as $new)
            <div class="col-md-12">
                <h1>{{$new->news_title}}</h1>
                @if(isset($new->news_image))
                    @foreach (json_decode($new->news_image) as $image)
                        <p><img src="{{ Voyager::image($image)}}"></p>
                    @endforeach
                @endif
                <div class="row">
                    <p>{{$new->news_description}}</p>
                </div>
            </div>
            @endforeach
        </div><!--./row-->
    </div>
@stop
