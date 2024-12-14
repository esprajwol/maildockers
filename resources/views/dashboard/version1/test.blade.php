<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="dark" data-vertical-style="detached" data-toggled="detached-close" data-card-style="style1" data-card-background="background1" >

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> SCIFI - Bootstrap 5 Premium Admin & Dashboard Template </title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin panel, admin, admin template, dashboard template, dashboard template bootstrap, crm dashboard, stocks dashboard, projects dashboard, sales dashboard, html template, html css templates, html dashboard, dashboard, bootstrap dashboard, template dashboard">

    <!-- Favicon -->
    <link rel="icon" href="../assets/images/brand-logos/favicon.ico" type="image/x-icon">

    <!-- Choices JS -->
    <script src="../assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- Main Theme Js -->
    <script src="../assets/js/main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="../assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

    <!-- Style Css -->
    <link href="../assets/css/styles.css" rel="stylesheet" >

    <!-- Icons Css -->
    <link href="../assets/css/icons.css" rel="stylesheet" >

    <!-- Node Waves Css -->
    <link href="../assets/libs/node-waves/waves.min.css" rel="stylesheet" >

    <!-- Simplebar Css -->
    <link href="../assets/libs/simplebar/simplebar.min.css" rel="stylesheet" >

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="../assets/libs/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="../assets/libs/@simonwep/pickr/themes/nano.min.css">

    <!-- Choices Css -->
    <link rel="stylesheet" href="../assets/libs/choices.js/public/assets/styles/choices.min.css">


    <!-- Jsvector Maps -->
    <link rel="stylesheet" href="../assets/libs/jsvectormap/css/jsvectormap.min.css">

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


<!-- Loader -->
<div id="loader" >
    <img src="../assets/images/media/loader.svg" alt="">
</div>
<!-- Loader -->

<div class="page">
    <!-- app-header -->
    <header class="app-header sticky">

        <!-- Start::main-header-container -->
        <div class="main-header-container container-fluid">

            <!-- Start::header-content-left -->
            <div class="header-content-left">

                <!-- Start::header-element -->
                <div class="header-element">
                    <div class="horizontal-logo">
                        <a href="index.html" class="header-logo">
                            <img src="../assets/img/resize-image/android-chrome-192x192.png" alt="logo" class="desktop-logo">
                            <img src="../assets/img/resize-image/android-chrome-192x192.png" alt="logo" class="toggle-logo">
                            <img src="../assets/img/resize-image/android-chrome-192x192.png" alt="logo" class="desktop-dark">
                            <img src="../assets/img/resize-image/android-chrome-192x192.png" alt="logo" class="toggle-dark">
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

                <!-- Start::header-element -->
                <li class="header-element header-search d-md-block d-none">
                    <!-- Start::header-link -->
                    <input type="text" class="header-search-bar form-control border-0" placeholder="Search for Results...">
                    <a href="javascript:void(0);" class="header-search-icon border-0">
                        <i class="bi bi-search"></i>
                    </a>
                    <!-- End::header-link -->
                </li>
                <!-- End::header-element -->

                <!-- Start::header-element -->
                <li class="header-element d-md-none d-block">
                    <a href="javascript:void(0);" class="header-link" data-bs-toggle="modal" data-bs-target="#header-responsive-search">
                        <!-- Start::header-link-icon -->
                        <i class="bi bi-search header-link-icon"></i>
                        <!-- End::header-link-icon -->
                    </a>
                </li>
                <!-- End::header-element -->

                <!-- Start::header-element -->
                <li class="header-element country-selector dropdown">
                    <!-- Start::header-link|dropdown-toggle -->
                    <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown">
                        <img src="../assets/images/flags/us_flag.jpg" alt="img" class="header-link-icon">
                    </a>
                    <!-- End::header-link|dropdown-toggle -->
                    <ul class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                            <span class="avatar avatar-xs lh-1 me-2">
                                <img src="../assets/images/flags/us_flag.jpg" alt="img">
                            </span>
                                English
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                            <span class="avatar avatar-xs lh-1 me-2">
                                <img src="../assets/images/flags/spain_flag.jpg" alt="img" >
                            </span>
                                Spanish
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                            <span class="avatar avatar-xs lh-1 me-2">
                                <img src="../assets/images/flags/french_flag.jpg" alt="img" >
                            </span>
                                French
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                            <span class="avatar avatar-xs lh-1 me-2">
                                <img src="../assets/images/flags/germany_flag.jpg" alt="img" >
                            </span>
                                German
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                            <span class="avatar avatar-xs lh-1 me-2">
                                <img src="../assets/images/flags/italy_flag.jpg" alt="img" >
                            </span>
                                Italian
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);">
                            <span class="avatar avatar-xs lh-1 me-2">
                                <img src="../assets/images/flags/russia_flag.jpg" alt="img" >
                            </span>
                                Russian
                            </a>
                        </li>
                    </ul>
                </li>
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
                <li class="header-element">
                    <!-- Start::header-link|dropdown-toggle -->
                    <a href="javascript:void(0);" class="header-link" data-bs-toggle="offcanvas" data-bs-target="#apps-header-offcanvas">
                        <i class="bi bi-grid header-link-icon"></i>
                    </a>
                    <!-- End::main-header-dropdown -->
                </li>
                <!-- End::header-element -->

                <!-- Start::header-element -->
                <li class="header-element notifications-dropdown  dropdown">
                    <!-- Start::header-link|dropdown-toggle -->
                    <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown">
                        <i class="bi bi-bell header-link-icon"></i>
                        <span class="header-icon-pulse bg-warning rounded pulse"></span>
                    </a>
                    <div class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
                        <div class="p-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0 fs-16">Notifications</p>
                                <span class="badge bg-secondary-transparent" id="notifiation-data">4 Unread</span>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <ul class="list-unstyled mb-0" id="header-notification-scroll">
                            <li class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <div class="pe-2 lh-1">
                                     <span class="avatar avatar-rounded">
                                        <img src="../assets/images/faces/6.jpg" alt="">
                                     </span>
                                    </div>
                                    <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="mb-0 fw-medium"><a href="notifications.html">Jessica Lily</a></p>
                                            <span class="text-muted fw-normal fs-12 header-notification-text">Reminder to complete your weekly tasks</span>
                                        </div>
                                        <div
                                        >
                                            <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="bi bi-x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <div class="pe-2 lh-1">
                                     <span class="avatar bg-success-transparent avatar-rounded">
                                        <i class="ri-arrow-left-down-fill fs-18"></i>
                                     </span>
                                    </div>
                                    <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="mb-0 fw-medium"><a href="notifications.html">Payment Received</a></p>
                                            <span class="text-muted fw-normal fs-12 header-notification-text">You've been paid for freelance project.</span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="bi bi-x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <div class="pe-2 lh-1">
                                     <span class="avatar bg-secondary-transparent avatar-rounded">
                                        <img src="../assets/images/faces/23.jpg" alt="">
                                     </span>
                                    </div>
                                    <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="mb-0 fw-medium"><a href="notifications.html">New Message</a></p>
                                            <span class="text-muted fw-normal fs-12 header-notification-text">You've received a new message from a friend.</span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="bi bi-x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <div class="pe-2 lh-1">
                                        <span class="avatar bg-info-transparent avatar-rounded"><i class="ri-calendar-schedule-line fs-18"></i></span>
                                    </div>
                                    <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="mb-0 fw-medium"><a href="notifications.html">Appointment Confirmed</a></p>
                                            <span class="text-muted fw-normal fs-12 header-notification-text">Your appointment for next week has been confirmed.</span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="bi bi-x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <div class="pe-2 lh-1">
                                     <span class="avatar bg-success-transparent avatar-rounded">
                                        <img src="../assets/images/faces/11.jpg" alt="">
                                     </span>
                                    </div>
                                    <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="mb-0 fw-medium"><a href="notifications.html">Exclusive Offer</a></p>
                                            <span class="text-muted fw-normal fs-12 header-notification-text">Limited-time offer just for you! Check it out now.</span>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="min-w-fit-content text-muted me-1 dropdown-item-close1"><i class="bi bi-x"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="p-3 empty-header-item1 border-top">
                            <div class="text-center">
                                <a href="notifications.html" class="link-primary text-decoration-underline">View All</a>
                            </div>
                        </div>
                        <div class="p-5 empty-item1 d-none">
                            <div class="text-center">
                            <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                                <i class="bi bi-bell-slash fs-2"></i>
                            </span>
                                <h6 class="fw-medium mt-3">No New Notifications</h6>
                            </div>
                        </div>
                    </div>
                    <!-- End::main-header-dropdown -->
                </li>
                <!-- End::header-element -->

                <!-- Start::header-element -->
                <li class="header-element dropdown">
                    <!-- Start::header-link|dropdown-toggle -->
                    <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="../assets/images/faces/22.jpg" alt="img" class="avatar avatar-sm rounded-0">
                            </div>
                        </div>
                    </a>
                    <!-- End::header-link|dropdown-toggle -->
                    <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
                        <li><a class="dropdown-item d-flex align-items-center" href="profile.html"><i class="bi bi-person fs-18 me-2 op-7"></i>Profile</a></li>
                        <li><a class="dropdown-item d-flex align-items-center" href="mail.html"><i class="bi bi-envelope fs-16 me-2 op-7"></i>Inbox <span class="ms-auto badge bg-info">17</span></a></li>
                        <li><a class="dropdown-item d-flex align-items-center" href="to-do-list.html"><i class="bi bi-check-square fs-16 me-2 op-7"></i>Task Manager</a></li>
                        <li><a class="dropdown-item d-flex align-items-center" href="mail-settings.html"><i class="bi bi-gear fs-16 me-2 op-7"></i>Settings</a></li>
                        <li><a class="dropdown-item d-flex align-items-center" href="chat.html"><i class="bi bi-headset fs-18 me-2 op-7"></i>Support</a></li>
                        <li><a class="dropdown-item d-flex align-items-center" href="sign-in-cover.html"><i class="bi bi-box-arrow-right fs-18 me-2 op-7"></i>Log Out</a></li>
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
    <!-- /app-header -->
    <!-- Start::app-sidebar -->
    <aside class="app-sidebar sticky" id="sidebar">

        <div class="top-left"></div>
        <div class="top-right"></div>
        <div class="bottom-left"></div>
        <div class="bottom-right"></div>
        <!-- Start::main-sidebar-header -->
        <div class="main-sidebar-header">
            <a href="index.html" class="header-logo">
                <img src="../assets/img/resize-image/android-chrome-192x192.png" alt="logo" class="desktop-logo">
                <img src="../assets/img/resize-image/android-chrome-192x192.png" alt="logo" class="toggle-dark">
                <img src="../assets/img/resize-image/android-chrome-192x192.png" alt="logo" class="desktop-dark">
                <img src="../assets/img/resize-image/android-chrome-192x192.png" alt="logo" class="toggle-logo">
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

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M152,208V160a8,8,0,0,0-8-8H112a8,8,0,0,0-8,8v48a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V115.54a8,8,0,0,1,2.62-5.92l80-75.54a8,8,0,0,1,10.77,0l80,75.54a8,8,0,0,1,2.62,5.92V208a8,8,0,0,1-8,8H160A8,8,0,0,1,152,208Z" opacity="0.2"/><path d="M152,208V160a8,8,0,0,0-8-8H112a8,8,0,0,0-8,8v48a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V115.54a8,8,0,0,1,2.62-5.92l80-75.54a8,8,0,0,1,10.77,0l80,75.54a8,8,0,0,1,2.62,5.92V208a8,8,0,0,1-8,8H160A8,8,0,0,1,152,208Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Dashboards</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Dashboards</a>
                            </li>
                            <li class="slide">
                                <a href="index.html" class="side-menu__item">Gaming</a>
                            </li>
                            <li class="slide">
                                <a href="index-1.html" class="side-menu__item">Sales</a>
                            </li>
                            <li class="slide">
                                <a href="index-2.html" class="side-menu__item">Analytics</a>
                            </li>
                            <li class="slide">
                                <a href="index-3.html" class="side-menu__item">Ecommerce</a>
                            </li>
                            <li class="slide">
                                <a href="index-4.html" class="side-menu__item">Crypto</a>
                            </li>
                            <li class="slide">
                                <a href="index-5.html" class="side-menu__item">NFT</a>
                            </li>
                            <li class="slide">
                                <a href="index-6.html" class="side-menu__item">CRM</a>
                            </li>
                            <li class="slide">
                                <a href="index-7.html" class="side-menu__item">HRM</a>
                            </li>
                            <li class="slide">
                                <a href="index-8.html" class="side-menu__item">Jobs</a>
                            </li>
                            <li class="slide">
                                <a href="index-9.html" class="side-menu__item">Projects</a>
                            </li>
                            <li class="slide">
                                <a href="index-10.html" class="side-menu__item">Stocks</a>
                            </li>
                            <li class="slide">
                                <a href="index-11.html" class="side-menu__item">Courses</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polygon points="152 32 152 88 208 88 152 32" opacity="0.2"/><path d="M200,224H56a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h96l56,56V216A8,8,0,0,1,200,224Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Pages</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1 pages-ul">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Pages</a>
                            </li>
                            <li class="slide">
                                <a href="profile.html" class="side-menu__item">Profile</a>
                            </li>
                            <li class="slide">
                                <a href="profile-settings.html" class="side-menu__item">Profile settings</a>
                            </li>
                            <li class="slide">
                                <a href="chat.html" class="side-menu__item">Chat</a>
                            </li>
                            <li class="slide">
                                <a href="contacts.html" class="side-menu__item">Contacts</a>
                            </li>
                            <li class="slide">
                                <a href="contact-us.html" class="side-menu__item">Contact Us</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Blog
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="blog.html" class="side-menu__item">Blog</a>
                                    </li>
                                    <li class="slide">
                                        <a href="blog-details.html" class="side-menu__item">Blog Details</a>
                                    </li>
                                    <li class="slide">
                                        <a href="blog-create.html" class="side-menu__item">Create Blog</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Email
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="mail.html" class="side-menu__item">Mail App</a>
                                    </li>
                                    <li class="slide">
                                        <a href="mail-settings.html" class="side-menu__item">Mail Settings</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a href="empty.html" class="side-menu__item">Empty</a>
                            </li>
                            <li class="slide">
                                <a href="faq's.html" class="side-menu__item">FAQ's</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Invoice
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="invoice-create.html" class="side-menu__item">Create Invoice</a>
                                    </li>
                                    <li class="slide">
                                        <a href="invoice-details.html" class="side-menu__item">Invoice Details</a>
                                    </li>
                                    <li class="slide">
                                        <a href="invoice-list.html" class="side-menu__item">Invoice List</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a href="landing.html" class="side-menu__item">Landing</a>
                            </li>
                            <li class="slide">
                                <a href="landing-jobs.html" class="side-menu__item">Jobs Landing</a>
                            </li>
                            <li class="slide">
                                <a href="notifications.html" class="side-menu__item">Notifications</a>
                            </li>
                            <li class="slide">
                                <a href="pricing.html" class="side-menu__item">Pricing</a>
                            </li>
                            <li class="slide">
                                <a href="reviews.html" class="side-menu__item">Reviews</a>
                            </li>
                            <li class="slide">
                                <a href="search-page.html" class="side-menu__item">Search Page</a>
                            </li>
                            <li class="slide">
                                <a href="team.html" class="side-menu__item">Team</a>
                            </li>
                            <li class="slide">
                                <a href="terms_conditions.html" class="side-menu__item">Terms & Conditions</a>
                            </li>
                            <li class="slide">
                                <a href="timeline.html" class="side-menu__item">Timeline</a>
                            </li>
                            <li class="slide">
                                <a href="to-do-list.html" class="side-menu__item">To Do List</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M216,96v96a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V96Z" opacity="0.2"/><rect x="24" y="56" width="208" height="40" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M216,96v96a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="104" y1="136" x2="152" y2="136" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Ui Elements</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1 mega-menu">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Ui Elements</a>
                            </li>
                            <li class="slide">
                                <a href="alerts.html" class="side-menu__item">Alerts</a>
                            </li>
                            <li class="slide">
                                <a href="badge.html" class="side-menu__item">Badge</a>
                            </li>
                            <li class="slide">
                                <a href="breadcrumb.html" class="side-menu__item">Breadcrumb</a>
                            </li>
                            <li class="slide">
                                <a href="buttons.html" class="side-menu__item">Buttons</a>
                            </li>
                            <li class="slide">
                                <a href="buttongroup.html" class="side-menu__item">Button Group</a>
                            </li>
                            <li class="slide">
                                <a href="cards.html" class="side-menu__item">Cards</a>
                            </li>
                            <li class="slide">
                                <a href="dropdowns.html" class="side-menu__item">Dropdowns</a>
                            </li>
                            <li class="slide">
                                <a href="images_figures.html" class="side-menu__item">Images & Figures</a>
                            </li>
                            <li class="slide">
                                <a href="links_interactions.html" class="side-menu__item">Links & Interactions</a>
                            </li>
                            <li class="slide">
                                <a href="listgroup.html" class="side-menu__item">List Group</a>
                            </li>
                            <li class="slide">
                                <a href="navs_tabs.html" class="side-menu__item">Navs & Tabs</a>
                            </li>
                            <li class="slide">
                                <a href="object-fit.html" class="side-menu__item">Object Fit</a>
                            </li>
                            <li class="slide">
                                <a href="pagination.html" class="side-menu__item">Pagination</a>
                            </li>
                            <li class="slide">
                                <a href="popovers.html" class="side-menu__item">Popovers</a>
                            </li>
                            <li class="slide">
                                <a href="progress.html" class="side-menu__item">Progress</a>
                            </li>
                            <li class="slide">
                                <a href="spinners.html" class="side-menu__item">Spinners</a>
                            </li>
                            <li class="slide">
                                <a href="toasts.html" class="side-menu__item">Toasts</a>
                            </li>
                            <li class="slide">
                                <a href="tooltips.html" class="side-menu__item">Tooltips</a>
                            </li>
                            <li class="slide">
                                <a href="typography.html" class="side-menu__item">Typography</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M128,32A96,96,0,0,0,63.8,199.38h0A72,72,0,0,1,128,160a40,40,0,1,1,40-40,40,40,0,0,1-40,40,72,72,0,0,1,64.2,39.37A96,96,0,0,0,128,32Z" opacity="0.2"/><circle cx="128" cy="120" r="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M63.8,199.37a72,72,0,0,1,128.4,0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="200 128 224 152 248 128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="8 128 32 104 56 128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M32,104v24a96,96,0,0,0,174,56" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M224,152V128A96,96,0,0,0,50,72" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Authentication</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Authentication</a>
                            </li>
                            <li class="slide">
                                <a href="coming-soon.html" class="side-menu__item">Coming Soon</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Create Password
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="create-password-basic.html" class="side-menu__item">Basic</a>
                                    </li>
                                    <li class="slide">
                                        <a href="create-password-cover.html" class="side-menu__item">Cover</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Lock Screen
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="lockscreen-basic.html" class="side-menu__item">Basic</a>
                                    </li>
                                    <li class="slide">
                                        <a href="lockscreen-cover.html" class="side-menu__item">Cover</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Reset Password
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="reset-password-basic.html" class="side-menu__item">Basic</a>
                                    </li>
                                    <li class="slide">
                                        <a href="reset-password-cover.html" class="side-menu__item">Cover</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Sign Up
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="sign-up-basic.html" class="side-menu__item">Basic</a>
                                    </li>
                                    <li class="slide">
                                        <a href="sign-up-cover.html" class="side-menu__item">Cover</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Sign In
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="sign-in-basic.html" class="side-menu__item">Basic</a>
                                    </li>
                                    <li class="slide">
                                        <a href="sign-in-cover.html" class="side-menu__item">Cover</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Two Step Verification
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="two-step-verification-basic.html" class="side-menu__item">Basic</a>
                                    </li>
                                    <li class="slide">
                                        <a href="two-step-verification-cover.html" class="side-menu__item">Cover</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a href="under-maintenance.html" class="side-menu__item">Under Maintenance</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M142.41,40.22l87.46,151.87C236,202.79,228.08,216,215.46,216H40.54C27.92,216,20,202.79,26.13,192.09L113.59,40.22C119.89,29.26,136.11,29.26,142.41,40.22Z" opacity="0.2"/><path d="M142.41,40.22l87.46,151.87C236,202.79,228.08,216,215.46,216H40.54C27.92,216,20,202.79,26.13,192.09L113.59,40.22C119.89,29.26,136.11,29.26,142.41,40.22Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="128" y1="144" x2="128" y2="104" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><circle cx="128" cy="180" r="12"/></svg>
                            <span class="side-menu__label">Error</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Error</a>
                            </li>
                            <li class="slide">
                                <a href="401-error.html" class="side-menu__item">401 - Error</a>
                            </li>
                            <li class="slide">
                                <a href="404-error.html" class="side-menu__item">404 - Error</a>
                            </li>
                            <li class="slide">
                                <a href="500-error.html" class="side-menu__item">500 - Error</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="152" y="40" width="56" height="168" opacity="0.2"/><polyline points="48 208 48 136 96 136" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="224" y1="208" x2="32" y2="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="96 208 96 88 152 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="152 208 152 40 208 40 208 208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Charts</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Charts</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Apex Charts
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="apex-line-charts.html" class="side-menu__item">Line Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-area-charts.html" class="side-menu__item">Area Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-column-charts.html" class="side-menu__item">Column Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-bar-charts.html" class="side-menu__item">Bar Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-mixed-charts.html" class="side-menu__item">Mixed Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-rangearea-charts.html" class="side-menu__item">Range Area Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-timeline-charts.html" class="side-menu__item">Timeline Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-funnel-charts.html" class="side-menu__item">Funnel Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-candlestick-charts.html" class="side-menu__item">CandleStick
                                            Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-boxplot-charts.html" class="side-menu__item">Boxplot Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-bubble-charts.html" class="side-menu__item">Bubble Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-scatter-charts.html" class="side-menu__item">Scatter Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-heatmap-charts.html" class="side-menu__item">Heatmap Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-treemap-charts.html" class="side-menu__item">Treemap Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-pie-charts.html" class="side-menu__item">Pie Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-radialbar-charts.html" class="side-menu__item">Radialbar Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-radar-charts.html" class="side-menu__item">Radar Charts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="apex-polararea-charts.html" class="side-menu__item">Polararea Charts</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a href="chartjs-charts.html" class="side-menu__item">Chartjs Charts</a>
                            </li>
                            <li class="slide">
                                <a href="echarts.html" class="side-menu__item">Echart Charts</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="48" y="48" width="64" height="64" rx="8" opacity="0.2"/><rect x="144" y="48" width="64" height="64" rx="8" opacity="0.2"/><rect x="48" y="144" width="64" height="64" rx="8" opacity="0.2"/><rect x="144" y="144" width="64" height="64" rx="8" opacity="0.2"/><rect x="144" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="48" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="144" y="48" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="48" y="144" width="64" height="64" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Apps</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Apps</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">File Manager
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="file-manager.html" class="side-menu__item">File Manager</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Ecommerce
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="add-products.html" class="side-menu__item">Add Products</a>
                                    </li>
                                    <li class="slide">
                                        <a href="cart.html" class="side-menu__item">Cart</a>
                                    </li>
                                    <li class="slide">
                                        <a href="checkout.html" class="side-menu__item">Checkout</a>
                                    </li>
                                    <li class="slide">
                                        <a href="edit-products.html" class="side-menu__item">Edit Products</a>
                                    </li>
                                    <li class="slide">
                                        <a href="order-details.html" class="side-menu__item">Order Details</a>
                                    </li>
                                    <li class="slide">
                                        <a href="orders.html" class="side-menu__item">Orders</a>
                                    </li>
                                    <li class="slide">
                                        <a href="products.html" class="side-menu__item">Products</a>
                                    </li>
                                    <li class="slide">
                                        <a href="product-details.html" class="side-menu__item">Product Details</a>
                                    </li>
                                    <li class="slide">
                                        <a href="products-list.html" class="side-menu__item">Products List</a>
                                    </li>
                                    <li class="slide">
                                        <a href="wishlist.html" class="side-menu__item">Wishlist</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a href="full-calendar.html" class="side-menu__item">Full Calendar</a>
                            </li>
                            <li class="slide">
                                <a href="gallery.html" class="side-menu__item">Gallery</a>
                            </li>
                            <li class="slide">
                                <a href="sweet_alerts.html" class="side-menu__item">Sweet Alerts</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Projects
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="projects-create.html" class="side-menu__item">Create Project</a>
                                    </li>
                                    <li class="slide">
                                        <a href="projects-list.html" class="side-menu__item">Projects List</a>
                                    </li>
                                    <li class="slide">
                                        <a href="projects-overview.html" class="side-menu__item">Project Overview</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Crypto
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="crypto-buy_sell.html" class="side-menu__item">Buy & Sell</a>
                                    </li>
                                    <li class="slide">
                                        <a href="crypto-marketcap.html" class="side-menu__item">Marketcap</a>
                                    </li>
                                    <li class="slide">
                                        <a href="crypto-wallet.html" class="side-menu__item">Wallet</a>
                                    </li>
                                    <li class="slide">
                                        <a href="crypto-currency-exchange.html" class="side-menu__item">Currency Exchange</a>
                                    </li>
                                    <li class="slide">
                                        <a href="crypto-transactions.html" class="side-menu__item">Transactions</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Task
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="task-kanban-board.html" class="side-menu__item">Kanban Board</a>
                                    </li>
                                    <li class="slide">
                                        <a href="task-details.html" class="side-menu__item">Task Details</a>
                                    </li>
                                    <li class="slide">
                                        <a href="task-list-view.html" class="side-menu__item">List View</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">NFT
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="nft-create.html" class="side-menu__item">Create NFT</a>
                                    </li>
                                    <li class="slide">
                                        <a href="nft-details.html" class="side-menu__item">NFT Details</a>
                                    </li>
                                    <li class="slide">
                                        <a href="nft-marketplace.html" class="side-menu__item">Market Place</a>
                                    </li>
                                    <li class="slide">
                                        <a href="nft-live-auction.html" class="side-menu__item">Live Auction</a>
                                    </li>
                                    <li class="slide">
                                        <a href="nft-wallet-integration.html" class="side-menu__item">Wallet Integration</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">CRM
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="crm-companies.html" class="side-menu__item">Companies</a>
                                    </li>
                                    <li class="slide">
                                        <a href="crm-contacts.html" class="side-menu__item">Contacts</a>
                                    </li>
                                    <li class="slide">
                                        <a href="crm-leads.html" class="side-menu__item">Leads</a>
                                    </li>
                                    <li class="slide">
                                        <a href="crm-deals.html" class="side-menu__item">Deals</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Jobs
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="job-details.html" class="side-menu__item">Job Details</a>
                                    </li>
                                    <li class="slide">
                                        <a href="job-post.html" class="side-menu__item">Job Post</a>
                                    </li>
                                    <li class="slide">
                                        <a href="jobs-list.html" class="side-menu__item">Jobs List</a>
                                    </li>
                                    <li class="slide">
                                        <a href="job-candidate-search.html" class="side-menu__item">Search Candidate</a>
                                    </li>
                                    <li class="slide">
                                        <a href="job-candidate-details.html" class="side-menu__item">Candidate Details</a>
                                    </li>
                                    <li class="slide">
                                        <a href="job-company-search.html" class="side-menu__item">Search Company</a>
                                    </li>
                                    <li class="slide">
                                        <a href="job-search.html" class="side-menu__item">Search Jobs</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polygon points="32 80 128 136 224 80 128 24 32 80" opacity="0.2"/><polyline points="32 176 128 232 224 176" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="32 128 128 184 224 128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polygon points="32 80 128 136 224 80 128 24 32 80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Nested Menu</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Nested Menu</a>
                            </li>
                            <li class="slide">
                                <a href="javascript:void(0);" class="side-menu__item">Nested-1</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Nested-2
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="javascript:void(0);" class="side-menu__item">Nested-2.1</a>
                                    </li>
                                    <li class="slide has-sub">
                                        <a href="javascript:void(0);" class="side-menu__item">Nested-2.2
                                            <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                        <ul class="slide-menu child3">
                                            <li class="slide">
                                                <a href="javascript:void(0);" class="side-menu__item">Nested-2.2.1</a>
                                            </li>
                                            <li class="slide">
                                                <a href="javascript:void(0);" class="side-menu__item">Nested-2.2.2</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M128,36a92,92,0,1,0,92,92A92.1,92.1,0,0,0,128,36Z" opacity="0.2"/><line x1="128" y1="64" x2="128" y2="192" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="104 40 128 64 152 40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="104 216 128 192 152 216" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="72.57" y1="96" x2="183.43" y2="160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="40 104 72.57 96 64 64" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="192 192 183.43 160 216 152" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="72.57" y1="160" x2="183.43" y2="96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="64 192 72.57 160 40 152" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="216 104 183.43 96 192 64" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Advanced UI</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Advanced Ui</a>
                            </li>
                            <li class="slide">
                                <a href="accordions_collpase.html" class="side-menu__item">Accordions & Collapse</a>
                            </li>
                            <li class="slide">
                                <a href="carousel.html" class="side-menu__item">Carousel</a>
                            </li>
                            <li class="slide">
                                <a href="draggable-cards.html" class="side-menu__item">Draggable Cards</a>
                            </li>
                            <li class="slide">
                                <a href="modals_closes.html" class="side-menu__item">Modals & Closes</a>
                            </li>
                            <li class="slide">
                                <a href="navbar.html" class="side-menu__item">Navbar</a>
                            </li>
                            <li class="slide">
                                <a href="offcanvas.html" class="side-menu__item">Offcanvas</a>
                            </li>
                            <li class="slide">
                                <a href="placeholders.html" class="side-menu__item">Placeholders</a>
                            </li>
                            <li class="slide">
                                <a href="ratings.html" class="side-menu__item">Ratings</a>
                            </li>
                            <li class="slide">
                                <a href="ribbons.html" class="side-menu__item">Ribbons</a>
                            </li>
                            <li class="slide">
                                <a href="scrollspy.html" class="side-menu__item">Scrollspy</a>
                            </li>
                            <li class="slide">
                                <a href="swiperjs.html" class="side-menu__item">Swiper JS</a>
                            </li>
                            <li class="slide">
                                <a href="sortable-list.html" class="side-menu__item">Sortable JS</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><circle cx="128" cy="96" r="48" opacity="0.2"/><circle cx="128" cy="96" r="80" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><circle cx="128" cy="96" r="48" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="176 160 176 240 127.99 216 80 240 80 160.01" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Utilities</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Utilities</a>
                            </li>
                            <li class="slide">
                                <a href="avatars.html" class="side-menu__item">Avatars</a>
                            </li>
                            <li class="slide">
                                <a href="borders.html" class="side-menu__item">Borders</a>
                            </li>
                            <li class="slide">
                                <a href="breakpoints.html" class="side-menu__item">Breakpoints</a>
                            </li>
                            <li class="slide">
                                <a href="colors.html" class="side-menu__item">Colors</a>
                            </li>
                            <li class="slide">
                                <a href="columns.html" class="side-menu__item">Columns</a>
                            </li>
                            <li class="slide">
                                <a href="flex.html" class="side-menu__item">Flex</a>
                            </li>
                            <li class="slide">
                                <a href="gutters.html" class="side-menu__item">Gutters</a>
                            </li>
                            <li class="slide">
                                <a href="helpers.html" class="side-menu__item">Helpers</a>
                            </li>
                            <li class="slide">
                                <a href="position.html" class="side-menu__item">Position</a>
                            </li>
                            <li class="slide">
                                <a href="more.html" class="side-menu__item">Additional Content</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polygon points="152 32 152 88 208 88 152 32" opacity="0.2"/><path d="M200,224H56a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h96l56,56V216A8,8,0,0,1,200,224Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="152 32 152 88 208 88" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Forms</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Forms</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Form Elements
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="form_inputs.html" class="side-menu__item">Inputs</a>
                                    </li>
                                    <li class="slide">
                                        <a href="form_check_radios.html" class="side-menu__item">Checks & Radios</a>
                                    </li>
                                    <li class="slide">
                                        <a href="form_input_group.html" class="side-menu__item">Input Group</a>
                                    </li>
                                    <li class="slide">
                                        <a href="form_select.html" class="side-menu__item">Form Select</a>
                                    </li>
                                    <li class="slide">
                                        <a href="form_range.html" class="side-menu__item">Range Slider</a>
                                    </li>
                                    <li class="slide">
                                        <a href="form_input_masks.html" class="side-menu__item">Input Masks</a>
                                    </li>
                                    <li class="slide">
                                        <a href="form_file_uploads.html" class="side-menu__item">File Uploads</a>
                                    </li>
                                    <li class="slide">
                                        <a href="form_dateTime_pickers.html" class="side-menu__item">Date,Time Picker</a>
                                    </li>
                                    <li class="slide">
                                        <a href="form_color_pickers.html" class="side-menu__item">Color Pickers</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a href="form_advanced.html" class="side-menu__item">Form Advanced</a>
                            </li>
                            <li class="slide">
                                <a href="floating_labels.html" class="side-menu__item">Floating Labels</a>
                            </li>
                            <li class="slide">
                                <a href="form_layout.html" class="side-menu__item">Form Layouts</a>
                            </li>
                            <li class="slide">
                                <a href="form_wizards.html" class="side-menu__item">Form Wizards</a>
                            </li>
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">Form Editors
                                    <i class="fe fe-chevron-right side-menu__angle"></i></a>
                                <ul class="slide-menu child2">
                                    <li class="slide">
                                        <a href="quill_editor.html" class="side-menu__item">Quill Editor</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="slide">
                                <a href="form_validation.html" class="side-menu__item">Validation</a>
                            </li>
                            <li class="slide">
                                <a href="form_select2.html" class="side-menu__item">Select2</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide">
                        <a href="widgets.html" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M208,128v72a8,8,0,0,1-8,8H56a8,8,0,0,1-8-8V128Z" opacity="0.2"/><rect x="32" y="80" width="192" height="48" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M208,128v72a8,8,0,0,1-8,8H56a8,8,0,0,1-8-8V128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="128" y1="80" x2="128" y2="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M176.79,31.21c9.34,9.34,9.89,25.06,0,33.82C159.88,80,128,80,128,80s0-31.88,15-48.79C151.73,21.32,167.45,21.87,176.79,31.21Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M79.21,31.21c-9.34,9.34-9.89,25.06,0,33.82C96.12,80,128,80,128,80s0-31.88-15-48.79C104.27,21.32,88.55,21.87,79.21,31.21Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Widgets</span>
                        </a>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="48" y="48" width="160" height="160" rx="8" opacity="0.2"/><rect x="48" y="48" width="160" height="160" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="128" y1="48" x2="128" y2="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="48" y1="128" x2="208" y2="128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Tables</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Tables</a>
                            </li>
                            <li class="slide">
                                <a href="tables.html" class="side-menu__item">Tables</a>
                            </li>
                            <li class="slide">
                                <a href="grid-tables.html" class="side-menu__item">Grid JS Tables</a>
                            </li>
                            <li class="slide">
                                <a href="data-tables.html" class="side-menu__item">Data Tables</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide has-sub">
                        <a href="javascript:void(0);" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M128,24a80,80,0,0,0-80,80c0,72,80,128,80,128s80-56,80-128A80,80,0,0,0,128,24Zm0,112a32,32,0,1,1,32-32A32,32,0,0,1,128,136Z" opacity="0.2"/><circle cx="128" cy="104" r="32" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M208,104c0,72-80,128-80,128S48,176,48,104a80,80,0,0,1,160,0Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Maps</span>
                            <i class="fe fe-chevron-right side-menu__angle"></i>
                        </a>
                        <ul class="slide-menu child1">
                            <li class="slide side-menu__label1">
                                <a href="javascript:void(0)">Maps</a>
                            </li>
                            <li class="slide">
                                <a href="google-maps.html" class="side-menu__item">Google Maps</a>
                            </li>
                            <li class="slide">
                                <a href="leaflet-maps.html" class="side-menu__item">Leaflet Maps</a>
                            </li>
                            <li class="slide">
                                <a href="vector-maps.html" class="side-menu__item">Vector Maps</a>
                            </li>
                        </ul>
                    </li>
                    <!-- End::slide -->

                    <!-- Start::slide -->
                    <li class="slide">
                        <a href="icons.html" class="side-menu__item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M54,40H202a8,8,0,0,1,7.69,5.8L224,96H32L46.34,45.8A8,8,0,0,1,54,40Z" opacity="0.2"/><path d="M96,96v16a32,32,0,0,1-64,0V96Z" opacity="0.2"/><path d="M224,96v16a32,32,0,0,1-64,0V96Z" opacity="0.2"/><path d="M48,139.59V208a8,8,0,0,0,8,8H200a8,8,0,0,0,8-8V139.59" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M54,40H202a8,8,0,0,1,7.69,5.8L224,96H32L46.34,45.8A8,8,0,0,1,54,40Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M96,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M160,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M224,96v16a32,32,0,0,1-64,0V96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                            <span class="side-menu__label">Icons</span>
                        </a>
                    </li>
                    <!-- End::slide -->

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

            <!-- Start:: row-1 -->
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card custom-card">
                        <div class="top-left"></div>
                        <div class="top-right"></div>
                        <div class="bottom-left"></div>
                        <div class="bottom-right"></div>
                        <div class="card-body">
                            <div class="mb-3 d-flex align-items-start justify-content-between">
                                <div>
                                    <span class="text-fixed-white fs-11">New Events</span>
                                    <h4 class="text-fixed-white mb-0">13,278<span class="text-success fs-12 ms-2 fw-semibold d-inline-block"><i class="ti ti-trending-up align-middle me-1 d-inline-block"></i>0.25%</span></h4>
                                </div>
                                <div class="dropdown">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown" class="op-4">
                                        <i class="bi bi-grid text-primary"></i>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="new-issues"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card custom-card">
                        <div class="top-left"></div>
                        <div class="top-right"></div>
                        <div class="bottom-left"></div>
                        <div class="bottom-right"></div>
                        <div class="card-body">
                            <div class="mb-3 d-flex align-items-start justify-content-between">
                                <div>
                                    <span class="text-fixed-white fs-11">Completed Events</span>
                                    <h4 class="text-fixed-white mb-0">29,912<span class="text-danger fs-12 ms-2 fw-semibold"><i class="ti ti-trending-down align-middle me-1 d-inline-block"></i>0.25%</span></h4>
                                </div>
                                <div class="dropdown">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown" class="op-4">
                                        <i class="bi bi-grid text-primary"></i>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="completed-issues"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card custom-card">
                        <div class="top-left"></div>
                        <div class="top-right"></div>
                        <div class="bottom-left"></div>
                        <div class="bottom-right"></div>
                        <div class="card-body">
                            <div class="mb-3 d-flex align-items-start justify-content-between">
                                <div>
                                    <span class="text-fixed-white fs-11">Pending Events</span>
                                    <h4 class="text-fixed-white mb-0">1,214<span class="text-success fs-12 ms-2 fw-semibold d-inline-block"><i class="ti ti-trending-up align-middle me-1 d-inline-block"></i>0.25%</span></h4>
                                </div>
                                <div class="dropdown">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown" class="op-4">
                                        <i class="bi bi-grid text-primary"></i>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="pending-issues"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card custom-card">
                        <div class="top-left"></div>
                        <div class="top-right"></div>
                        <div class="bottom-left"></div>
                        <div class="bottom-right"></div>
                        <div class="card-body">
                            <div class="mb-3 d-flex align-items-start justify-content-between">
                                <div>
                                    <span class="text-fixed-white fs-11">Unresolved Events</span>
                                    <h4 class="text-fixed-white mb-0">563<span class="text-success fs-12 ms-2 fw-semibold d-inline-block"><i class="ti ti-trending-up align-middle me-1 d-inline-block"></i>0.25%</span></h4>
                                </div>
                                <div class="dropdown">
                                    <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown" class="op-4">
                                        <i class="bi bi-grid text-primary"></i>
                                    </a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="unresolved-issues"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: row-1 -->

            <!-- Start:: row-2 -->
            <div class="row">
                <div class="col-xxl-6 col-xl-12">
                    <div class="card custom-card">
                        <div class="top-left"></div>
                        <div class="top-right"></div>
                        <div class="bottom-left"></div>
                        <div class="bottom-right"></div>
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Distance Covered
                            </div>
                            <div class="dropdown">
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown" class="op-4">
                                    <i class="bi bi-grid text-primary"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="distance-covered-content container">
                                <div class="row gy-3">
                                    <div class="col-xl-5 col-sm-4 col-12">
                                        <div class="d-flex align-items-center gap-1">
                                            <div id="safe-zones"></div>
                                            <div class="flex-fill">
                                                <span class="d-block fs-12">Safe Zone</span>
                                                <h4 class="fw-medium mb-1">32.17H</h4>
                                                <div class="progress rounded-0 custom-progress-padding progress-sm border border-primary border-opacity-10" role="progressbar" aria-label="Basic example" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 65%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-sm-4 col-12">
                                        <div class="d-flex align-items-center gap-1">
                                            <div id="danger-zones"></div>
                                            <div class="flex-fill">
                                                <span class="d-block fs-12">Danger Zone</span>
                                                <h4 class="fw-medium mb-1">18.65H</h4>
                                                <div class="progress rounded-0 custom-progress-padding progress-sm border border-primary border-opacity-10" role="progressbar" aria-label="Basic example" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-danger" style="width: 65%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="distance-covered"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6">
                    <div class="card custom-card">
                        <div class="top-left"></div>
                        <div class="top-right"></div>
                        <div class="bottom-left"></div>
                        <div class="bottom-right"></div>
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Skills Achieved
                            </div>
                            <a href="javascript:void(0);" class="badge bg-primary-transparent border border-primary border-opacity-10 rounded-0">View All</a>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 skills-achieved-list">
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="d-flex align-items-center justify-content-between mb-1 fs-13">
                                            <div>
                                                Epic Button Masher
                                            </div>
                                            <div>65%</div>
                                        </div>
                                        <div>
                                            <div class="progress rounded-0 progress-sm border border-primary border-opacity-10 custom-progress-padding" role="progressbar" aria-label="Basic example" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar" style="width: 65%"><div class="progress-before"></div></div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="d-flex align-items-center justify-content-between mb-1 fs-13">
                                            <div>
                                                Alertness Alchemist
                                            </div>
                                            <div>58%</div>
                                        </div>
                                        <div>
                                            <div class="progress rounded-0 progress-sm border border-primary border-opacity-10 custom-progress-padding" role="progressbar" aria-label="Basic example" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar" style="width: 58%"><div class="progress-before"></div></div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="d-flex align-items-center justify-content-between mb-1 fs-13">
                                            <div>
                                                Resolution Wizard
                                            </div>
                                            <div>37%</div>
                                        </div>
                                        <div>
                                            <div class="progress rounded-0 progress-sm border border-primary border-opacity-10 custom-progress-padding" role="progressbar" aria-label="Basic example" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar" style="width: 37%"><div class="progress-before"></div></div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="d-flex align-items-center justify-content-between mb-1 fs-13">
                                            <div>
                                                Dropdown Diviner
                                            </div>
                                            <div>48%</div>
                                        </div>
                                        <div>
                                            <div class="progress rounded-0 progress-sm border border-primary border-opacity-10 custom-progress-padding" role="progressbar" aria-label="Basic example" aria-valuenow="48" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar" style="width: 48%"><div class="progress-before"></div></div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="d-flex align-items-center justify-content-between mb-1 fs-13">
                                            <div>
                                                Modal Maestro
                                            </div>
                                            <div>22%</div>
                                        </div>
                                        <div>
                                            <div class="progress rounded-0 progress-sm border border-primary border-opacity-10 custom-progress-padding" role="progressbar" aria-label="Basic example" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar" style="width: 22%"><div class="progress-before"></div></div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6">
                    <div class="card custom-card">
                        <div class="top-left"></div>
                        <div class="top-right"></div>
                        <div class="bottom-left"></div>
                        <div class="bottom-right"></div>
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Energy Block
                            </div>
                            <div class="dropdown">
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown" class="op-4">
                                    <i class="bi bi-grid text-primary"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body px-1">
                            <div id="energy-block"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: row-2 -->

            <!-- Start:: row-3 -->
            <div class="row">
                <div class="col-xxl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="card custom-card">
                        <div class="top-left"></div>
                        <div class="top-right"></div>
                        <div class="bottom-left"></div>
                        <div class="bottom-right"></div>
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Air Support
                            </div>
                            <div class="dropdown">
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown" class="op-4">
                                    <i class="bi bi-grid text-primary"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="air-support"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-5 col-lg-6 col-md-6 col-sm-12">
                    <div class="card custom-card">
                        <div class="top-left"></div>
                        <div class="top-right"></div>
                        <div class="bottom-left"></div>
                        <div class="bottom-right"></div>
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Player Statistics
                            </div>
                            <a href="javascript:void(0);" class="badge bg-primary-transparent border border-primary border-opacity-10 rounded-0">View All</a>
                        </div>
                        <div class="card-body player-statistics">
                            <div class="table-responsive">
                                <table class="table text-nowrap table-borderless table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Player</th>
                                        <th scope="col">Score</th>
                                        <th scope="col">Performance</th>
                                        <th scope="col">Objective </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">Harshrath</th>
                                        <td>
                                            <span class="fs-15 fw-medium">1200</span>
                                        </td>
                                        <td><div id="player1-stats"></div></td>
                                        <td><span class="text-primary">Defeat Boss</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Zozo Hadid</th>
                                        <td>
                                            <span class="fs-15 fw-medium">950</span>
                                        </td>
                                        <td><div id="player2-stats"></div></td>
                                        <td><span class="text-primary">In Progress</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Martiana</th>
                                        <td>
                                            <span class="fs-15 fw-medium">1800</span>
                                        </td>
                                        <td><div id="player3-stats"></div></td>
                                        <td><span class="text-primary">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Reva Shaan</th>
                                        <td>
                                            <span class="fs-15 fw-medium">1100</span>
                                        </td>
                                        <td><div id="player4-stats"></div></td>
                                        <td><span class="text-primary">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Reva Shaan</th>
                                        <td>
                                            <span class="fs-15 fw-medium">1500</span>
                                        </td>
                                        <td><div id="player5-stats"></div></td>
                                        <td><span class="text-primary">Pending</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="card custom-card">
                        <div class="top-left"></div>
                        <div class="top-right"></div>
                        <div class="bottom-left"></div>
                        <div class="bottom-right"></div>
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Total Time Spent
                            </div>
                            <div class="dropdown">
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown" class="op-4">
                                    <i class="bi bi-grid text-primary"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="time-spent"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="card custom-card">
                        <div class="top-left"></div>
                        <div class="top-right"></div>
                        <div class="bottom-left"></div>
                        <div class="bottom-right"></div>
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Civilian Population
                            </div>
                            <div class="dropdown">
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown" class="op-4">
                                    <i class="bi bi-grid text-primary"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="civilian-population-support"></div>
                            <div id="civilian-population"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="card custom-card">
                        <div class="top-left"></div>
                        <div class="top-right"></div>
                        <div class="bottom-left"></div>
                        <div class="bottom-right"></div>
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Top Countries
                            </div>
                            <div class="dropdown">
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown" class="op-4">
                                    <i class="bi bi-grid text-primary"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="top-country"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="card custom-card">
                        <div class="top-left"></div>
                        <div class="top-right"></div>
                        <div class="bottom-left"></div>
                        <div class="bottom-right"></div>
                        <div class="card-header justify-content-between">
                            <div class="card-title">
                                Top Players
                            </div>
                            <div class="dropdown">
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="dropdown" class="op-4">
                                    <i class="bi bi-grid text-primary"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Day</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="users-report"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End:: row-3 -->

        </div>
    </div>
    <!-- End::app-content -->


    <!-- Footer Start -->
    <footer class="footer mt-auto py-3 text-center">
        <div class="container">
        <span class="text-muted"> Copyright © <span id="year"></span> <a
                href="javascript:void(0);" class="text-dark fw-medium">SciFi</a>.
            Designed with <span class="ri-heart-fill text-danger"></span> by <a href="javascript:void(0);">
                <span class="fw-medium text-primary text-decoration-underline">Spruko</span>
            </a> All
            rights
            reserved
        </span>
        </div>
    </footer>
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
                                                <img alt="avatar" class="shadow" src="../assets/images/faces/5.jpg">
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
                                                <img alt="avatar" class="shadow" src="../assets/images/faces/9.jpg">
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
                                                <img alt="avatar" class="shadow" src="../assets/images/faces/8.jpg">
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
                                                <img alt="avatar" class="shadow" src="../assets/images/faces/3.jpg">
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
                                                <img alt="avatar" class="shadow" src="../assets/images/faces/10.jpg">
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
                                                <img alt="avatar" class="shadow" src="../assets/images/faces/14.jpg">
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
                                                <img alt="avatar" class="shadow" src="../assets/images/faces/7.jpg">
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
                                                <img alt="avatar" class="shadow" src="../assets/images/faces/4.jpg">
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
                                                <img alt="avatar" class="shadow" src="../assets/images/faces/12.jpg">
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
                                                <img alt="avatar" class="shadow" src="../assets/images/faces/13.jpg">
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
                                    <img src="../assets/images/media/media-67.jpg" alt="">
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
                                    <img src="../assets/images/media/media-66.png" alt="">
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

<!-- Popper JS -->
<script src="../assets/libs/@popperjs/core/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Defaultmenu JS -->
<script src="../assets/js/defaultmenu.min.js"></script>

<!-- Node Waves JS-->
<script src="../assets/libs/node-waves/waves.min.js"></script>

<!-- Sticky JS -->
<script src="../assets/js/sticky.js"></script>

<!-- Simplebar JS -->
<script src="../assets/libs/simplebar/simplebar.min.js"></script>
<script src="../assets/js/simplebar.js"></script>

<!-- Color Picker JS -->
<script src="../assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>


<!-- Apex Charts JS -->
<script src="../assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- JSVector Maps JS -->
<script src="../assets/libs/jsvectormap/js/jsvectormap.min.js"></script>

<!-- JSVector Maps MapsJS -->
<script src="../assets/libs/jsvectormap/maps/world-merc.js"></script>

<!-- Dashboard -->
<script src="../assets/js/gaming-dashboard.js"></script>

<!-- Custom JS -->
<script src="../assets/js/custom.js"></script>


<!-- Custom-Switcher JS -->
<script src="../assets/js/custom-switcher.min.js"></script>

</body>

</html>
