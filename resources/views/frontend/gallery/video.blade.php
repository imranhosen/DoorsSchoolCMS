@extends('frontend.layouts.master')
@section('content')
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
                                    {{--@if($video->link != null)
                                            <h2 class="line-bottom mt-0">University
                                                <span class="text-theme-colored2">Video</span>
                                            </h2>        
                                                    <div class="box-hover-effect play-button">               
                                                        <div class="effect-wrapper">             
                                                            --}}{{--<div class="thumb">
                                                                <img class="img-fullwidth" src="images/about/5.jpg" alt="project">                    
                                                            </div>--}}{{--                 
                                                            <div class="overlay-shade bg-theme-colored"></div>   
                                                            <div class="video-button"></div>
                                                            <a class="hover-link"
                                                               data-lightbox-gallery="youtube-video"
                                                               href="{{$video->link}}"
                                                               title="Youtube Video">Youtube
                                                                Video
                                                            </a>                 
                                                        </div>               
                                                    </div>
                                    @endif--}}
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
                            {{-- <tr>
                                 @foreach(json_decode($photo->gallery_image) as $ph)
                                     --}}{{--<div class="col-md-4" style="margin-bottom: 10px">--}}{{--
                                     <td colspan="5" align="justify">
                                         <img width="380" height="250" style="margin-bottom: 10px"
                                              src="{{Voyager::image($ph)}}"/>
                                     </td>
                                     --}}{{-- </div>--}}{{--
                                 @endforeach
                             </tr>--}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div><!--./row-->
    </div><!--./container-->
@stop
