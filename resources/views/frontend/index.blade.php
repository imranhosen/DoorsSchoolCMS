@extends('frontend.layouts.master')
@section('content')
    <div class="container pt10">
        <div class="row">
            <div class="col-md-3 col-sm-3" style="padding-left:50px">
                <div class="row">
                    <div class="sidebar newsmain">
                        <div class="catetab" style="padding-left:20px">নোটিস বোর্ড</div>
                        <div class="newscontent">
                            <div class="tickercontainer" style="height: 350px">
                                <div class="mask">
                                    <ul id="ticker01" class="newsticker" style="top: 124.54px;">
                                        @foreach($news as $new)
                                            <li><a href="{{route('news.view',$new->id)}}">
                                                    <div class="date">{{$new->created_at->format('d')}}
                                                        <span>{{$new->created_at->format('M')}}</span>
                                                    </div>{{$new->news_title}}
                                                </a></li>
                                        @endforeach
                                    </ul>
                                    <h5 style="color: #62a8ea">এখানে, আপনি সাম্প্রতিক আপডেটগুলি দেখতে পারেন এবং সমস্ত আপডেট দেখতে, অনুগ্রহ করে নীচে ক্লিক করুন৷</h5>
                                </div>
                                <a href="{{route('newsAll.view')}}" style="float:right">সব দেখুন</a>
                            </div>
                        </div><!--./newscontent-->
                        {{--<div style="float:right">
                        </div>--}}
                    </div><!--./sidebar-->
                </div>
                </br>
            </div><!--./col-md-12-->
            <div class="col-md-6 col-sm-6">
                <div id="bootstrap-touch-slider" class="carousel bs-slider slide  control-round">
                    <div class="carousel-inner">
                        @foreach($banner_images as $banner_image)
                            <div class="item active">
                                <img src="{{ \TCG\Voyager\Facades\Voyager::image($banner_image->banner_image)}}"
                                     alt=""/>
                            </div>
                        @endforeach
                        @foreach($banner_images2 as $banner_image2)
                            <div class="item">
                                <img src="{{ \TCG\Voyager\Facades\Voyager::image($banner_image2->banner_image)}}"
                                     alt=""/>
                            </div>
                        @endforeach
                    </div><!--./carousel-inner-->
                    <a class="left carousel-control" href="#bootstrap-touch-slider" data-slide="prev">
                        <span class="fa fa-angle-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <!-- Right Control-->
                    <a class="right carousel-control" href="#bootstrap-touch-slider" data-slide="next">
                        <span class="fa fa-angle-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div> <!--./bootstrap-touch-slider-->
                <div class="row" style="">
                    <table width="100%" border="0">
                        <tr>
                            <td style="padding-left:20px;padding-top:10px;word-spacing:4px" align="justify">দেশকে নিরক্ষরমুক্ত করার লক্ষ্যে সরকারের অঙ্গীকারের পঠভূমিতে দেশে সরকারি প্রাথমিক বিদ্যালয়ের
                                পাশাপাশি স্থানীয় ও বেসরকারি উদ্যোগে প্রাথমিক বিদ্যালয় প্রতিষ্ঠা সময়ের দাবী। ২০১১ সালের নভেম্বরে
                                ডোরস বেসরকারি প্রাথমিক বিদ্যালয় প্রতিষ্ঠিত হয়। প্রতিষ্ঠাতা পরিচালক ও প্রধান শিক্ষক
                                জনাব ইন্জিনিয়ার মোꓽ জাকির হোসেন এর আর্থিক বিনিয়োগ
                                <a class="read_more" href="{{route('historical.index')}}">READ MORE <i
                                        class="fa fa-arrow-circle-right"></i></a>

                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="row">
                    <div>
                        <div class="catetab">বার্তা</div>
                        <div style="border:1px solid #ddd">
                            <table width="100%" border="0">
                                <tr>
                                    @foreach($chairman as $prin)
                                        <td width="40%"><img width="100" height="125"
                                                             src="{{ Voyager::image($prin->staff_image) }}"/>
                                        </td>
                                        <td width="60%" align="center" valign="top">
                                            <table width="100%">
                                                <tr>
                                                    <td align=""><h4 style="font-size:15px;font-weight:bold;"><u><a
                                                                    href="{{route('chairmanIndex')}}">{{$prin->designation->designation_name}}</a></u>
                                                        </h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        @php
                                                        $notes = explode(' ', $prin->note);
                                                        @endphp
                                                        <p style="align:justify;font-size:12px">@foreach($notes as $key => $note)
                                                        @if($key < 16)
                                                            {{$note}}
                                                            @endif
                                                            @endforeach
                                                            ...
                                                            </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach($principle as $prin)
                                        <td valign="top" width="40%"><img width="100"
                                                                          src="{{ Voyager::image($prin->staff_image) }}"/>
                                        </td>
                                        <td width="60%" align="center" valign="top">

                                            <table width="100%">
                                                <tr>
                                                    <td align=""><h4 style="font-size:15px; font-weight:bold;"><u><a
                                                                    href="{{route('principleIndex')}}">{{$prin->designation->designation_name}}</a></u>
                                                        </h4></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        @php
                                                        $notes = explode(' ', $prin->note);
                                                        @endphp
                                                        <p style="align:justify;font-size:12px">@foreach($notes as $key => $note)
                                                        @if($key < 16)
                                                            {{$note}}
                                                            @endif
                                                            @endforeach
                                                            ...
                                                            </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach($vice_principle as $prin)
                                        <td width="40%"><img width="100" height="123"
                                                             src="{{ Voyager::image($prin->staff_image) }}"/>
                                        </td>
                                        <td width="60%" align="center" valign="top">
                                            <table width="100%">
                                                <tr>
                                                    <td align=""><h4 style="font-size:15px;font-weight:bold;"><u><a
                                                                    href="{{route('vicePrincipleIndex')}}">{{$prin->designation->designation_name}}</a></u>
                                                        </h4></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        @php
                                                        $notes = explode(' ', $prin->note);
                                                        @endphp
                                                        <p style="align:justify;font-size:12px">@foreach($notes as $key => $note)
                                                        @if($key < 16)
                                                            {{$note}}
                                                            @endif
                                                            @endforeach
                                                            ...
                                                            </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    @endforeach
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <br/>
    <div class="container" style="height:350px">
        <div class="row border">
            <div class="card-header py-6" style="background:#E7D4B5">
                <h4 class="m-0 font-weight-bold text-center" style="font-size:20px;font-weight:bold;">আমাদের স্কুল সম্পর্কে</h4>
            </div>
        </div>
        <div class="row" style="background:#A0937D;color:white">
            <div class="card col-md-4" style="height:280px;background:#A0937D;">
                @foreach($banner_images as $banner_image)
                    <p align="center"><img
                            src="{{ \TCG\Voyager\Facades\Voyager::image($banner_image->banner_image)}}"
                            width="360" height="275"/></p>
                @endforeach

            </div>
            <div class="card col-md-4" style="height:280px;background:#A0937D;">
                <p align="justify">২০১৬ শিক্ষাবর্ষে  বিদ্যালয়ের নাম পরিবর্তন করে ডোরস বিদ্যালয় নামে মাধ্যমিক পর্যায় শুরু করা হয়।
                    ২০১৬ সালে ষষ্ঠ শ্রেণিসহ মোট শিক্ষার্থী সংখ্যা ছিল ১২০ জন।
                    ২০১৭ সালে সপ্তম শ্রেণি এভাবে পর্যায়ক্রমে ২০১৮ সালে অষ্টম শ্রেণি শুরু করে
                    ১১জন শিক্ষার্থী ২০২১ সালের এস.এস.সি. পরীক্ষায় অংশগ্রহন করে।
                    ৫ জন শিক্ষার্থী জিপিএ ৫ প্রাপ্ত হয়। ২০২৩ সালের বিদ্যালয় ভর্তি রেজিষ্টার অনুযায়ী
                    প্রাক-প্রাথমিক শ্রেণি হতে ১০ম শ্রেণি পর্যন্ত মোট শিক্ষার্থী সংখ্যা  প্রায় ৩০০।
                    নিয়মিত শিক্ষক সংখ্যা ১৬ জন, গেস্ট শিক্ষক ৩ জন, অফিস সহকারি ১ জন এবং অফিস সহায়ক ১ জন।
                </p>
                <button class="btn btn-success" align="center" valign="bottom" style="vertical-align:bottom"
                        onClick="location.href='frontend/contact-index'">Contact Us
                </button>
            </div>
            <div class="card col-md-4" style="height:280px;background:#A0937D;">
                <p align="center">
                    <iframe
                        src="https://maps.google.com/maps?q=বোরহানগঞ্জ, বোরহানউদ্দিন, ভোলা&t=&z=10&ie=UTF8&iwloc=&output=embed"
                        width="350" height="280"></iframe>
                </p>
            </div>

        </div>
    </div>
    <div class="container">
        <!-- Content Row -->
        <div class="row">
            <!-- Content Column -->
            <div class="">
                <!-- Project Card Example -->
                <div class="card  mb-4">
                    <div class="card-header py-6" style="background:#E7D4B5">
                        <h4 class="m-0 font-weight-bold text-center" style="font-size:20px;font-weight:bold;">এক নজরে স্কুল</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table style="background:#A0937D" class="table table-bordered text-center" width="100%"
                                   cellspacing="0">
                                <thead style="color:white">
                                <tr>
                                    <th class="text-center" width="20%">জমি (sq/ft)</th>
                                    <th class="text-center" width="15%">তথ্য কেন্দ্র</th>
                                    <th class="text-center" width="15%">পাঠ্যধারাগুলি</th>
                                    <th class="text-center" width="15%">বিভাগসমূহ</th>
                                    <th class="text-center" width="10%">শিক্ষকরা</th>
                                    <th class="text-center" width="10%">অফিসিয়াল স্টাফ</th>
                                    <th class="text-center" width="15%">শিক্ষার্থী</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr style="color:white">
                                    <td style="text-align: left">প্রাথমিক পর্যায়ে পরিপূর্ণ  জ্ঞানের আলো শিশুদের মাঝে ছড়িয়ে দেয়ার লক্ষ্যে আমাদের ব্যাক্তিগত উদ্যোগে ও স
                                        ্থানীয় গন্যমান্য ব্যক্তিবর্গের সহযোগীতায়  ২০১১ সালের নভেম্বরে ডোরস বেসরকারি
                                        প্রাথমিক বিদ্যালয় প্রতিষ্ঠিত হয়। প্রতিষ্ঠাতা পরিচালক ও প্রধান শিক্ষক জনাব ইন্জিনিয়ার
                                        মোꓽ জাকির হোসেন এর আর্থিক বিনিয়োগ, পরিচালক জনাব মোꓽ রেজাউল হাসান এবং
                                        পরিচালক জনাব শংকর দে এর শিক্ষার প্রতি অনুরাগ ও ত্যাগ মহতী উদ্যোগের ভিত্তি রচিত হয়।
                                        <a style="text-align: center" href="{{route('landArea.index')}}">বিস্তারিত</a>
                                    </td>
                                    <td>আরো বিস্তারিত জানার জন্য কল করুন
                                        <i class="fa-solid fa-phone"> 01756-292250</i></td>
                                    <td style="text-align: left">1. বিজ্ঞান<br>
                                        2. মানবিক<br>
                                        3. বিজনেস স্টাডিজ<br>
                                        <a style="text-align: center" href="{{route('courses.index')}}">বিস্তারিত</a>
                                    </td>
                                    <td style="text-align: left">1. এসএসসি (বিজ্ঞান)<br>
                                        2. এসএসসি (মানবিক)<br>
                                        3. এসএসসি (বিজনেস স্টাডিজ)<br>
                                        <a style="text-align: center" href="{{route('department.index')}}">বিস্তারিত</a>
                                    </td>
                                    <td>আমাদের সম্মানিত শিক্ষকদের সম্পর্কে জানতে, নীচে এখানে ক্লিক করুন
                                        <a style="text-align: center" href="{{route('teacherInfo.index')}}">বিস্তারিত</a>
                                    </td>
                                    <td>আমাদের সম্মানিত কর্মীদের সম্পর্কে জানতে, নীচে এখানে ক্লিক করুন
                                        <a style="text-align: center" href="{{route('employeeInfo.index')}}">বিস্তারিত</a>
                                    </td>
                                    <td>আমাদের শিক্ষার্থীরা বিতর্ক, খেলাধুলা, সাংস্কৃতিক মত বিভিন্ন কর্মকান্ডে গতিশীল
                                        প্রোগ্রাম, গণিত অলিম্পিক, বিজ্ঞান মেলা, বিএনসিসি ইত্যাদি
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="container">
        <div class="row">
            <div class="card-header py-6" style="background:#E7D4B5">
                <h4 class="m-0 font-weight-bold text-center" style="font-size:20px;font-weight:bold;">কার্যক্রম</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 border" style="background:#E7D4B5">
                <h6 class="text-success font-weight-bold" align="center">সাম্প্রতিক কার্যক্রম</h6>
            </div>
            <div class="col-md-6 border" style="background:#E7D4B5">
                <h6 class="text-success font-weight-bold" align="center">সহ - পাঠক্রম সংক্রান্ত কার্যক্রম</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    {{--<div class="col-md-6 border" style="background:#A0937D;color:white">--}}
                    <div class="col-md-6 border carousel-wrap">
                        <div class="owl-carousel">
                            @foreach($banner_images2 as $banner_image2)
                                <div class="item">
                                    <img src="{{ \TCG\Voyager\Facades\Voyager::image($banner_image2->banner_image)}}"
                                         alt=""/>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <p align="center">সাম্প্রতিক ছবিসমূহ</p>
                    {{--</div>--}}
                    <div class="col-md-6 border"
                         style="inline-size: auto" {{-- style="background:#A0937D;color:white"--}}>
                        {{--<div class="carousel-wrap">--}}

                        @foreach($videos as $video)
                            <?php $file = (json_decode($video->video_name))[0]->download_link; ?>
                            <video width="180" height="150" controls>
                                <source src="{{ Voyager::image( $file ) }}" type="video/mp4">
                            </video>
                            {{--<div class="item">--}}
                            {{--<video width="320" height="240" controls>
                                <source src="{{ asset("storage/$video->video_name") }}" type="video/mp4">
                            </video>--}}
                            {{--</div>--}}
                        @endforeach
                        <p align="center">সাম্প্রতিক ভিডিও</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="background:#A0937D;color:white">
                <div class="row border" style="height: 300px">
                    <div class="col-md-4" align="center">
                        <br>
                        <a href="http://www.scouts.gov.bd/">
                            <img src="{{asset('frontend/assets')}}/images/scout.png" target="_blank" alt="..."
                                 class="rounded-circle" width="170"></a>
                        <br><br>
                    </div>
                    <div class="col-md-4" align="center">
                        <br>
                        <a href="https://bdrcs.org/">
                            <img src="{{asset('frontend/assets')}}/images/red-cresent.png" target="_blank" alt="..."
                                 class="rounded-circle" width="170"></a>
                        <br><br>
                    </div>
                    <div class="col-md-4" align="center">
                        <br>
                        <a href="http://bncc.teletalk.com.bd/admitcard/index.php">
                            <img src="{{asset('frontend/assets')}}/images/bncss.png" target="_blank" alt="..."
                                 class="rounded-circle" width="170"></a>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="container">
        <div class="row">
            <div class="card-header py-6" style="background:#E7D4B5">
                <h4 class="m-0 font-weight-bold text-center" style="font-size:20px;font-weight:bold">দ্রুত সেবা</h4>
            </div>
        </div>
        <div class="row" style="background:#A0937D;color:white">
            <div class="col-md-12">
                <div class="row border">
                    <div class="carousel-wrap">
                        <div class="owl-carousel">
                            <div class="item"><img src="{{asset('frontend/assets/uploads')}}/image/student%20info.jpg"
                                                   width="150" height="150"><br/><b>শিক্ষার্থী তথ্য</b></div>
                            <div class="item"><img src="{{asset('frontend/assets/uploads')}}/image/online_admission.png"
                                                   width="150" height="150"><br/><b>শিক্ষার্থী তথ্য</b></div>
                            <div class="item"><img src="{{asset('frontend/assets/uploads')}}/image/online_class.jpg"
                                                   width="150" height="150"><br/><b>অনলাইন ক্লাস ও পরীক্ষা</b></div>
                            <div class="item"><img src="{{asset('frontend/assets/uploads')}}/image/id_card.jpg"
                                                   width="150" height="150"><br/><b>স্টুডেন্ট আইডি কার্ড</b></div>
                            <div class="item"><img src="{{asset('frontend/assets/uploads')}}/image/result.jpg"
                                                   width="150" height="150"><br/><b>একাডেমিক ফলাফল</b></div>
                            <div class="item"><img src="{{asset('frontend/assets/uploads')}}/image/payment.jpg"
                                                   width="150" height="150"><br/><b>অনলাইন পেমেন্ট</b></div>
                            <div class="item"><img src="{{asset('frontend/assets/uploads')}}/image/event.jpg"
                                                   width="150" height="150"><br/><b>ইভেন্ট নিবন্ধন</b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
