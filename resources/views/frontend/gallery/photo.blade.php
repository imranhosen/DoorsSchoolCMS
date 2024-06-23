@extends('frontend.layouts.master')
@section('content')
    <div class="container spacet50 spaceb50">
        <div class="row">
            <div class="col-md-12">
                <div class="post-list" id="postList">
                    @foreach($photos as $photo)
                        @if($photo->gallery_title != null || $photo->gallery_description != null ||$photo->featured_image != null)
                        <table width="100%" border="0" style="font-size:11px; margin-bottom: 20px">
                            @if($photo->gallery_title != null)
                                <tr>
                                    <td colspan="5" align="justify"><b><h1>{{$photo->gallery_title}}</h1></b></td>
                                </tr>
                            @endif
                            @if($photo->gallery_description != null)
                                <tr>
                                    <td colspan="5" align="justify"><b><h3>{{$photo->gallery_description}}</h3></b></td>
                                </tr>
                            @endif
                            @if($photo->featured_image != null)
                                <tr>
                                    <td colspan="5" align="justify"><img width="500" height="300"
                                                                         src="{{Voyager::image($photo->featured_image)}}"/>
                                    </td>
                                </tr>
                            @endif
                        </table>
                        @endif
                        <tr>
                            @foreach(json_decode($photo->gallery_image) as $ph)
                                {{--<div class="col-md-4" style="margin-bottom: 10px">--}}
                                <td colspan="5" align="justify">
                                    <img width="380" height="250" style="margin-bottom: 10px"
                                         src="{{Voyager::image($ph)}}"/>
                                </td>
                                {{-- </div>--}}
                            @endforeach
                        </tr>
                    @endforeach
                </div>
            </div>
        </div><!--./row-->
    </div><!--./container-->
@stop
