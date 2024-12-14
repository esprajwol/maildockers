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
                    <p class="h5 mb-2 text-center">Sign In</p>
                    <p class="mb-4 text-muted op-7 fw-normal text-center">{{localize('Sign in to continue')}} !</p>
                    {{--                    <div class="d-flex mb-3 justify-content-between gap-2 flex-wrap flex-lg-nowrap">--}}
                    {{--                        <button class="btn btn-lg btn-light-ghost border d-flex align-items-center justify-content-center flex-fill">--}}
                    {{--                                <span class="avatar avatar-xs flex-shrink-0">--}}
                    {{--                                    <img src="{{asset('dashboard/version1/')}}/assets/images/media/apps/google.png" alt="">--}}
                    {{--                                </span>--}}
                    {{--                            <span class="lh-1 ms-2 fs-13 text-default">Signup with Google</span>--}}
                    {{--                        </button>--}}
                    {{--                        <button class="btn btn-lg btn-light-ghost border d-flex align-items-center justify-content-center flex-fill">--}}
                    {{--                                <span class="avatar avatar-xs invert-1 flex-shrink-0">--}}
                    {{--                                    <img src="{{asset('dashboard/version1/')}}/assets/images/media/apps/apple.png" alt="">--}}
                    {{--                                </span>--}}
                    {{--                            <span class="lh-1 ms-2 fs-13 text-default">Signup with Apple</span>--}}
                    {{--                        </button>--}}
                    {{--                    </div>--}}
                    <div class="text-center my-3 authentication-barrier">
                        <span> ... </span>
                    </div>
                    @if (Session::has('error_message'))
                        <div class="alert alert-danger">{{Session::get('error_message')}}</div>
                    @endif
                    @if (isset($success))
                        <div class="alert alert-success">{{$success}}</div>
                    @endif
                    
                    <form class="pt-3" action="{{ route('login') }}" method="POST" id="login-form">
                        @csrf
                        <div class="row gy-3">
                            <div class="col-xl-12">
                                <label  for="signin-username" class="form-label text-default">User Name</label>
                                <input
                                    type="username"
                                    name="username"
                                    class="form-control form-control-lg @error('username') is-invalid @enderror"
                                    id="signin-username"
                                    placeholder="user name">
                                @error('username')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-xl-12 mb-2">
                                <label for="signin-password" class="form-label text-default d-block">Password
                                    {{--                                <a href="reset-password-basic.html" class="float-end text-danger">Forget password ?</a>--}}
                                </label>
                                <div class="position-relative">
                                    <input type="password"
                                           name="password"
                                           class="form-control form-control-lg @error('password') is-invalid @enderror"
                                           id="signin-password" placeholder="password">
                                    @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mt-2">
{{--                                    <div class="form-check">--}}
{{--                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">--}}
{{--                                        <label class="form-check-label text-muted fw-normal" for="defaultCheck1">--}}
{{--                                            Remember password ?--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary" id="submit-btn">Sign In</button>
                        </div>
                    </form>
                    {{--                    <div class="text-center">--}}
                    {{--                        <p class="text-muted mt-3 mb-0">Dont have an account? <a href="sign-up-basic.html" class="text-primary">Sign Up</a></p>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="btn-list text-center mt-3">--}}
                    {{--                        <button class="btn btn-icon btn-sm btn-wave authentication-social-btn">--}}
                    {{--                            <i class="ri-facebook-line fw-bold"></i>--}}
                    {{--                        </button>--}}
                    {{--                        <button class="btn btn-icon btn-sm btn-wave authentication-social-btn">--}}
                    {{--                            <i class="ri-twitter-x-line fw-bold"></i>--}}
                    {{--                        </button>--}}
                    {{--                        <button class="btn btn-icon btn-sm btn-wave authentication-social-btn">--}}
                    {{--                            <i class="ri-instagram-line fw-bold"></i>--}}
                    {{--                        </button>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="{{asset('dashboard/version1/')}}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Show Password JS -->
<script src="{{asset('dashboard/version1/')}}/assets/js/show-password.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('login-form');
        const submitButton = document.getElementById('submit-btn');

        form.addEventListener('submit', function() {
            submitButton.disabled = true;
        });

        @if ($errors->any())
        // If there are validation errors, re-enable the button
        submitButton.disabled = false;
        @endif
    });
</script>

</body>

</html>
