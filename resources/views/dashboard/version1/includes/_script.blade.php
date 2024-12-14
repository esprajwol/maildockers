<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Popper JS -->
<script src="{{asset('dashboard/version1/')}}/assets/libs/@popperjs/core/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="{{asset('dashboard/version1/')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Defaultmenu JS -->
<script src="{{asset('dashboard/version1/')}}/assets/js/defaultmenu.min.js"></script>

<!-- Node Waves JS-->
<script src="{{asset('dashboard/version1/')}}/assets/libs/node-waves/waves.min.js"></script>

<!-- Sticky JS -->
<script src="{{asset('dashboard/version1/')}}/assets/js/sticky.js"></script>

<!-- Simplebar JS -->
<script src="{{asset('dashboard/version1/')}}/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{asset('dashboard/version1/')}}/assets/js/simplebar.js"></script>

<!-- Color Picker JS -->
<script src="{{asset('dashboard/version1/')}}/assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>


<!-- Apex Charts JS -->
<script src="{{asset('dashboard/version1/')}}/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- JSVector Maps JS -->
<script src="{{asset('dashboard/version1/')}}/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>

<!-- JSVector Maps MapsJS -->
<script src="{{asset('dashboard/version1/')}}/assets/libs/jsvectormap/maps/world-merc.js"></script>

<!-- Dashboard -->
<script src="{{asset('dashboard/version1/')}}/assets/js/gaming-dashboard.js"></script>

<!-- Custom JS -->
<script src="{{asset('dashboard/version1/')}}/assets/js/custom.js"></script>


<!-- Custom-Switcher JS -->
<script src="{{asset('dashboard/version1/')}}/assets/js/custom-switcher.min.js"></script>

<script>



    /**
     * Notification Mark As Read
     * */
    $(".mark-as-read").click(function() {
        let id = $(this).data("id");
        let url = $(this).data("url");

        let callParams = {};
        callParams.method="POST";
        callParams.url=  url;
        callParams.data = {
            id: id,
            _token : "{{ csrf_token() }}"
        };

        ajaxCall(callParams, function (response) {
                console.log("Response Log: ", response);
                window.location.reload();
            },
            function (XHR, textStatus, errorThrown) {

            });
    })
</script>

@stack('extra-scripts')

@yield("js")
