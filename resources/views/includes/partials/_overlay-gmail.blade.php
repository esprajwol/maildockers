<div class="overlay-layout" id="overlay-layout">
    <div class="row loading-dilog show-layer" id="loading-dilog">
        <div class="col">
            <div class="text-center">
                <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
        </div>
    </div>

    <div class="row success-dilog" id="success-dilog">
        <div class="col">
            <i class="fa-solid fa-circle-check fa-2xl text-orange"></i>
            <p class="paragraph fw-bold">{{ localize('done') }}</p>

            <h3 class="title" style="color: #b19125;">
                {{ localize('we_found') }} <span id="data_count"></span> {{ localize('correspondences') }}!
            </h3>

            <p>
                <form name="coupon_form" action="#" method="POST">
                    <input type="text" id="coupon_no" class="form-control " name="coupon_no" placeholder="{{ localize('coupon_number') }}" autocomplete="off">
                    <br>
                    <div id="coupon-success" class="alert alert-success d-none">{{ localize('valid_coupon') }} </div>
                    <div id="coupon-error" class="alert alert-danger d-none">{{ localize('invalid_coupon') }}</div>
                    <input type="hidden" id="your_email_coupon" name="your_email_coupon" value="{{LaravelGmail::user()}}">
                </form>

            </p>

            <button class="showPrivacyPopUp btn btn-warning text-white"
                    id="generate-gmail-pdf-btn"
                    style="font-size: 16px; margin-top: 40px; background: #f96d13!important; font-weight: bold;">
                {{ localize('generate_pdf') }}
            </button>

            <button class="btn btn-warning text-white"
                    id="retry-gmail-pdf-btn"
                    style="font-size: 16px; margin-top: 40px; background: #f96d13!important; font-weight: bold;">
                {{ localize('try_again') }}
            </button>

        {{-- <a href="#" class="text-link" id="download-link" data-download-url="{{ route('web.download') }}" data-destroy-url="{{ route('web.destroy') }}">{{ localize('download_continue') }}</a>--}}
            <br>
        </div>
    </div>

    <div class="row faild-dilog" id="faild-dilog">
        <div class="col">
            <h3 class="title-1" id="faild-dilog-msg">{{ localize('incorrect_email_warning') }}</h3>
            <h3 class="title-2">{{ localize('retry_prompt') }}</h3>
        </div>
    </div>
</div>


@push('extra-scripts')

    <script type="text/javascript">

    </script>

@endpush