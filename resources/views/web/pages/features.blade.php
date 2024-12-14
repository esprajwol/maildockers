@extends('web.layout')
@section('title', ucfirst($metaTitle))
@push('extra-styles')
<link href="{{ asset('./web/assets/css/pages/features.css') }}" rel="stylesheet">
@endpush
@section('content')
<section>
    <div class="container">
        <div class="row">
            <h1 class="heading mb-4">{{ ucfirst($metaTitle) }}</h1>

            <div class="row flex-column flex-md-row card-item offset mt-3">
                <div class="col col-md-1 text-center">
                    <span class="">
                        <i aria-hidden="true" class="fas fa-fast-forward"></i>
                    </span>
                </div>
                <div class="col">
                    <h3 class="title">{{ localize('fast_free') }}</h3>
                    <p class="paragraph">
                        {{ localize('fast_free_description') }}
                    </p>
                </div>
            </div>

            <div class="row flex-column flex-md-row card-item">
                <div class="col col-md-1 text-center">
                    <span class="">
                        <i aria-hidden="true" class="far fa-check-circle"></i>
                    </span>
                </div>
                <div class="col">
                    <h3 class="title">{{ localize('trustworthy') }}</h3>
                    <p class="paragraph">
                        {{ localize('trustworthy_description') }}
                    </p>
                </div>
            </div>

            <div class="row flex-column flex-md-row card-item offset">
                <div class="col col-md-1 text-center">
                    <span class="">
                        <i aria-hidden="true" class="fas fa-stamp"></i>
                    </span>
                </div>
                <div class="col">
                    <h3 class="title">{{ localize('multilingual_any_mailbox') }}</h3>
                    <p class="paragraph">
                        {{ localize('multilingual_any_mailbox_description') }}
                    </p>
                </div>
            </div>

            <div class="row flex-column flex-md-row card-item">
                <div class="col col-md-1 text-center">
                    <span class="">
                        <i aria-hidden="true" class="fas fa-user-secret"></i>
                    </span>
                </div>
                <div class="col">
                    <h3 class="title">{{ localize('privacy_focus') }}</h3>
                    <p class="paragraph">
                        {{ localize('privacy_description') }}
                    </p>
                </div>
            </div>
        </div>
</section>
@endsection
