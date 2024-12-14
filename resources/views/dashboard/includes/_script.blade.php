<!-- container-scroller -->
<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" ></script>
<!-- plugins:js -->
<script src="{{asset('dashboard/assets/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<script src="{{asset('dashboard/assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('dashboard/assets/js/off-canvas.js')}}"></script>
<script src="{{asset('dashboard/assets/js/hoverable-collapse.js')}}"></script>
<!-- endinject -->
<!-- Toastr -->
<script src="{{ asset('dashboard/assets/js/app.js') }}"></script>

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
