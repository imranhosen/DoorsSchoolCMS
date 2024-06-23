@extends('frontend.layouts.master')
@section('content')
    <div class="container spacet50 spaceb50 centerAndFont">
        <div class="row">

            <div class="col-md-12" style="text-align: center">
                @foreach($routines as $routine)
                <p><a href="{{Storage::url((json_decode($routine->file))[0]->download_link)}}" target="_blank">
                        {{ $routine->file ?: '' }}
                    </a></p>
                @endforeach
            </div>
        </div>
    </div>
                {{--<p><a href="../uploads/gallery/media/Routine%202021-22%20HSC%2001.pdf">Routine 2021-22 HSC 01.pdf</a></p>

                <p><a href="../uploads/gallery/media/Routine%20-2020-21%20HSC%2002.pdf">Routine -2020-21 HSC 02.pdf</a></p>

                <p><a href="../uploads/gallery/media/Routine%20-2022%20DEGREE.pdf">Routine -2022 DEGREE.pdf</a></p>
                <title></title>
                <p>&nbsp;</p><!-- <h2 class="courses-head text-center"></h2> -->
                <input type="hidden" name="page_content_type" id="page_content_type" value="">
                <div class--}}
@stop
