@extends('dashboard.version1.layouts.main')

@section('title', 'Update Partner Price')
@section('top-header', 'Update Partner Price')

@section('content')
    <form class="forms-sample" action="{{ route('partner.prices.update',["partner_id" =>$user->id]) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @include("dashboard.version1.partners.prices.form_price")
    </form>
@stop
