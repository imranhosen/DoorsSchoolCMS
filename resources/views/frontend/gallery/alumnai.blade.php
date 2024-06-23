@extends('frontend.layouts.master')
@section('content')
    @foreach($alumnai as $alu)
    <div class="container spacet50 spaceb50 centerAndFont">
        <div class="row">

            <div class="col-md-12">
                <p><img src="{{ Voyager::image($alu->event_image) }}" style="height: 300px; width: 400px;" /></p>
                <title></title>
                <p>{{$alu->description}}</p><!-- <h2 class="courses-head text-center"></h2> -->
                <input type="hidden" name="page_content_type" id="page_content_type" value="">
                <div class="post-list" id="postList">
                </div>
            </div>
        </div>
    </div>
    @endforeach
@stop
