<div class="row success-dilog" id="outlook-success-dilog">
    <div class="col">
        <i class="fa-solid fa-circle-check fa-2xl text-orange"></i>
        <p class="paragraph">{{ localize('done') }}</p>
        {{-- <h3 class="title">{{ localize('doc_ready') }}</h3> --}}
        <h3 class="title text-success ">Total Message Found (<span id="data_count">0</span>)</h3>
        <form action="{{route('stripe.checkout.session')}}" method="POST" style="text-align: center">
            @csrf
            <button id="paymentButton" class="btn text-button" style="  font-size: 20px; color: #f96d13; font-weight: bold;">
                 Agree & Continue for Payment
                </button>
        </form>
        <button id="paymentButton"
                class="btn text-button"
                style="  font-size: 20px; color: #f96d13; font-weight: bold;">
                Pay £9.90 to Download PDF
        </button>
        {{-- <a href="#" class="text-link" id="outlook-download-link" data-download-url="{{ route('web.download') }}" data-destroy-url="{{ route('web.destroy') }}">{{ localize('download_continue') }}</a>--}}
        <br>
        {{-- <a href="#" class="text-link" id="outlook-download-link-with-logout" data-download-url="{{ route('web.download') }}" data-destroy-url="{{ route('web.destroy') }}" data-user-logout="{{ url('oauth/gmail/logout') }}">{{ localize('download_logout') }}</a>--}}
    </div>
</div>
