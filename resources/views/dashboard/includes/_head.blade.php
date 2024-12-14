<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>{{ localize("Dashboard") }} @yield('title')</title>
<!-- plugins:css -->
<link rel="stylesheet" href="{{asset('dashboard/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
<link rel="stylesheet" href="{{asset('dashboard/assets/vendors/css/vendor.bundle.base.css')}}">
<link rel="stylesheet" href="{{asset('dashboard/assets/css/style.css')}}">
<!-- endinject -->
<!-- Layout styles -->
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
<!-- End layout styles -->
<link rel="shortcut icon" href="{{asset('logo/favicon.png')}}" />

{{--data table css--}}
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">


<style>

     .sidebar .nav .nav-item.nav-profile .nav-link .nav-profile-image {
        position: relative;
    }
    .availability-status.online {
        background: #1bcfb4;
    }
    .availability-status {
        position: absolute;
        width: 10px;
        height: 10px;
        border-radius: 100%;
        border: 2px solid #ffffff;
        bottom: 5px;
        right: -5px;
    }
    .navbar .navbar-brand-wrapper .navbar-brand img {
        height: auto;
    }
    .navbar .navbar-brand-wrapper .navbar-brand.brand-logo-mini img {
        width: 100%;
        margin-left: 36px;
    }
    .qr-holder > svg {
        width: 100%;
        height: auto;
        object-fit: contain;
    }
</style>

@stack('extra-styles')
