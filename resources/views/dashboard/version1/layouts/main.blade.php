<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="dark" data-vertical-style="detached" data-toggled="detached-close" data-card-style="style1" data-card-background="background1" >

<head>
    @include('dashboard.version1.includes._head')

    <style>
        button[type="submit"] {
            transition: none !important; /* Disable transitions */
        }

        button[type="submit"]:hover {
            transform: rotate(0) !important; /* Ensure no rotation on hover */
        }

    </style>
</head>

<body>

<!-- Start Switcher -->
<div class="offcanvas offcanvas-end switcher-offacanvas" tabindex="-1" id="switcher-canvas" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header border-bottom d-block p-0">
        <div class="d-flex align-items-center justify-content-between p-3">
            <h5 class="offcanvas-title text-default" id="offcanvasRightLabel">Switcher</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <nav class="border-top border-block-start-dashed">
            <div class="nav nav-tabs nav-justified" id="switcher-main-tab" role="tablist">
                <button class="nav-link active" id="switcher-home-tab" data-bs-toggle="tab" data-bs-target="#switcher-home"
                        type="button" role="tab" aria-controls="switcher-home" aria-selected="true">Theme Styles</button>
                <button class="nav-link" id="switcher-profile-tab" data-bs-toggle="tab" data-bs-target="#switcher-profile"
                        type="button" role="tab" aria-controls="switcher-profile" aria-selected="false">Theme Colors</button>
            </div>
        </nav>
    </div>
    <div class="offcanvas-body">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active border-0" id="switcher-home" role="tabpanel" aria-labelledby="switcher-home-tab"
                 tabindex="0">
                <div class="">
                    <p class="switcher-style-head">Directions:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-ltr">
                                    LTR
                                </label>
                                <input class="form-check-input" type="radio" name="direction" id="switcher-ltr" checked>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-rtl">
                                    RTL
                                </label>
                                <input class="form-check-input" type="radio" name="direction" id="switcher-rtl">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="switcher-style-head">Navigation Styles:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-vertical">
                                    Vertical
                                </label>
                                <input class="form-check-input" type="radio" name="navigation-style" id="switcher-vertical"
                                       checked>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-horizontal">
                                    Horizontal
                                </label>
                                <input class="form-check-input" type="radio" name="navigation-style"
                                       id="switcher-horizontal">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navigation-menu-styles">
                    <p class="switcher-style-head">Vertical & Horizontal Menu Styles:</p>
                    <div class="row switcher-style gx-0 pb-2 gy-2">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-menu-click">
                                    Menu Click
                                </label>
                                <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                       id="switcher-menu-click">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-menu-hover">
                                    Menu Hover
                                </label>
                                <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                       id="switcher-menu-hover">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-icon-click">
                                    Icon Click
                                </label>
                                <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                       id="switcher-icon-click">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-icon-hover">
                                    Icon Hover
                                </label>
                                <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                       id="switcher-icon-hover">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sidemenu-layout-styles">
                    <p class="switcher-style-head">Sidemenu Layout Styles:</p>
                    <div class="row switcher-style gx-0 pb-2 gy-2">
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-default-menu">
                                    Default Menu
                                </label>
                                <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                       id="switcher-default-menu">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-closed-menu">
                                    Closed Menu
                                </label>
                                <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                       id="switcher-closed-menu">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-icontext-menu">
                                    Icon Text
                                </label>
                                <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                       id="switcher-icontext-menu">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-icon-overlay">
                                    Icon Overlay
                                </label>
                                <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                       id="switcher-icon-overlay">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-detached">
                                    Detached
                                </label>
                                <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                       id="switcher-detached" checked>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-double-menu">
                                    Double Menu
                                </label>
                                <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                       id="switcher-double-menu">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="switcher-style-head">Layout Width Styles:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-full-width">
                                    Full Width
                                </label>
                                <input class="form-check-input" type="radio" name="layout-width" id="switcher-full-width"
                                       checked>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-boxed">
                                    Boxed
                                </label>
                                <input class="form-check-input" type="radio" name="layout-width" id="switcher-boxed">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="switcher-style-head">Menu Positions:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-menu-fixed">
                                    Fixed
                                </label>
                                <input class="form-check-input" type="radio" name="menu-positions" id="switcher-menu-fixed"
                                       checked>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-menu-scroll">
                                    Scrollable
                                </label>
                                <input class="form-check-input" type="radio" name="menu-positions" id="switcher-menu-scroll">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="switcher-style-head">Header Positions:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-header-fixed">
                                    Fixed
                                </label>
                                <input class="form-check-input" type="radio" name="header-positions"
                                       id="switcher-header-fixed" checked>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-header-scroll">
                                    Scrollable
                                </label>
                                <input class="form-check-input" type="radio" name="header-positions"
                                       id="switcher-header-scroll">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <p class="switcher-style-head">Loader:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-loader-enable">
                                    Enable
                                </label>
                                <input class="form-check-input" type="radio" name="page-loader"
                                       id="switcher-loader-enable">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-loader-disable">
                                    Disable
                                </label>
                                <input class="form-check-input" type="radio" name="page-loader"
                                       id="switcher-loader-disable" checked>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade border-0" id="switcher-profile" role="tabpanel" aria-labelledby="switcher-profile-tab" tabindex="0">
                <div>
                    <div class="theme-colors">
                        <p class="switcher-style-head">Theme Primary:</p>
                        <div class="d-flex flex-wrap align-items-center switcher-style">
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-1" type="radio"
                                       name="theme-primary" id="switcher-primary">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-2" type="radio"
                                       name="theme-primary" id="switcher-primary1">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-3" type="radio" name="theme-primary"
                                       id="switcher-primary2">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-4" type="radio" name="theme-primary"
                                       id="switcher-primary3">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-5" type="radio" name="theme-primary"
                                       id="switcher-primary4">
                            </div>
                            <div class="form-check switch-select ps-0 mt-1 color-primary-light">
                                <div class="theme-container-primary"></div>
                                <div class="pickr-container-primary"  onchange="updateChartColor(this.value)"></div>
                            </div>
                        </div>
                    </div>
                    <div class="pattern-image mb-3">
                        <p class="switcher-style-head">Background Patterns:</p>
                        <div class="d-flex flex-wrap align-items-center switcher-style">
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input patternimage-input bg-pattern1" type="radio"
                                       name="background-pattern" id="switcher-pattern-img">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input patternimage-input bg-pattern2" type="radio"
                                       name="background-pattern" id="switcher-pattern-img1">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input patternimage-input bg-pattern3" type="radio" name="background-pattern"
                                       id="switcher-pattern-img2">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input patternimage-input bg-pattern4" type="radio"
                                       name="background-pattern" id="switcher-pattern-img3" checked>
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input patternimage-input bg-pattern5" type="radio"
                                       name="background-pattern" id="switcher-pattern-img4">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input patternimage-input bg-pattern6" type="radio"
                                       name="background-pattern" id="switcher-pattern-img5">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input patternimage-input bg-pattern7" type="radio"
                                       name="background-pattern" id="switcher-pattern-img6">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input patternimage-input bg-pattern8" type="radio"
                                       name="background-pattern" id="switcher-pattern-img7">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input patternimage-input bg-pattern9" type="radio"
                                       name="background-pattern" id="switcher-pattern-img8">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input patternimage-input bg-pattern10" type="radio"
                                       name="background-pattern" id="switcher-pattern-img9">
                            </div>
                        </div>
                    </div>
                    <div class="card-style mb-3">
                        <p class="switcher-style-head">Card Styling:</p>
                        <div class="d-flex flex-wrap align-items-center switcher-style">
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-style1" type="radio"
                                       name="card-style" id="switcher-card-style" checked>
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-style2" type="radio"
                                       name="card-style" id="switcher-card-style1">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-style3" type="radio" name="card-style"
                                       id="switcher-card-style2">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-style4" type="radio"
                                       name="card-style" id="switcher-card-style3">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-style5" type="radio"
                                       name="card-style" id="switcher-card-style4">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-style6" type="radio"
                                       name="card-style" id="switcher-card-style5">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-style7" type="radio"
                                       name="card-style" id="switcher-card-style6">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-style8" type="radio"
                                       name="card-style" id="switcher-card-style7">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-style9" type="radio"
                                       name="card-style" id="switcher-card-style8">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-style10" type="radio"
                                       name="card-style" id="switcher-card-style9">
                            </div>
                        </div>
                    </div>
                    <div class="card-background mb-3">
                        <p class="switcher-style-head">Card Background:</p>
                        <div class="d-flex flex-wrap align-items-center switcher-style">
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-background1" type="radio"
                                       name="card-background" id="switcher-card-background" checked>
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-background2" type="radio"
                                       name="card-background" id="switcher-card-background1">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-background3" type="radio" name="card-background"
                                       id="switcher-card-background2">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-background4" type="radio"
                                       name="card-background" id="switcher-card-background3">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-background5" type="radio"
                                       name="card-background" id="switcher-card-background4">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-background6" type="radio"
                                       name="card-background" id="switcher-card-background5">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-background7" type="radio"
                                       name="card-background" id="switcher-card-background6">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-background8" type="radio"
                                       name="card-background" id="switcher-card-background7">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input card-input card-background9" type="radio"
                                       name="card-background" id="switcher-card-background8">
                            </div>
                        </div>
                    </div>
                    <div class="menu-image mb-3">
                        <p class="switcher-style-head">Menu With Background Image:</p>
                        <div class="d-flex flex-wrap align-items-center switcher-style">
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img1" type="radio"
                                       name="theme-background" id="switcher-bg-img">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img2" type="radio"
                                       name="theme-background" id="switcher-bg-img1">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img3" type="radio" name="theme-background"
                                       id="switcher-bg-img2">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img4" type="radio"
                                       name="theme-background" id="switcher-bg-img3">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img5" type="radio"
                                       name="theme-background" id="switcher-bg-img4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between canvas-footer flex-sm-nowrap flex-wrap gap-2">
                <a href="javascript:void(0);" id="reset-all" class="btn btn-danger flex-fill">Reset</a>
            </div>
        </div>
    </div>
</div>
<!-- End Switcher -->



<div class="page">
    <!-- app-header -->
    @include('dashboard.version1.includes._navigation')

    <!-- /app-header -->
    <!-- Start::app-sidebar -->
    <aside class="app-sidebar sticky" id="sidebar">

        <div class="top-left"></div>
        <div class="top-right"></div>
        <div class="bottom-left"></div>
        <div class="bottom-right"></div>
        <!-- Start::main-sidebar-header -->
        <div class="main-sidebar-header">
            <a href="#" class="header-logo">
                <img src="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" alt="logo" class="desktop-logo">
                <img src="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" alt="logo" class="toggle-dark">
                <img src="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" alt="logo" class="desktop-dark">
                <img src="{{asset('web/assets/img/resize-image/android-chrome-192x192.png')}}" alt="logo" class="toggle-logo">
            </a>
        </div>
        <!-- End::main-sidebar-header -->

        <!-- Start::main-sidebar -->
        <div class="main-sidebar" id="sidebar-scroll">

            <!-- Start::nav -->
            <nav class="main-menu-container nav nav-pills flex-column sub-open">
                <div class="slide-left" id="slide-left">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
                </div>
                <ul class="main-menu">
                    @if(isAdmin())
                        @include('dashboard.version1.includes._sidebar')
                    @endif

                    @if(isCustomer())
                        @include('dashboard.version1.includes._sidebar_customer')
                    @endif

                    @if(isPartner())
                        @include('dashboard.version1.includes._sidebar_partner')
                    @endif

                    @if(isclient() || isIndividual())
                        @include('dashboard.version1.includes._sidebar_client')
                    @endif
                    <!-- Start::slide -->

                </ul>
                <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
            </nav>
            <!-- End::nav -->

        </div>
        <!-- End::main-sidebar -->

    </aside>
    <!-- End::app-sidebar -->

    <!-- Start::app-content -->
    <div class="main-content app-content">
        <div class="container-fluid">
            @yield('actions')
            @yield('content')
        </div>
    </div>
    <!-- End::app-content -->


    <!-- Footer Start -->
    <!-- include:includes/_footer -->
    @include('dashboard.version1.includes._footer')

    <!-- Footer End -->
    <div class="modal fade" id="header-responsive-search" tabindex="-1" aria-labelledby="header-responsive-search" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="input-group">
                        <input type="text" class="form-control border-end-0" placeholder="Search Anything ..."
                               aria-label="Search Anything ..." aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="button"
                                id="button-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="apps-header-offcanvas">
        <div class="offcanvas-header border-bottom">
            <h6 class="offcanvas-title" id="offcanvasExampleLabel">Shortcuts</h6>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="panel tabs-style2">
                <div class="panel-head">
                    <ul class="nav d-flex  app-header-nav-tabs">
                        <li class="nav-item mb-2 flex-grow-1 text-center"><a class="nav-link active" data-bs-toggle="tab" href="#side1"><i
                                    class="bi bi-chat me-2 d-inline-block"></i> Chat</a></li>
                        <li class="nav-item  flex-grow-1 text-center mb-sm-0 mb-2"><a class="nav-link" data-bs-toggle="tab"
                                                                                      href="#side2"><i class="bi bi-person-gear me-2 d-inline-block"></i> Settings</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane p-0 show active" id="side1">
                            <div class="text-end m-3">
                                <a href="mail-settings.html" class="text-primary">Mail Settings</a>
                            </div>
                            <div class="px-3 pt-0 pb-3 border-bottom border-block-end-dashed">
                                <div class="d-flex align-items-center justify-content-between gap-1 mb-3">
                                    <p class="mb-0 font-weight-semibold">Messages</p>
                                    <a href="mail.html" class="btn btn-sm btn-primary-light btn-icon btn-icon"><i class="ri-chat-1-line"></i></a>
                                </div>
                                <ul class="list-unstyled mb-0 mt-2">
                                    <li class="mb-3">
                                        <div class="d-flex pos-relative">
                                            <a href="javascript:void(0)" class="link-overlap"></a>
                                            <div class="main-img-user avatar d-none d-sm-block">
                                                <img alt="avatar" class="shadow" src="{{asset('dashboard/version1/')}}/assets/images/faces/5.jpg">
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">Elizabeth Ava<span
                                                            class="badge bg-primary-transparent fs-11 ms-2 font-weight-normal">2</span><span
                                                            class="ms-2"><i class="ti-pin-alt fs-11 text-muted"></i></span></h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">3:55 PM</span>
                                                </div>
                                                <p class="mb-0 fs-12 text-muted d-flex align-items-center">Elizabeth is
                                                    online</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex pos-relative">
                                            <a href="javascript:void(0)" class="link-overlap"></a>
                                            <div class="main-img-user avatar d-none d-sm-block">
                                                <img alt="avatar" class="shadow" src="{{asset('dashboard/version1/')}}/assets/images/faces/9.jpg">
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">George Rhys<span
                                                            class="badge bg-primary-transparent fs-11 ms-2 font-weight-normal">1</span>
                                                    </h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">12:04 PM</span>
                                                </div>
                                                <p class="mb-0 fs-12 text-muted d-flex align-items-center">I must explain...</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex pos-relative">
                                            <a href="javascript:void(0)" class="link-overlap"></a>
                                            <div class="main-img-user avatar d-none d-sm-block">
                                                <img alt="avatar" class="shadow" src="{{asset('dashboard/version1/')}}/assets/images/faces/8.jpg">
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">Bethany Isla<span
                                                            class="badge bg-primary-transparent fs-11 ms-2 font-weight-normal">2</span>
                                                    </h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">Yesterday</span>
                                                </div>
                                                <p class="mb-0 fs-12">We denounce with righteous..</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex pos-relative">
                                            <a href="javascript:void(0)" class="link-overlap"></a>
                                            <div class="main-img-user avatar d-none d-sm-block">
                                                <img alt="avatar" class="shadow" src="{{asset('dashboard/version1/')}}/assets/images/faces/3.jpg">
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">Margaret Emma<span
                                                            class="badge bg-primary-transparent fs-11 ms-2 font-weight-normal">1</span>
                                                    </h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">01 Mar</span>
                                                </div>
                                                <p class="mb-0 fs-12 text-muted d-flex align-items-center"><i
                                                        class="fe fe-link-2 me-1 fs-12 text-primary"></i><a
                                                        href="javascript:void(0);">http://Diam-duoet.xd</a></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-0">
                                        <div class="d-flex pos-relative">
                                            <a href="javascript:void(0)" class="link-overlap"></a>
                                            <div class="main-img-user avatar d-none d-sm-block">
                                                <img alt="avatar" class="shadow" src="{{asset('dashboard/version1/')}}/assets/images/faces/10.jpg">
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">Michael Souris<span
                                                            class="badge bg-primary-transparent fs-11 ms-2 font-weight-normal">1</span>
                                                    </h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">22 Feb</span>
                                                </div>
                                                <p class="mb-0 fs-12 text-muted d-flex align-items-center"><i
                                                        class="fe fe-image me-1 fs-12 text-primary"></i>+13 photos</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="text-end mt-2">
                                    <a href="chat.html" class="text-primary">View All</a>
                                </div>
                            </div>
                            <div class="p-3 border-bottom border-block-end-dashed">
                                <div class="d-flex align-items-center justify-content-between gap-1 my-3">
                                    <p class="mb-0 font-weight-semibold">Workspace</p>
                                    <a href="mail.html" class="btn btn-sm btn-primary-light btn-icon btn-icon"><i class="ri-add-circle-line"></i></a>
                                </div>
                                <ul class="list-unstyled mb-0 mt-1">
                                    <li class="mb-3">
                                        <div class="d-flex">
                                            <div class="avatar avatar  shadow bg-primary-transparent">
                                                <i class="ri-user-line"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">Olivia Lily<span
                                                            class="badge bg-primary-transparent fs-11 ms-2 font-weight-normal">1</span>
                                                    </h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">2:00 PM</span>
                                                </div>
                                                <p class="mb-0 fs-12">Aliquyam ipsum sit.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex">
                                            <div class="avatar avatar  shadow bg-secondary-transparent">
                                                <i class="ri-arrow-right-circle-line"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">Smith Brown<span
                                                            class="badge bg-primary-transparent fs-11 ms-2 font-weight-normal">2</span>
                                                    </h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">12:00 PM</span>
                                                </div>
                                                <p class="mb-0 fs-12">At eos no sit...</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex">
                                            <div class="avatar avatar  shadow bg-warning-transparent">
                                                <i class="ri-drag-move-line"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">Wilson Li<span
                                                            class="badge bg-primary-transparent fs-11 ms-2 font-weight-normal">24</span>
                                                    </h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">16 Feb</span>
                                                </div>
                                                <p class="mb-0 fs-12">Sit est dolor dolor.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex">
                                            <div class="avatar avatar  shadow bg-success-transparent">
                                                <i class="ri-home-8-line"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">Jones Morton<span
                                                            class="badge bg-primary-transparent fs-11 ms-2 font-weight-normal">3</span>
                                                    </h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">12 Jan </span>
                                                </div>
                                                <p class="mb-0 fs-12">Erat diam ipsum... Sed dolor...</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-0">
                                        <div class="d-flex">
                                            <div class="avatar avatar  shadow bg-danger-transparent">
                                                <i class="ri-global-line"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">White Lee<span
                                                            class="badge bg-primary-transparent fs-11 ms-2 font-weight-normal">1</span>
                                                    </h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">01 Feb</span>
                                                </div>
                                                <p class="mb-0 fs-12">Justo accusam stet eirmod et....</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="text-end mt-2">
                                    <a href="chat.html" class="text-primary">View All</a>
                                </div>
                            </div>
                            <div class="p-3 border-bottom border-block-end-dashed">
                                <div class="d-flex align-items-center justify-content-between gap-1 mb-3">
                                    <p class="mb-0 font-weight-semibold">Calls</p>
                                    <a href="contacts.html" class="btn btn-sm btn-primary-light btn-icon btn-icon"><i class="ri-phone-line"></i></a>
                                </div>
                                <ul class="list-unstyled mb-0 mt-2">
                                    <li class="mb-3">
                                        <div class="d-flex pos-relative">
                                            <a href="javascript:void(0)" class="link-overlap"></a>
                                            <div class="main-img-user avatar d-none d-sm-block">
                                                <img alt="avatar" class="shadow" src="{{asset('dashboard/version1/')}}/assets/images/faces/14.jpg">
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">Wilfrid Price<span
                                                            class="badge bg-danger-transparent text-danger fs-11 ms-2 font-weight-normal">3</span>
                                                    </h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">11:15 AM</span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-1">
                                                    <p class="mb-0 fs-12 text-muted d-flex align-items-center"><i
                                                            class="fe fe-x me-1 fs-13 text-danger"></i>Missed call</p>
                                                    <span class="text-primary"><i class="fe fe-phone"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex pos-relative">
                                            <a href="javascript:void(0)" class="link-overlap" data-bs-toggle="modal"
                                               data-bs-target="#videoModal"></a>
                                            <div class="main-img-user avatar d-none d-sm-block">
                                                <img alt="avatar" class="shadow" src="{{asset('dashboard/version1/')}}/assets/images/faces/7.jpg">
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">Jasmin O'Kon</h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">Yesterday</span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-1">
                                                    <p class="mb-0 fs-12 text-muted d-flex align-items-center"><i
                                                            class="fe fe-arrow-down-left me-1 fs-13 text-primary"></i>Duration:
                                                        15:30</p>
                                                    <span class="text-primary"><i class="fe fe-video"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex pos-relative">
                                            <a href="javascript:void(0)" class="link-overlap" data-bs-toggle="modal"
                                               data-bs-target="#videoModal"></a>
                                            <div class="main-img-user avatar d-none d-sm-block">
                                                <img alt="avatar" class="shadow" src="{{asset('dashboard/version1/')}}/assets/images/faces/4.jpg">
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">River Gleichner</h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">01 Mar</span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-1">
                                                    <p class="mb-0 fs-12 text-muted d-flex align-items-center"><i
                                                            class="fe fe-arrow-up-right me-1 fs-13 text-primary"></i>Declined
                                                    </p>
                                                    <span class="text-primary"><i class="fe fe-video"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-3">
                                        <div class="d-flex pos-relative">
                                            <a href="javascript:void(0)" class="link-overlap"></a>
                                            <div class="main-img-user avatar d-none d-sm-block">
                                                <img alt="avatar" class="shadow" src="{{asset('dashboard/version1/')}}/assets/images/faces/12.jpg">
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">Saul Goodmate<span
                                                            class="badge bg-danger-transparent text-danger fs-11 ms-2 font-weight-normal">1</span>
                                                    </h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">20 Feb</span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-1">
                                                    <p class="mb-0 fs-12 text-muted d-flex align-items-center"><i
                                                            class="fe fe-x me-1 fs-13 text-danger"></i>Missed call</p>
                                                    <span class="text-primary"><i class="fe fe-phone"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-0">
                                        <div class="d-flex pos-relative">
                                            <a href="javascript:void(0)" class="link-overlap"></a>
                                            <div class="main-img-user avatar d-none d-sm-block">
                                                <img alt="avatar" class="shadow" src="{{asset('dashboard/version1/')}}/assets/images/faces/13.jpg">
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                <div class="d-flex align-items-center justify-content-between gap-1 mb-1">
                                                    <h6 class="mb-0">Edgardo Huel</h6>
                                                    <span class="fs-11 text-muted ms-auto my-auto">15 Feb</span>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-1">
                                                    <p class="mb-0 fs-12 text-muted d-flex align-items-center"><i
                                                            class="fe fe-arrow-down-left me-1 fs-13 text-success"></i>Duration:
                                                        01:20:10</p>
                                                    <span class="text-primary"><i class="fe fe-phone"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="text-end mt-3">
                                    <a href="chat.html" class="text-primary">View All</a>
                                </div>
                            </div>
                            <div class="p-3 text-center">
                                <div class="svg-card overflow-hidden">
                                    <img src="{{asset('dashboard/version1/')}}/assets/images/media/media-67.jpg" alt="">
                                </div>
                                <h6 class="mt-3">Find out more !</h6>
                                <a href="mail-settings.html" class="btn btn-outline-primary btn-block">Mail Settings</a>
                            </div>
                        </div>
                        <div class="tab-pane p-0" id="side2">
                            <div class="p-3 border-bottom">
                                <h6>Notifications :</h6>
                                <div class="panel mt-2 tabs-style5">
                                    <div class="panel-head">
                                        <ul class="nav app-header-nav-tabs tab-style-2 mb-3">
                                            <li class="nav-item flex-grow-1 text-center"><a class="nav-link active" data-bs-toggle="tab"
                                                                                            href="#tab_chat">Home</a></li>
                                            <li class="nav-item flex-grow-1 text-center"><a class="nav-link" data-bs-toggle="tab" href="#tab_tasks">Tasks</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="panel-body p-0">
                                        <div class="tab-content">
                                            <div class="tab-pane rounded-0 border border-dashed active" id="tab_chat">
                                                <div class="mt-0">
                                                    <div class="d-flex align-items-center justify-content-between gap-1">
                                                        <label class="text-muted d-flex align-items-center">Someone
                                                            mentioned</label>
                                                        <div class="custom-toggle-switch ms-auto">
                                                            <input id="some" name="toggleswitchsize" type="checkbox">
                                                            <label for="some" class="label-primary mb-1"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="d-flex align-items-center justify-content-between gap-1">
                                                        <label class="text-muted d-flex align-items-center">Someone
                                                            Replies</label>
                                                        <div class="custom-toggle-switch ms-auto">
                                                            <input id="reply" name="toggleswitchsize" type="checkbox">
                                                            <label for="reply" class="label-primary mb-1"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="d-flex align-items-center justify-content-between gap-1">
                                                        <label class="text-muted d-flex align-items-center">Allow All
                                                            Notifications</label>
                                                        <div class="custom-toggle-switch ms-auto">
                                                            <input id="notify-allow" name="toggleswitchsize" type="checkbox" checked>
                                                            <label for="notify-allow" class="label-primary mb-1"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-1 mt-3 flex-wrap">
                                                    <label class="text-muted mb-0">Notifications On</label>
                                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                        <input type="radio" class="btn-check" name="radioChat" id="radio1">
                                                        <label class="btn btn-sm btn-outline-primary mb-0" for="radio1">In App</label>

                                                        <input type="radio" class="btn-check" name="radioChat" id="radio2" checked>
                                                        <label class="btn btn-sm btn-outline-primary mb-0" for="radio2">Email</label>

                                                        <input type="radio" class="btn-check" name="radioChat" id="radio3">
                                                        <label class="btn btn-sm btn-outline-primary mb-0" for="radio3">Both</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane rounded-0 border border-dashed" id="tab_tasks">
                                                <div class="mt-0">
                                                    <div class="d-flex align-items-center justify-content-between gap-1">
                                                        <label class="text-muted d-flex align-items-center">Assigned a
                                                            Task</label>
                                                        <div class="custom-toggle-switch ms-auto">
                                                            <input id="task" name="toggleswitchsize" type="checkbox">
                                                            <label for="task" class="label-primary mb-1"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="d-flex align-items-center justify-content-between gap-1">
                                                        <label class="text-muted d-flex align-items-center">If I Have More
                                                            Than 24 Tasks</label>
                                                        <div class="custom-toggle-switch ms-auto">
                                                            <input id="listed" name="toggleswitchsize" type="checkbox">
                                                            <label for="listed" class="label-primary mb-1"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="d-flex align-items-center justify-content-between gap-1">
                                                        <label class="text-muted d-flex align-items-center">Allow All
                                                            Notifications</label>
                                                        <div class="custom-toggle-switch ms-auto">
                                                            <input id="all-notify" name="toggleswitchsize" type="checkbox" checked>
                                                            <label for="all-notify" class="label-primary mb-1"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between gap-1 mt-3 flex-wrap">
                                                    <label class="text-muted mb-0">Notifications On</label>
                                                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                        <input type="radio" class="btn-check" name="radioTasks" id="radio4" checked>
                                                        <label class="btn btn-sm btn-outline-primary mb-0" for="radio4">In App</label>

                                                        <input type="radio" class="btn-check" name="radioTasks" id="radio5">
                                                        <label class="btn btn-sm btn-outline-primary mb-0" for="radio5">Email</label>

                                                        <input type="radio" class="btn-check" name="radioTasks" id="radio6">
                                                        <label class="btn btn-sm btn-outline-primary mb-0" for="radio6">Both</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 border-bottom">
                                <h6>App :</h6>
                                <div class="panel mt-2 tabs-style5">
                                    <div class="panel-head">
                                        <ul class="nav app-header-nav-tabs tab-style-2 mb-3">
                                            <li class="nav-item flex-grow-1 text-center"><a class="nav-link active" data-bs-toggle="tab"
                                                                                            href="#tab_apps">Files</a></li>
                                            <li class="nav-item flex-grow-1 text-center"><a class="nav-link" data-bs-toggle="tab" href="#tab_profile">Profile</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="panel-body p-0">
                                        <div class="tab-content">
                                            <div class="tab-pane rounded-0 border border-dashed active" id="tab_apps">
                                                <div class="mt-3">
                                                    <p class="mb-0">Files : </p>
                                                    <div class="mt-3">
                                                        <div class="mb-0 d-flex align-items-center justify-content-between gap-1">
                            <span class="text-muted">
                              <i class="ri-folder-image-fill me-1 d-inline-block fs-18 text-primary"></i>
                              Images
                            </span>

                                                            <div class=" ms-auto=">
                                                                1,458
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <div class="mb-0 d-flex align-items-center justify-content-between gap-1">
                            <span class="text-muted">
                              <i class="ri-live-line me-1 d-inline-block fs-18 text-secondary"></i>
                              Videos
                            </span>

                                                            <div class=" ms-auto=">
                                                                213
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <div class="mb-0 d-flex align-items-center justify-content-between gap-1">
                            <span class="text-muted">
                              <i class="ri-database-2-line me-1 d-inline-block fs-18 text-success"></i>
                              Storage
                            </span>

                                                            <div class=" ms-auto text-success">
                                                                8.50MB free space
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <p class="mb-0">Files Privacy Settings :</p>
                                                    <div class="mt-3">
                                                        <div class="form-group mb-0">
                                                            <p class="mb-2 d-flex align-items-center justify-content-between gap-1">
                                                                <label for="inputPassword" class="mb-0 text-muted">Password</label>
                                                                <a href="javascript:void(0)" class="fs-11 text-primary" id="changePassword">change</a>
                                                            </p>
                                                            <input type="password" class="form-control form-contron-sm radius-4" id="inputPassword"
                                                                   placeholder="Enter New Password" value="passwordzem">
                                                            <div class="mt-2 d-none" id="reEnterPassword">
                                                                <input type="password" class="form-control form-contron-sm radius-4" id="inputPasswordTwo"
                                                                       placeholder="Re-Enter Password">
                                                                <div class="btn-list mt-2 text-end">
                                                                    <a href="javascript:void(0)" class="text-danger" id="closePassword">Discard</a>
                                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary ms-3">Save
                                                                        Changes</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <div class="mb-0 d-flex align-items-center justify-content-between gap-1">
                            <span class="text-muted d-flex align-items-center">Two Factor
                              Authentication</span>
                                                            <div class="custom-toggle-switch ms-auto">
                                                                <input id="authentication" name="toggleswitchsize" type="checkbox" checked>
                                                                <label for="authentication" class="label-primary mb-1"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <div class="form-group mb-0">
                                                            <p class="mb-0 d-flex align-items-center justify-content-between gap-1">
                                                                <label for="inputPassword" class="mb-0 text-muted">Recent Deleted Files</label>
                                                                <a href="javascript:void(0)" class="btn btn-sm btn-outline-danger mt-2">Delete All</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane border border-dashed rounded-0" id="tab_profile">
                                                <div class="mt-3">
                                                    <div class="form-group mb-3">
                                                        <label class="text-muted" for="inputName">Full Name</label>
                                                        <input type="text" class="form-control radius-4" id="inputName" placeholder="Enter Full Name"
                                                               value="Json Taylor">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="text-muted" for="inputMail">Email</label>
                                                        <input type="email" class="form-control radius-4" id="inputMail" placeholder="Enter Your Mail"
                                                               value="nicktaylor@Sprukosoftware.me">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="inputNumber" class="text-muted d-flex align-items-center justify-content-between gap-1">
                                                            Mobile Number
                                                            <a href="javascript:void(0)" class="fs-11 text-primary">Change number</a>
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text br-ts-20 br-bs-20">+91</span>
                                                            <input type="number" class="form-control br-te-4 br-be-4" id="inputNumber"
                                                                   placeholder="Enter Your Number" value="1212313231">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 border-bottom">
                                <h6>Remaiders :</h6>
                                <div class="mt-3">
                                    <div class="d-flex align-items-center justify-content-between gap-1">
                                        <label class="text-muted">Get alert for remaiders</label>
                                        <div class="custom-toggle-switch ms-auto">
                                            <input id="mails-images" name="toggleswitchsize" type="checkbox" checked>
                                            <label for="mails-images" class="label-primary mb-1"></label>
                                        </div>
                                        <span class="custom-switch-indicator"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="text-center">
                                    <img src="{{asset('dashboard/version1/')}}/assets/images/media/media-66.png" alt="">
                                    <h6 class="mt-4">This Is Not You're Looking For?</h6>
                                    <a href="profile-settings.html" class="btn btn-block btn-outline-primary">Go To Profile Settings</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Scroll To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="ti ti-arrow-narrow-up fs-20"></i></span>
</div>
<div id="responsive-overlay"></div>
<!-- Scroll To Top -->
@include('dashboard.version1.includes._script')
</body>

</html>
