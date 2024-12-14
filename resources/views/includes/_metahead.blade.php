<!DOCTYPE html>
<html dir="{{ getSession('lang-direction') }}" lang="{{ session('lang', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="3gX_o8kaS7-3yE1MQxAHDdCdp3z-o1FJ_y9mz2WQ3mI" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>LegalPDF - @yield('title')</title>
    <link rel="icon" href="{{ asset('web/assets/img/resize-image/favicon.ico') }}" sizes="32x32">
    <link rel="stylesheet" href="{{ asset('./web/assets/bootstrap-5.2.3-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./web/assets/fontawesome-free-6.4.0-web/css/all.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('./web/assets/jquery-ui-1.13.1/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./web/assets/css/main.css') }}">
    <link href="{{ asset('./web/assets/css/app.css') }}" rel="stylesheet">
    @stack('extra-styles')
</head>
