<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{config('app.name')}}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon"
          href="{{asset('logo/favicon.png')}}" />
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="{{ asset('dashboard/assets/images/logo.svg') }}">
                        </div>
                        <h4>{{localize('Sign Up Now')}}</h4>
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger">{{Session::get('error_message')}}</div>
                        @endif
                        <form class="pt-3" {{ route('register') }} method="POST">
                            @csrf
                            <div class="form-group has-validation">
                                <input type="text" name="first_name"
                                       class="form-control form-control-lg @error('first_name') is-invalid @enderror"
                                       placeholder="first name">
                                @error('first_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group has-validation">
                                <input type="text" name="middle_name"
                                       class="form-control form-control-lg @error('middle_name') is-invalid @enderror"
                                       placeholder="middle name">
                                @error('middle_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>


                            <div class="form-group has-validation">
                                <input type="text" name="last_name"
                                       class="form-control form-control-lg @error('last_name') is-invalid @enderror"
                                       placeholder="last name">
                                @error('last_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group has-validation">
                                <input type="text" name="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       placeholder="email">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group has-validation">
                                <input type="text" name="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       placeholder="password">
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group has-validation">
                                <input type="password" name="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       placeholder="Password">
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button
                                    class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn w-100"
                                    type="submit">{{localize('SIGN UP')}}</button>


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
    $(".alert").delay(5000).queue(function() {
        $(this).remove();
    });
</script>
<!-- endinject -->
</body>

</html>
