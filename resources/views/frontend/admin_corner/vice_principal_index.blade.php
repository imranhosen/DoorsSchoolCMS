@extends('frontend.layouts.master')
@section('content')
    <div class="container spacet50 spaceb50">
        <div class="row">
            <div class="col-md-12">
                <div class="post-list" id="postList">
                    <table width="100%" border="0">
                        @foreach($vice_principle as $prin)
                            <tr>
                                <td align="center"><img width="200" src="{{ Voyager::image($prin->staff_image) }}"/></td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size: medium"><b>{{$prin->first_name}} {{$prin->last_name}}<br/>সহকারি প্রধান<br/>
                                        {{setting('general-settings.clg_name_bengali')}}।<br/><br/>
                                    </b></td>
                            </tr>
                            <tr>
                                <td style="word-spacing:6px; font-size: large">{{$prin->note}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div><!--./row-->
    </div><!--./container-->
@stop
