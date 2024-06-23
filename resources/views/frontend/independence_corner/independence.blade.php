@extends('frontend.layouts.master')
@section('content')
    <div class="container spacet50 spaceb50">
        <div class="row">
            <div class="col-md-12">
                <div class="post-list" id="postList">
                    @foreach($photos as $photo)
                                @if($photo->gallery_title != null)
                                    <tr>
                                        <td colspan="5" align="justify"><b><h1>{{$photo->gallery_title}}</h1></b></td>
                                    </tr>
                                @endif
                                @if($photo->gallery_description != null)
                                    <tr>
                                        <td colspan="5" align="justify"><b><h3>{{$photo->gallery_description}}</h3></b>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    @if($photo->featured_image != null)
                                        <td colspan="5" align="justify"><img width="380" height="250" style="margin-bottom: 10px"
                                                                             src="{{Voyager::image($photo->featured_image)}}"/>
                                        </td>
                                    @endif
                                    @foreach(json_decode($photo->gallery_image) as $ph)
                                        <td colspan="5" align="justify">
                                            <img width="380" height="250" style="margin-bottom: 10px"
                                                 src="{{Voyager::image($ph)}}"/>
                                        </td>
                                    @endforeach
                                </tr>
                    @endforeach
                </div>
            </div>
        </div><!--./row-->
    </div><!--./container-->
    <div class="container spacet50 spaceb50">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="post-list" id="postList">
                    @foreach($videos as $video)
                        <div class="col-lg-6 col-md-6 col-sm-6 ">
                            @if($video->title != null || $video->description != null ||$video->video != null ||$video->link != null)
                                <table width="100%" border="0" style="font-size:11px">
                                    @if($video->video != null)
                                        <tr>
                                            <td colspan="5" align="justify">
                                                <?php $file = (json_decode($video->video))[0]->download_link; ?>
                                                <video width="550" height="400" controls>
                                                    <source src="{{ Voyager::image( $file ) }}" type="video/mp4">
                                                </video>
                                            </td>
                                        </tr>
                                    @endif
                                    @if($video->link != null)
                                        <tr>
                                            <td colspan="5" align="justify">
                                                <a class="hover-link"
                                                   data-lightbox-gallery="youtube-video"
                                                   href="{{$video->link}}"
                                                   title="Youtube Video">Click Here To See More
                                                </a> 
                                            </td>
                                        </tr>

                                    @endif
                                    @if($video->title != null)
                                        <tr>
                                            <td colspan="5" align="justify"><b><h4>{{$video->title}}</h4></b></td>
                                        </tr>
                                    @endif
                                    @if($video->description != null)
                                        <tr>
                                            <td colspan="5" align="justify"><h5>{{$video->description}}</h5></td>
                                        </tr>
                                    @endif
                                </table>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--./row-->
    </div>
    <!--./container-->
@stop
