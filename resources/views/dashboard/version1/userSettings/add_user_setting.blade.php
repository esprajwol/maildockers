@extends('dashboard.layouts.main')

@section('title', localize(' - Update Settings'))
@section('top-header', localize('Update Settings'))

@section('content')
    <form class="forms-sample"
          action="@if(isAdmin()) {{ route('admin.user-settings.store') }} @elseif(isDistributor()) {{ route('distributor.user-settings.store') }} @elseif(isPartner()) {{ route('partner.user-settings.store') }} @endif"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @include("dashboard.userSettings.form_user_setting")
    </form>
@stop
@push('extra-scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    @endpush
