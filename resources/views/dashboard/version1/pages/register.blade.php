<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="dark" data-toggled="close"
      data-vertical-style="default" data-card-style="style1" data-card-background="background1">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> LegalPDF</title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
          content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- Favicon -->
    <link rel="icon" href="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="{{asset('dashboard/version1/')}}/assets/js/authentication-main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{asset('dashboard/version1/')}}/assets/libs/bootstrap/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Style Css -->
    <link href="{{asset('dashboard/version1/')}}/assets/css/styles.css" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{asset('dashboard/version1/')}}/assets/css/icons.css" rel="stylesheet">

<style>
option:not(first-child) {
    color: #000;
}
</style>
</head>

<body class="authentication-background">

<div class="container">
    <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
        <div class="col-xxl-5 col-xl-5 col-md-6 col-sm-8 col-12">
            <div class="card custom-card my-4">
                <div class="top-left"></div>
                <div class="top-right"></div>
                <div class="bottom-left"></div>
                <div class="bottom-right"></div>
                <div class="card-body p-5">
                    <div class="mb-3 d-flex justify-content-center">
                        <a href="{{url('/')}}">
                            <img src="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" alt="logo"
                                 class="desktop-logo">
                            <img src="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" alt="logo"
                                 class="desktop-dark">
                        </a>
                    </div>
                        <p class="h5 mb-2 text-center">{{localize('Sign Up Now')}}</p>
                        <div class="text-center my-3 authentication-barrier">
                            <span> ... </span>
                        </div>
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger">{{Session::get('error_message')}}</div>
                        @endif
                        <form class="pt-3" {{ route('register') }} method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group has-validation">
                                <select class="form-control form-control-lg @error('user_type') is-invalid @enderror" name="user_type" id="user_type">
                                    <option value="">-- Select User Type --</option>
                                    <option value="client" @if(old("user_type") == "client") {{'selected="selected"'}} @endif>Client/Lawyer</option>
                                    <option value="individual" @if(old("user_type") == "individual") {{'selected="selected"'}} @endif>Individual</option>
                                </select>
                                @error('user_type')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <h4 class="mb-2 mt-2 text-left">Personal details:</h4>
                            <div class="form-group has-validation">
                                <input type="text" name="full_name"
                                       class="form-control form-control-lg @error('full_name') is-invalid @enderror" placeholder="Full name" value="{{old('full_name')}}">
                                @error('full_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group has-validation">
                                <input type="text" name="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="email" value="{{old('email')}}">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group has-validation">
                                <input type="text" name="username" class="form-control form-control-lg @error('username') is-invalid @enderror" placeholder="Username" value="{{old('username')}}">
                                @error('username')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group has-validation">
                                <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="password">
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group has-validation">
                                <input type="password" name="cpassword" class="form-control form-control-lg @error('cpassword') is-invalid @enderror" placeholder="Confirm Password">
                                @error('cpassword')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group has-validation">
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" placeholder="Upload .png,.jpg,.jpeg,.webp" value="" accept=".png,.jpg,.jpeg,.webp">
                                @error('photo')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        <div id="lawyer_div" @if(old("user_type") != "client" || empty(old("user_type"))) <?php echo 'style="display: none"';?> @endif>
                            <h4 class="mb-2 mt-2 text-left">Payment Details:</h4>
                            <div class="form-group has-validation">
                                <input type="text" name="card_number" class="form-control form-control-lg @error('card_number') is-invalid @enderror" placeholder="Card Number" value="{{old('card_number')}}">
                                @error('card_number')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group has-validation">
                                <input type="text" name="card_holder_name" class="form-control form-control-lg @error('card_holder_name') is-invalid @enderror" placeholder="Card Holder Name" value="{{old('card_holder_name')}}">
                                @error('card_holder_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="row">
                              <div class="col-md-6" style="padding-right:0;">
                                <div class="form-group has-validation">
                                    <input type="text" name="card_exipre" class="form-control form-control-lg @error('card_exipre') is-invalid @enderror"
                                       placeholder="Card expire mm/yy" value="{{old('card_exipre')}}">
                                    @error('card_exipre')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                              </div>
                              <div class="col-md-6" style="padding-left:0;">
                                <div class="form-group has-validation">
                                    <input type="text" name="card_cvv" class="form-control form-control-lg @error('card_cvv') is-invalid @enderror" placeholder="Card CVV" value="{{old('card_cvv')}}">
                                    @error('card_cvv')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                              </div>
                            </div>

                            <h4 class="mb-2 mt-2 text-left">Business Details:</h4>
                            <div class="form-group has-validation">
                                <input type="text" name="business_name" class="form-control form-control-lg @error('business_name') is-invalid @enderror" placeholder="Business Name" value="{{old('business_name')}}">
                                @error('business_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group has-validation">
                                <input type="text" name="business_address" class="form-control form-control-lg @error('business_address') is-invalid @enderror" placeholder="Business Address" value="{{old('business_address')}}">
                                @error('business_address')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group has-validation">
                                <input type="text" name="vat_no" class="form-control form-control-lg @error('vat_no') is-invalid @enderror" placeholder="Business VAT No" value="{{old('vat_no')}}">
                                @error('vat_no')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group has-validation">
                                <input type="file" class="form-control @error('attachment') is-invalid @enderror" id="attachment" name="attachment" placeholder="Upload .png,.jpg,.jpeg file">
                                @error('attachment')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                            <div class="d-grid mt-4">
                                <button class="btn btn-primary" id="submit-btn" type="submit">{{localize('SIGN UP')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ asset('dashboard/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('dashboard/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/misc.js') }}"></script>
<script>
    $("#user_type").on("change", function(){
        var value = $(this).val();
        if(value == "client"){
            $("#lawyer_div").show();
        }else{
            $("#lawyer_div").hide();
        }
    });
    $(".alert").delay(5000).queue(function() {
        $(this).remove();
    });
</script>
<!-- endinject -->
</body>

</html>
