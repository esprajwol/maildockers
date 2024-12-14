@php
    $sessionTotalMessages = session()->has("total_messages") ? session("total_messages") : 0;
@endphp

<div class="overlay-layout" id="success100PlusOverlayLayout">
    <div class="row success-dilog" id="success100-dilog">
        <div class="col">
            <i class="fa-solid fa-circle-check fa-2xl text-orange"></i>
            <h3 class="title">{{ localize('paid') }}</h3>

            <h3 class="title" style="color: #b19125; margin-top: 20px">
                {{localize('thank_you_for_choosing')}} <b>{{ config('app.name') }}</b> <br>
                {{localize('the_payment_was_successfully_received')}}
            </h3>
        </div>
    </div>
</div>
