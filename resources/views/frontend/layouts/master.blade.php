<!DOCTYPE html>
<html dir="ltr" lang="en">

<!-- Mirrored from kajcc.edu.bd/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Feb 2023 03:49:17 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ডোরস বিদ্যালয়</title>
    <meta name="title" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('frontend.layouts.partials.style')
    <style>
        .req {
            color: #ff1210;
        }
        .bold{
            color: #020402;
        }
        .txt-black{
            color: #134013;
        }

    </style>
    <style>
        @media screen and (min-width: 1200px){
            .container {
                width: 1200px !important;
            }
        }
    </style>
    @yield('css')
</head>
<body>

@include('frontend.layouts.partials.header')

@include('frontend.layouts.partials.header_menu')

<link rel="stylesheet" href="{{asset('frontend/assets')}}/themes/yellow/css/owl.carousel.min.css">

@yield('content')

@include('frontend.layouts.partials.custom_style')

<div class="container spacet50 spaceb50">
    <div class="row">
        <div class="col-md-12">
            <p><span style="color:#FFFFFF;"><span style="background-color:#FFFFFF;">t</span></span></p>
        </div>



    </div><!--./row-->
</div><!--./container-->

@include('frontend.layouts.partials.footer')
@include('frontend.layouts.partials.scripts')
@yield('javascript')

</body>

<!-- Mirrored from kajcc.edu.bd/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Feb 2023 04:07:27 GMT -->
</html>

