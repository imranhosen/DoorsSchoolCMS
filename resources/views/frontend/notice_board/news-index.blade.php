@extends('frontend.layouts.master')
@section('content')
    <div class="container spacet50 spaceb50 centerAndFont">
        <div class="row">
            <div class="col-md-12">
                <h1>{{$news->news_title}}</h1>
                @if(isset($news->news_image))
                    @foreach (json_decode($news->news_image) as $image)
                        <p><img src="{{ Voyager::image($image)}}"></p>
                    @endforeach
                @endif
                <div class="row">
                    <p>{{$news->news_description}}</p>
                </div>
            </div>
        </div><!--./row-->
    </div>
@stop
