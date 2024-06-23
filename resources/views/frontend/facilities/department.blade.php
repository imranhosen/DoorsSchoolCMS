@extends('frontend.layouts.master')

@section('content')
    <div class="container spacet50 spaceb50">
        <div class="row">

            <div class="col-md-12">
                <p><img src="{{asset('frontend/assets')}}/uploads/gallery/media/Website%20Department.jpg" /></p><!-- <h2 class="courses-head text-center"></h2> -->
                <input type="hidden" name="page_content_type" id="page_content_type" value="">
                <div class="post-list" id="postList">
                </div>
            </div>
        </div>
    </div>
@stop
