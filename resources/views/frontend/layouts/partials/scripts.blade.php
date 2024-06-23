<script src="{{asset('frontend/assets')}}/themes/yellow/js/jquery.min.js"></script>
<script src="{{asset('frontend/assets')}}/themes/yellow/js/bootstrap.min.js"></script>
<script src="{{asset('frontend/assets')}}/themes/yellow/js/ss-lightbox.js"></script>
<script src="{{asset('frontend/assets')}}/themes/yellow/js/custom.js"></script>
<script src="{{asset('frontend/assets')}}/themes/yellow/js/ticker.min9f1e.js?v=1.1.0"></script>
<script src="{{asset('frontend/assets')}}/themes/yellow/js/owl.carousel.min.js"></script>
<script>
    $( document ).ready(function() {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            navText: [
                "<i class='fa fa-caret-left'></i>",
                "<i class='fa fa-caret-right'></i>"
            ],
            autoplay: true,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    });
</script>
<script>
    $('.js-conveyor-3').jConveyorTicker({
        anim_duration:  200,
        reverse_elm: true
    });
</script>
<script>
        @if(Session::has('alerts'))
    let alerts = {!! json_encode(Session::get('alerts')) !!};
    helpers.displayAlerts(alerts, toastr);
    @endif

    @if(Session::has('message'))

    // TODO: change Controllers to use AlertsMessages trait... then remove this
    var alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};
    var alertMessage = {!! json_encode(Session::get('message')) !!};
    var alerter = toastr[alertType];

    if (alerter) {
        alerter(alertMessage);
    } else {
        toastr.error("toastr alert-type " + alertType + " is unknown");
    }
    @endif
</script>
