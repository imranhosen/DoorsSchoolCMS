@extends('frontend.layouts.master')

@section('content')

    <div class="container spacet50 spaceb50 centerAndFont">
        <div class="row">

            <div class="col-md-12">
                <title></title>
                <p>FOOTBAL</p>

                <p>CRICKET</p>

                <p>KABADI</p>

                <p>BADMINTON</p>

                <p>LUDU</p>

                <p>&nbsp;</p><!-- <h2 class="courses-head text-center"></h2> -->
                <input type="hidden" name="page_content_type" id="page_content_type" value="">
                <div class="post-list" id="postList">
                </div>
            </div>
        </div>
    </div>
@stop
