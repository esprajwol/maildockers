<div class="overlay-layout" id="outlook-overlay-layout">
    <div class="row loading-dilog" id="outlook-loading-dilog">
        <div class="col">
            <div class="text-center">
                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
        </div>
    </div>

    <div class="row success-dilog" id="outlook-success-dilog">
        <div class="col">
            <i class="fa-solid fa-circle-check fa-2xl text-orange"></i>
            <p class="paragraph fw-bold">{{ localize('done') }}</p>
            <h3 class="title" style="color: #b19125;">
                We Found (<span id="data_count" class="data_count_ms">0</span>) Correspondences!
            </h3>

            <p>
                <form name="coupon_form" action="#" method="POST">
                    <input type="text" id="coupon_no_ms" class="form-control " name="coupon_no_ms" placeholder="Coupon Number" autocomplete="off">
                    <br>
                    <div id="coupon-success-ms" class="alert alert-success d-none">Valid Coupon</div>
                    <div id="coupon-error-ms" class="alert alert-danger d-none">Invalid Coupon</div>
                    <input type="hidden" id="your_email_coupon_ms" name="your_email_coupon_ms" value="{{session('userEmail')}}">
                </form>

            </p>

            <button class="showPrivacyPopUpMS btn btn-warning text-white"
                    id="generate-outlook-pdf-btn"
                    style="font-size: 16px; margin-top: 40px; background: #f96d13!important; font-weight: bold;">
                Generate PDF
            </button>
            <button class="btn btn-warning text-white"
                    id="retry-outlook-pdf-btn"
                    style="font-size: 16px; margin-top: 40px; background: #f96d13!important; font-weight: bold;">
                Try Again
            </button>
{{--            <a href="#" class="text-link" id="outlook-download-link" data-download-url="{{ route('web.download') }}" data-destroy-url="{{ route('web.destroy') }}">{{ localize('download_continue') }}</a>--}}
            <br>
{{--            <a href="#" class="text-link" id="outlook-download-link-with-logout" data-download-url="{{ route('web.download') }}" data-destroy-url="{{ route('web.destroy') }}" data-user-logout="{{ url('oauth/gmail/logout') }}">{{ localize('download_logout') }}</a>--}}
        </div>
    </div>


    <div class="row faild-dilog" id="outlook-faild-dilog">
        <div class="col">
            <h3 class="title-1" id="outlook-faild-dilog-msg">{{ localize('incorrect_email_warning') }}</h3>
            <h3 class="title-2">{{ localize('retry_prompt') }}</h3>
        </div>
    </div>
</div>
