<header class="app-header sticky">
    <?php $user = \Illuminate\Support\Facades\Auth::user(); ?>
    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="#" class="header-logo">
                        <img src="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" alt="logo" class="desktop-logo">
                        <img src="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" alt="logo" class="toggle-logo">
                        <img src="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" alt="logo" class="desktop-dark">
                        <img src="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" alt="logo" class="toggle-dark">
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element mx-lg-0 mx-2">
                <a aria-label="Hide Sidebar" class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle" data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <ul class="header-content-right">

{{--            <!-- Start::header-element -->--}}
{{--            <li class="header-element header-search d-md-block d-none">--}}
{{--                <!-- Start::header-link -->--}}
{{--                <input type="text" class="header-search-bar form-control border-0" placeholder="Search for Results...">--}}
{{--                <a href="javascript:void(0);" class="header-search-icon border-0">--}}
{{--                    <i class="bi bi-search"></i>--}}
{{--                </a>--}}
{{--                <!-- End::header-link -->--}}
{{--            </li>--}}
{{--            <!-- End::header-element -->--}}

{{--            <!-- Start::header-element -->--}}
{{--            <li class="header-element d-md-none d-block">--}}
{{--                <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal" data-bs-target="#header-responsive-search">--}}
{{--                    <!-- Start::header-link-icon -->--}}
{{--                    <i class="bi bi-search header-link-icon"></i>--}}
{{--                    <!-- End::header-link-icon -->--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <!-- End::header-element -->--}}

            <!-- Start::header-element -->
{{--            <li class="header-element country-selector dropdown">--}}
{{--                <!-- Start::header-link|dropdown-toggle -->--}}
{{--                <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown">--}}
{{--                    <img src="{{asset('dashboard/version1/')}}/assets/images/flags/us_flag.jpg" alt="img" class="header-link-icon">--}}
{{--                </a>--}}
{{--                <!-- End::header-link|dropdown-toggle -->--}}
{{--                <ul class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">--}}
{{--                    <li>--}}
{{--                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">--}}
{{--                            <span class="avatar avatar-xs lh-1 me-2">--}}
{{--                                <img src="{{asset('dashboard/version1/')}}/assets/images/flags/us_flag.jpg" alt="img">--}}
{{--                            </span>--}}
{{--                            English--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">--}}
{{--                            <span class="avatar avatar-xs lh-1 me-2">--}}
{{--                                <img src="{{asset('dashboard/version1/')}}/assets/images/flags/spain_flag.jpg" alt="img" >--}}
{{--                            </span>--}}
{{--                            Hebru--}}
{{--                        </a>--}}
{{--                    </li>--}}

{{--                </ul>--}}
{{--            </li>--}}
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <li class="header-element header-fullscreen">
                <!-- Start::header-link -->
                <a onclick="openFullscreen();" href="javascript:void(0);" class="header-link">
                    <i class="bi bi-fullscreen full-screen-open header-link-icon"></i>
                    <i class="bi bi-fullscreen-exit full-screen-close header-link-icon d-none"></i>
                </a>
                <!-- End::header-link -->
            </li>
            <!-- End::header-element -->

            <!-- Start::header-element -->
{{--            <li class="header-element">--}}
{{--                <!-- Start::header-link|dropdown-toggle -->--}}
{{--                <a href="javascript:void(0);" class="header-link" data-bs-toggle="offcanvas" data-bs-target="#apps-header-offcanvas">--}}
{{--                    <i class="bi bi-grid header-link-icon"></i>--}}
{{--                </a>--}}
{{--                <!-- End::main-header-dropdown -->--}}
{{--            </li>--}}
            <!-- End::header-element -->


            <!-- Start::header-element -->
            <li class="header-element dropdown">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div>
                            <img src="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" alt="img" class="avatar avatar-sm rounded-0">
                        </div>
                    </div>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                    <li><a class="dropdown-item d-flex align-items-center"
                           href="@if($user->user_type == 'admin') 
                           {{route('admin.user.admin.profile')}} 
                           @elseif($user->user_type == 'partner') 
                           {{route('partner.user.partner.profile')}} 
                           @elseif($user->user_type == 'distributor') 
                           {{route('distributor.user.distributor.profile')}} 
                           @elseif($user->user_type == 'client')
                           {{route('admin.user.admin.profile')}} 
                           @elseif($user->user_type == 'individual')
                           {{route('admin.user.admin.profile')}} 
                           @endif"
                        ><i class="bi bi-person fs-18 me-2 op-7"></i>Profile</a></li>

                    <li>
                        @php
                            if(isAdmin()){
                                $passwordResetRoute = 'admin.userPasswordReset';
                            }elseif(isPartner()){
                                $passwordResetRoute = 'partner.userPasswordReset';
                            }elseif(isDistributor()){
                                $passwordResetRoute = 'distributor.userPasswordReset';
                            } elseif(isCustomer()){
                                $passwordResetRoute = 'customer.userPasswordReset';
                            }elseif(isclient()){
                                $passwordResetRoute = 'admin.userPasswordReset';
                            }elseif(isIndividual()){
                                $passwordResetRoute = 'admin.userPasswordReset';
                            }

                            $settingRoute = route("admin.user-settings.create");

                            if(isPartner()){
                                $settingRoute = route('partner.user-settings.create');
                            }

                            if(isDistributor()){
                                $settingRoute = route('distributor.user-settings.create');
                            }
                        @endphp
                        <a class="dropdown-item d-flex align-items-center" href="@if(!empty($passwordResetRoute)){{ route($passwordResetRoute) }} @endif">
                            <i class="bi bi-lock fs-18 me-2 op-7"></i>
                            Change Password
                        </a>
                    </li>
                    <li><a class="dropdown-item d-flex align-items-center" href="{{ route('admin.signout') }}"><i class="bi bi-box-arrow-right fs-18 me-2 op-7"></i>Log Out</a></li>
                </ul>
            </li>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <li class="header-element">
                <!-- Start::header-link|switcher-icon -->
                <a href="javascript:void(0);" class="header-link switcher-icon" data-bs-toggle="offcanvas" data-bs-target="#switcher-canvas">
                    <i class="bi bi-gear header-link-icon border-0"></i>
                </a>
                <!-- End::header-link|switcher-icon -->
            </li>
            <!-- End::header-element -->

        </ul>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header>
