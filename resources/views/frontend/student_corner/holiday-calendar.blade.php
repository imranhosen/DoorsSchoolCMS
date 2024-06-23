@extends('frontend.layouts.master')
@section('content')
    <div class="container spacet50 spaceb50 centerAndFont">
        <div class="row">

            <div class="col-md-12" style="text-align: center">
                @foreach($calender_lists as $list)
                    <p><a href="{{Storage::url((json_decode($list->file))[0]->download_link)}}" target="_blank">
                            {{ $list->file ?: '' }}
                        </a></p>
                @endforeach
            </div>
        </div>
    </div>
@stop
