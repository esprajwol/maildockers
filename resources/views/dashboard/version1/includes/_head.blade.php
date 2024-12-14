<!-- Meta Data -->
<meta charset="UTF-8">
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ localize("Dashboard") }} @yield('title')</title>
<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
<meta name="Author" content="Spruko Technologies Private Limited">
<meta name="keywords" content="admin panel, admin, admin template, dashboard template, dashboard template bootstrap, crm dashboard, stocks dashboard, projects dashboard, sales dashboard, html template, html css templates, html dashboard, dashboard, bootstrap dashboard, template dashboard">

<!-- Favicon -->
<link rel="icon" href="{{asset('dashboard/version1/')}}/assets/images/brand-logos/favicon.ico" type="image/x-icon">

<!-- Choices JS -->
<script src="{{asset('dashboard/version1/')}}/assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- Main Theme Js -->
<script src="{{asset('dashboard/version1/')}}/assets/js/main.js"></script>

<!-- Bootstrap Css -->
<link id="style" href="{{asset('dashboard/version1/')}}/assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

<!-- Style Css -->
<link href="{{asset('dashboard/version1/')}}/assets/css/styles.css" rel="stylesheet" >

<!-- Icons Css -->
<link href="{{asset('dashboard/version1/')}}/assets/css/icons.css" rel="stylesheet" >

<!-- Node Waves Css -->
<link href="{{asset('dashboard/version1/')}}/assets/libs/node-waves/waves.min.css" rel="stylesheet" >

<!-- Simplebar Css -->
<link href="{{asset('dashboard/version1/')}}/assets/libs/simplebar/simplebar.min.css" rel="stylesheet" >

<!-- Color Picker Css -->
<link rel="stylesheet" href="{{asset('dashboard/version1/')}}/assets/libs/flatpickr/flatpickr.min.css">
<link rel="stylesheet" href="{{asset('dashboard/version1/')}}/assets/libs/@simonwep/pickr/themes/nano.min.css">

<!-- Choices Css -->
<link rel="stylesheet" href="{{asset('dashboard/version1/')}}/assets/libs/choices.js/public/assets/styles/choices.min.css">


<!-- Jsvector Maps -->
<link rel="stylesheet" href="{{asset('dashboard/version1/')}}/assets/libs/jsvectormap/css/jsvectormap.min.css">


@stack('extra-styles')
