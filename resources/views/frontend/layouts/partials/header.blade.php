<header>
<div class="container">
        <div class="row" >
            <div class="col-md-12 col-sm-12">
                <div class="header-top-left">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="logo-area">
                                <?php $admin_favicon = \TCG\Voyager\Facades\Voyager::setting('general-settings.clg_logo', ''); ?>
                                <a class="logo" href="{{route('home.index')}}"><img src="{{ \TCG\Voyager\Facades\Voyager::image($admin_favicon) }}" alt="" style="height: 140px"></a>
                            </div><!--./col-md-4-->
                            <div class="banner-area">
                                <h1 style="font-size: xxx-large; font-weight: 900">{{setting('general-settings.clg_name_bengali')}}</h1>
                                <h3 style="font-weight:bold; color: #f48000">{{setting('general-settings.clg_name')}}</h3>
                                <h6>{{setting('general-settings.clg_details')}}</h6>
                                <h5 style="font-weight:bold">{{setting('general-settings.clg_address')}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-top-right">
                    <div class="bg-border">
                        <ul class="social top-social">
                            <li><a href="{{setting('general-settings.fb_link')}}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{setting('general-settings.tw_link')}}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{setting('general-settings.gl_link')}}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="{{setting('general-settings.yt_link')}}" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                    <div class="" style="float:right!important">
                        <div class="contact">
                            <P><i class="fa fa-phone i-plain" style="font-size:16px;margin:0!important"></i><span>{{setting('general-settings.clg_number')}}</span></P>
                            <P><i class="fa fa-envelope-o i-plain" style="font-size:16px;margin:0!important"></i><a href="mailto:ppajcdc@gmail.com">{{setting('general-settings.clg_email')}}</a></P>
                        </div>
                        <ul class="top-right">
                            <li><a href="{{route('userLogin')}}"><i class="fa fa-user"></i>লগইন</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!--./row-->
    </div><!--./container-->
</header>
