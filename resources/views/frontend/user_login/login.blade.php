{{--@extends('frontend.layouts.master')
@section('content')
    <body>
    <!-- Top content -->
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-sm-5  form-box">
                        <div class="loginbg">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <img src="{{asset('frontend/assets')}}/backend/images/s_logo.png" class="logowidth">

                                </div>
                                <div class="form-top-right"> <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <h3 class="font-white">Student Login</h3>
                                <form action="{{ route('voyager.login') }}" method="POST" name="loginForm" onsubmit="return validateForm()">
                                    {{ csrf_field() }}
                                    <div class="form-group form-group-default" id="emailGroup">
                                        <label>{{ __('voyager::generic.email') }}</label>
                                        <div class="controls">
                                            <input type="text" name="email" id="email" value="{{ old('email') }}"
                                                   placeholder="{{ __('voyager::generic.email') }}" class="form-control" required>
                                        </div>
                                        <span class="text-danger">{{$errors->first('email')}}</span>

                                    </div>

                                    <div class="form-group form-group-default" id="passwordGroup">
                                        <label>{{ __('voyager::generic.password') }}</label>
                                        <div class="controls">
                                            <input type="password" name="password" placeholder="{{ __('voyager::generic.password') }}"
                                                   class="form-control" required>
                                            <span class="text-danger">{{$errors->first('password')}}</span>
                                        </div>
                                    </div>
                                    <p class="pull-right"><a href="{{route('voyager.password.request')}}">{{  __('voyager::auth.forgotten_password?') }}</a></p>

                                    <div class="form-group" id="rememberMeGroup">
                                        <div class="controls">
                                            <input type="checkbox" name="remember" id="remember" value="1"><label for="remember" class="remember-me-text">{{ __('voyager::generic.remember_me') }}</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-block login-button" value="Submit">
                                        <span class="signingin hidden"><span class="voyager-refresh"></span> {{ __('voyager::login.loggingin') }}...</span>
                                        <span class="signin">{{ __('voyager::generic.login') }}</span>
                                    </button>

                                </form>
                                <div style="clear:both"></div>

                                @if(!$errors->isEmpty())
                                    <div class="alert alert-red">
                                        <ul class="list-unstyled">
                                            @foreach($errors->all() as $err)
                                                <li>{{ $err }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                --}}{{--<p><a href="ufpassword.html" class="forgot"> <i class="fa fa-key"></i> Forgot Password</a> </p>--}}{{--
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-1"><div class="separatline"></div></div>
                    <div class="col-lg-6 col-sm-6 col-sm-6">
                        <div class="loginright form-box  mCustomScrollbar">
                            <div class="messages">
                                <h3>What's new in Karnaphuli Abdul Jalil  Chowdhury College</h3>
                                <h4>এইচএসসি ২য় বর্ষের প্রাক-নির্বাচনী পরীক্ষার ফি পরিশোধ সম্পর্কিত বিজ্ঞপ্তি।</h4>

                                <p></p>                        <div class="logdivider"></div>
                                <h4>এইচএসসি(সাধারন ও বিএমটি) ২য় বর্ষ প্রাক-নির্বাচনী পরীক্ষার রুটিন।</h4>

                                <p></p>                        <div class="logdivider"></div>
                                <h4>এইচএসসি(সাধারন ও বিএমটি) ২০২২ এর বোর্ড পরীক্ষার ফলাফল প্রকাশিত।</h4>

                                <p></p>                        <div class="logdivider"></div>
                                <h4>২০২২-২৩ শিক্ষাবর্ষে এইচএসসি একাদশ শ্রেণির উপবৃত্তি সংক্রান্ত বিজ্ঞপ্তি।</h4>

                                <p>(১) বিজ্ঞপ্তি ও নিয়মাবলী -

                                    HSP KAJCC NOTICE 23... <a class=more href="{{asset('frontend/assets')}}/read/%e0%a7%a8%e0%a7%a6%e0%a7%a8%e0%a7%a8-%e0%a7%a8%e0%a7%a9-%e0%a6%b6%e0%a6%95%e0%a6%b7%e0%a6%ac%e0%a6%b0%e0%a6%b7-%e0%a6%8f%e0%a6%87%e0%a6%9a%e0%a6%8f%e0%a6%b8%e0%a6%b8-%e0%a6%8f%e0%a6%95%e0%a6%a6%e0%a6%b6-%e0%a6%b6%e0%a6%b0%e0%a6%a3%e0%a6%b0-%e0%a6%89%e0%a6%aa%e0%a6%ac%e0%a6%a4%e0%a6%a4-%e0%a6%b8%e0%a6%95%e0%a6%b0%e0%a6%a8%e0%a6%a4-%e0%a6%ac%e0%a6%9c%e0%a6%9e%e0%a6%aa%e0%a6%a4.html">Read More</a></p>                        <div class="logdivider"></div>
                                <h4>০২১-২০২২ শিক্ষাবর্ষে  ১ম বর্ষ স্নাতক (পাস) ভর্তি কার্যক্রমে ২য় রিলিজ স্লিপে অনলাইন আবেদন সংক্রান্ত বিজ্ঞপ্তি</h4>

                                <p></p>                        <div class="logdivider"></div>




                            </div>
                        </div>
                        <!-- <img src="http://kajcc.edu.bd/backend/usertemplate/assets/img/backgrounds/bg3.jpg" class="img-responsive" style="border-radius:4px;" /> -->
                    </div><!--./col-lg-6-->

                    <!-- <div class="col-md-6 col-sm-12 discover">
                        <img src="backend/usertemplate/assets/img/backgrounds/discover.png">
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('frontend/assets')}}/backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
    <script src="{{asset('frontend/assets')}}/backend/usertemplate/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{asset('frontend/assets')}}/backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
    <script src="{{asset('frontend/assets')}}/backend/usertemplate/assets/js/jquery.mCustomScrollbar.min.js"></script>
    <script src="{{asset('frontend/assets')}}/backend/usertemplate/assets/js/jquery.mousewheel.min.js"></script>
    <script>
        var btn = document.querySelector('button[type="submit"]');
        var form = document.forms[0];
        var email = document.querySelector('[name="email"]');
        var password = document.querySelector('[name="password"]');
        btn.addEventListener('click', function(ev){
            var x = document.forms["loginForm"]["email"].value;
            var y = document.forms["loginForm"]["password"].value;

            if (x == "") {
                //alert('hi');
                //alert("Email must be filled out");
                return false;
            }
            if (y == "") {
                //alert('hi');
                //alert("Email must be filled out");
                return false;
            }
            if (form.checkValidity()) {
                btn.querySelector('.signingin').className = 'signingin';
                btn.querySelector('.signin').className = 'signin hidden';
            } else {
                ev.preventDefault();
            }
        });
        email.focus();
        document.getElementById('emailGroup').classList.add("focused");

        // Focus events for email and password fields
        email.addEventListener('focusin', function(e){
            document.getElementById('emailGroup').classList.add("focused");
        });
        email.addEventListener('focusout', function(e){
            document.getElementById('emailGroup').classList.remove("focused");
        });

        password.addEventListener('focusin', function(e){
            document.getElementById('passwordGroup').classList.add("focused");
        });
        password.addEventListener('focusout', function(e){
            document.getElementById('passwordGroup').classList.remove("focused");
        });

    </script>
    </body>
@stop--}}
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from kajcc.edu.bd/site/userlogin by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Feb 2023 04:10:19 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#424242" />
    <title>{{Voyager::setting('general-settings.clg_name_bengali')}}</title>
    <link rel="shortcut icon" href="{{asset('frontend/assets')}}/uploads/school_content/logo/dddd.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="{{asset('frontend/assets')}}/backend/usertemplate/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('frontend/assets')}}/backend/usertemplate/assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('frontend/assets')}}/backend/usertemplate/assets/css/form-elements.css">
    <link rel="stylesheet" href="{{asset('frontend/assets')}}/backend/usertemplate/assets/css/style.css">
    <link rel="stylesheet" href="{{asset('frontend/assets')}}/backend/usertemplate/assets/css/jquery.mCustomScrollbar.min.css">
    <style type="text/css">
        .width100, .width50{font-size: 12px !important;}
        .discover{margin-top: -90px;position: relative;z-index: -1;}
        /*.form-bottom {box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.35);}*/
        .gradient{margin-top: 40px;text-align: right;padding: 10px;background: rgb(72,72,72);
            background: -moz-linear-gradient(left, rgba(72,72,72,1) 1%, rgba(73,73,73,1) 44%, rgba(73,73,73,1) 100%);
            background-image: linear-gradient(to right, rgba(72, 72, 72, 0.23) 1%, rgba(37, 37, 37, 0.64) 44%, rgba(73, 73, 73, 0) 100%);
            background-position-x: initial;
            background-position-y: initial;
            background-size: initial;
            background-repeat-x: initial;
            background-repeat-y: initial;
            background-attachment: initial;
            background-origin: initial;
            background-clip: initial;
            background-color: initial;
            background: -webkit-linear-gradient(left, rgba(72,72,72,1) 1%,rgb(73, 73, 73) 44%,rgba(73,73,73,1) 100%);
            background: linear-gradient(to right, rgba(72, 72, 72, 0.02) 1%,rgba(37, 37, 37, 0.67) 30%,rgba(73, 73, 73, 0) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#484848', endColorstr='#494949',GradientType=1 );}
        @media (min-width: 320px) and (max-width: 991px){
            .width100{width: 100% !important;display: block !important;
                float: left !important; margin-bottom: 5px !important;
                border-radius: 2px !important;}
            .width50{width: 50% !important;
                margin-bottom: 5px !important;
                display: block !important;
                border-radius:2px 0px 0px 2px !important;
                float: left !important;
                margin-left: 0px !important; }
            .widthright50{width: 50% !important;
                display: block !important;
                margin-bottom: 5px !important;
                border-radius: 0px 2px 2px 0px !important;
                float: left !important;margin-left: 0px !important;} }
        input[type="text"], input[type="password"], textarea, textarea.form-control {
            height: 40px;border: 1px solid #999;}

        input[type="text"]:focus, input[type="password"]:focus, textarea:focus, textarea.form-control:focus {border: 1px solid #424242;}

        button.btn {height: 40px;line-height: 40px;}

        @media(max-width:767px){
            .discover{margin-top: 10px}
            .gradient {text-align: center;}
            .logowidth{padding-right:0px;}
        }
        @media(min-width:768px) and (max-width:992px){
            .discover{margin-top: 10px}
            .logowidth{padding-right:0px;}
            .gradient {text-align: center;}
        }

        /*.backstretch{position: relative;}
        .backstretch:after {
            position: absolute;
            z-index: 2;
            width: 100%;
            height: 100%;
            display: block;
            left: 0;
            top: 0;
            content: "";
            background-color: rgba(0, 0, 0, 0.16);
        }*/
        .col-md-offset-3 { margin-left: 29%;}

        .loginbg {
            background: rgba(0, 0, 0, 0.81);
            max-height: 390px;
            box-shadow: 0px 7px 12px rgba(0, 0, 0, 0.29);
            border-radius: 4px;
        }
        .loginright {
            text-align: left;
            color: #fff;
            max-height: 385px;
            /* padding-right: 20px; */
            overflow: auto;
            position: relative;
            width: 100%;
            max-width: 100%;
            height: 385px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .logdivider {
            background: rgba(255, 253, 253, 0.7);
            clear: both;
            width: 100%;
            height: 1px;
            margin: 15px 0 15px;
        }

        .separatline {
            margin-left: 30px;
            width: 1px;
            height: 450px;
            background: rgba(255, 253, 253, 0.7);
        }
        .loginright h3 {
            font-size: 22px;
            color: #eae8e8;
            margin-top: 10px;
            line-height: normal;
            font-weight: 500;
            padding-bottom: 10px;
        }
        .col-md-offset-3 { margin-left: 29%;}
        @media (max-width: 767px) {
            .separatline {
                margin-left: 0;
                width: 100%;
                height: 2px;
                margin: 35px auto 0px auto;
            }
            .col-md-offset-3 {margin-left: 0;}
        }
    </style>
</head>

<body>
<!-- Top content -->
<div class="top-content">
    <div class="inner-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-5  form-box">
                    <div class="loginbg">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3 style="color: gainsboro; font-weight: 600;">{{Voyager::setting('general-settings.clg_name_bengali')}}</h3>
                            </div>
                            <div class="form-top-right">
                                <i class="fa fa-key"></i>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <h3 class="font-white">Student Login
                                @if(Session::has('message'))
                                    <h9 class="alert alert-danger">
                                        {{ Session::get('message') }}
                                    </h9>
                                @endif
                            </h3>
                            <form action="{{ route('userLogged') }}" method="POST" name="loginForm" onsubmit="return validateForm()">
                                {{ csrf_field() }}
                                {{--<div class="form-group">
                                    <label class="sr-only" for="form-username">
                                        Username</label>
                                    <input type="text" name="username" placeholder="Username" class="form-username form-control" id="email"> <span class="text-danger"></span>
                                </div>--}}
                                <div class="form-group form-group-default" id="emailGroup">
                                    <label>{{ __('voyager::generic.email') }}</label>
                                    <div class="controls">
                                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                                               placeholder="{{ __('voyager::generic.email') }}" class="form-control" required>
                                    </div>
                                    <span class="text-danger">{{$errors->first('username')}}</span>

                                </div>
                                {{--<div class="form-group">
                                    <input type="password" name="password" placeholder="Password" class="form-password form-control" id="password"> <span class="text-danger"></span>
                                </div>--}}
                                <div class="form-group form-group-default" id="passwordGroup">
                                    <label>{{ __('voyager::generic.password') }}</label>
                                    <div class="controls">
                                        <input type="password" name="password" placeholder="{{ __('voyager::generic.password') }}"
                                               class="form-control" required>
                                        <span class="text-danger">{{$errors->first('password')}}</span>
                                    </div>
                                </div>
                                {{--<button type="submit" class="btn">
                                    Sign In</button>--}}
                                <button type="submit" class="btn btn-block login-button" value="Submit">
                                    <span class="signingin hidden"><span class="voyager-refresh"></span> {{ __('voyager::login.loggingin') }}...</span>
                                    <span class="signin">{{ __('voyager::generic.login') }}</span>
                                </button>
                            </form>
                            <p><a href="{{route('voyager.password.request')}}" class="forgot"> <i class="fa fa-key"></i> Forgot Password</a> </p>
                           {{-- @if(!$errors->isEmpty())
                                <div class="alert alert-red">
                                    <ul class="list-unstyled">
                                        @foreach($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 col-sm-1"><div class="separatline"></div></div>
                <div class="col-lg-6 col-sm-6 col-sm-6">
                    <div class="loginright form-box  mCustomScrollbar">
                        <div class="messages">
                            <h3> What's new in {{Voyager::setting('general-settings.clg_name')}}</h3>
                            @foreach($news as $new)
                            <h4>{{$new->news_title}}</h4>

                            <p></p>
                             <div class="logdivider"></div>
                            @endforeach
                            {{--<h4>এইচএসসি(সাধারন ও বিএমটি) ২য় বর্ষ প্রাক-নির্বাচনী পরীক্ষার রুটিন।</h4>

                            <p></p>                        <div class="logdivider"></div>
                            <h4>এইচএসসি(সাধারন ও বিএমটি) ২০২২ এর বোর্ড পরীক্ষার ফলাফল প্রকাশিত।</h4>

                            <p></p>                        <div class="logdivider"></div>
                            <h4>২০২২-২৩ শিক্ষাবর্ষে এইচএসসি একাদশ শ্রেণির উপবৃত্তি সংক্রান্ত বিজ্ঞপ্তি।</h4>

                            <p>(১) বিজ্ঞপ্তি ও নিয়মাবলী -

                                HSP KAJCC NOTICE 23... <a class=more href="{{asset('frontend/assets')}}/read/%e0%a7%a8%e0%a7%a6%e0%a7%a8%e0%a7%a8-%e0%a7%a8%e0%a7%a9-%e0%a6%b6%e0%a6%95%e0%a6%b7%e0%a6%ac%e0%a6%b0%e0%a6%b7-%e0%a6%8f%e0%a6%87%e0%a6%9a%e0%a6%8f%e0%a6%b8%e0%a6%b8-%e0%a6%8f%e0%a6%95%e0%a6%a6%e0%a6%b6-%e0%a6%b6%e0%a6%b0%e0%a6%a3%e0%a6%b0-%e0%a6%89%e0%a6%aa%e0%a6%ac%e0%a6%a4%e0%a6%a4-%e0%a6%b8%e0%a6%95%e0%a6%b0%e0%a6%a8%e0%a6%a4-%e0%a6%ac%e0%a6%9c%e0%a6%9e%e0%a6%aa%e0%a6%a4.html">Read More</a></p>                        <div class="logdivider"></div>
                            <h4>০২১-২০২২ শিক্ষাবর্ষে  ১ম বর্ষ স্নাতক (পাস) ভর্তি কার্যক্রমে ২য় রিলিজ স্লিপে অনলাইন আবেদন সংক্রান্ত বিজ্ঞপ্তি</h4>

                            <p></p>                        <div class="logdivider"></div>

--}}


                        </div>
                    </div>
                    {{--<img src="{{asset('frontend/assets')}}/backend/usertemplate/assets/img/backgrounds/bg3.jpg" class="img-responsive" style="border-radius:4px;"/>--}}
                </div><!--./col-lg-6-->

                <!-- <div class="col-md-6 col-sm-12 discover">
                    <img src="backend/usertemplate/assets/img/backgrounds/discover.png">
                </div> -->
            </div>
        </div>
    </div>
</div>
<script src="{{asset('frontend/assets')}}/backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
<script src="{{asset('frontend/assets')}}/backend/usertemplate/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="{{asset('frontend/assets')}}/backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
<script src="{{asset('frontend/assets')}}/backend/usertemplate/assets/js/jquery.mCustomScrollbar.min.js"></script>
<script src="{{asset('frontend/assets')}}/backend/usertemplate/assets/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        var base_url = '{{asset('frontend/assets')}}/';
        $.backstretch([
            base_url + "backend/usertemplate/assets/img/backgrounds/user15.jpg"
        ], {duration: 3000, fade: 750});
        $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function () {
            $(this).removeClass('input-error');
        });
        $('.login-form').on('submit', function (e) {
            $(this).find('input[type="text"], input[type="password"], textarea').each(function () {
                if ($(this).val() == "") {
                    e.preventDefault();
                    $(this).addClass('input-error');
                } else {
                    $(this).removeClass('input-error');
                }
            });
        });
    });
</script>
<script>
    var btn = document.querySelector('button[type="submit"]');
    var form = document.forms[0];
    var email = document.querySelector('[name="name"]');
    var password = document.querySelector('[name="password"]');
    btn.addEventListener('click', function(ev){
        var x = document.forms["loginForm"]["name"].value;
        var y = document.forms["loginForm"]["password"].value;

        if (x == "") {
            //alert('hi');
            //alert("Email must be filled out");
            return false;
        }
        if (y == "") {
            //alert('hi');
            //alert("Email must be filled out");
            return false;
        }
        if (form.checkValidity()) {
            btn.querySelector('.signingin').className = 'signingin';
            btn.querySelector('.signin').className = 'signin hidden';
        } else {
            ev.preventDefault();
        }
    });
    email.focus();
    document.getElementById('emailGroup').classList.add("focused");

    // Focus events for email and password fields
    email.addEventListener('focusin', function(e){
        document.getElementById('emailGroup').classList.add("focused");
    });
    email.addEventListener('focusout', function(e){
        document.getElementById('emailGroup').classList.remove("focused");
    });

    password.addEventListener('focusin', function(e){
        document.getElementById('passwordGroup').classList.add("focused");
    });
    password.addEventListener('focusout', function(e){
        document.getElementById('passwordGroup').classList.remove("focused");
    });

</script>
<div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 297px; width: 1349px; z-index: -999999; position: fixed;">
    <img src="{{asset('frontend/assets')}}/backend/usertemplate/assets/img/backgrounds/user15.jpg" style="position: absolute; margin: 0px; padding: 0px; border: none; width: 1349px; height: 1124.17px; max-height: none; max-width: none; z-index: -999999; left: 0px; top: -413.583px;"></div>
</body>

<!-- Mirrored from kajcc.edu.bd/site/userlogin by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Feb 2023 04:12:17 GMT -->
</html>

