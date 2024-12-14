@extends('web.layout')
@section('title', "Gmail's Messages into an Organised Document")
@push('extra-styles')
<link href="{{ asset('./web/assets/css/pages/homepage.css') }}" rel="stylesheet">
<link href="{{ asset('web/assets/css/homepage.css?time=' . time()) }}" rel="stylesheet">
<style>
    ::-webkit-scrollbar {
        width: 2px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: rgba(178, 201, 241, 0.21);
    }


    @media only screen and (max-width: 600px) {
        #download-loader {
            max-width: 320px;
        }

        /*.popup {*/
        /*    top: 49.5%!important;*/
        /*    left: 50%!important;*/
        /*    width: 91%!important;*/
        /*    z-index: 1000!important;*/
        /*    padding: 20px!important;*/
        /*    height: 577px!important;*/
        /*}*/

        .popup-content {
            width: 98% !important;
            margin: 1% auto !important;
            height: 520px !important;
        }

        .close {
            top: 13px;
        }
    }

    section.email-section .email-extract-form .dropdown {
        z-index: 1 !important;
    }

    /* Center the modal vertically and horizontally */
    .modal.fade .modal-dialog-centered {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        /* Full height */
    }

    .lds-roller {
        /* change color here */
        color: #FF6704;
    }

    .lds-roller,
    .lds-roller div,
    .lds-roller div:after {
        box-sizing: border-box;
    }

    .lds-roller {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-roller div {
        animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        transform-origin: 40px 40px;
    }

    .lds-roller div:after {
        content: " ";
        display: block;
        position: absolute;
        width: 7.2px;
        height: 7.2px;
        border-radius: 50%;
        background: currentColor;
        margin: -3.6px 0 0 -3.6px;
    }

    .lds-roller div:nth-child(1) {
        animation-delay: -0.036s;
    }

    .lds-roller div:nth-child(1):after {
        top: 62.62742px;
        left: 62.62742px;
    }

    .lds-roller div:nth-child(2) {
        animation-delay: -0.072s;
    }

    .lds-roller div:nth-child(2):after {
        top: 67.71281px;
        left: 56px;
    }

    .lds-roller div:nth-child(3) {
        animation-delay: -0.108s;
    }

    .lds-roller div:nth-child(3):after {
        top: 70.90963px;
        left: 48.28221px;
    }

    .lds-roller div:nth-child(4) {
        animation-delay: -0.144s;
    }

    .lds-roller div:nth-child(4):after {
        top: 72px;
        left: 40px;
    }

    .lds-roller div:nth-child(5) {
        animation-delay: -0.18s;
    }

    .lds-roller div:nth-child(5):after {
        top: 70.90963px;
        left: 31.71779px;
    }

    .lds-roller div:nth-child(6) {
        animation-delay: -0.216s;
    }

    .lds-roller div:nth-child(6):after {
        top: 67.71281px;
        left: 24px;
    }

    .lds-roller div:nth-child(7) {
        animation-delay: -0.252s;
    }

    .lds-roller div:nth-child(7):after {
        top: 62.62742px;
        left: 17.37258px;
    }

    .lds-roller div:nth-child(8) {
        animation-delay: -0.288s;
    }

    .lds-roller div:nth-child(8):after {
        top: 56px;
        left: 12.28719px;
    }

    @keyframes lds-roller {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .hidden {
        display: none;
    }
    .form-check-input[type="radio"] {
        width: 21px;
        height: 21px;
        appearance: none; 
        border: 3px solid #aaa;
        border-radius: 50%;
        background-color: white; 
        outline: none;
        cursor: pointer;
        position: relative;
        transition: all 0.3s ease;
    }

    .form-check-input[type="radio"]:checked {
        border-color: #aaa;
        background-color: white;
    }

   
    .form-check-input[type="radio"]:checked::after {
        content: '';
        width: 12px; 
        height: 12px;
        background-color: green;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); 
    }
</style>
@endpush

@section('content')
{{-- <section class="gmail-services-msg">
        <div class="container">
            <div class="row">
                <div class="card shadow">
                    <p class="paragraph">
                        <strong>{{ localize('google_api_services_notice') }}</strong>
{{ localize('google_api_services_notice') }} <a
    href="https://developers.google.com/terms/api-services-user-data-policy#additional_requirements_for_specific_api_scopes"
    target="_blank">{{ localize('google_api_services') }}</a>.
<a href="{{ route('web.page', ['slug' => 'google-api-services']) }}"
    class="read-link">{{ localize('read_more') }}</a>
</p>
</div>
</div>
</div>
</section> --}}

<!-- Email Extracting Form Section -->
<section class="email-section">
    <div class="container">
        <div class="row">
            <div class="email-extract-form shadow">

                {{-- <button id="paymentButton">Login</button>--}}
                @include('includes.partials._overlay-gmail')
                {{-- @include('includes.partials._download-section')--}}

                @include('includes.partials._overlay-microSoft')

                {{-- success pop-up for 100+ messages --}}
                @include("web.pages.dialog.success-job-100-plus")

                <div class="float-end" style="text-align: right; margin-top: 6px; xmargin-right: 15px; xmargin-left:10px">
                @if (!LaravelGmail::check() && !session('userName'))
                    <a href="#" id="social-login-button" class="btn btn-sm shadow-sm" title="Sign in" style="background: #999903; color: #ffffff; font-size: 1.2rem; font-weight: 600;margin-left: 10px;">
                        <i class="fa-solid fa-user" style="margin-right: 8px;"></i>Sign in
                    </a>
                    @endif
                </div>



                @if(LaravelGmail::check())
                <div class="dropdown float-end">
                    <h3 class="user-account-title">
                        <img src="{{ asset('web/assets/img/gmail.png') }}" alt="gmail"> | {{ localize('logged_as') }} {{ LaravelGmail::user() }}
                    </h3>
                    <a href="#"
                        class="dropdown-toggle arrow-none card-drop"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        title="MyAccount"></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="{{ url('oauth/gmail/logout') }}"
                            class="dropdown-item danger-link">
                            <i class="fa-solid fa-power-off text-danger"></i>
                            {{ localize('logout') }}
                        </a>
                    </div>
                </div>
                @endif

                @if(session('userName'))
                <div class="dropdown float-end">
                    <h3 class="user-account-title">
                        <img src="{{ asset('web/assets/img/outlook.png') }}"
                            loading="lazy"
                            alt="gmail"> | {{ localize('logged_as') }} {{ session('userEmail') }}
                    </h3>
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                        aria-expanded="false" title="MyAccount"></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="{{ url('microsoft/signout') }}" class="dropdown-item danger-link"><i
                                class="fa-solid fa-power-off text-danger"></i> {{ localize('logout') }}</a>
                    </div>
                </div>
                @endif

                {{--privacy policy--}}

                @include("web.pages.includes.nav")

                {{-- Tab Content --}}
                @include("web.pages.includes.tab")
            </div>
        </div>
    </div>
</section>


<!-- download alert model when message up to 100 -->
<div class="modal fade" id="downloadAlertModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" style="margin-top: 20%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    <h3> {{ localize('please_wait_download_link') }}</h3>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- About site video display area -->
@include('includes.partials._video')

<!-- Site features section -->
@include("web.pages.includes.site-feature")

<!-- Site testimonials by clients area -->
@include("web.pages.includes.client-area")

<!-- Latest blog area -->
@include("web.pages.includes.blog-area")

{{-- Modal --}}
@include("web.pages.modal.download-modal")

{{-- Pop-up --}}
@include("web.pages.dialog.payment-dialog")

{{-- Refund popup --}}
@include("web.pages.dialog.refund-dialog")

{{-- Regenerate pdf popup --}}
@include("web.pages.dialog.regenerate-pdf-dialog")

@endsection
@push('extra-scripts')
{{-- <script src="{{ asset('web/assets/js/jquery.min.js') }}"></script>--}}

@include("web.pages.js")

@php
$time = time();
@endphp
<script src="{{ asset('web/assets/js/google-signin-email-extract.js?v='.$time) }}"></script>
<script src="{{ asset('web/assets/js/outlook-signin-email-extract.js?v='.$time) }}"></script>
<script src="{{ asset('web/assets/js/pages/homepage.js?v='.$time) }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var socialLoginButton = document.getElementById('social-login-button');
        if (socialLoginButton) {
            socialLoginButton.addEventListener('click', function() {
                var socialTab = document.getElementById('nav-social-tab');
                if (socialTab) {
                    socialTab.classList.add('d-none');
                    var tabs = document.querySelectorAll('.nav-link');
                    tabs.forEach(function(tab) {
                        tab.classList.remove('active');
                    });
                    socialTab.classList.add('active');
                    var tabContents = document.querySelectorAll('.tab-pane');
                    tabContents.forEach(function(content) {
                        content.classList.remove('active', 'show');
                    });
                    var socialContent = document.getElementById('nav-social');
                    if (socialContent) {
                        socialContent.classList.add('active', 'show');
                    }
                }
            });
        }
    });
</script>
@endpush
